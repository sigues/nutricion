$(document).ready(function() {
    /*$( "#paciente" ).autocomplete({
            source:"buscaPaciente",
            select: function( event, ui ) {
                        $("#usuario_idusuario").val( ui.item.valor );
                    }
    });*/
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
        alert("aun no desarrollado");
    });

});

function pideAjax(vurl){
    var html = $.ajax({
        url: vurl,
        async: false
        }).responseText;//oncomplete
    return html;
}

function actualizaHoras(horas){
    var hora = horas.replace(" ","");
    hora = hora.split('- ');
    var hora_inicio = hora[0].split(":");
    var hora_fin = hora[1].split(":");
    $("#horaInicio").val(hora[0]);
    $("#horaFin").val(hora[1]);
}
