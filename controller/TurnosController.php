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
        echo $this->printer->render( "view/turnosView.html");
    }
    public function reservarTurno(){
        $data= $_SESSION['usuario'];
        $idusuario = $data[0]['idusuario'];

        $data['msg'] = $this->turnosModel->setTurno($idusuario,$_POST['hospital'],$_POST['dia']);
        $this->turnosModel->setNivelVuelo($idusuario);
        echo $this->printer->render( "view/inicioView.html", $data);
    }
}