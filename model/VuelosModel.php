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
        $SQL = "SELECT * FROM vuelo WHERE idvuelo = $id";
        return $vuelo = $this->database->query($SQL);
    }
    public function realizarReserva($idVuelo,$idUsuario,$cantidadReservas,$comprobante){
        $insert = "INSERT INTO `reserva` (`idreserva`, `vuelo_id`, `usuario_id`, `cantidad_pasajeros`, `comprobante`) VALUES (NULL, $idVuelo, $idUsuario, $cantidadReservas,'$comprobante')";
        $this->database->insertQuery($insert);

    }

    public function actualizarCapacidad($equipo, $cantidad)
    {
        $update = "UPDATE `equipo` SET `capacidad` = `capacidad` - $cantidad WHERE `equipo`.`idequipo` = $equipo";
        $this->database->update($update);
    }
}