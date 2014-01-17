<script src="<?=base_url()?>assets/js/lib/datosPersonales.js"></script>
<script src="<?=base_url()?>assets/js/jquery.validate.js"></script>

<div class="container marketing" id="nosotros">
  	<div class="row">
        <div class="span9">
        	<h2>Hola! Gracias por registrarte!</h2>
        	<h3>Ahora, solo debes llenar un breve cuestionario para conocerte mejor y poder recomendarte una dieta personalizada.</h3>
        	<form class="form frm" id="form_datosPersonales">
                <table class="table">
        		<?php foreach($propiedades as $propiedad){
                    $data["propiedad"] = $propiedad;
                    $this->load->view("usuario/parseDatoPersonal",$data);
        		}?>
                <tr><td>&nbsp;</td><td>
                    <button value="guardarDatos" id="guardarDatos" name="guardarDatos" class="btn btn-info active" type="button">Guardar</button>
                </td>
                </table>
        	</form>
 		</div>
  	</div>
</div>