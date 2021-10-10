<?php

$local="localhost";
$userBase="root";
$passwordBase="";
$nombreBase="pw2";

$db = new mysqli($local,$userBase,$passwordBase,$nombreBase);

if($db->connect_error){
    echo "Ha ocurrido un error" . $db->connect_error;
}
session_start();

?>