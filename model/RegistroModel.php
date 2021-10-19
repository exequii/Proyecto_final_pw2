<?php

class RegistroModel
{
    private $database;
    
    public function __construct($database){
        $this->database = $database;
    }

    function enviarMailValidacion($usuario, $hash){
        /*
        $to = $usuario;
        $subject = 'Registro | Verificacion';
        $hash = md5( rand(0,1000) );
        $message = '
 
        Gracias por registrarte!
        Para poder confirmar sus datos necesitamos que clickee el link:

        http://localhost/verify.php?email='.$to.'&hash='.$hash.'
        ';
                     
        $headers = 'From:noreply@yourwebsite.com' . "\r\n";
        mail($to, $subject, $message, $headers);
        */
        $msg = 'http://localhost/verify?email='.$usuario.'&hash='.$hash.'';
        return $msg;
    }

    function verificarSiLaCuentaExiste($email, $password){
        $SQL = "SELECT * FROM usuario WHERE usuario = '".$email."' AND clave = '".$password."'";
        $usuario = $this->database->query($SQL);
        if($usuario != null){
            return false;
        }
        else{
            return true;
        }
    }

    function setUsuario($email,$password,$repitePassword,$rol){
        if($password == $repitePassword) {
            if($this->verificarSiLaCuentaExiste($email,$password)){
                $hash = md5( rand(0,1000) );
                $SQL = "INSERT INTO usuario (usuario, clave, hash) VALUES (?,?,?)";
                $this->database->insert($SQL,$email,$password, $hash);
                //$data['errores'] = "Su cuenta fue registrada, <br /> por favor verifique su cuenta con el correo que le enviamos.";
                return $this->enviarMailValidacion($email,$hash);
                //echo "Se ha registrado correctamente";
            }else{
                echo "El mail ya se encuentra registrado.";
            }
        }
        else{
            echo "Las contraseñas no coinciden";
            //$_SESSION['errores'] = "Las contraseñas no coinciden";
        }
    }
}

?>