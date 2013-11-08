<?php

//var_dump($paises);
?>
    <script src="<?=base_url()?>/assets/js/jquery.validate.js"></script>
    <script src="<?=base_url()?>/assets/js/lib/registro.js"></script>
    
 <!--   <form class="form-horizontal" method="post" id="registro" name="registro">
    <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
    <input type="text" id="inputEmail" placeholder="Email">
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
    <input type="password" id="inputPassword" placeholder="Password">
    </div>
    </div>
    <div class="control-group">
    <div class="controls">
    <label class="checkbox">
    <input type="checkbox"> Remember me
    </label>
    <button type="submit" class="btn">Sign in</button>
    </div>
    </div>
    </form>!-->
<div class="container marketing" id="nosotros">

      <!-- Three columns of text below the carousel -->
      <div class="row">
      	<div class="span2">
      	<br>
    	</div>
        <div class="span10">
    	    <form class="form-horizontal" method="post" id="registro" name="registro" method="get" action="">
				<fieldset>
					<legend>Gracias por registrarse</legend>
					<div class="control-group">
				    	<label class="control-label" for="email">Correo Electrónico</label>
				    	<div class="controls">
				    	<input type="text" id="email" name="email" placeholder="Email">
				    	</div>
				    </div>
				    <div class="control-group">
				    	<label class="control-label" for="nombre">Nombre/s</label>
				    	<div class="controls">
				    	<input type="text" id="nombre" name="nombre" placeholder="Nombre/s">
				    	</div>
				    </div>
					<div class="control-group">
				    	<label class="control-label" for="apellido">Apellido/s</label>
				    	<div class="controls">
				    	<input type="text" name="apellido" id="apellido" placeholder="Apellido/s">
				    	</div>
				    </div>
					<div class="control-group">
				    	<label class="control-label" for="password">Contraseña</label>
				    	<div class="controls">
				    	<input type="text" name="password" id="password" placeholder="Contraseña">
				    	</div>
				    </div>
					<div class="control-group">
						<label class="control-label" for="confirm_password">Confirmar contraseña</label>
				    	<div class="controls">
				    	<input type="text" name="confirm_password" id="confirm_password" placeholder="Confirmar contraseña">
				    	</div>
				    </div>


					<p>
						<label for="agree">Estoy de acuerdo con las políticas de privacidad</label>
						<input type="checkbox" class="checkbox" id="agree" name="agree" />
					</p>
					<p>
						<input class="submit" type="submit" value="Submit"/>
					</p>
				</fieldset>
			</form>
