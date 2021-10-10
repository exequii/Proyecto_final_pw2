<?php

class RegistroModel
{
    private $database;
    
    public function __construct($database){
        $this->database = $database;
    }

    function setUsuario($email,$password,$repitePassword,$rol){
        if($password == $repitePassword) {
        //$SQL = "INSERT INTO usuario (usuario, clave,rol) VALUES ('".$email."','".$password."')";
        $SQL = "INSERT INTO usuario (usuario, clave) VALUES (?,?)";
        $this->database->insert($SQL,$email,$password);
        echo "Se ha registrado correctamente";
        }
        else{
            echo "Las contraseñas no coinciden";
            //$_SESSION['errores'] = "Las contraseñas no coinciden";
        }
    }
}

?>