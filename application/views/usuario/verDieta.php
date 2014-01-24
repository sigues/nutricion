<div class="span8">
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
<div class="span4">
	<div id="muestraAlimentos">
		Selecciona una porción de tu dieta para ver sugerencias.
	</div>
</div>