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
				</p>
				<p><label for="descripcion">Descripción</label>
					<textarea id="descripcion" name="descripcion" ></textarea>
				</p>
				</div>
				<div class="span6">
					<?php foreach($perfiles as $perfil){ ?>
							<div class="checkbox">
						        <label>
						          <input type='checkbox' class='checkbox' name='perfil-<?=$perfil->idperfil?>' id='perfil-<?=$perfil->idperfil?>'/>
						          <input type="checkbox"> <?=$perfil->nombre?>
						        </label>
						      </div>
					<?php } ?>
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
						echo "<tr><td><input type='text' class='input-mini' id='total-grupo-".$grupo->idgrupo."' readonly/></td>
								<td>".$grupo->nombre."</td>";
						foreach($horarios as $horario){
							echo "<td><input type='text' class='input-mini horario-grupo' id='".$grupo->idgrupo.'-'.$horario->idhorario."' /></td>";
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
