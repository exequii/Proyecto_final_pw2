<?php

require 'vendor/autoload.php';

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
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
        }
        $data['fecha'] = $_POST['fecha'];
        $data['idvuelo'] = $_POST['idvuelo'];
        $data['vuelos'] = $this->vuelosModel->buscarVueloPorId($data['idvuelo']);
        //$data['urlPagar'] = $this->inicializarMP();
        $data['vuelo'] = $this->procesarReservaModel->consultarSiElVueloYaExiste($data['fecha'],$data['vuelos'][0]['equipo_id'],$data['vuelos'][0]['horario'],$data['vuelos'][0]['tipo_vuelo'],$data['vuelos'][0]['partida'],$data['vuelos'][0]['destino']);
        
        if($data['vuelo'] == null){
            
            $data['equipo']= $this->procesarReservaModel->obtenerEquipoDelVuelo($data['vuelos'][0]['equipo_id']);

            $data['vueloactivo'] = $this->procesarReservaModel->crearVuelo($data['fecha'],$data['vuelos'][0]['equipo_id'],$data['vuelos'][0]['duracion'],
            $data['vuelos'][0]['horario'],$data['vuelos'][0]['tipo_vuelo'],$data['vuelos'][0]['partida'],
            $data['vuelos'][0]['destino'],$data['equipo'][0]['general'],$data['equipo'][0]['familiar'],$data['equipo'][0]['suite']);

            $data['cantidad-filas'] = ($data['equipo'][0]['capacidad'])/10;

            $asientosOcupados=0;
            $data['asientos']=$this->getAsientos($asientosOcupados,$data['cantidad-filas']);
            echo $this->printer->render( "view/procesarReservaView.html",$data);
        }
        else{
            $data['vueloactivo'] = $data['vuelo'][0]['idvuelo'];
            $asientosOcupados = $this->procesarReservaModel->consultarPorAsientosDeUnVueloEspecifico($data['vuelo'][0]['idvuelo']);

            $cantidadAsientos = $this->procesarReservaModel->getCantidadAsientos($data['vuelos'][0]['equipo_id']);
            $data['cantidad-filas']=(intval($cantidadAsientos[0]["capacidad"], 10)/10);
            $data['asientos']=$this->getAsientos($asientosOcupados,$data['cantidad-filas']);

            echo $this->printer->render( "view/procesarReservaView.html",$data);
        }
    }

    public function reservar(){
        $data['usuario'] = $_SESSION['usuario'];
        $nivelVueloUsuario = $data['usuario'][0]['nivelVuelo'];
        $idvuelo = $_POST['idvueloactivo'];
        $tipoVuelo = $_POST['tipo_vuelo'];
        $tipo_asiento = $_POST['tipo_asiento'];
        $numero_asiento = $_POST['numero_asiento'];
        $fila_asiento = $_POST['fila_asiento'];
        $fecha = $_POST['fecha'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $idequipo = $_POST['equipo_id'];
        $tipo_servicio = $_POST['tipo_servicio'];

        $tipoEquipo = $this->procesarReservaModel->obtenerEquipoDelVuelo($idequipo);

        if($this->chequearDisponibilidadVuelo($tipo_asiento,$idvuelo,$data['usuario'][0]['idusuario'])){
            if($this->chequearDisponibilidadAsiento($idvuelo,$tipo_asiento,$numero_asiento,$fila_asiento)){
                if($this->procesarReservaModel->chequearNivelUsuario($nivelVueloUsuario,$tipoEquipo)){
                    
                     $urlPagar = $this->inicializarMP($idvuelo,$fila_asiento,$numero_asiento,$tipo_asiento);
                     header("Location: ".$urlPagar."");
                    die();
                     $comprobante = $this->generarCodigoComprobante("Boleto para ".$tipoVuelo. "cantidad" .$fecha. "");
                     $this->procesarReservaModel->realizarReserva($idvuelo,$data['usuario'][0]['idusuario'],$comprobante,$tipo_asiento,$numero_asiento,$fila_asiento,$tipo_servicio);
                     $this->procesarReservaModel->actualizarCapacidadVuelo($tipo_asiento,$idvuelo);

                     $this->procesarReservaModel->enviarMailReserva($data['usuario'][0]['usuario'],$comprobante,$tipo_asiento,$numero_asiento,$fila_asiento,$fecha,$origen,$destino,$tipoVuelo);
                     //$data['exito'] = "Se ha realizado la reserva correctamente. Le enviaremos toda la informacion a su casilla de correo.";
                    //echo $this->printer->render( "view/vuelosView.html",$data);
                }else{
                    $data['error'] = "El resultado de su chequeo medico no le permite viajar en vuelos de este tipo.";
                    echo $this->printer->render( "view/vuelosView.html",$data);
                }
            }
            else{
                $data['error'] = "El asiento seleccionado no se encuentra disponible.";
                echo $this->printer->render( "view/vuelosView.html",$data);
            }
        }else{
            $data['error'] = "No hay disponibilidad de ningun asiento en el vuelo indicado. Lo agregaremos a una lista de espera.";
            echo $this->printer->render( "view/vuelosView.html",$data);
        }
            
    }

    function generarCodigoComprobante($tipoVuelo){
        return hash("crc32b",$tipoVuelo);
    }

    function getAsientos($asientosOcupados,$cantidadFilas){
        $letras = array("A","B","C","D","E","F","G","H","I","J");
        $k = 0;
        for ($i = 0; $i < ($cantidadFilas); $i++) {
            $k++;
            for ($j = 0; $j <= 9; $j++) {
                        $columna[$j] =array('columna' => $k.$letras[$j]);
                }
            $fila[$i] = array('fila' =>  $columna);
            }
        if ($asientosOcupados != 0) {
            foreach ($asientosOcupados as $asiento) {
                for ($j = 0; $j <= 9; $j++) {
                    if ($asiento['fila_asiento'] == $letras[$j])
                        $fila[$asiento['numero_asiento']-1]['fila'][$j]['columna'] = "Reservado";
                        //$fila[$asiento['numero_asiento']]['fila'][$j]['disponible'] = "disabled";
                        
                }
            }
        }
        return $fila;
    }

    function chequearDisponibilidadAsiento($idvuelo,$tipo_asiento,$numero_asiento,$fila_asiento){
        $data['disponibilidad'] = $this->procesarReservaModel->consultarDisponibilidadAsiento($idvuelo,$tipo_asiento,$numero_asiento,$fila_asiento);
        if($data['disponibilidad'] == null){
            return true;
        }
        else{
            return false;
        }
    }

    function chequearDisponibilidadVuelo($tipo_asiento,$idvuelo,$idusuario){
        $data['vuelo'] = $this->procesarReservaModel->traerCapacidadActualVueloPorId($tipo_asiento,$idvuelo);
        if($data['vuelo'][0][$tipo_asiento] > 1){
            return true;
        }else{
            $this->procesarReservaModel->agregarListaDeEspera($idvuelo,$idusuario);
            return false;
        }
    }
    
    function inicializarMP($idvuelo,$fila_asiento,$numero_asiento,$tipo_asiento){
        
        $token = "TEST-5916094541699370-111014-1eaa90a66f41c97bc3c420d2f70da2a9-238927187";
        MercadoPago\SDK::setAccessToken($token);
    
        $preference = new MercadoPago\Preference();
    
        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Reserva Vuelo - GauchoRocket';
        $item->quantity = 1;
        $item->unit_price = 100;
        $preference->back_urls = [
            "success" => "http://localhost/vuelos&pagorealizado=true",
            "failure" => "http://localhost/vuelos?pagorealizado=false&idvuelo=".$idvuelo."&fila=".$fila_asiento."&numero=".$numero_asiento."&tipo=".$tipo_asiento.""
        ];
        //
        $preference->auto_return = 'approved';
        $preference->items = array($item);
        $preference->save();
        return $preference->init_point;
        //header("Location: ".$preference->init_point."");
    }

}