<?php

class PerfilAdminModel
{
    private $database;
    
    public function __construct($database){
        $this->database = $database;
    }

    function getTurnos(){
        $sql = "SELECT * FROM turno";
        return $this->database->query($sql);
    }
}

?>