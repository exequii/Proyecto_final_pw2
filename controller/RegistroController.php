<?php

class RegistroController{

    private $printer;
    private $registroModel;

    public function __construct($registroModel,$printer)
    {
        $this->printer = $printer;
        $this->registroModel = $registroModel;
    }

    public function show()
    {
        echo $this->printer->render( "view/registroView.html");
    }

    function procesarRegistro(){
        $data["usuario"] = $_POST["usuario"];
        $data["clave"] = $_POST["clave"];
        $data["repiteClave"] = $_POST["repiteClave"];
        $data["rol"] = "usuario";

        $this->registroModel->setUsuario($data["usuario"], $data["clave"], $data["repiteClave"], $data["rol"]);

        echo $this->printer->render( "view/inicioView.html", $data);
    }
}

?>