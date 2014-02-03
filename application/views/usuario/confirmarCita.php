<script>
function send_payment_oxxo(){	
	
    $.ajax({
        type: "POST",
        url: $("#base_url").val()+"index.php/conekta_nutink/conekta_oxxo/<?=$this->uri->segment(3)?>",
        success: function(resp) {                               
            window.open($("#base_url").val()+"index.php/conekta_nutink/report/"+resp, '_blank');          
            $('#oxxo').html('Thanks for your donation');
        }
    }); 
}
</script>
<div class="row container">
	<div class="span12">
	<h1>¡Cita confirmada!</h1>
	<h2 class="muted">	Ahora solo es necesario imprimir el recibo de pago y realizar el pago en OXXO. Haga clic en el botón de abajo para abrir el recibo.</h2>
	<button class="btn btn-lg btn-primary" onclick="send_payment_oxxo();">
		Abrir recibo
	</button>
	<br><br><br>
	</div>
</div>