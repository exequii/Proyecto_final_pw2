<?php

class ProcesarReservaController
{
    private $printer;
    private $procesarReservaModel;
    private $vuelosModel;

    public function __construct($procesarReservaModel,$printer,$vuelosModel)
    {
        $this->procesarReservaModel = $procesarReservaModel;
        $this->printer = $printer;
        $this->vuelosModel = $vuelosModel;
    }
    public function show(){
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
            echo $this->printer->render( "view/procesarReservaView.html",$data);
        }else {
            echo $this->printer->render( "view/procesarReservaView.html");
        }
    }

    public function showVuelo(){
        $data['fecha'] = $_POST['fecha'];
        $idvuelo = $_POST['idvuelo'];
        $data['vuelos'] = $this->vuelosModel->buscarVueloPorId($idvuelo);

        $data['vuelo'] = $this->procesarReservaModel->consultarSiElVueloYaExiste($data['fecha'],$data['vuelos'][0]['equipo_id'],$data['vuelos'][0]['horario'],$data['vuelos'][0]['tipo_vuelo'],$data['vuelos'][0]['partida'],$data['vuelos'][0]['destino']);
        
        if($data['vuelo'] == null){
            $data['equipo']= $this->procesarReservaModel->obtenerEquipoDelVuelo($data['vuelos'][0]['equipo_id']);
            $this->procesarReservaModel->crearVuelo($data['fecha'],$data['vuelos'][0]['equipo_id'],$data['vuelos'][0]['duracion'],
            $data['vuelos'][0]['horario'],$data['vuelos'][0]['tipo_vuelo'],$data['vuelos'][0]['partida'],
            $data['vuelos'][0]['destino'],$data['equipo'][0]['general'],$data['equipo'][0]['familiar'],$data['equipo'][0]['suite']);
            echo $this->printer->render( "view/procesarReservaView.html",$data);
            //si el vuelo era null y lo tuvo que crear, no consultamos por reservas ya que significa que nunca tuvo reservas.
        }
        else{
            //si el vuelo no es null, es decir que ya existia, significa que tuvo una reserva previamente por lo cual debemos traernos todas las reservas.
            $data['reservas'] = $this->procesarReservaModel->consultarPorTodasLasReservasDeUnVueloEspecifico($data['vuelo'][0]['idvuelo']);
            echo $this->printer->render( "view/procesarReservaView.html",$data);
        }
    }

    public function reservar(){
        $fecha = $_POST['fecha'];
        $idequipo = $_POST['equipo_id'];
        $duracion = $_POST['duracion'];
        $horario = $_POST['horario'];
        $tipoVuelo = $_POST['tipo_vuelo'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $cantidad = $_POST['cantidad'];
        $tipo_asiento = $_POST['tipo_asiento'];
        $numero_asiento = $_POST['numero_asiento'];
        $fila_asiento = $_POST['fila_asiento'];

        //  echo $fecha;
        //  echo $idequipo;
        //  echo $duracion;
        //  echo $horario;
        //  echo $tipoVuelo;
        //  echo $origen;
        //  echo $destino;
        //  echo $cantidad;
        //  echo $tipo_asiento;
        //  echo $numero_asiento;
        //  echo $fila_asiento;

        $this->procesarReservaModel->consultarDisponibilidadAsiento();

        //$comprobante = $this->generarCodigoComprobante("Boleto para ".$data['vuelo'][0] . "cantidad ");
        //$this->procesarReservaModel->realizarReserva($data['vuelo'][0]['idvuelo'],$data['usuario'][0]['idusuario'],$comprobante,$tipo_asiento,$numero_asiento,$fila_asiento);
        //$this->procesarReservaModel->actualizarCapacidadVuelo();
        
    }

    function generarCodigoComprobante($vuelo){
        return hash("crc32b",$vuelo);
    }

}