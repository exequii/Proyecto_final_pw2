<?php

class LoginController{

    private $printer;
    private $loginModel;

    public function __construct($loginModel,$printer)
    {
        $this->loginModel = $loginModel;
        $this->printer = $printer;
    }

    public function show()
    {
        //$usuario = $this->loginModel->getUsuario($_POST["usuario"],$_POST["clave"]);
        echo $this->printer->render( "view/loginView.html");
    }

    function procesarLogin(){
        $data["usuario"] = $_POST["usuario"];
        $data["clave"] = $_POST["clave"];

        $usuario = $this->loginModel->getUsuario($data["usuario"],$data["clave"]);

        echo $this->printer->render( "view/loginView.html", $usuario);
    }
}

?>