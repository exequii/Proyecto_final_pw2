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
    public function show()
    {
        if ($_SESSION['usuario'][0]['rol'] == 'ADMIN'){
            $data['usuario'] = $_SESSION['usuario'];
            echo $this->printer->render( "view/admin/reportesView.html",$data);
        }else {
            header("Location: /");
        }
    }
    public function getOcupacion(){
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
        $this->graphicPrinter->imprimirBarras($nombres, $generales,$familiares,$suites);
    }
}