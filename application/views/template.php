<!DOCTYPE html>
<html lang="en">
<?php 
if(!$this->session->userdata("is_logged") != null ){
		$this->session->set_userdata("is_logged",false);
	} 
	?>

  <head>
    <meta charset="utf-8">
    <title>Nutink</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <script src="<?=base_url()?>/assets/js/jquery.js"></script>
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/main.css" rel="stylesheet">

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
<?php

$this->load->view("navbar");

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
                	if(isset($main)){ ?>
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
    <link rel="stylesheet" href="<?=base_url()?>assets/css/colorbox.css" />
    <script src="<?=base_url()?>assets/js/jquery.colorbox.js"></script>

    <input type="hidden" value="<?=base_url()?>" name="base_url" id="base_url" />
  </body>
</html>
