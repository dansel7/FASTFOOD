<?php 
session_start();
//error_reporting(0);
require 'clases/clase_database.php';
$conexion = new clase_database();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>Fast Food Restautant - Centro de Administraci&oacute;n</title>
	<meta name="author" content="UDB">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	
	<link rel="shortcut icon" href="../favicon.ico">
		
</head>

<body>
				<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="/" target="_blank"><span>Fast Food Restaurant</span></a>
				<!-- theme selector starts -->
				<div class="btn-group pull-right theme-container" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-tint"></i><span class="hidden-phone"> Cambiar Tema / Estilo</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
						<li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
						<li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
						<li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
						<li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
						<li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
						<li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
						<li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
						<li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
					</ul>
				</div>
				<!-- theme selector ends -->
				
			<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $_SESSION['nombreAdmin'] ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Perfil</a></li>
						<li class="divider"></li>
						<li><a href="?logout=0">Cerrar Sesi&oacute;n</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="/" target="_blank">Ir al sitio</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Principal</li>
						<li><a class="ajax-link" href="index.php"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
						<li><a class="ajax-link" href="ordenes.php"><i class="icon-eye-open"></i><span class="hidden-tablet"> Ordenes</span></a></li>
						<li><a class="ajax-link" href="productos.php"><i class="icon-edit"></i><span class="hidden-tablet"> Men&uacute; Productos</span></a></li>
						<li><a class="ajax-link" href="categorias.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Categor&iacute;as</span></a></li>
						<li class="nav-header hidden-tablet">Administraci&oacute;n</li>
						<li><a class="ajax-link" href="user_clientes.php"><i class="icon-align-justify"></i><span class="hidden-tablet"> Registro Clientes</span></a></li>
                                                <li><a class="ajax-link" href="user_admin.php"><i class="icon-user"></i><span class="hidden-tablet"> Usuarios Panel</span></a></li>
                                                <li><a class="ajax-link" href="tour.php"><i class="icon-question-sign"></i><span class="hidden-tablet"> Tour del Panel</span></a></li>
						<li><a href="?logout=0"><i class="icon-lock"></i><span class="hidden-tablet"> 	Cerrar Sesi&oacute;n</span></a></li>
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Inicio</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Menu Productos</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Menu de Productos</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Producto</th>
								  <th>Descripcion</th>
                                                                  <th>Precio</th>
								  <th>Calorias</th>
                                                                  <th>Imagen</th>
                                                                  <th>Categoria</th>
								  <th>Ultima Modificacion</th>
                                                                  <th>Visible</th>
								  <th>Acciones</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                          $enlace = $conexion->crear_conexion();
                          $query_clientes = "SELECT
                                    producto,
                                    descripcion,
                                    precio,
                                    calorias,
                                    imagen,
                                    categoria,
                                    p.modifica,
                                    visible,
                                    id_producto
                                    FROM productos p inner join categorias_productos c on p.id_categoria=c.id_categoria";
                          
                            $result_menusection = $conexion->enviarQuery($enlace, $query_clientes);
                            if($conexion->countRows($result_menusection) > 0){
                                    while($row = mysql_fetch_array($result_menusection)){
                                        if($row["visible"]==1){$var='<span class="label label-success">Visible</span>';}else{ $var='<span class="label label-important">Oculto</span>'; }
                                      echo '<tr>
                                    <td>'.$row["producto"].'</td>
                                    <td class="center">'.$row["descripcion"].'</td>
                                    <td class="center">'.$row["precio"].'</td>
                                    <td class="center">'.$row["calorias"].'</td>
                                    <td class="center">'.$row["imagen"].'</td>
                                    <td class="center">'.$row["categoria"].'</td>
                                    <td class="center">'.$row["modifica"].'</td>
                                    <td class="center">'.$var .'</td>
                                    <td class="center">
                                        <a class="btn btn-success" href="mantto-edit/edit-productos.php">
                                                    <i class="icon-zoom-in icon-white"></i>  
                                                    Nuevo                                            
                                            </a>
                                            <a class="btn btn-info" href="mantto-edit/edit-productos.php?idp='.$row["id_producto"].'">
                                                    <i class="icon-edit icon-white"></i>  
                                                    Edit                                            
                                            </a>
                                            <a class="btn btn-danger" href="mantto-del/del-productos.php?idp='.$row["id_producto"].'">
                                                    <i class="icon-trash icon-white"></i> 
                                                    Delete
                                                </a>
                                        </td>
                                        </tr>' ;
                                    }
                            }
                                    $conexion->cerrar_conexion($enlace);
                           ?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Configuraciones</h3>
			</div>
			<div class="modal-body">
				<p>Sin configuraciones...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
				<a href="#" class="btn btn-primary">Guardar Cambios</a>
			</div>
		</div>

                <footer>
			<p class="pull-left">&copy; <a href="http://www.udb.edu.sv" target="_blank">Universidad Don Bosco</a> <?=date("Y")?></p>
			<p class="pull-right">Powered by: <a href="#">Web Developer Team</a></p>
		</footer>
	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.min.js"></script>
	<script src="js/jquery.flot.pie.min.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="js/charisma.js"></script>
	
</body>
</html>
