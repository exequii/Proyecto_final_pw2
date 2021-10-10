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
        // if($this->database->error){
        //     echo "La Consulta produjo un error " .$this->database->error;
        //}
        if($usuario != null) echo "FUNCIONA" .var_dump($usuario). "";
        else echo "El usuario ingresado no existe";
        return $usuario;
    }
}

?>