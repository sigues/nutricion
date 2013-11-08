<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Carousel Template &middot; Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="<?=base_url()?>assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- Le styles -->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/main.css" rel="stylesheet">
    <script src="<?=base_url()?>/assets/js/jquery.js"></script>

    <style>


    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>/assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>/assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>/assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?=base_url()?>/assets/ico/favicon.png">
  </head>

  <body>
    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper" role="navigation">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">

        <div class="navbar navbar-inverse">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?=base_url()?>">MeNut</a>
            <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
              <ul class="nav" id="top-nav">
                <li <?php
                	if(isset($main)){
                		echo 'class="active"';
                	}
                ?>><a href="<?=base_url()?>">Inicio</a></li>
                <li><a href="<?=base_url()?>#nosotros">Nosotros</a></li>
                <li><a href="<?=base_url()?>#servicios">Servicios</a></li>
                <li><a href="<?=base_url()?>#contacto">Contacto</a></li>
                <!-- Read about Bootstrap dropdowns at http://twbs.github.com/bootstrap/javascript.html#dropdowns -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="nav-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form pull-right form-inline ">
                <input class="span2 input-small" type="text" placeholder="Correo">
                <input class="span2 input-small" type="password" placeholder="Contraseña">
                <button type="submit" class="btn btn-small">Iniciar Sesión</button>
                <button type="submit" class="btn btn-info btn-small" id="btn-registro" url="<?=site_url('usuario/registro')?>">Registro</button>
              </form>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->

      </div> <!-- /.container -->
    </div><!-- /.navbar-wrapper -->

<?php
if(!isset($main)){ ?>
<div class="row">
	<div class="fondoMenu" style="height:90px">
	</div>
</div>
<?php } ?>
<?=$contenido?>
<div class="row">
  	<div class="container marketing" id="nosotros">
  	<!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->
</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url()?>/assets/js/bootstrap-transition.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-alert.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-modal.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-dropdown.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-scrollspy.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-tab.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-tooltip.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-popover.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-button.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-collapse.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap-carousel.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap-typeahead.js"></script>
    <?php
                	if(isset($main)){
                		echo 'class="active"';
                		?>
					    <script src="<?=base_url()?>assets/js/plugins.js"></script>
					    <script>
					         $('#top-nav').onePageNav({
					             currentClass: 'active',
					             changeHash: true,
					             scrollSpeed: 1200
					        });
					    </script>
					    <script>
					      !function ($) {
					        $(function(){
					          // carousel demo
					          $('#myCarousel').carousel()
					        })
					      }(window.jQuery)
					    </script>

                		<?php
                	}
	?>
        <script src="<?=base_url()?>assets/js/main.js"></script>
    <script src="<?=base_url()?>/assets/js/holder/holder.js"></script>
    <input type="hidden" value="<?=base_url()?>" name="base_url" id="base_url" />
  </body>
</html>
