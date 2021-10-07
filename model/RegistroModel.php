<?php

class RegistroModel
{
    private $database;
    
    public function __construct($database){
        $this->database = $database;
    }

    function setUsuario($email,$password,$repitePassword,$rol){
        if($password == $repitePassword) {
        $SQL = "INSERT INTO usuario (usuario, clave,rol) VALUES ('".$email."','".$password."','".$rol."')";
        $this->database->insert($SQL);
        }
        else{
            echo "Las contraseñas no coinciden";
            //$_SESSION['errores'] = "Las contraseñas no coinciden";
        }
    }
}

?>