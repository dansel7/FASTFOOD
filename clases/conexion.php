<?php


$dbhost = "mysql"; // El host

$dbuser = "versanet"; // El usuario
 
$dbpass = "egga8466-2"; // El Pass
 
$db = "soporte"; // Nombre de la base
 

 
$connect=mysql_connect("$dbhost","$dbuser","$dbpass"); // se conecta con la db
mysql_select_db("$db")or die(mysql_error());
 
echo "Conexion Establecida";

?>