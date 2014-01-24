<table class="table">
	<tr>
		<th>Fecha</th>
		<th>Peso</th>
	</tr>
<?php foreach($peso as $c=>$pesoDia){ ?>
		<tr><td><?=$c?></td><td><?=$pesoDia?> Kg</td></tr>
<?php } ?>
</table>