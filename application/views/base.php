<!DOCTYPE HTML>
<html>
        <head>
                <title>MeNut :: Portal de nutrición</title>
                <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                <meta name="description" content="" />
                <meta name="keywords" content="" />
                <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,600,700" rel="stylesheet" />
                <script src="<?=base_url()?>/assets/js/jquery.min.js"></script>
                <script src="<?=base_url()?>/assets/js/config.js"></script>
                <script src="<?=base_url()?>/assets/js/skel.min.js"></script>
                <noscript>
                        <link rel="stylesheet" href="assets/css/skel-noscript.css" />
                        <link rel="stylesheet" href="assets/css/style.css" />
                        <link rel="stylesheet" href="assets/css/style-desktop.css" />
                </noscript>
                <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
                <!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
                <!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
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
echo $contenido;
?>
				<div class="wrapper wrapper-style4">
                    <article id="footer" class="container small">
                        <div class="12u">
                                <h3>Encuéntranos en ...</h3>
                                <ul class="social">
                                        <li class="twitter"><a href="http://twitter.com/n33co" class="icon icon-twitter"><span>Twitter</span></a></li>
                                        <li class="facebook"><a href="#" class="icon icon-facebook"><span>Facebook</span></a></li>
                                        <li class="dribbble"><a href="http://dribbble.com/n33" class="icon icon-dribbble"><span>Dribbble</span></a></li>
                                        <li class="linkedin"><a href="#" class="icon icon-linkedin"><span>LinkedIn</span></a></li>
                                        <li class="tumblr"><a href="#" class="icon icon-tumblr"><span>Tumblr</span></a></li>
                                        <li class="googleplus"><a href="#" class="icon icon-google-plus"><span>Google+</span></a></li>
                                        <li class="github"><a href="http://github.com/n33" class="icon icon-github"><span>Github</span></a></li>
                                        <!--
                                        <li class="rss"><a href="#" class="icon icon-rss"><span>RSS</span></a></li>
                                        <li class="instagram"><a href="#" class="icon icon-instagram"><span>Instagram</span></a></li>
                                        <li class="foursquare"><a href="#" class="icon icon-foursquare"><span>Foursquare</span></a></li>
                                        <li class="skype"><a href="#" class="icon icon-skype"><span>Skype</span></a></li>
                                        <li class="soundcloud"><a href="#" class="icon icon-soundcloud"><span>Soundcloud</span></a></li>
                                        <li class="youtube"><a href="#" class="icon icon-youtube"><span>YouTube</span></a></li>
                                        <li class="blogger"><a href="#" class="icon icon-blogger"><span>Blogger</span></a></li>
                                        <li class="flickr"><a href="#" class="icon icon-flickr"><span>Flickr</span></a></li>
                                        <li class="vimeo"><a href="#" class="icon icon-vimeo"><span>Vimeo</span></a></li>
                                        -->
                                </ul>
                        </div>
						<footer>
                                <p id="copyright">
                                        &copy; 2013 MeNut | Imágenes: <a href="http://fotogrph.com">fotogrph</a> | Diseño: <a href="http://html5up.net/">HTML5 UP</a>
                                </p>
                        </footer>
					</article>
                </div>
        </body>
</html>