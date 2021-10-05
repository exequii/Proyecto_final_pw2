<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>TP N*2 - Sanson Ezequiel</title>
</head>
<body>

<?php

$local="localhost";
$userBase="root";
$passwordBase="";
$nombreBase="pw2";

$usuario = $_POST["usuario"];
$password= $_POST["clave"];

$db = new mysqli($local,$userBase,$passwordBase,$nombreBase);

if($db->connect_error){
    echo "Ha ocurrido un error" . $db->connect_error;
}

$usuarioLogin = "SELECT * FROM usuario where usuario = ? and clave = ?";
$comm = $db->prepare($usuarioLogin);


$comm->bind_param("ss",$usuario, $password); //ss string , ssi integer , ssb bolean
$comm->execute();

$usuarioLogin = $comm->get_result();
//var_dump($usuarioLogin);

if($db->error){
    echo "La Consulta produjo un error " .$db->error;
}

$cantidadResultados = $usuarioLogin->num_rows; // si esto da 1, significa que encontro un usuario correcto.

include('./header.php');

if($cantidadResultados >=1){
    echo "<div class='w3-grey w3-container' style='min-height:500px;'>Iniciaste Sesion Correctamente<br>";
    while($fila = $usuarioLogin->fetch_assoc()){
        echo "El ID del usuario ingresado es: ";
        echo $fila["idusuario"] . "<br>";
        echo "Bienvenido: " . $fila["usuario"] . "</div>";
    }
}else echo "El usuario o clave ingresados no existe";

include('./footer.php');

?>

</body>
</html>