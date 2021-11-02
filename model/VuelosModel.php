<?php

class VuelosModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }
    public function getVuelosBuscados($dia,$origen,$destino){
        //$SQL = "SELECT vuelo.dia,vuelo.idvuelo,vuelo.duracion,vuelo.partida,vuelo.horario,vuelo.tipo_vuelo,equipo.capacidad,equipo.modelo FROM vuelo INNER JOIN equipo ON vuelo.equipo_id = equipo.idequipo;";
        $SQL = "SELECT * FROM vuelo INNER JOIN equipo ON vuelo.equipo_id = equipo.idequipo WHERE vuelo.dia = '".$dia."' AND vuelo.origen = '".$origen."' AND vuelo.destino = '".$destino."'";
        $vuelos = $this->database->query($SQL);
        return $vuelos;
    }
    public function buscarVueloPorId($id){
        $SQL = "SELECT * FROM vuelo WHERE idvuelo = $id";
        return $vuelo = $this->database->query($SQL);
    }
    public function realizarReserva($idVuelo,$idUsuario,$cantidadReservas,$comprobante){
        $insert = "INSERT INTO `reserva` (`idreserva`, `vuelo_id`, `usuario_id`, `cantidad_pasajeros`, `comprobante`) VALUES (NULL, $idVuelo, $idUsuario, $cantidadReservas,'$comprobante')";
//        var_dump($insert);
//        die();
        $this->database->insertQuery($insert);

    }

    public function actualizarCapacidad($equipo, $cantidad)
    {
        $update = "UPDATE `equipo` SET `capacidad` = `capacidad` - $cantidad WHERE `equipo`.`idequipo` = $equipo";
        $this->database->update($update);
    }
}