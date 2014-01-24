<script type="text/javascript" src="<?=base_url()?>assets/js/lib/listadoPeso.js"></script>

<div id="listadoPeso">
	<table class="table">
		<tr>
			<th>Fecha</th>
			<th>Peso</th>
		</tr>
	<?php foreach($peso as $c=>$pesoDia){ ?>
			<tr><td><?=$c?></td><td><?=$pesoDia?> Kg</td></tr>
	<?php } ?>
		<tr><td><input type="text" placeholder="Ingrese su peso actual" id="pesoActual" /></td><td><button id="guardarPesoActual">Guardar</button></td></tr>
	</table>
</div>