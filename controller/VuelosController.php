<?php

class VuelosController
{
    private $printer;
    private $vuelosModel;

    public function __construct($vuelosModel,$printer)
    {
        $this->vuelosModel = $vuelosModel;
        $this->printer = $printer;
    }
    public function show(){
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            echo $this->printer->render( "view/vuelosView.html",$data);
        }else {
            echo $this->printer->render( "view/vuelosView.html");
        }
    }

    public function showVuelos(){
        $data['dia'] = $_POST['dia'];
        $data['origen'] = $_POST['origen'];
        $data['destino'] = $_POST['destino'];
        $data['vuelos'] = $this->vuelosModel->getVuelosBuscados($data['dia'],$data['origen'],$data['destino']);
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            echo $this->printer->render( "view/vuelosDisponiblesView.html",$data);
        }else {
            echo $this->printer->render( "view/vuelosDisponiblesView.html",$data);
        }

    }

    public function reservar(){
        $data['vuelo'] = $this->vuelosModel->buscarVueloPorId($_POST['vuelo']);
        $data['cantidad'] = $_POST['cantidad'];
        if (!isset($_SESSION['usuario'])){
            $data['error'] = "Debe iniciar sesion para poder reservar un vuelo.";
            echo $this->printer->render( "view/vuelosView.html", $data);
        }
        else{
            $data['usuario'] = $_SESSION['usuario'];
            $nivelUsuario = $data['usuario'][0]['nivelVuelo'];
            $nivelVuelo= $data['vuelo'][0]['tipo_vuelo'];
            $vuelo = $data['vuelo'][0]['idvuelo'];
            $user = $data['usuario'][0]['idusuario'];
            $equipo = $data['vuelo'][0]['equipo_id'];
            $cantidad = $data['cantidad'];
            if ($this->chequearNivelUsuario($nivelUsuario,$nivelVuelo)) {
                    $codigo = $this->generarCodigoComprobante("Boleto para ".$vuelo . "cantidad ".$cantidad);
                    $this->vuelosModel->realizarReserva($vuelo, $user, $cantidad,$codigo);
                    $this->vuelosModel->actualizarCapacidad($equipo, $cantidad);
                    $data['msg'] = "La reserva se ha realizado correctamente. Revise su correo.";
                    echo $this->printer->render( "view/vuelosDisponiblesView.html", $data);
            } else {
                $data['error'] = "Su nivel de vuelo no le permite viajar en este tipo de vuelo.";
                echo $this->printer->render( "view/vuelosView.html", $data);
            }
        }
    }

     function chequearNivelUsuario($nivelUsuario,$nivelVuelo){
        if ($nivelVuelo == "AA" && $nivelUsuario == 3){
            return true;
        }else {
            return false;
        }
    }
    function generarCodigoComprobante($vuelo){
        return hash("crc32b",$vuelo);
    }

}