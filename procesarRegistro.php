<?php include('conexion.php');

$usuario = $_POST["usuario"];
$password= $_POST["clave"];
$repitePassword= $_POST["repiteClave"];
$rol = "CLIENTE";

if($password == $repitePassword) {
    $usuarioNuevo = "INSERT INTO usuario (usuario, clave,rol) VALUES (? , ? , '$rol')";
    $comm = $db->prepare($usuarioNuevo);

    $comm->bind_param("ss",$usuario, $password); //ss string , ssi integer , ssb bolean
    $comm->execute();
}else {
    header('Location: registro.php');
    $_SESSION['errores'] = "Las contraseñas no coinciden";

}

$db->close();
header('Location: login.php');

?>