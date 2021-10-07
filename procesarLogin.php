<?php

require_once('conexion.php');

$email = $_POST["usuario"];
$password= $_POST["clave"];

$usuarioLogin = "SELECT * FROM usuario where usuario = ? and clave = ?";
$comm = $db->prepare($usuarioLogin);

$comm->bind_param("ss",$email, $password); //ss string , ssi integer , ssb bolean
$comm->execute();
$usuarioLogin = $comm->get_result();
if($db->error){
    echo "La Consulta produjo un error " .$db->error;
}

$cantidadResultados = $usuarioLogin->num_rows; // si esto da 1, significa que encontro un usuario correcto.


if($cantidadResultados == 1){
    //guardo los datos en array
    $usuario = mysqli_fetch_assoc($usuarioLogin);

    //compruebo la clave
    if($password == $usuario['clave']){
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");

    } else {
        $_SESSION['errores'] = "El usuario o clave ingresados no existe";
        var_dump($_SESSION['errores']);
        die();
    }
}else {
    $_SESSION['errores'] = "El usuario o clave ingresados no existe";
    header("Location: login.php");

}

?>

