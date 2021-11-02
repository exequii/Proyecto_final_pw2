<?php

class LoginModel
{
    private $database;
    
    public function __construct($database){
        $this->database = $database;
    }

    public function getUsuario($email,$password){
        $SQL = "SELECT * FROM usuario WHERE usuario = '".$email."' AND clave = '".$password."'";
        $usuario = $this->database->query($SQL);
        return $usuario;
    }

    public function verificarUsuario($email, $hash){
        $SQL = "SELECT * FROM usuario WHERE usuario = '".$email."' AND hash = '".$hash."'";
        $usuario = $this->database->query($SQL);
        if($usuario != null){
            $SQL2 = "UPDATE usuario SET hash = null WHERE usuario = '".$email."' AND hash = '".$hash."'";
            $this->database->update($SQL2);
            return true;
        }
        else{
            return "El usuario ya se encontraba verificado";
        }
    }

    public function obtenerRolDeUsuario($nombre_usuario){
        $SQL = "SELECT rol FROM usuario WHERE usuario like '$nombre_usuario'";
        return $this->database->query($SQL);
    }

    public function getUsuarios(){
        $SQL = "SELECT * FROM usuario";
        return $this->database->query($SQL);
    }

    public function updateRol($rol,$usuario){
        return $this->database->update("UPDATE usuario SET rol='".$rol."' WHERE usuario='".$usuario."'");
    }
}

?>