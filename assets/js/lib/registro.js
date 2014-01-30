$(document).ready(function(){
		$("#registro").validate({
		rules: {
			nombre: {
				required: true,
				minlength: 2
			},
			apellido: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
			agree: "required"
		},
		messages: {
			nombre: {
				required: "Favor de ingresar su nombre",
				minlength: "Su nombre debe tener al menos 2 caracteres"
			},
			apellido: {
				required: "Favor de ingresar su apellido",
				minlength: "Su apellido debe tener al menos 2 caracteres"
			},
			password: {
				required: "Favor de ingresar una contraseña",
				minlength: "Su contraseña debe tener al menos 5 caracteres"
			},
			confirm_password: {
				required: "Favor de ingresar una contraseña",
				minlength: "Su contraseña debe tener al menos 5 caracteres",
				equalTo: "Las contraseñas no coinciden"
			},
			email: "Favor de ingresar una dirección de correo electrónico válida",
			agree: "Favor de aceptar las políticas de privacidad"
		}
	});

	$("#registrarse").click(function(){
		if($("#validaEmail").is(":visible")){
			alert("Debe ingresar una dirección de correo electrónico válida");
			return false;
		}
		$("#registro").submit();

	});

	$("#reset").click(function(){
		$('#registro').find("input").each(function(){
		  $(this).val("");
		});
	});

	$("#email").change(function(){
		$("#validaEmail").hide();
		$.ajax({
                    url: $("#base_url").val()+"index.php/usuario/validarCorreo",
                    type: "post",
                    dataType: "json",
                    data:{
                        estado:$("#email").val()
                    },
                    success: function( strData ){
                    	console.log(strData.lenght);
                    	if(strData.valido==true){
                    		$("#validaEmail").show();
                    	}else{
                    		$("#validaEmail").hide();
                    	}
                    }
                });
	});



});

