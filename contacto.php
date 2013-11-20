<?php
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$mensaje = $_POST['mensaje'];
	$para = 'hugodimas11@hotmail.com';
	$titulo = 'ASUNTO DEL MENSAJE';
	$header = 'From: ' . $email;
	$msjCorreo = "Nombre: $nombre\n E-Mail: $email\n Mensaje:\n $mensaje";
  
	if ($_POST['submit']) {
		if (mail($para, $titulo, $msjCorreo, $header)) {
			?>
				<span style="padding: 12px 20px 12px 38px!important; font-size: 15px!important; color: #222!important; line-height: 1.2!important; border: 1px solid #ccc!important; background: url('../images/info.png') no-repeat 10px 12px #F6E3CE!important; border-color: #f28e2c!important; margin: 0 0 20px 0!important; display: block; font-family:Arial;">Su mensaje se ha enviado<br/>Pronto nos comunicaremos con usted</span>
			<?
		} else {
			?>
				<span style="padding: 12px 20px 12px 38px!important; font-size: 15px!important; color: #222!important; line-height: 1.2!important; border: 1px solid #ccc!important; background: url('../images/info.png') no-repeat 10px 12px #F6E3CE!important; border-color: #f28e2c!important; margin: 0 0 20px 0!important; display: block; font-family:Arial;">Fall&oacute; el env&iacute;o del mensaje.<br/>Int&eacute;ntelo de nuevo.</span>
			<?
		}
	}
?>

<!DOCTYPE html>    
<html>
 <head>
  <title>Formulario de contacto</title>
 </head>
 <style type="text/css">
	label {
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
	 
	input, textarea {
		width:380px;
		height:20px;
		background:#666666;
		border:2px solid #f6f6f6;
		padding:5px;
		margin-top:5px;
		font-size:10px;
		color:#ffffff;
	}
	 
	textarea {
		height:100px;
	}
	 
	#submit {
		width:85px;
		height:35px;
		border:none;
		margin-top:10px;
		cursor:pointer;
		background: #e3553c;
	}

 </style>
 <body>
  <section class="formulario">
    <form action="contacto.php" method="post">
		<label for="nombre">Nombre:</label>
		 <input id="nombre" type="text" name="nombre" placeholder="Nombre y Apellido" required="" />
		 <label for="email">Tel&eacute;fono:</label>
		 <input id="telefono" type="text" name="telefono" placeholder="7777-7777" required="" />
		 <label for="email">Email:</label>
		 <input id="email" type="email" name="email" placeholder="ejemplo@correo.com" required="" />
		 <label for="mensaje">Mensaje:</label>
		 <textarea id="mensaje" name="mensaje" placeholder="Mensaje" required=""></textarea>
		 <input id="submit" type="submit" name="submit" value="Enviar" />
	</form>
  </section>
 </body>
</html>
