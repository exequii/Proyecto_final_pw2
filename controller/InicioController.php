<?php

class InicioController{

    private $printer;

    public function __construct($printer)
    {
        $this->printer = $printer;
    }

    public function show()
    {
        echo $this->printer->render( "view/inicioView.html");
    }
}

?>