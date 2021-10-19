<?php

class RegistroModel
{
    private $database;
    
    public function __construct($database){
        $this->database = $database;
    }

    function enviarMailValidacion($usuario){

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
                $SQL = "INSERT INTO usuario (usuario, clave) VALUES (?,?)";
                $this->database->insert($SQL,$email,$password);
                //$data['errores'] = "Su cuenta fue registrada, <br /> por favor verifique su cuenta con el correo que le enviamos.";
                $this->enviarMailValidacion($email);
                echo "Se ha registrado correctamente";
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