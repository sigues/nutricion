<div class="container marketing" id="nosotros">

    <div class="row">
      	<div class="span2">
      	<br>
    	</div>
        <div class="span10">
    	    <form class="form-horizontal" id="login" name="login" method="post"  action="<?=site_url('usuario/iniciarSesion')?>">
				<fieldset>
						<legend>Iniciar Sesión</legend>
		          <br>
		          <div class="control-group">
				    	<label class="control-label" for="email">Correo Electrónico</label>
				    	<div class="controls">
				    	<input type="text" id="correo" name="correo" placeholder="Correo Electrónico">
				    	</div>
				    </div>
				    <div class="control-group">
				    	<label class="control-label" for="nombre">Contraseña</label>
				    	<div class="controls">
				    	<input type="password" id="contrasena" name="contrasena" placeholder="Contraseña">
				    	</div>
				    </div>
					<p>
			    <input type="hidden" name="iniciarSesion" id="iniciarSesion" value="true">
			            <button type="submit" class="btn btn-info active" name="iniciarSesion" id="iniciarSesion" value="iniciarSesion">Iniciar Sesión</button>
					</p>
				</fieldset>
			</form>
		</div>
	</div>
</div>