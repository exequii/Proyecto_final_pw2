<?php

class PerfilAdminController{

    private $printer;
    private $loginModel;

    public function __construct($loginModel,$printer)
    {
        $this->loginModel = $loginModel;
        $this->printer = $printer;
    }

    public function show()
    {
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            if (isset($_SESSION['admin'])){
                $data['admin'] = $_SESSION['admin'];
            }
            echo $this->printer->render( "view/perfilAdminView.html",$data);
        }else {
            echo $this->printer->render( "view/perfilAdminView.html");
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