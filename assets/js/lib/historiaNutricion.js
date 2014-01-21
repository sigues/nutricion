$(document).ready(function(){
	$("#guardarHistoria").click(function(){
		var datos = {};
		var x=0;
		var tipo_pregunta = "";
		$("form#historiaNutricion :input").each(function(){
			tipo_pregunta = $(this).attr("tipo_pregunta");

			if(tipo_pregunta == "radio" || tipo_pregunta == "checkbox" ){

				datos[this.id] = $( this ).prop( "checked" );
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
            	if(strData.valido==true){
					$.colorbox.next();
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