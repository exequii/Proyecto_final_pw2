<?php

class PerfilUsuarioModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }
    public function getDatosUsuario($id){
        $sql ="SELECT   reserva.numero_asiento,reserva.fila_asiento,reserva.tipo_servicio,reserva.comprobante, vuelo.dia, vuelo.duracion, vuelo.horario, vuelo.origen, vuelo.tipo_vuelo, vuelo.destino, reserva.estado 
                        FROM usuario INNER JOIN reserva ON usuario.idusuario = reserva.usuario_id
						INNER JOIN vuelo ON reserva.vuelo_id = vuelo.idvuelo 
						WHERE usuario.idusuario = $id AND reserva.estado = 'Confirmado'";
        return $usuario = $this->database->query($sql);
    }

    public function getDatosPendientesUsuario($id){
        $sql ="SELECT   reserva.numero_asiento,reserva.fila_asiento,reserva.tipo_servicio,reserva.comprobante, vuelo.dia, vuelo.duracion, vuelo.horario, vuelo.origen, vuelo.tipo_vuelo, vuelo.destino, reserva.estado, reserva.idreserva
                        FROM usuario INNER JOIN reserva ON usuario.idusuario = reserva.usuario_id
						INNER JOIN vuelo ON reserva.vuelo_id = vuelo.idvuelo 
						WHERE usuario.idusuario = $id AND reserva.estado = 'Pendiente'";
        return $usuario = $this->database->query($sql);
    }

     //  $urlPagar = $this->inicializarMP($idvuelo,$fila_asiento,$numero_asiento,$tipo_asiento);
                    //  header("Location: ".$urlPagar."");
                    // die();

}