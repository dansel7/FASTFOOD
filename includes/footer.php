   <footer id="footer">
		<span>
			Tel:25-100-300
			<br />
			Correo: alamar.mercadeo@gmail.com
			<br />
			Avenida La Capilla No. 539, Colonia San Benito, San Salvador El Salvador
			<br />
			&copy; Derechos Reservados 2013
			<br />
			powered by <a target="_blank" class="versanet" href="http://www.versanetsa.com/" title="Versanet Sistemas">Versanet Sistemas</a>
			<br />
			<a href="http://www.versanetsa.com/" target="_blank"><img src="images/logo_footer.png" height="59" width="53" /></a>
		</span>
   </footer>
   <script src="js/bjqs-1.3.min.js"></script>
  <script>
			$(document).ready(function() {
				$('#banner-fade').bjqs({
					height      : 480,
					width       : 198,
					responsive  : true,
					animtype : 'slide', 
					animduration : 1000, // how fast the animation are
					animspeed : 15000, // the delay between each slide
					automatic : true, // automatic
					// control and marker configuration
					showcontrols : false, // show next and prev controls
					// interaction values
					keyboardnav : true, // enable keyboard navigation
					hoverpause : false, // pause the slider on hover
					// presentational options
					usecaptions : false, // show captions for images using the image title tag
					showmarkers : false, // Show individual slide markers
					centermarkers : false, // Center markers horizontally

				});
				
				$('#banner-top').bjqs({
					height      : 165,
					width       : 790,
					responsive  : true,
					animtype : 'slide', 
					animduration : 650, // how fast the animation are
					animspeed : 7000, // the delay between each slide
					automatic : true, // automatic
					// control and marker configuration
					showcontrols : false, // show next and prev controls
					// interaction values
					keyboardnav : true, // enable keyboard navigation
					hoverpause : false, // pause the slider on hover
					// presentational options
					usecaptions : false, // show captions for images using the image title tag
					showmarkers : false, // Show individual slide markers
					centermarkers : false, // Center markers horizontally

				});

			});
 </script>
<?
	$conexion->cerrar_conexion($enlace);
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42643370-1', 'alamar.org');
  ga('send', 'pageview');

</script>