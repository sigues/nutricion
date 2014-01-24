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

function recargaTabla(){
	$.ajax({
        url: $("#base_url").val()+"index.php/usuario/tablaListadoPeso",
        success: function( data ){
        	$("#tablaListadoPeso").html(data);
			$("#chart1").fadeIn(1000);
			$("#listadoPeso").fadeIn(1000);
    	}
	});
}