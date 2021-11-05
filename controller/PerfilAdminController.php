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
    public function showCrearVuelo(){
        $data['equipos'] = $this->perfilAdminModel->getEquipos();
//        var_dump($data['equipos']);
//        die();
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            if (isset($_SESSION['admin'])){
                $data['admin'] = $_SESSION['admin'];
            }
            echo $this->printer->render( "view/admin/crearVueloView.html",$data);
        }else {
            echo $this->printer->render( "view/admin/crearVueloView.html");
        }
    }

    public function guardarVuelo(){
        $data['vuelo'] = $_POST;
        $dia=$data['vuelo']['dia'];
        $equipo_id=$data['vuelo']['equipo'];
        $duracion=$data['vuelo']['duracion'];
        $partida=$data['vuelo']['partida'];
        $destino=$data['vuelo']['destino'];
        $tipo_vuelo=$data['vuelo']['tipo_vuelo'];
        $horario=$data['vuelo']['horario'];

        switch($tipo_vuelo){
            case "Suborbital": 
                if($equipo_id == 1 || $equipo_id == 2){
                    $this->perfilAdminModel->insertVueloSemanal($dia,$equipo_id,$duracion,$partida,$destino,$tipo_vuelo,$horario);
                    $data['msg'] = "Se ha registrado el vuelo correctamente.";
                    break;
                }else{
                    $data['error'] = "El tipo de vuelo indicado no esta permitido con el equipo seleccionado.";
                    break;
                }
            case "BA":
                if($equipo_id == 3 || $equipo_id == 4 || $equipo_id == 5 || $equipo_id == 6){
                    $this->perfilAdminModel->insertVueloSemanal($dia,$equipo_id,$duracion,$partida,$destino,$tipo_vuelo,$horario);
                    $data['msg'] = "Se ha registrado el vuelo correctamente.";
                    break;
                }else{
                    $data['error'] = "El tipo de vuelo indicado no esta permitido con el equipo seleccionado.";
                    break;
                }
            case "AA":
                if($equipo_id == 7 || $equipo_id == 8 || $equipo_id == 9 || $equipo_id == 10){
                    $this->perfilAdminModel->insertVueloSemanal($dia,$equipo_id,$duracion,$partida,$destino,$tipo_vuelo,$horario);
                    $data['msg'] = "Se ha registrado el vuelo correctamente.";
                    break;
                }else{
                    $data['error'] = "El tipo de vuelo indicado no esta permitido con el equipo seleccionado.";
                    break;
                }
            default:
                    $data['error'] = "Se ha producido un error inesperado.";
                    break;
        }
        $data['usuario'] = $_SESSION['usuario'];
        echo $this->printer->render( "view/inicioView.html",$data);
    }
}

?>