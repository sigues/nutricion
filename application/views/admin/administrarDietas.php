<?php
/*
var_dump($grupos);echo "<br>";
var_dump($perfiles);echo "<br>";
var_dump($horarios);echo "<br>";*/
?>
<div class="container marketing" id="nosotros">

      <div class="row">
      	<div class="span2">
      	<br>
    	</div>
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
	echo "<tr><td>&nbsp;eq</td><td>".$grupo->nombre."</td>";
	foreach($horarios as $horario){
		echo "<td>1</td>";
	}
	echo "</tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>
