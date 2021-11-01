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
        $data['vuelos'] = $this->vuelosModel->getVuelos();
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            echo $this->printer->render( "view/vuelosView.html",$data);
        }else {
            echo $this->printer->render( "view/vuelosView.html",$data);
        }

    }
    public function reservar(){
        $data['vuelo'] = $this->vuelosModel->buscarVueloPorId($_POST['vuelo']);
        $data['usuario'] = $_SESSION['usuario'];
        //chequear nivel de usuario
        $nivelUsuario = $data['usuario'][0]['nivelVuelo'];
        $nivelVuelo= $data['vuelo'][0]['tipo_vuelo'];

        //Preparacion de datos
        $vuelo = $data['vuelo'][0]['idvuelo'];
        $user = $data['usuario'][0]['idusuario'];
        $cantidad = 1;
        $equipo = $data['vuelo'][0]['equipo_id'];
        $comprobante = $this->generarComprobante("Boleto para ".$vuelo . "cantidad ".$cantidad);

        if ($this->chequearNivelUsuario($nivelUsuario,$nivelVuelo)) {
            $this->vuelosModel->realizarReserva($vuelo, $user, $cantidad,$comprobante);
            $this->vuelosModel->actualizarCapacidad($equipo, $cantidad);
        } else {
            echo "No puede realizar la reserva por su nivel de vuelo";
        }

        header('Location: /index.php');

    }


     function chequearNivelUsuario($nivelUsuario,$nivelVuelo){
        if ($nivelVuelo == "orbital" && $nivelUsuario == 1 || $nivelUsuario == 2 || $nivelUsuario == 3){
            return true;
        }else {
            return false;
        }
    }
    function generarComprobante($vuelo){
        return hash("crc32b",$vuelo);
    }

}