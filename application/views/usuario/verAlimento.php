<?php $cantidad = $alimento->cantidad * $grupo->porciones; ?>
<div class="span3">
	<img src="<?=base_url()?>assets/uploads/files/alimentos/<?=$alimento->imagen?>" />
	<p><?= $alimento->nombreAlimento?></p>
	<p><?= $cantidad." ".$alimento->abreviatura ?></p>
</div>