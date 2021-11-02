<?php

class PerfilAdminController{

    private $perfilAdminModel;
    private $printer;
    private $loginModel;

    public function __construct($perfilAdminModel,$printer,$loginModel)
    {
        $this->perfilAdminModel = $perfilAdminModel;
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
            $data['usuarios'] = $this->loginModel->getUsuarios();
            $data['turnos'] = $this->perfilAdminModel->getTurnos();
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
            if ($_SESSION['rol'] == "ADMIN") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function actualizarRol()
    {
        $rol = $_POST['rol'];
        $usuario = $_POST["usuario"];
        $this->loginModel->updateRol($rol, $usuario);
        $data['msg'] = "Se ha actualizado correctamente el rol";
        $data['usuarios'] = $this->loginModel->getUsuarios();
        $data['turnos'] = $this->perfilAdminModel->getTurnos();
        $data['usuario'] = $_SESSION['usuario'];
        $data['admin'] = $_SESSION['admin'];
        echo $this->printer->render( "view/perfilAdminView.html",$data);
    }   
}

?>