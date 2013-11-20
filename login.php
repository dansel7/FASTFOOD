<?php
	session_start();
	require_once("administrator/clases/clase_database.php");
	$conexion = new clase_database();
	$enlace = $conexion->crear_conexion();
	
	$email = sprintf('%s', mysql_real_escape_string($_POST['email']));
	$password = sprintf('%s', mysql_real_escape_string($_POST['password']));
	
	
	if(isset($_GET['method']) and $_GET['method']=="close"){
		$_SESSION['login_costumer_user'] = false;
		unset($_SESSION['login_costumer_user']);
		unset($_SESSION['id_costumer']);
		unset($_SESSION['costumer_name']);
		session_destroy();
		header("Location: /");
	}
  
	if ($_POST['submit'] == "Ingresar" and isset($_POST['submit'])) {
		$query_login = "SELECT id_usuario, concat(nombres, ' ', apellidos) as costName, sexo FROM usuarios WHERE email = '".$email."' AND password = AES_ENCRYPT('".$password."','fastf00d') AND tipo_usuario = 9";
		$dataset_login = mysql_query($query_login, $enlace);
		if(mysql_num_rows($dataset_login) > 0){
			$_SESSION['login_costumer_user'] = true;
			$_SESSION['costumer_id'] = mysql_result($dataset_login, 0, 'id_usuario');
			$_SESSION['costumer_name'] = mysql_result($dataset_login, 0, 'costName');
			$_SESSION['costumer_sex'] = mysql_result($dataset_login, 0, 'sexo');
			
			mysql_query("UPDATE usuarios SET ultimo_ingreso = '".date("Y-m-d H:i:s")."', ip_last_login = '".getRealIP()."', origen_ip = '".getOrigen()."' WHERE id_usuario = " . $_SESSION['costumer_id'], $enlace);
			?>
				<script type="text/javascript">
					parent.document.location.href="index.php";
				</script>
			<?
		}else{
			unset($_SESSION['login_costumer_user']);
			?>
				<span style="padding: 12px 20px 12px 38px!important; font-size: 15px!important; color: #222!important; line-height: 1.2!important; border: 1px solid #ccc!important; background: url('../images/info.png') no-repeat 10px 12px #F6E3CE!important; border-color: #f28e2c!important; margin: 0 0 20px 0!important; display: block; font-family:Arial;">Email o contrase&ntilde;a incorrecto.<br/>Int&eacute;ntelo de nuevo.</span>
			<?
		}
	}
	$conexion->cerrar_conexion($enlace);
?>

<!DOCTYPE html>    
<html>
 <head>
  <title>Login</title>
 </head>
 <style type="text/css">
	label, a {
		display:block;
		margin-top:10px;
		letter-spacing:1px;
		color: #C4361D;
	}
	.formulario {
		display:block;
		margin:0 auto;
		width: 400px;
		color: #666666;
		font-family:Arial;
	}
	form {
		margin:0 auto;
		width:390px;
	}
	 
	input {
		width:380px;
		height:20px;
		background:#666666;
		border:2px solid #f6f6f6;
		padding:5px;
		margin-top:5px;
		font-size:10px;
		color:#ffffff;
	}
	 
	#submit {
		width:85px;
		height:35px;
		border:none;
		margin-top:10px;
		cursor:pointer;
		background: #e3553c;
	}
	
	a{
		float: right;
		text-decoration: none;
	}
	a:hover{
		text-decoration: underline;
	}

 </style>
 <body>
  <section class="formulario">
    <form action="login.php" method="post">
		 <label for="email">Email:</label>
		 <input id="email" type="email" name="email" placeholder="ejemplo@correo.com" required="" />
		 <label for="email">Contrase&ntilde;a:</label>
		 <input id="password" type="password" name="password" required="" />
		 <input id="submit" type="submit" name="submit" value="Ingresar" />
		 <div style="clear: both;"></div>
		 <a class="register_nu" href="registro.php">Registrarme</a>
	</form>
  </section>
 </body>
</html>
<?
	function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];
		   
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
	   
		return $_SERVER['REMOTE_ADDR'];
	}
	
	function getOrigen() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return "IP COMPARTIDA";
		   
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return "IP PROXY";
	   
		return "IP ACCESO";
	}
?>
