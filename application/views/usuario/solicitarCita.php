<link href="<?=base_url()?>assets/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="<?=base_url()?>assets/js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/lib/solicitarCita.js"></script>

<div class="container marketing">
    <div class="row">
		<div class="span6">
			<div class="row">
				<h2 class="muted">Paso 1:</h2> Selecciona la fecha de tu cita
					<table class="table">
						<tr class="frm-par">
				            <td>
				                <label for="fecha">Fecha</label> <div id="fecha_error"></div>
				            </td>
				            <td>
				                <input type="text" id="fecha" value="" />&nbsp;<img src="<?=base_url()?>assets/images/datepicker.jpeg" style="margin-bottom:15px" />
				            </td>
				        </tr>
					</table>
			</div>
			<div class="row">
				<h2 class="muted">Paso 3:</h2> Solicita tu cita
					<table class="table">
						<tr class="frm-par">
				            <td>
				            	<p><input type="text" size="4" placeholder="Hora Inicio" id="horaInicio" /><input type="text" size="4" placeholder="Hora Fin" id="horaFin" /></p>
				            	<p>Una vez que solicites tu cita, recibirás un correo con la liga para confirmar y el recibo con el que podrás pagar en cualquier tienda OXXO.</p>
				            </td>
				            <td>
			                	<button class="btn btn-lg btn-primary" id="botonSolicitarCita">
									Solicitar cita
					            	<span id="loadingCita"><img src="<?=base_url()?>assets/images/loading.gif" /></span>
								</button>
							</td>
				        </tr>
					</table>
			</div>
		</div>
		<div class="span6">
			<h2 class="muted">Paso 2:</h2> Selecciona el horario
			<input id="doctor" type="hidden" value="1" />
			<div id="diaDoctor">
			</div>
		</div>
	</div>
</div>