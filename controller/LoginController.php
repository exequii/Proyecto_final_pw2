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

        if($usuario != null) {
            $_SESSION['usuario'] = $usuario;
            header("Location: /index.php");
        }
        else{
            $_SESSION['errores'] = "El usuario ingresado no existe";
            header("Location: /login");

        }
//        echo $this->printer->render( "view/inicioView.html", $usuario);
    }
    function logout(){
        if(isset($_SESSION['usuario'])){
            session_destroy();
        }

        header('Location: index.php');
    }
}

?>