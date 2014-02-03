$(document).ready(function(){
	$("#guardarPesoActual").click(function(){
		var peso = parseFloat($("#pesoActual").val());
		if(isNaN(peso)){
			alert("Peso invalido, favor de solo introducir numeros");
		} else {
			$("#listadoPeso").fadeOut(300);
			$("#chart1").fadeOut(300);
			peso = guardaPeso();
			//inicializaGrafica(peso);
		}
	});
});

function muestraAlimentos(horario){
	$("#muestraAlimentos").html("<br><br><img src='"+$("#base_url").val()+"assets/images/loading.gif' />");
	$.ajax({
        url: $("#base_url").val()+"index.php/usuario/muestraAlimentosHorario",
        type: "post",
        data:{
            horario : horario
        },
        success: function( alimentos ){
			$("#muestraAlimentos").html(alimentos);
        }
    });


}

function guardaPeso(){
	$.ajax({
        url: $("#base_url").val()+"index.php/usuario/guardaPeso",
        type: "post",
        dataType: "json",
        data:{
            peso : parseFloat($("#pesoActual").val())
        },
        success: function( arr ){
		var line1 = [];
        

			var peso = [];
			for (var k in arr){
			    if (arr.hasOwnProperty(k)) {
    						peso.push([k, arr[k]]);
			    }
			}

			inicializaGrafica(peso);
			recargaTabla();
        }
    });
}