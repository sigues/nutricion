<script src="<?=base_url()?>assets/js/lib/historiaNutricion.js"></script>
<div style="width:400px">
	<span class="title"><h2>Historia Nutricional</h2></span>
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
		<input type="radio" idpregunta="<?=$pregunta->idpregunta?>" 
		tipo_pregunta="<?=$pregunta->tipo?>" name="<?=$pregunta->idpregunta?>" 
		<?=($pregunta->valor=="true")?"checked=checked":""?>
		value="<?=$pregunta->idrespuesta?>" id="<?=$pregunta->idrespuesta?>" />
		<?php 
	} else if($pregunta->tipo == "checkbox"){ ?>
		<input type="checkbox" idpregunta="<?=$pregunta->idpregunta?>" 
		tipo_pregunta="<?=$pregunta->tipo?>" name="<?=$pregunta->idrespuesta?>" 
		<?=($pregunta->valor=="true")?"checked=checked":""?>
		value="<?=$pregunta->idrespuesta?>" id="<?=$pregunta->idrespuesta?>" />
		<?php
	}
	echo $pregunta->nombreRespuesta."<br>";

}

?>
<br>
<button id="guardarHistoria" class="btn btn-medium btn-primary">Guardar</button>
</form>
</div>