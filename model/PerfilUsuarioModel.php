<?php

class PerfilUsuarioModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }
    public function getDatosUsuario($id){
        $sql ="SELECT   reserva.cantidad_pasajeros, reserva.comprobante, vuelo.dia, vuelo.duracion, vuelo.horario, vuelo.origen, vuelo.tipo_vuelo, vuelo.destino 
                        FROM usuario INNER JOIN reserva ON usuario.idusuario = reserva.usuario_id
						INNER JOIN vuelo ON reserva.vuelo_id = vuelo.idvuelo 
						WHERE usuario.idusuario = $id";
        return $usuario = $this->database->query($sql);
    }

}