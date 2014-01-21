$(document).ready(function(){
	$("#guardarDatos").click(function(){
		var datos = {};
		var x=0;
		$("form#form_datosPersonales :input").each(function(){
			var idpropiedad_usuario = $(this).attr("idpropiedad_usuario");
		 	var valor = $(this).val(); // This is the jquery object of the input, do what you will
		 	datos[idpropiedad_usuario] = {};
		 	datos[idpropiedad_usuario]["idpropiedad_usuario"] = idpropiedad_usuario;
		 	datos[idpropiedad_usuario]["valor"] = valor;
		});

		$.ajax({
            url: $("#base_url").val()+"index.php/usuario/guardaDatosPersonales",
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