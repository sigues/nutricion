$(document).ready(function() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $('#fecha').datepicker({ 
                            dateFormat: "dd/mm/yy",
                            minDate: new Date(y, m, d)
                        });

    $(function() {
            $( "#fecha" ).change(function() {
                var fecha = $( "#fecha" ).val().replace(/\//g,"-");
                var doctor = $( "#doctor" ).val();
                var respuesta = pideAjax("../usuario/diaDoctor/"+fecha+"/"+doctor);
                $("#diaDoctor").html(respuesta);
            });
    });
    $("#botonSolicitarCita").click(function(){
        solicitarCita();
    });

});

function pideAjax(vurl){
    var html = $.ajax({
        url: vurl,
        async: false
        }).responseText;//oncomplete
    return html;
}

function actualizaHoras(horas,span){
    $(".horarioLibre").css( "background-color", "white" );
    $( span )
    .closest( "tr" )
    .css( "background-color", "#f0f0f0" );




    var hora = horas.replace(" ","");
    hora = hora.split('- ');
    var hora_inicio = hora[0].split(":");
    var hora_fin = hora[1].split(":");
    $("#horaInicio").val(hora[0]);
    $("#horaFin").val(hora[1]);
}

function solicitarCita(){
    var fecha = $("#fecha").val();
    var horaInicio = $("#horaInicio").val();
    var horaFin = $("#horaFin").val();
    $("#loadingCita").show();
    $("#botonSolicitarCita").addClass("disabled");
    $("#botonSolicitarCita").attr('disabled', 'disabled');
    $("#botonSolicitarCita").prop('disabled', true);

    $.ajax({
        url: $("#base_url").val()+"index.php/usuario/solicitarCitaAjax",
        type: "post",
        data:{
            fecha : fecha,
            horaInicio : horaInicio,
            horaFin : horaFin
        },
        success: function( cita ){
            if(IsNumeric(cita)){
                window.location = $("#base_url").val()+"index.php/usuario/avisoConfirmarCita/"+cita;
            }
            else{
                alert("Hubo un error al generar su cita, intentelo de nuevo mas tarde.");
            }
        }
    });

}

function IsNumeric(input){
    var RE = /^-{0,1}\d*\.{0,1}\d+$/;
    return (RE.test(input));
}