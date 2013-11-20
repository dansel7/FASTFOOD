<?php
	include_once('jcart/jcart.php');
	session_start();
	require_once("administrator/clases/clase_database.php");
	
	$conexion = new clase_database();
	$enlace = $conexion->crear_conexion();
	$pagina_actual = basename($_SERVER['PHP_SELF'], ".php");
	
	/*switch($pagina_actual){
		case "quienes-somos":
			$titulo_pagina = "Qui&eacute;nes Somos - Alamar";
			break;
		case "contactanos":
			$titulo_pagina = "Cont&aacute;ctanos - Alamar";
			break;
		case "listado-libros":
			$titulo_pagina = "Listado de Libros - Alamar";
			break;
		default:
			$titulo_pagina = "Alamar";
			$keywords = "alamar, fundaciòn, organizaciòn, ong";
			break;
	}*/

?>
<!DOCTYPE html>
<html lang="es">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="title" content="Fast Food El Salvador - Pedidos de Comida en Linea" />
		<meta name="keywords" content="comida, restaurante, comida rapida, fas food, udb" />
		<meta name="author" content="Universidad Don Bosco - Hugo, Daniel y Rodrigo - EIC" />
		<meta property="og:title" content="Fast Food El Salvador - Pedidos de Comida en Linea" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="http://fastfoodes.net23.net/" />
		<meta name="description" content="Fast Food El Salvador - Pedidos de Comida en Linea" />
		<link rel="icon" href="favicon.ico" type="image/icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1">
		<title>Fast Food Restaurant S.V.</title>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/flexslider.css" type="text/css">	
		<link rel="stylesheet" href="css/styles.css" type="text/css">
		<link rel="stylesheet" href="css/layout.css" type="text/css">
		<link rel="stylesheet" href="css/demo.css" type="text/css">
		<link rel="stylesheet" type="text/css" media="screen, projection" href="jcart/css/jcart.css" />
		<link rel="stylesheet" type="text/css" href="css/source/jquery.fancybox.css?v=2.1.5" media="screen" />
		
	</head>	
   <!--Finaliza seccion de encabezado-->