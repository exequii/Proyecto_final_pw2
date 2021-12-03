<?php

class VerifyController{

    private $printer;
    private $loginModel;

    public function __construct($loginModel,$printer)
    {
        $this->printer = $printer;
        $this->loginModel = $loginModel;
    }

    public function show()
    {
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            $data['msg'] = $this->verificarUsuario();
            echo $this->printer->render( "view/verifyView.html",$data);
        }else {
            $data['msg'] = $this->verificarUsuario();
            echo $this->printer->render( "view/verifyView.html",$data);
        }
    }

    function verificarUsuario(){
        $usuario = $_GET["email"];
        $hash = $_GET["hash"];

        if($this->loginModel->verificarUsuario($usuario,$hash) == true){
            return "Se ha verificado el usuario correctamente";
        }
        else{
            return "Ha ocurrido un error al verificar la cuenta. Intente nuevamente.";
        }
    }
}
