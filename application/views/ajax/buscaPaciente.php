<?php
$respuesta="";
$x=0;
foreach ($pacientes->result() as $paciente){
    $respuesta[$x]["value"] = $paciente->nombre." ".$paciente->apellido;
    $respuesta[$x]["label"] = $paciente->nombre." ".$paciente->apellido;
    $respuesta[$x]["valor"] = $paciente->idusuario;
    $x++;
}
echo json_encode($respuesta);
?>