<div class="container marketing">

      <div class="row">
        <div class="span12">


			<?php 
			foreach($css_files as $file): ?>
				<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
			<?php endforeach; ?>
			<?php foreach($js_files as $file): ?>
				<script src="<?php echo $file; ?>"></script>
			<?php endforeach; ?>
<!--					<a href='<?php echo site_url('examples/customers_management')?>'>Customers</a> |
					<a href='<?php echo site_url('examples/orders_management')?>'>Orders</a> |
					<a href='<?php echo site_url('examples/products_management')?>'>Products</a> |
					<a href='<?php echo site_url('examples/offices_management')?>'>Offices</a> | 
					<a href='<?php echo site_url('examples/employees_management')?>'>Employees</a> |		 
					<a href='<?php echo site_url('examples/film_management')?>'>Films</a> | 
					<a href='<?php echo site_url('examples/film_management_twitter_bootstrap')?>'>Twitter Bootstrap Theme [BETA]</a> | 
					<a href='<?php echo site_url('examples/multigrids')?>'>Multigrid [BETA]</a>
!-->
				<div>
					<?php if(isset($titulo)){ ?>
						<h1><?php echo $titulo; ?></h1>
					<?php }?>
					<?php if(isset($subtitulo)){ ?>
						<?php echo $subtitulo; ?>
					<?php }?>
				</div>  
			    <div>
					<?php echo $output; ?>
			    </div>


        </div><!-- /.span4 -->
      </div><!-- /.row -->

</div>
      <!-- START THE FEATURETTES -->



    <!--
</body>
</html>!-->
