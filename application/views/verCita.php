<?php

    foreach($cita as $c){
        $citaObj = $c;
    }
    $cita = $citaObj;
?>
<h3>Cita <?=$cita->idcita?></h3>
<strong>Hora: </strong> <?=$cita->horaInicio?> - <?=$cita->horaFin?> <br/>
<strong>Paciente: </strong> <?=$cita->nombrePaciente." ".$cita->apellido?> <br/>
<strong>Costo: </strong> $<?=$cita->costo?> <br/>
<strong>Doctor: </strong> <?=$cita->nombreEmpleado?> <br/>
<strong>Observaciones: </strong> <?=$cita->comentario?> <br/>
<center><a href="<?=base_url()?>index.php/admin/cita/<?=$cita->idcita?>#tabs-2"><button class="btn btn-primary"
 id="verExpediente">Ver cita y expediente</button></a></center>
<!--<center><a href="<?=base_url()?><?=$eventoIcal?>"><button class="boton" id="verExpediente">Bajar para iphone</button></a></center>-->