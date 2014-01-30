<?php
	echo "<tr>";
    if($propiedad->codigo == "sexo"){
    	$checkedh = ($propiedad->respuesta == 'h')?"checked=checked":"";
        $checkedm = ($propiedad->respuesta == 'm')?"checked=checked":"";
        echo "<td>".$propiedad->nombre.'</td><td>
        <input type="radio" name="'.$propiedad->idpropiedad_usuario.'" 
        idpropiedad_usuario="'.$propiedad->idpropiedad_usuario.'" id="'.$propiedad->codigo.'" value="h" '.$checkedh.'>Hombre 
        <input type="radio" name="'.$propiedad->idpropiedad_usuario.'" id="'.$propiedad->codigo.'" idpropiedad_usuario="'.$propiedad->idpropiedad_usuario.'" value="m"  '.$checkedm.'>Mujer</td>';
    }else{ ?>
        <td><?=$propiedad->nombre?>
            <?=($propiedad->codigo == "peso")?"(kg)":""?>
            <?=($propiedad->codigo == "talla")?"(cm)":""?>
        </td>
        <td> <input id=<?=$propiedad->codigo?> 
            name=<?=$propiedad->idpropiedad_usuario?> 
            idpropiedad_usuario=<?=$propiedad->idpropiedad_usuario?> 
            <?=($propiedad->tipo=="int")?" type='number'":""?>
            <?=($propiedad->tipo=="int")?" style='width:30px'":""?>
            required="true"
            <?=($propiedad->limiteMinimo>0 && $propiedad->tipo == "int")? " min=".$propiedad->limiteMinimo:""?>
            <?=($propiedad->limiteMinimo>0 && $propiedad->tipo == "varchar")? " minlength=".$propiedad->limiteMinimo:""?>
            <?=($propiedad->limiteMaximo>0 && $propiedad->tipo == "int")? " max=".$propiedad->limiteMaximo:""?>
            <?=($propiedad->limiteMaximo>0 && $propiedad->tipo == "varchar")? " maxlength=".$propiedad->limiteMaximo:""?>
            <?=($propiedad->respuesta != null)? " value=".$propiedad->respuesta:""?>

            />
            <?=($propiedad->codigo == "peso")?"kg":""?>
            <?=($propiedad->codigo == "talla")?"cm":""?>
        </td>
    <?php }
    echo "</tr>";
?>