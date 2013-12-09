<script src="<?=base_url()?>assets/js/lib/administrarDietas.js"></script>
<div class="container marketing" id="nosotros">
<form action="" class="form">
      <div class="row">
      	<div class="span2">
      		<ul>
      			<?php foreach($dietas as $vdieta){
      				echo "<li><a href=\"".site_url()."/admin/catalogoDietas/".$vdieta->iddieta."\">".$vdieta->nombre."</a></li>";
      			}?>
      		</ul>
    	</div>
        <div class="span10">
        	<div class="row">
				<p><h2>Nombre de la dieta *</h2>
					<input type="text"  class="input-xxlarge" id="nombre" name="nombre" value="<?=(isset($dieta["dieta"]->nombre))?$dieta["dieta"]->nombre:""?>" />
					<label for="nombre" style="color:#B94A48; display:none" id="labelNombre" >Debe incluir un nombre para la dieta</label>
				</p>
        	</div>
        	<div class="row">
	        	<div class="span4" style="text-align: left;">

				<p><label for="codigo">Código *</label>
					<input type="text" class="input-medium" id="codigo" name="codigo" value="<?=(isset($dieta["dieta"]->codigo))?$dieta["dieta"]->codigo:""?>"/>
					<label style="color:#B94A48; display:none" id="labelCodigo" >Debe incluir un código para la dieta</label>
					<label style="color:#B94A48; display:none" id="labelCodigoUnico" >Este código ya está ocupado</label>
				</p>
				<p><label for="descripcion">Descripción</label>
					<textarea id="descripcion" name="descripcion" ><?=(isset($dieta["dieta"]->descripcion))?$dieta["dieta"]->descripcion:""?></textarea>
				</p>
				</div>
				<div class="span6"><?php //echo "<pre>";var_dump($dieta);echo "</pre>"; ?>
					
<pre>
<input type="checkbox" id="tipoDietaUsuario" class="tipoDieta" name="tipoDieta" value="usuarios" <?=(@sizeof($dieta["usuario_has_dieta"])>0)?"checked='checked'":""?>> Usuarios
</pre>
					<div id="div-usuarios" <?php
					if(@sizeof($dieta["usuario_has_dieta"])>0){
						echo "";
					}else if(sizeof($dieta)==0){
						echo 'style="display:none"';
					}else{
						echo 'style="display:none"';	
					}
					?>
					>
						<select multiple id="usuarios" name="usuarios">
						<?php 
						foreach($usuarios as $usuario){ ?>
							<option value="<?=$usuario->idusuario?>" <?=(isset($dieta["usuario_has_dieta"][$usuario->idusuario]))?" selected='selected' ":""?>><?=$usuario->nombre." ".$usuario->apellido?></option>
						<?php } ?>
						</select>
					</div>
<pre>
<input type="checkbox" id="tipoDietaPerfiles" class="tipoDieta" name="tipoDieta" value="perfiles" <?=(@sizeof($dieta["perfil_has_dieta"])>0)?"checked='checked'":""?>> Perfiles
</pre>
					<div id="div-perfiles" <?php
					if(@sizeof($dieta["perfil_has_dieta"])>0){
						echo "";
					}else if(sizeof($dieta)==0){
						echo 'style="display:none"';
					}else{
						echo 'style="display:none"';	
					}
					?>
					>
					<?php foreach($perfiles as $perfil){ ?>
							<div class="checkbox">
						        <label>
						          <input type='checkbox' class='checkbox checkbox-perfil' 
						          name='perfil-<?=$perfil->idperfil?>' 
						          idperfil='<?=$perfil->idperfil?>' 
						          id='perfil-<?=$perfil->idperfil?>'
						          <?=(isset($dieta["perfil_has_dieta"][$perfil->idperfil]))?"checked='checked'":""?> />
						          <?=$perfil->nombre?>
						          
						        </label>
						        	<span style="display:block;margin-left:20px">
							          Principal
	  						          <input type='checkbox' class='checkbox-perfil-principal' 
	  						          name='principal-<?=$perfil->idperfil?>' 
	  						          id='principal-<?=$perfil->idperfil?>'
	  						          <?=(isset($dieta["perfil_has_dieta"][$perfil->idperfil]->default) && $dieta["perfil_has_dieta"][$perfil->idperfil]->default == true)?" checked='checked' ":"" ?> 
	  						          />
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
						$tr="";
						$sumValue = 0;
						foreach($horarios as $horario){
							$value = (isset($dieta["dieta_has_grupo"][$grupo->idgrupo.'-'.$horario->idhorario]->porciones))?$dieta["dieta_has_grupo"][$grupo->idgrupo.'-'.$horario->idhorario]->porciones:"";
							$sumValue += $value;
							$tr .= "<td><input type='text' class='input-mini horario-grupo horario-grupo-".$grupo->idgrupo."' 
							idgrupo='".$grupo->idgrupo."' idhorario='".$horario->idhorario."' 
							id='".$grupo->idgrupo.'-'.$horario->idhorario."' value='".$value."' /></td>";
						}
						
						echo "<tr><td><input type='text' class='input-mini' 
							id='total-grupo-".$grupo->idgrupo."' idgrupo='".$grupo->idgrupo."' readonly value='".$sumValue."' /></td>
							<td>".$grupo->nombre."</td>".$tr;
						
						echo "</tr>";
					}
					?>
					</tbody>
					</table>
					<p>
					<button type="button" class="btn btn-primary" id="guardarDieta" name="guardarDieta">Guardar</button> 
					<button type="button" class="btn" id="cancelarDieta" name="cancelarDieta" <?=(!isset($dieta["dieta"]->iddieta))?"style='display:none'":""?>>Cancelar</button>
					</p>
					<input type="hidden" name="iddieta" id="iddieta" value="<?=(isset($dieta["dieta"]->iddieta))?$dieta["dieta"]->iddieta:0?>" />
					<input type="hidden" name="site_url" id="site_url" value="<?=site_url()?>" />
				</div>
			</div>
</div>
</div>
</form>
</div>
