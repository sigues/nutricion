<script src="<?=base_url()?>assets/js/lib/administrarDietas.js"></script>
<div class="container marketing" id="nosotros">
<form action="" class="form">
      <div class="row">
      	<div class="span2">
      	<br>hhh
      	<br>hhh
      	<br>hhh
      	<br>hhh
    	</div>
        <div class="span10">
        	<div class="row">
				<p><h2>Nombre de la dieta *</h2>
					<input type="text"  class="input-xxlarge" id="nombre" name="nombre" />
					<label for="nombre" style="color:#B94A48; display:none" id="labelNombre" >Debe incluir un nombre para la dieta</label>
				</p>
        	</div>
        	<div class="row">
	        	<div class="span4" style="text-align: left;">

				<p><label for="codigo">Código *</label>
					<input type="text" class="input-medium" id="codigo" name="codigo" />
					<label style="color:#B94A48; display:none" id="labelCodigo" >Debe incluir un código para la dieta</label>
					<label style="color:#B94A48; display:none" id="labelCodigoUnico" >Este código ya está ocupado</label>
				</p>
				<p><label for="descripcion">Descripción</label>
					<textarea id="descripcion" name="descripcion" ></textarea>
				</p>
				</div>
				<div class="span6">
					<p>
						<input type="radio" id="tipoDietaPerfiles" class="tipoDieta" name="tipoDieta" value="perfiles" checked="checked"> Perfiles - 
						<input type="radio" id="tipoDietaUsuario" class="tipoDieta" name="tipoDieta" value="usuarios">Usuarios</p>
					<div id="div-usuarios" style="display:none">
						<select multiple id="usuarios" name="usuarios">
						<?php 
						foreach($usuarios as $usuario){ ?>
							<option value="<?=$usuario->idusuario?>"><?=$usuario->nombre." ".$usuario->apellido?></option>
						<?php } ?>
						</select>
					</div>
					<div id="div-perfiles">
					<?php foreach($perfiles as $perfil){ ?>
							<div class="checkbox">
						        <label>
						          <input type='checkbox' class='checkbox checkbox-perfil' name='perfil-<?=$perfil->idperfil?>' idperfil='<?=$perfil->idperfil?>' id='perfil-<?=$perfil->idperfil?>'/>
						          <?=$perfil->nombre?>
						          
						        </label>
						        	<span style="display:block;margin-left:20px">
							          Principal
	  						          <input type='checkbox' class='checkbox-perfil-principal' disabled="disabled" name='principal-<?=$perfil->idperfil?>' id='principal-<?=$perfil->idperfil?>'/>
  						          </span>
						      </div>
					<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span10">
					<table class="table">
					<thead>
						<tr>
							<th>Total de Equivalentes por dia</th>
							<th>Alimentos</th>
							<?php
								foreach($horarios as $horario){
									echo "<th>".$horario->nombre."</th>";
								}
							?>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach($grupos as $grupo){
						echo "<tr><td><input type='text' class='input-mini' id='total-grupo-".$grupo->idgrupo."' idgrupo='".$grupo->idgrupo."' readonly /></td>
								<td>".$grupo->nombre."</td>";
						foreach($horarios as $horario){
							echo "<td><input type='text' class='input-mini horario-grupo horario-grupo-".$grupo->idgrupo."' idgrupo='".$grupo->idgrupo."' idhorario='".$horario->idhorario."' id='".$grupo->idgrupo.'-'.$horario->idhorario."' /></td>";
						}
						echo "</tr>";
					}
					?>
					</tbody>
					</table>
					<p><button type="button" class="btn btn-primary" id="guardarDieta" name="guardarDieta">Guardar</button></p>
					<input type="hidden" name="iddieta" id="iddieta" value="0" />
				</div>
			</div>
</div>
</div>
</form>
</div>
