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
        echo $this->printer->render( "view/vuelosView.html");
    }
}