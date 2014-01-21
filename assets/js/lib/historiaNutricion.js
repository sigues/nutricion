$(document).ready(function(){
	$("#guardarHistoria").click(function(){
		var datos = {};
		var x=0;
		var tipo_pregunta = "";
		$("form#historiaNutricion :input").each(function(){
			tipo_pregunta = $(this).attr("tipo_pregunta");

			if(tipo_pregunta == "radio" || tipo_pregunta == "checkbox" ){
				datos[this.id] = {}
				datos[this.id]["id"] = this.id;
				datos[this.id]["idpregunta"] = $(this).attr("idpregunta");
				datos[this.id]["valor"] = $( this ).prop( "checked" );
				datos[this.id]["tipo_pregunta"] = tipo_pregunta;
			}
		});
		console.log(datos);

		$.ajax({
            url: $("#base_url").val()+"index.php/usuario/guardaHistorial",
            type: "post",
            dataType: "json",
            data:{
                datos:datos
            },
            success: function( strData ){
            	if(strData.value=="ok"){
					$.colorbox.close();
            	}else{
            		alert(strData.error);
            	}
            }
        });
	});

	$("#form_datosPersonales").validate({
		submitHandler: function(form) {
			form.submit();
			//alert("huevos");
		}
		});
});