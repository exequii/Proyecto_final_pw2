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
}