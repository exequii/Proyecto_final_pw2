<?php

class InicioController{

    private $printer;

    public function __construct($printer)
    {
        $this->printer = $printer;
    }

    public function show()
    {
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
//            var_dump($data['usuario']);
//            die();
            echo $this->printer->render( "view/inicioView.html", $data);
        }else {
            echo $this->printer->render("view/inicioView.html");
        }
    }
}

?>