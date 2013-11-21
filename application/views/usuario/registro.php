    <script src="<?=base_url()?>/assets/js/jquery.validate.js"></script>
    <script src="<?=base_url()?>/assets/js/lib/registro.js"></script>
    
<div class="container marketing" id="nosotros">

      <div class="row">
      	<div class="span2">
      	<br>
    	</div>
        <div class="span10">
    	    <form class="form-horizontal" method="post" id="registro" name="registro" method="get" action="">
				<fieldset>
					<legend>Gracias por registrarse - Paso 1</legend>
          <?php echo validation_errors('<span class="label label-danger">','</span><br>'); ?>
          <br>
          <div class="control-group">
				    	<label class="control-label" for="email">Correo Electrónico</label>
				    	<div class="controls">
				    	<input type="text" id="email" name="email" placeholder="Email">
              <label for="email" class="error" id="validaEmail" style="display:none">La dirección de correo que eligió ya está ocupada.</label>
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
				    	<input type="password" name="password" id="password" placeholder="Contraseña">
				    	</div>
				    </div>
          <div class="control-group">
            <label class="control-label" for="confirm_password">Confirmar contraseña</label>
              <div class="controls">
              <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmar contraseña">
              </div>
          </div>
					<p>
					   <input type="checkbox" id="agree" name="agree" />&nbsp;&nbsp;<label for="agree" style="display:inline">Estoy de acuerdo con las políticas de privacidad</label>
					</p>
					<p>
            <input type="hidden" name="inputRegistro" id="inputRegistro" value="registro" />
            <button type="button" class="btn btn-default btn-lg active" id="reset" name="reset">Limpiar formulario</button>
            <button type="button" class="btn btn-info active" name="registrarse" id="registrarse" value="registrarse">Registrarse</button>
					</p>
				</fieldset>
			</form>
</div>
</div>
</div>