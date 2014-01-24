$(document).ready(function(){
	$("#guardarPesoActual").click(function(){
		var peso = parseFloat($("#pesoActual").val());
		if(isNaN(peso)){
			alert("Peso invalido, favor de solo introducir numeros");
		} else {
			peso = guardaPeso();
			return false;
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
//        	ret = data;
//        	console.log(arr);

		var line1 = [];
        

			var peso = [];
			for (var k in arr){
			    if (arr.hasOwnProperty(k)) {
    						peso.push([k, arr[k]]);
			    }
			}

			inicializaGrafica(peso);
//		    return ret;
        }
    });
}