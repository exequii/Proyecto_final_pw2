<?php

class ReporteController
{

    private $printer;
    private $graphicPrinter;
    private $reporteModel;

    public function __construct($reporteModel, $printer, $graphicPrinter)
    {
        $this->printer = $printer;
        $this->graphicPrinter = $graphicPrinter;
        $this->reporteModel = $reporteModel;
    }

    public function getOcupacion(){
        if ($_SESSION['usuario'][0]['rol'] == 'ADMIN'){
            $data['usuario'] = $_SESSION['usuario'];
            $data['admin'] = $_SESSION['admin'];
        }else {
            header("Location: /");
        }

        $data['vuelos'] = $this->reporteModel->getVuelos();

        $nombres = array();
        $generales = array();
        $familiares = array();
        $suites = array();

        foreach ($data['vuelos'] as $vuelo) {
            array_push($nombres, $vuelo['origen'] . "/" . $vuelo['destino']);

            array_push($generales, $vuelo['cap_gen'] - $vuelo['general']);

            array_push($familiares, $vuelo['cap_fam'] - $vuelo['familiar']);

            array_push($suites, $vuelo['cap_sui'] - $vuelo['suite']);

        }
        //var_dump($generales,$familiares,$suites);
        //die();
        if(file_exists("./public/ocupacion.jpg")) {
            unlink("./public/ocupacion.jpg");
        }
        $this->graphicPrinter->imprimirBarras($nombres, $generales,$familiares,$suites);
        echo $this->printer->render( "view/admin/ocupacionView.html",$data);
    }
    public function getCabinaMasVendida(){
        $data['cabinas']=$this->reporteModel->getCabinasVendidas();
        $general= 0;
        $familiar= 0;
        $suite= 0;
        foreach ($data['cabinas'] as $cabinas) {
            if ($cabinas['tipo_asiento'] == "general") {
                $general ++;
            } elseif ($cabinas['tipo_asiento'] == "familiar") {
                $familiar++;
            } else {
                $suite++;
            }
        }
        if(file_exists("./public/cabinas.jpg")) {
            unlink("./public/cabinas.jpg");
        }

        $this->graphicPrinter->imprimirCirculo($general,$familiar,$suite);
        echo $this->printer->render( "view/admin/cabinasView.html",$data);

    }
}