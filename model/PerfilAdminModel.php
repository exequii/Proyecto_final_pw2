<?php

class PerfilAdminModel
{
    private $database;
    
    public function __construct($database){
        $this->database = $database;
    }

    function getTurnos(){
        $sql = "SELECT usuario.usuario, hospital.nombre, turno.dia, usuario.nivelVuelo 
                        FROM turno JOIN hospital ON turno.hospital_id = hospital.idhospital 
                                    JOIN usuario ON turno.usuario_id = usuario.idusuario";
        return $this->database->query($sql);
    }
    function getEquipos(){
        $sql = "SELECT idequipo,modelo,matricula FROM equipo";
        return $this->database->query($sql);
    }
    function insertVueloSemanal($dia,$equipo_id,$duracion,$partida,$destino,$tipo_vuelo,$horario){
        $sql = "INSERT INTO `vuelo_semanal` (`idvuelo_semanal`, `dia`, `equipo_id`, `duracion`, `partida`, `destino`, `tipo_vuelo`, `horario`) 
        VALUES (NULL, '" . $dia ."', '".$equipo_id ."', '".$duracion."', '".$partida."', '".$destino."', '".$tipo_vuelo."', '".$horario."')";
        $this->database->insertQuery($sql);
    }
}

?>