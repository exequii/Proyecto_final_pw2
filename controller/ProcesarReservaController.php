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
        if (isset($_SESSION['usuario'])){
            $data['usuario'] = $_SESSION['usuario'];
        }
        $data['fecha'] = $_POST['fecha'];
        $data['idvuelo'] = $_POST['idvuelo'];
        $data['vuelos'] = $this->vuelosModel->buscarVueloPorId($data['idvuelo']);

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
            $asientosOcupados = $this->procesarReservaModel->consultarPorAsientosDeUnVueloEspecifico($data['vuelo'][0]['idvuelo']);

//            $fila[0] = array(
//                'fila' => array(
//                    $columna[0] =array('columna' => "libre" ),
//                    $columna[1] =array('columna' => "libre" ),
//                    $columna[2] =array('columna' => "libre" )
//                ));
//                $fila[1] = array(
//                    'fila' => array(
//                        $columna[0] =array('columna' => "libre" ),
//                        $columna[1] =array('columna' => "ocupado" ),
//                        $columna[2] =array('columna' => "ocupado" )
//                        ));
//
            //CREO EL ARRAY DE ASIENTOS
            $data['asientos']=$this->getAsientos($asientosOcupados);

//            var_dump($asientosOcupados);
//            die();
            echo $this->printer->render( "view/procesarReservaView.html",$data);
        }
    }

    public function reservar(){
        $data['usuario'] = $_SESSION['usuario'];
        $idvuelo = $_POST['idvuelo'];
        $tipoVuelo = $_POST['tipo_vuelo'];
        $tipo_asiento = $_POST['tipo_asiento'];
        $numero_asiento = $_POST['numero_asiento'];
        $fila_asiento = $_POST['fila_asiento'];
        $fecha = $_POST['fecha'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];


        //$this->procesarReservaModel->consultarDisponibilidadAsiento();

        $comprobante = $this->generarCodigoComprobante("Boleto para ".$tipoVuelo. "cantidad" .$fecha. "");
        $this->procesarReservaModel->realizarReserva($idvuelo,$data['usuario'][0]['idusuario'],$comprobante,$tipo_asiento,$numero_asiento,$fila_asiento);
        $this->procesarReservaModel->actualizarCapacidadVuelo($tipo_asiento,$idvuelo);

        $this->procesarReservaModel->enviarMailReserva($data['usuario'][0]['usuario'],$comprobante,$tipo_asiento,$numero_asiento,$fila_asiento,$fecha,$origen,$destino,$tipoVuelo);
        $data['exito'] = "Se ha realizado la reserva correctamente. Le enviaremos toda la informacion a su casilla de correo.";
        echo $this->printer->render( "view/procesarReservaView.html",$data);
        
    }

    function generarCodigoComprobante($tipoVuelo){
        return hash("crc32b",$tipoVuelo);
    }

    function getAsientos($asientosOcupados){
        $letras = array("A","B","C","D","E","F","G","H","I","J");
        for ($i = 0; $i <= 5; $i++) {
            for ($j = 0; $j <= 9; $j++) {
                        $columna[$j] =array('columna' => $i.$letras[$j].' libre' );
                }
            $fila[$i] = array('fila' =>  $columna);
        }
        foreach ($asientosOcupados as $asiento) {
            for ($j = 0; $j <= 9; $j++) {
                if ($asiento['fila_asiento'] == $letras[$j])
                    $fila[$asiento['numero_asiento']]['fila'][$j]['columna'] = $asiento['numero_asiento'].$letras[$j]. " reservado";
            }
        }
        return $fila;
    }

}