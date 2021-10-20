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
        echo $this->printer->render( "view/loginView.html");
    }

    function procesarLogin(){
        $data["usuario"] = $_POST["usuario"];
        $data["clave"] = $_POST["clave"];


        $usuario = $this->loginModel->getUsuario($data["usuario"],$data["clave"]);

        if($usuario != null) {
            if($usuario[0]['hash']==null){
        
                $_SESSION['usuario'] = $usuario;
                $data['usuario'] = $usuario;
                $rol = $this->loginModel->obtenerRolDeUsuario($_POST["usuario"]);
                $rolAdmin = "ADMIN";
                if($rol[0]['rol'] == $rolAdmin){
                    $_SESSION['admin'] = $rol[0]['rol'];
                    $data['admin'] = $rol[0]['rol'];
                }
                echo $this->printer->render( "view/inicioView.html", $data);
            }
            else{
                $data['errores'] = "El usuario debe verificar su cuenta.";
                echo $this->printer->render( "view/loginView.html", $data);
            }
        }
        else{
            $data['errores'] = "El usuario ingresado no existe";
            echo $this->printer->render( "view/loginView.html", $data);
        }
    }


    function logout(){
        if(isset($_SESSION['usuario'])){
            session_destroy();
        }

        header('Location: index.php');
    }

    public function validarPermisosDeAdmin()
    {
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == 2) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function editarRol()
    {
        if ($this->validarPermisosDeAdmin()) {
            $data["usuarios"] = $this->model->mostrarUsuariosYRolPorId();
            $data["roles"] = $this->model->obtenerRoles();
            echo $this->renderer->render("view/perfilAdminView.html", $data);
        } else {
            header('Location: index.php');
        }
    }

    public function actualizarRol()
    {
        if ($this->validarPermisosDeAdmin()) {
            if (isset($_POST['rol'])) {
                $rol = $_POST['rol'];
                $usuario = $_POST["usuario"];
                $this->model->updateRol($rol, $usuario);
                echo $this->editarRol();
            } else {
                echo $this->editarRol();
            }
        } else {
            header('Location: index.php');
        }
    }
}

?>