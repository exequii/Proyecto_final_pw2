<?php

class VuelosModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }
    public function getVuelosBuscadosPorDia($dia,$origen,$destino){
        $SQL = "SELECT * FROM vuelo_semanal INNER JOIN equipo ON vuelo_semanal.equipo_id = equipo.idequipo WHERE vuelo_semanal.dia = '".$dia."' AND vuelo_semanal.partida = '".$origen."' AND vuelo_semanal.destino = '".$destino."'";
        $vuelos = $this->database->query($SQL);
        return $vuelos;
    }

    public function buscarVueloPorId($id){
        $SQL = "SELECT * FROM vuelo_semanal WHERE idvuelo_semanal = $id";
        return $vuelo = $this->database->query($SQL);
    }
    public function realizarReserva($idVuelo,$idUsuario,$comprobante){
        $insert = "INSERT INTO `reserva` (`idreserva`, `vuelo_id`, `usuario_id`, `comprobante`) VALUES (NULL, $idVuelo, $idUsuario,'$comprobante')";
        $this->database->insertQuery($insert);

    }

}