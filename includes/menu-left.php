	<div id="left_container">
		<img src="images/actividades.png" width="197" height="42" alt="Actividades" title="Actividades" />
		<a href="actividades.php?actividad=1" class="enlaces_actividades"><img src="images/ninias.png" width="197" height="46" alt="Ninias" title="Ni&ntilde;as" /></a>
		<a href="actividades.php?actividad=2" class="enlaces_actividades"><img src="images/bachilleres.png" width="197" height="46" alt="Bachilleres" title="Bachilleres" /></a>
		<a href="actividades.php?actividad=3" class="enlaces_actividades"><img src="images/universitarias.png" width="197" height="46" alt="Universitarias" title="Universitarias y Profesionales" /></a>
		<a href="actividades.php?actividad=4" class="enlaces_actividades"><img src="images/senioras.png" width="197" height="46" alt="Se&ntilde;oras" title="Se&ntilde;oras" /></a>
		<span class="proximos_eventos">
			Pr&oacute;ximos eventos
		</span>
		 
		<?
			$sql_banner_lateral = "SELECT * FROM banner WHERE tipo = 2";
			$dataset_banner = mysql_query($sql_banner_lateral, $enlace);
			
			//width="198" height="459"
		?>
		 
		<div id="banner-fade">
			 <ul class="bjqs">
			 <?
				while($filas_banner_lateral = mysql_fetch_array($dataset_banner)){
					$ruta = $filas_banner_lateral['nombre_archivo'];
					?>
						<li><img src="images_banner/<?=$ruta?>" width="198" alt="Proximos Eventos" title="" /></li>
					<?
				}
			 ?>
			</ul>
		</div>
	</div>