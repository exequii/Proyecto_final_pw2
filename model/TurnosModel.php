<?php

class TurnosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    function setTurno($usuario, $hospital, $dia)
    {
        $this->database->insertTurnos($usuario, $hospital, $dia);
        echo "Se ha reservado el turno correctamente";
    }
    function setNivelVuelo($idusuario){
        //porcentajes de niveles de vuelo
        $probabilidades = array(3,3,3,3,3,3,2,2,2,1);

        $nivelVuelo = $probabilidades[array_rand($probabilidades,1)];
        $sql = "UPDATE `usuario` SET `nivelVuelo` = $nivelVuelo WHERE `usuario`.`idusuario` = $idusuario";
        $this->database->update($sql);

    }
}
