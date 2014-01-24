<script type="text/javascript" src="<?=base_url()?>assets/js/lib/listadoPeso.js"></script>

<div id="listadoPeso">
	<div id="tablaListadoPeso">
		<?php 
			$data["peso"] = $peso;
			$this->load->view("usuario/tablaListadoPeso",$data);
		?>
	</div>
	<div id="nuevoListadoPeso">
		<div class="span3">
			<input type="text" placeholder="Ingrese su peso actual" id="pesoActual" />
		</div>
		<div class="span1">
			<button id="guardarPesoActual">Guardar</button>
		</div>
	</div>
</div>