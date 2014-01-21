<script src="<?=base_url()?>assets/js/lib/historiaNutricion.js"></script>
<form id="historiaNutricion" onsubmit="return false;">

<?php

//var_dump($preguntas);
$pregAnterior = 0;
foreach($preguntas as $pregunta){
	//var_dump($pregunta);
	if($pregunta->idpregunta != $pregAnterior){ ?>
		<b><?=$pregunta->nombrePregunta?></b><br>
		<?php 
		$pregAnterior = $pregunta->idpregunta;
	}
	if($pregunta->tipo == "radio"){ ?>
		<input type="radio" tipo_pregunta="<?=$pregunta->tipo?>" name="<?=$pregunta->idpregunta?>" value="<?=$pregunta->idrespuesta?>" id="<?=$pregunta->idrespuesta?>" />
		<?php 
	} else if($pregunta->tipo == "checkbox"){ ?>
		<input type="checkbox" tipo_pregunta="<?=$pregunta->tipo?>" name="<?=$pregunta->idrespuesta?>" value="<?=$pregunta->idrespuesta?>" id="<?=$pregunta->idrespuesta?>" />
		<?php
	}
	echo $pregunta->nombreRespuesta."<br>";

}

?>
<br>
<button id="guardarHistoria" class="btn btn-medium btn-primary">Guardar</button>
</form>