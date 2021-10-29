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
        $data['vuelos'] = $this->vuelosModel->getVuelos();
        echo $this->printer->render( "view/vuelosView.html",$data);
    }
}