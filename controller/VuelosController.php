<?php

class VuelosController
{
    private $printer;
    private $vuelosModel;

    public function __construct($vuelosModel,$printer)
    {
        $this->vuelosModel = $vuelosModel;
        $this->printer = $printer;
    }
    public function show(){
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            echo $this->printer->render( "view/vuelosView.html",$data);
        }else {
            echo $this->printer->render( "view/vuelosView.html");
        }
    }

    public function showVuelos(){
        $data['fecha'] = $_POST['dia'];
        $data['dia'] = $this->getDia($_POST['dia']);
        $data['origen'] = $_POST['origen'];
        $data['destino'] = $_POST['destino'];
        $data['vuelos'] = $this->vuelosModel->getVuelosBuscadosPorDia($data['dia'],$data['origen'],$data['destino']);

        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            echo $this->printer->render( "view/vuelosDisponiblesView.html",$data);
        }else {
            echo $this->printer->render( "view/vuelosDisponiblesView.html",$data);
        }
    }

    function getDia($fechaForm)
    {
        $fecha = strtotime($fechaForm);
        $dia = date("N",$fecha);
        $dias = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
        return $dias[$dia];

    }

}