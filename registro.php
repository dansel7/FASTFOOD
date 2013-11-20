<?php
	session_start();
	require_once("administrator/clases/clase_database.php");
	$conexion = new clase_database();
	$enlace = $conexion->crear_conexion();
	
	if ($_POST['submit'] == "Ingresar" and isset($_POST['submit'])) {
		$_POST['creacion'] = date("Y-m-d H:i:s");
		$_POST['tipo_usuario'] = 9;
		
		$email = sprintf('%s', mysql_real_escape_string($_POST['email']));
		$query_verificar = "SELECT id_usuario FROM usuarios WHERE email = '".$email."' AND tipo_usuario = 9";
		$dataset_verificar = mysql_query($query_verificar, $enlace);
		if(mysql_num_rows($dataset_verificar) > 0){
			?>
				<span style="padding: 12px 20px 12px 38px!important; font-size: 15px!important; color: #222!important; line-height: 1.2!important; border: 1px solid #ccc!important; background: url('../images/info.png') no-repeat 10px 12px #F6E3CE!important; border-color: #f28e2c!important; margin: 0 0 20px 0!important; display: block; font-family:Arial;">
					Ya existe un usuario registrado con el email <?=$email;?>
				</span>
			<?
		}else{
                    
			$resultado = $conexion->formulario_a_database($enlace,'usuarios','submit, Ingresar, ','','insert','');
			if($resultado){
				?>
					<span style="padding: 12px 20px 12px 38px!important; font-size: 15px!important; color: #222!important; line-height: 1.2!important; border: 1px solid #ccc!important; background: url('../images/info.png') no-repeat 10px 12px #F6E3CE!important; border-color: #f28e2c!important; margin: 0 0 20px 0!important; display: block; font-family:Arial;">
						Cuenta registrada exitosamente.<br/>
						Inicia Sesi&oacute;n y disfruta de la mejor experiencia en gastronom&iacute;a
					</span>
					<a href="checkout.php" style="color: #FFF;">Iniciar Sesi&oacute;n</a>
				<?
			}
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
	 
	input, select {
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
    <form action="registro.php" method="post">
		 <label for="nombres">Nombres:</label>
		 <input id="nombres" type="text" name="nombres" required="" />
		 <label for="apellidos">Apellidos:</label>
		 <input id="apellidos" type="text" name="apellidos" required="" />
		 <label for="email">Email:</label>
		 <input id="email" type="email" name="email" placeholder="ejemplo@correo.com" required="" />
		 <label for="password">Contrase&ntilde;a:</label>
		 <input id="password" type="password" name="password" required="" />
		 <label for="password">Sexo:</label>
		 <select name="sexo" style="height: 30px;">
			<option value="F">Femenino</option>
			<option value="M">Masculino</option>
		 </select>
		 <input id="submit" type="submit" name="submit" value="Ingresar" />
		 <div style="clear: both;"></div>
	</form>
  </section>
 </body>
</html>
