<?php

use PHPMailer\PHPMailer\PHPMailer;
require './helpers/Exception.php';
require './helpers/PHPMailer.php';
require './helpers/SMTP.php';

class RegistroModel
{
    private $database;
    
    public function __construct($database){
        $this->database = $database;
    }

    function enviarMailValidacion($usuario, $hash){

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->Host       = 'smtp.gmail.com';
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth   = true;

        //mi usuario
        $mail->Username   = "drawio.887@gmail.com";
        $mail->Password   = "Pasionquemera98";
        $mail->SetFrom('drawio.887@gmail.com', 'GauchoRocket');

        //destino
        $mail->AddAddress(''.$usuario.'', 'El Destinatario');

        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Verificacion de Cuenta - GauchoRocket';
        $mail->Body = 'Por favor ingrese al siguiente link para poder verificar su cuenta. http://localhost/verify?email='.$usuario.'&hash='.$hash.'';
        $mail->AltBody = 'Link para confirmar la cuenta';
        $mail->Send();
        
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
                $this->enviarMailValidacion($email,$hash);
                return "Su cuenta fue registrada. Enviamos a su correo el mail de verificacion.";
            }else{
                return "El mail ya se encuentra registrado.";
            }
        }
        else{
            return "Las contrase??as no coinciden";
            //$_SESSION['errores'] = "Las contrase??as no coinciden";
        }
    }
}

?>