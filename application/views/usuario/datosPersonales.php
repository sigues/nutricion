<div class="container marketing" id="nosotros">
  	<div class="row">
        <div class="span9">
        	<h2>Hola! Gracias por registrarte!</h2>
        	<h3>Ahora, solo debes llenar un breve cuestionario para conocerte mejor y poder recomendarte una dieta personalizada.</h3>
        	<form class="form frm">
        		<?php foreach($propiedades as $propiedad){
        			echo $propiedad->nombre." <input type='text' /><br>";
        		}?>
        	</form>
 		</div>
  	</div>
</div>