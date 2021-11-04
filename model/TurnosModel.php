<?php

use PHPMailer\PHPMailer\PHPMailer;
require './helpers/Exception.php';
require './helpers/PHPMailer.php';
require './helpers/SMTP.php';

class TurnosModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    function enviarMailResultadoMedico($usuario,$hospital,$dia,$nivelVuelo){

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->Host       = 'smtp.gmail.com';
        $mail->Port       = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth   = true;
        $mail->Username   = "drawio.887@gmail.com";
        $mail->Password   = "Pasionquemera98";
        $mail->SetFrom('drawio.887@gmail.com', 'GauchoRocket');
        $mail->AddAddress(''.$usuario.'', 'El Destinatario');
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Resultado Chequeo Medico - GauchoRocket';
        $mail->Body = 'Hola! Estan listos los resultados del chequeo medico que te realizaste el dia '.$dia.' en el Hospital '.$hospital.'. El resultado del chequeo medico es que tu nivel de Vuelo es: '.$nivelVuelo.'';
        $mail->AltBody = 'Hola! Estan listos los resultados del chequeo medico que te realizaste el dia '.$dia.' en el Hospital '.$hospital.'. El resultado del chequeo medico es que tu nivel de Vuelo es: '.$nivelVuelo.'';
        $mail->Send();
        
    }

    function setTurno($usuario, $idhospital, $dia, $idusuario)
    {
        $this->database->insertTurnos($idusuario, $idhospital, $dia);
        $nivelVuelo = $this->setNivelVuelo($idusuario);
        $nombreHospital = $this->buscarNombreHospitalPorId($idhospital);
        $_SESSION['usuario'][0]['nivelVuelo'] = $nivelVuelo;
        $this->enviarMailResultadoMedico($usuario,$nombreHospital[0]['nombre'],$dia,$nivelVuelo);
        return "Se ha reservado el turno correctamente. Se le enviara el resultado de su examen al mail.";
    }
    function setNivelVuelo($idusuario){
        $probabilidades = array(3,3,3,3,3,3,2,2,2,1);
        $nivelVuelo = $probabilidades[array_rand($probabilidades,1)];
        $sql = "UPDATE `usuario` SET `nivelVuelo` = '$nivelVuelo' WHERE `idusuario` = '$idusuario'";
        $this->database->update($sql);
        return $nivelVuelo;
    }

    function buscarNombreHospitalPorId($idhospital){
        $sql = "SELECT * FROM hospital WHERE idhospital='".$idhospital."'";
        return $this->database->query($sql);
    }

    public function insertTurnos($idusuario,$hospital,$dia){
        $sql = " INSERT INTO `turno` (`idturno`, `usuario_id`, `hospital_id`, `dia`) VALUES (NULL, '$idusuario', '$hospital', '$dia')";
        $this->database->insertG($sql);
    }
}
