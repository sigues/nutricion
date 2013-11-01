<!DOCTYPE HTML>
<html>
	<head>
		<title>Nutrisanissimo</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,600,700" rel="stylesheet" />
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/config.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="assets/css/skel-noscript.css" />
			<link rel="stylesheet" href="assets/css/style.css" />
			<link rel="stylesheet" href="assets/css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="assets/css/ie7.css" /><![endif]-->
	</head>
	<body>
		<input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>" />
		<!-- Nav -->
			<nav id="nav">
				<ul class="container">
					<li><a href="#top">Inicio</a></li>
					<li><a href="#work">Nosotros</a></li>
					<li><a href="#portfolio">Casos de éxito</a></li>
					<li><a href="#contact">Contacto</a></li>
					<li><button class="button-small button">Iniciar sesión</button></li>
				</ul>
			</nav>

				<?php
					echo $contenido
				?>

					<footer>
						<p id="copyright">
							&copy; 2013 Nutrisa | Imágenes: <a href="http://fotogrph.com">fotogrph</a> | Diseño: <a href="http://html5up.net/">HTML5 UP</a>
						</p>
					</footer>
				</article>
			</div>


	</body>
</html>