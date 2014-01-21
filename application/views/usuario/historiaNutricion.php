<script src="<?=base_url()?>assets/js/lib/historiaNutricion.js"></script>
<form id="historiaNutricion">

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
	if($pregunta->tipo == "radio"){?>
		<input type="radio" name="<?=$pregunta->idpregunta?>" value="<?=$pregunta->idrespuesta?>" />
		<?php 
	} else if($pregunta->tipo == "checkbox"){?>
		<input type="checkbox" name="<?=$pregunta->idrespuesta?>" value="<?=$pregunta->idrespuesta?>" />
		<?php
	}
	echo $pregunta->nombreRespuesta."<br>";

}

?>
<br>
<button id="guardarHistoria">Guardar</button>
</form>