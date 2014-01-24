<div class="container marketing" id="nosotros">

    <div class="row">
      	<div class="span5">
      		<?=listado_peso($this->session->userdata("idusuario"))?>
    	</div>
        <div class="span7">
        	<?=grafica_peso($this->session->userdata("idusuario"))?>
		</div>
	</div>
    <div class="row">
      		<?=dieta_paciente($this->session->userdata("idusuario"))?>
	</div>
</div>