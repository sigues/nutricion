<div class="row">
	<script src="<?=base_url()?>assets/js/lib/verDieta.js"></script>

<div class="span12">
	<table class="table">
		<thead>
			<tr>
				<th>Total de Equivalentes por dia</th>
				<th>Alimentos</th>
				<?php
					foreach($horarios as $horario){
						echo "<th><span class='horario' onclick='muestraAlimentos(".$horario->idhorario.");'>".$horario->nombre."<span></th>";
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
				$tr .= "<td>$value</td>";
			}
			
			echo "<tr><td>$sumValue</td>
				<td>".$grupo->nombre."</td>".$tr;
			
			echo "</tr>";
		}
		?>
		</tbody>
	</table>
</div>
</div>
<div class="row">
	<div class="span12">
		<div id="muestraAlimentos">
			Selecciona una porción de tu dieta para ver sugerencias.
		</div>
	</div>
</div>