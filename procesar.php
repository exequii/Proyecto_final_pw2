<?php

$local="localhost";
$userBase="root";
$passwordBase="";
$nombreBase="pw2";

$usuario = $_POST["nombre"];
$password= $_POST["clave"];

$db = new mysqli($local,$userBase,$passwordBase,$nombreBase);
//Esto me hace la conexion a la base de datos

if($db->connect_error){
    echo "Ha ocurrido un error" . $db->connect_error;
}

//$consulta = "SELECT * FROM usuario where usuario = '" .$usuario . "' AND clave = '".$password."'";

//Formas seguras de viajar informacion:
//$consulta2 = "SELECT * FROM usuario where usuario = ? and clave = ?";


$consulta2 = "INSERT INTO usuario (usuario, clave) VALUES (? , ?)";
$comm = $db->prepare($consulta2);

$comm->bind_param("ss",$usuario, $password); //ss string , ssi integer , ssb bolean
$comm->execute();
//$resultado4 = $comm->get_result(); //eso no se puede hacer al hacer un INSERT INTO en la consulta, ya que estoy insertando datos
//var_dump($resultado4);

//$query = $db->query($consulta);
//query se usa para enviar en un string la consulta SQL
//$query seria un objeto con la respuesta de SQL
/*
if($db->error){
    echo "La Consulta produjo un error " .$db->error;
}
*/
/******************************************************************** */
/*
$resultado = $query->num_rows;
echo $resultado;
*/
//me indica cuantos registros tiene la consulta


/******************************************************************** */
/*
$resultado2 = $query->fetch_assoc();
var_dump($resultado2);
//fetch_assoc me trae el resultado del primer registro, y luego mueve el puntero al segundo resultado para que si lo hago denuevo
//me traiga el siguiente
//con var dump me debugea la variable que me llega.

$resultado2 = $query->fetch_assoc();
var_dump($resultado2);
*/

/******************************************************************* */
/*
//puedo usar un fetch_all y me trae todo
$resultado3 = $query->fetch_all();
var_dump($resultado3);
*/

// while($resultado3 = $query->fetch_assoc()){
//     echo "El ID del usuario ingresado es: ";
//     echo $resultado3["idusuario"] . "<br>";
// }
/*
while($fila = $resultado4->fetch_assoc()){
         echo "El ID del usuario ingresado es: ";
         echo $fila["idusuario"] . "<br>";
 }

 /*********** HASH a la hora de registrarse que se genere ***********/
// echo md5(time());

$db->close();


if($usuario == "pepe" && $password == "asd"){
    //echo "Hola";
}

else{
    //echo "Le pifiaste";
}


?>