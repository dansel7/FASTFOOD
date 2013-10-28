<?php
session_start();

if(isset($_POST["username"]) && isset($_POST["pass"]) && !isset($_SESSION["user"])){
    if($_POST["username"]=="ddiaz"){
     $_SESSION["user"]="ddiaz";
    }   
}
if(isset($_GET["logout"])){
    session_destroy ();
    header("Location: index.php");
}

if(isset($_SESSION["user"])){
    require "dashboard.php";
}else{    
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>Inicio Sesion Administracion</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="LOGIN FASTFOOD">
	<meta name="author" content="UDB">

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


	<link rel="shortcut icon" href="../favicon.ico">
		
</head>

<body>
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Bienvenido a administraci&oacute;n del sitio</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
                                            Ingrese su nombre de usuario y password
                </div>
                <form class="form-horizontal" action="" method="post">
                        <fieldset>
                                <div class="input-prepend" title="Username" data-rel="tooltip">
                                        <span class="add-on"><i class="icon-user"></i></span>
                                        <input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
                                </div>
                                <div class="clearfix"></div>

                                <div class="input-prepend" title="Password" data-rel="tooltip">
                                        <span class="add-on"><i class="icon-lock"></i></span>
                                        <input class="input-large span10" autocomplete="off" name="pass" id="password" type="password" value="" />
                                </div>
                                <div class="clearfix"></div>

                                <div class="input-prepend">
                                <label class="remember" for="remember">
                                    <input type="checkbox" id="remember" />Recordarme</label>
                                </div>
                                <div class="clearfix"></div>

                                <p class="center span5">
                                <button type="submit" class="btn btn-primary">Login</button>
                                </p>
                        </fieldset>
                </form>
            </div><!--/span-->
    </div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->

	
		
</body>
</html>
<?php
} 
?>
