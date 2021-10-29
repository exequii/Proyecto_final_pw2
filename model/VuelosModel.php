<?php

class VuelosModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }
    public function getVuelos(){
        $SQL = "SELECT * FROM vuelo";
        $vuelos = $this->database->query($SQL);
        return $vuelos;
    }
}