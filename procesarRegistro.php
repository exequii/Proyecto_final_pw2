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

$usuarioNuevo = "INSERT INTO usuario (usuario, clave) VALUES (? , ?)";
$comm = $db->prepare($usuarioNuevo);

$comm->bind_param("ss",$usuario, $password); //ss string , ssi integer , ssb bolean
$comm->execute();

$db->close();

include('./header.php');
echo "<div class='w3-grey w3-container' style='min-height:500px; background: url(https://i.pinimg.com/originals/24/b9/47/24b9478ec632f3657d4ac19ec9853397.jpg);'>Se ha registrado correctamente</div>";
include('./footer.php');
?>

</body>
</html>