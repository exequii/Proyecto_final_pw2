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
}
