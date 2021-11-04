<?php

use PHPMailer\PHPMailer\PHPMailer;
require './helpers/Exception.php';
require './helpers/PHPMailer.php';
require './helpers/SMTP.php';

class ProcesarReservaModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function consultarSiElVueloYaExiste($fecha,$idequipo,$horario,$tipoVuelo,$origen,$destino){
        $SQL = "SELECT * FROM `vuelo` WHERE `equipo_id` = '".$idequipo."' AND `dia` = '".$fecha."' AND `horario` = '".$horario."' AND `tipo_vuelo` = '".$tipoVuelo."' AND `origen` = '".$origen."' AND `destino` = '".$destino."'";
        return $this->database->query($SQL);
    }

    public function obtenerEquipoDelVuelo($id_equipo){
        $SQL = "SELECT * FROM `equipo` WHERE `idequipo` = '".$id_equipo."'";
        return $this->database->query($SQL);
    }

    public function crearVuelo($fecha,$idequipo,$duracion,$horario,$tipoVuelo,$origen,$destino,$general,$familiar,$suite){
        $SQL = "INSERT INTO `vuelo`(`dia`, `equipo_id`, `duracion`, `origen`, `horario`, `tipo_vuelo`, `destino`, `general`, `familiar`, `suite`) VALUES ($fecha,$idequipo,$duracion,'$origen',$horario,'$tipoVuelo','$destino',$general,$familiar,$suite)";
        $this->database->insertG($SQL);
    }

    public function realizarReserva($idvuelo,$idusuario,$comprobante,$tipo_asiento,$numero_asiento,$fila_asiento){
        $SQL = "INSERT INTO `reserva`(`vuelo_id`, `usuario_id`, `comprobante`, `tipo_asiento`, `numero_asiento`,`fila_asiento`) VALUES ($idvuelo,$idusuario,'$comprobante','$tipo_asiento',$numero_asiento,'$fila_asiento')";
        $this->database->insertG($SQL);
    }

    public function actualizarCapacidadVuelo($tipo_asiento,$idvuelo){
        $SQL = "UPDATE `vuelo` SET `$tipo_asiento` = `$tipo_asiento` - 1 WHERE `idvuelo` = '".$idvuelo."'";
        $this->database->update($SQL);
    }

    public function consultarPorAsientosDeUnVueloEspecifico($idvuelo){
        $SQL = "SELECT tipo_asiento,numero_asiento,fila_asiento FROM `reserva` WHERE `vuelo_id` = '".$idvuelo."'";
        return $this->database->query($SQL);
    }

    function enviarMailReserva($usuario,$comprobante,$tipo_asiento,$numero_asiento,$fila_asiento,$fecha,$origen,$destino,$tipoVuelo){

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
        $mail->Subject = 'Informacion Reserva - GauchoRocket';
        $mail->Body = '<h1>Felicidades! Ha realizado su reserva satisfactoriamente.</h1><br>
                        <h2>Informacion de su reserva:</h2><br>
                        <h4>- Codigo de comprobante: ' .$comprobante. '</h4><br>
                        <h4>- Dia de Partida: ' .$fecha.'</h4><br>
                        <h4>- Punto de Partida: ' .$origen. '</h4><br>
                        <h4>- Punto de Destino: ' .$destino. '</h4><br>
                        <h4>- Tipo de Vuelo: ' .$tipoVuelo. '</h4><br>
                        <h4>- Tipo de Asiento: ' .$tipo_asiento. '</h4><br>
                        <h4>- Fila de Asiento: ' .$fila_asiento. '</h4><br>
                        <h4>- Numero de Asiento: ' .$numero_asiento. '</h4>';
        $mail->AltBody = 'Esto es la informacion de su reserva';
        $mail->Send();
        
    }
}
?>