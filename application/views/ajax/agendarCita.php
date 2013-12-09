<html>
<script src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>assets/js/lib/agendarCita.js"></script>
<style>

.ui-autocomplete {
  z-index: 9999;
}

</style>

<h3>Agendar Cita</h3>

<form action="" name="" class="frm" method="post" onsubmit="return false;" name="agendarCita" id="agendarCita">
    <table width="500px">
        <tr class="frm-non">
            <td>
                <label for="paciente">Paciente: </label> <div id="paciente_error"></div>
            </td>
            <td>
                <input type="text" id="paciente" name="paciente" value="" />
            </td>
        </tr>
        <tr class="frm-non">
            <td>
                <label for="doctor">Nutriólogo</label> <div id="doctor_error"></div>
            </td>
            <td>
                <select name="doctor" id="doctor">
                    <option value=""> Seleccione </option>
                    <?php 
                    foreach($doctores as $doctor) {?>
                        <option value="<?=$doctor->idusuario?>"><?=$doctor->nombre.' '.$doctor->apellido?></option>
                    <?php } ?>
                </select>
                <span id="tratamientos" value="" ></span>
            </td>
        </tr>
        <tr class="frm-par">
            <td>
                <label for="fecha">Fecha</label> <div id="fecha_error"></div>
            </td>
            <td>
                <input type="text" id="fecha" value="<?=(!$fecha)?date('d/m/Y'):date('d/m/Y',strtotime($fecha));?>" />
            </td>
        </tr>
        <tr class="frm-non">
            <td>
                <label for="hora">Hora:</label> <div id="hora_error"></div>
            </td>
            <td>
                <table>
                    <tr>
                        <td>
                            <div id="hora_inicio" style="width:150px;"></div>
                            <div id="minuto_inicio" style="width:150px;"></div>
                            <input type="text" style="width:20px"  size="2" id="h_inicio" name="h_inicio" />:
                            <input type="text" style="width:20px"  size="2" id="m_inicio" name="m_inicio" />

                            <div id="hora_fin" style="width:150px;"></div>
                            <div id="minuto_fin" style="width:150px;"></div>
                            <input type="text" style="width:20px" size="2" id="h_fin" name="h_fin" />:
                            <input type="text" style="width:20px"  size="2" id="m_fin" name="m_fin" />
                            <br><br>
                            <div id="hora_cita" name="hora_cita"></div>
                        </td>
                        <td>
                            <div id="diaDoctor"></div>
                        </td>
                    </tr>
                </table>
                

            </td>
        </tr>
        <tr class="frm-non">
            <td>
                <label for="costo">Costo</label> <div id="costo_error"></div>
            </td>
            <td>
                $<input type="text" name="costo" id="costo"/> <div id="costoSugerido"></div>

            </td>
        </tr>
        <tr class="frm-par">
            <td>
                <label for="observaciones">Observaciones</label> <div id="observaciones_error"></div>
            </td>
            <td>
                <textarea rows="5" cols="20" name="observaciones" id="observaciones"></textarea>
            </td>
        </tr>
        <tr class="frm-non">
            <td>
                &nbsp;
            </td>
            <td>
                <center>
                    <button class="btn btn-primary" id="guardarCita" value="Guardar">Guardar Cita</button>
                </center>
            </td>
        </tr>
        <tr class="frm-non">
            <td colspan="2">
                <div id="respuesta"></div>
            </td>
        </tr>
    </table>
</form>
<!--
<div id="costoSugerido"></div> <br/>
<strong>Costo: </strong> $500.00 <br/>
<strong>Mas información: </strong> Mas información <br/>
<strong>Mas información: </strong> Mas información <br/>
<strong>Obervaciones: </strong> <textarea cols="15" rows="10"> Escribir observaciones sobre la cita</textarea><br/><br/><br/>
<center><button class="boton" id="verExpediente">Guardar Cita</button></center>!-->

</html>