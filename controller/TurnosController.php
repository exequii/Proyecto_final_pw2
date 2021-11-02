<?php

class TurnosController
{
    private $printer;
    private $turnosModel;

    public function __construct($turnosmodel,$printer)
    {
        $this->turnosModel = $turnosmodel;
        $this->printer = $printer;
    }

    public function show(){
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            echo $this->printer->render( "view/turnosView.html",$data);
        }else{
            echo $this->printer->render( "view/turnosView.html");
        }

    }
    public function reservarTurno(){
        error_reporting(0);
        if($_SESSION['usuario'] !=null){
            $data= $_SESSION['usuario'];
            $idusuario = $data[0]['idusuario'];
            $data['msg'] = $this->turnosModel->setTurno($idusuario,$_POST['hospital'],$_POST['dia'],$idusuario);
            echo $this->printer->render( "view/turnosView.html", $data);
        }
        else{
            $data["errores"] = "Debe estar iniciada la sesion para reservar un turno medico";
            echo $this->printer->render( "view/turnosView.html", $data);
        }
    }
}