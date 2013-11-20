	<?
		require_once("includes/header.php");
	?>

	<body class="sunfire">
		
		<a id="Top"></a>
		<div id="nav">
			<div id="navitems">
				<div id="logo"><a href="/"><img src="images/logo.png"></a></div>
				<ul>
					<li><a href="/">Inicio</a></li>
					<li><a href="#Specials">Especiales</a></li>
					<?
						if(isset($_SESSION['login_costumer_user']) and $_SESSION['login_costumer_user']==true){
							?>
								<li><a href="#Locations">Contactanos</a></li>
								<li><a href="login.php?method=close">Mi Perfil</a></li>
							<?
						}
						else{
							?>
								<li><a href="#Story">Sobre Nosotros</a></li></li>
								<li><a href="#Locations">Contactanos</a></li>
							<?
						}
						
						if(isset($_SESSION['login_costumer_user']) and $_SESSION['login_costumer_user']==true){
							?><li><a href="login.php?method=close">Cerrar Sesi&oacute;n</a></li><?
						}
						else{
							?><li><a href="login.php" class="login fancybox.iframe">Login</a></li><?
						}
					?>
				</ul>
			</div>
		</div>
		<div id="allconent">
			<div class="contentsection" id="header" style="background:url(images/f1image.jpg) 50% 0 no-repeat; height:645px;">
				<div class="content">
					<?
						if(isset($_SESSION['login_costumer_user']) and $_SESSION['login_costumer_user']==true){
							if($_SESSION['costumer_sex'] == 'F'){
								$message_show = "Bienvenida " . $_SESSION['costumer_name'];
							}else{
								$message_show = "Bienvenido " . $_SESSION['costumer_name'];
							}
							?>
								<div id="content" style="width: 200px; margin: 0 auto;">
									<span style="text-align: center; color: #FFF; display: block; margin-top: 10px;">
										<?=$message_show?>
									</span>
									<div id="jcart"><?php $jcart->display_cart();?></div>
									<p><a href="#Menu">&larr; Continuar Comprando</a></p>
								</div>
							<?
						}else{
							?>
								 <style type="text/css">
									label{
										display:block;
										margin-top:10px;
										letter-spacing:1px;
										color: #FFF;
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

								 </style>
								 <section class="formulario">
									<form action="login.php" method="post">
										 <label for="email">Email:</label>
										 <input id="email" type="email" name="email" placeholder="ejemplo@correo.com" required="" />
										 <label for="email">Contrase&ntilde;a:</label>
										 <input id="password" type="password" name="password" required="" />
										 <input id="submit" type="submit" name="submit" value="Ingresar" />
										 <div style="clear: both;"></div>
										 <a class="register_nu" href="registro.php" style="float: right; color: #FFF;">Registrarme</a>
									</form>
								 </section>
							<?
						}
					?>
				</div>
			</div>
			
			<a id="Menu"></a>
			<div class="contentsection beige">
				<div class="content">
					<img src="images/seal.png" class="seal">
					<h1>Nuestro Men&uacute;</h1>
					<h2>Satisface tu hambre con nuestro exquisito men&uacute;!</h2>
					<div id="menu">
						
						<?
							$query_select_menusection = "SELECT id_categoria, categoria, icono FROM categorias_productos ORDER BY id_categoria ASC";
							$result_menusection = $conexion->enviarQuery($enlace, $query_select_menusection);
							if($conexion->countRows($result_menusection) > 0){
								while($filas_menusection = mysql_fetch_array($result_menusection)){
									?>
										<div class="menusection">
											<h2><?=$filas_menusection['categoria']?> <img class="tape" src="icon_categorias/<?=$filas_menusection['icono']?>"></h2>
											<div class="cols clearfix">
												<?
													$query_select_product = "SELECT * FROM productos WHERE visible = 1 AND id_categoria = " . $filas_menusection['id_categoria'];
													$result_item_product = $conexion->enviarQuery($enlace, $query_select_product);
													if($conexion->countRows($result_item_product) > 0){
														$class_selected = "col1";
														$control_flat = 1;
														while($filas_item_product = mysql_fetch_array($result_item_product)){
															?>
																<div class="<?=$class_selected?>">
																	<div class="menuitem">
																		<form method="post" action="" class="jcart">
																			<input type="hidden" name="my-item-id" value="<?=$filas_item_product['id_producto']?>" />
																			<input type="hidden" name="my-item-name" value="<?=$filas_item_product['producto']?>" />
																			<input type="hidden" name="my-item-price" value="<?=number_format($filas_item_product['precio'], 2)?>" />
																			<input type="hidden" name="my-item-url" value="" />
																			<input type="hidden" name="my-item-qty" value="1" />
																			
																			<h3><?=$filas_item_product['producto']?></h3>
																			<img src="images/img_prueba.jpg" class="image_item" alt="<?=$filas_item_product['producto']?>" title="<?=$filas_item_product['producto']?>" />
																			<p><?=$filas_item_product['descripcion']?></p>
																			<p class="price">$ <?=number_format($filas_item_product['precio'], 2)?></p>
																			<p class="calories"><?=$filas_item_product['calorias']?> Calorias</p>
																			<?
																				if(isset($_SESSION['login_costumer_user']) and $_SESSION['login_costumer_user']==true){
																					?>
																						<input type="submit" name="my-add-button" value="Agregar" class="addcart_btn" />
																					<?
																				}else{
																					?>
																						<a class="addcart_btn login fancybox.iframe" href="login.php" style="width: 150px;">Iniciar Sesi&oacute;n</a>
																					<?
																				}
																			?>
																		</form>
																	</div>
																</div>
															<?
															if($control_flat == 1){
																$control_flat = 2;
																$class_selected = "col2"; 
															}else{
																$control_flat = 1;
																$class_selected = "col1"; 
															}
														}
													}
												?>
												
												
											</div>
										</div>
									<?
								}
							}
						?>
					</div>
				</div>
			</div>
			
			
			<a id="Specials"></a>
			<div class="contentsection dark">
				<div class="content">
					<div class="left">
						<h1>Especiales</h1>
						<p class="callout">Conoce las diferentes promociones que tenemos en d&iacute;as especiales y ven a celebrar con nosotros tus eventos, baby shower y cumplea&nilde;os.</p><br>
						<div class="special">
							<h2>Lunch Ejecutivos</h2>
							<p><i>11:00am-3:00pm Todos los d&iacute;as, todas las semanas</i></p>
							<p>Bebidas acorde a tu altura, mimosas y Bloody Marys</p>
						</div>
						<div class="special">
							<img src="images/happyhour.png">
							<h2>Happy Hour</h2>
							<p><i>5:00pm-7:00pm Todos los viernes</i></p>
							<p>Precios especiales en comidas seleccionadas.</p>
						</div>
						<div class="special">
							<h2>Celebra tu fiesta con nosotros!</h2>
							<p><i>Te ayudamos a organizar tu fiesta en nuestras instalaciones.</i></p>
							<p>Cont&aacute;ctanos y deja que los expertos te asesoren</p>
						</div>
					</div>
					<div id="beer">
						
					</div>
				</div>
			</div>
			
			
			<a id="Story"></a>
			<div class="contentsection orange" style="background-image:url(images/bs.png); background-position:92% -45px;">
				<div class="content">
					<h1>Sobre Nosotros</h1>
					<h2>Bienvenidos a nuestro restaurante!!.</h2>
					<p class="callout full">
						Bodas. Graduaciones. Un evento de negocios. Cualquiera que sea la razón o por ninguna razón en absoluto, 
						todos queremos estar en la presencia de buena comida, buena bebida y buenos amigos.
					</p>
					<p class="callout full">
						El amor por la comida, bebidas ex&oacute;ticas, los amigos, y una habilidad especial para poner los tres juntos de una manera que es inolvidable.
					</p>
					<p class="callout full">Y ahora siempre a la vanguardia de la tecnolog&iacute;a contamos con nuestro nuevo y novedoso sistema
					de ordenes en l&iacute;nea donde podr&aacute;s realizar tus pedidos desde cualquier zona de San Salvador y te lo llevamos hasta
					donde te encuentres, de una forma f&aacute;cil para que siempre disfrutes de nuestros exquisitos platillos.</p><br>
					<div id="wheel">
						<img src="images/wheel.png">
						<img src="images/wheel.png">
					</div>
				</div>
			</div>

			<a id="Locations"></a>
			<div class="contentsection beige">
				<div class="content">
					<h1>Cont&aacute;ctanos</h1>
					<p class="callout">Visita nuestras instalaciones y disfruta de la mejor atenci&oacute;n cuando disfrutes de nuestros exquisitos platillos</p>
					<div id="map" data-lat="13.716154" data-long="-89.1537"></div>
					<div id="maplocations">
						<div class="locationitem clearfix" data-lat="26.711574" data-long="-80.036144">
							<div class="fb-like" data-href="http://fastfoodes.net23.net/" data-width="140" data-colorscheme="light" data-layout="box_count" data-action="recommend" data-show-faces="false" data-send="true"></div>
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://fastfoodes.net23.net/" data-via="HuguitoBox" data-lang="es" data-size="large" data-hashtags="fastfoodUDB">Twittear</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
						</div>
						<div class="locationitem clearfix" data-lat="25.794945" data-long="-80.224972">
							<h3>Comun&iacute;cate con nosotros</h3>
							<p>Env&iacute;anos tu mensaje, sugerencia o comentario y te responderemos lo m&aacute;s pronto posible!</p>
							<p class="telephone"><a href="contacto.php" class="button fancybox fancybox.iframe">Contactar</a></p>
						</div>
						<div class="locationitem clearfix" data-lat="13.716154" data-long="-89.1537">
							<h3>Visitanos en Campus Ciudadela</h3>
							<p>Calle a Plan del Pino, Km 1 1/2, Ciudadela Don Bosco, Soyapango.</p>
							<p class="telephone"><a href="#" class="button">(503)2251-8200</a></p>
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="footer">
				<div id="footercontent">
					<div class="clearfix">
						<div class="content">
							<p>We hoped you had fun on our interactive site. Now come try our food! &nbsp;&nbsp;&nbsp;<a class="button anchor" href="#Top">Back to Top</a></p>
						</div>
						<div id="socialmedia">
							<ul>
								<li class="twitter"><a href="#"><img src="images/twitter.png"></a></li>
								<li class="facebook"><a href="#"><img src="images/facebook.png"></a></li>
								<li class="vimeo"><a href="#"><img src="images/vimeo.png"></a></li>
							</ul>
						</div>
					</div>
					<p class="copyright">&copy; Copyright Universidad Don Bosco 2013</p>
				</div>
			</div>
			
		</div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/jquery.sticky.js"></script>
		<script type="text/javascript" src="js/jquery.mousewheel-3.0.4.pack.js"></script>
		<script src="js/jqueryeasing.js"></script>
		<script src="js/flexslider.js"></script>
		<script src="js/site.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaXBe4RxtbrU2clirhC4fpzY4E6riZC_Y&amp;sensor=false"></script>
		<script src="js/maps.js"></script>
		<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
	
		<script type="text/javascript">
			$(document).ready(function()
			{
					$('#btnShop').toggle(function(){
						$('#colorpicker').css("overflow","hidden");
						$('#colorpicker').animate({height:30},200);
					},function(){
						$('#colorpicker').css("overflow","auto");
						$('#colorpicker').animate({height:200},200);
					});
					
					$('.fancybox').fancybox({
						maxWidth	: 410,
						maxHeight	: 410,
						fitToView	: false,
						width		: '70%',
						height		: '70%',
						autoSize	: false,
						closeClick	: false,
						openEffect	: 'none',
						closeEffect	: 'none'
					});
					
					$('.login').fancybox({
						maxWidth	: 410,
						maxHeight	: 210,
						fitToView	: false,
						width		: '70%',
						height		: '70%',
						autoSize	: false,
						closeClick	: false,
						openEffect	: 'none',
						closeEffect	: 'none'
					});
					
					$( ".register_nu" ).live( "click", function() {
						$this = $(this);
						$.fancybox({
							href: $this.attr('href'),
							type: 'iframe',
							fitToView	: false,
							width		: '70%',
							height		: '70%',
							autoSize	: false,
							closeClick	: false,
							openEffect	: 'none',
							closeEffect	: 'none'
							
						});
						return false;
					});
			});
		</script>
		
	</body>
	<script type="text/javascript" src="jcart/js/jcart.min.js"></script>
</html>

<?
	$conexion->cerrar_conexion($enlace);
?>