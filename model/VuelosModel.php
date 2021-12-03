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

    public function obtenerEquipoDelVuelo($id_equipo){
        $SQL = "SELECT * FROM `equipo` WHERE `idequipo` = '".$id_equipo."'";
        return $this->database->query($SQL);
    }

    public function eliminarReserva($idvuelo,$fila,$numero){
        $SQL = "DELETE FROM `reserva` WHERE `vuelo_id` = $idvuelo AND `fila_asiento` = '".$fila."' AND `numero_asiento` = $numero";
        $this->database->insertG($SQL);
    }

    public function actualizarCapacidadVuelo($tipo_asiento,$idvuelo){
        $SQL = "UPDATE `vuelo` SET `$tipo_asiento` = `$tipo_asiento` + 1 WHERE `idvuelo` = $idvuelo";
        $this->database->update($SQL);
    }

    public function actualizarReserva($idreserva){
        $confirmado = "Confirmado";
        $SQL = "UPDATE `reserva` SET `estado` = '".$confirmado."' WHERE `idreserva` = $idreserva";
        $this->database->update($SQL);
    }

}