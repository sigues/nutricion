<script src="<?=base_url()?>assets/js/lib/datosPersonales.js"></script>

<div class="container marketing" id="nosotros">
  	<div class="row">
        <div class="span9">
        	<h2>Hola! Gracias por registrarte!</h2>
        	<h3>Ahora, solo debes llenar un breve cuestionario para conocerte mejor y poder recomendarte una dieta personalizada.</h3>
        	<form class="form frm" id="form_datosPersonales">
                <table class="table">
        		<?php foreach($propiedades as $propiedad){
                    echo "<tr>";
                    if($propiedad->codigo == "sexo"){
                        echo "<td>".$propiedad->nombre.'</td><td><input type="radio" name="'.$propiedad->idpropiedad_usuario.'" idpropiedad_usuario="'.$propiedad->idpropiedad_usuario.'" id="'.$propiedad->codigo.'" value="h">Hombre 
                        <input type="radio" name="'.$propiedad->idpropiedad_usuario.'" id="'.$propiedad->codigo.'" idpropiedad_usuario="'.$propiedad->idpropiedad_usuario.'" value="h">Mujer</td>';
                    }else{
                        echo "<td>".$propiedad->nombre."</td><td> <input type='text' id='".$propiedad->codigo."' name='".$propiedad->idpropiedad_usuario."' idpropiedad_usuario='".$propiedad->idpropiedad_usuario."' /></td>";
                    }
                    echo "</tr>";
        		}?>
                <tr><td>&nbsp;</td><td>
                    <button value="guardarDatos" id="guardarDatos" name="guardarDatos" class="btn btn-info active" type="button">Guardar</button>
                </td>
                </table>
        	</form>
 		</div>
  	</div>
</div>