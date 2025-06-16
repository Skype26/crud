<?php

$server="localhost";
$user="root";
$pass="";
$bd="tienda";
/*cadena de conexion*/

$con=new mysqli($server,$user,$pass,$bd);


if($con->connect_error){
    die("error de conexion: ".$con->connect_error);
}