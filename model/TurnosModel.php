<?php

class TurnosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    function setTurno($usuario, $hospital, $dia, $idusuario)
    {
        $this->database->insertTurnos($usuario, $hospital, $dia);
        $nivelVuelo = $this->setNivelVuelo($idusuario);
        $_SESSION['usuario'][0]['nivelVuelo'] = $nivelVuelo;
        return "Se ha reservado el turno correctamente. Su nivel de vuelo es ".$nivelVuelo.".";
    }
    function setNivelVuelo($idusuario){
        //porcentajes de niveles de vuelo
        $probabilidades = array(3,3,3,3,3,3,2,2,2,1);

        $nivelVuelo = $probabilidades[array_rand($probabilidades,1)];
        $sql = "UPDATE `usuario` SET `nivelVuelo` = '$nivelVuelo' WHERE `idusuario` = '$idusuario'";
        $this->database->update($sql);
        return $nivelVuelo;
    }
}
