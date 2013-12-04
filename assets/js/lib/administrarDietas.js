$(document).ready(function(){
	$("#guardarDieta").click(function(){
		if($("#nombre").val() == ""){
			$("#labelNombre").show();
			return false;
		}else{
			$("#labelNombre").hide();
		}
		if($("#codigo").val() == ""){
			$("#labelCodigo").show();
			return false;
		}else{
			$("#labelCodigo").hide();
		}
		var codigo = $("#codigo").val();
		$.ajax({
			type: "POST",
			url: $("#base_url").val()+"index.php/admin/verificaCodigoDieta",
			dataType: "json",
			data: { 
				codigo: codigo 
			},
			success: function(response) {
				if(response.valid == "true"){
					$("#labelCodigoUnico").hide();
					guardaDieta();
				} else {
					$("#labelCodigoUnico").show();
				}
			}
		});
	});

	$(".checkbox-perfil").change(function(){
		var idperfil = $(this).attr("idperfil");
		if($(this).is(":checked")){
			$("#principal-"+idperfil).removeAttr("disabled");
		} else {
			$("#principal-"+idperfil).attr("disabled","disabled");
		}
	});

	$(".horario-grupo").change(function(){
		var idgrupo = $(this).attr("idgrupo");
		var suma = parseInt(0);
		$(".horario-grupo-"+idgrupo).each(function(index,value){
			if($(value).val() != ""){
				suma = suma + parseInt($(value).val());
			}
		});
		$("#total-grupo-"+idgrupo).val(suma);
	});

	$(".tipoDieta").change(function(){
		var tipoDieta = $('input:radio[name=tipoDieta]:checked').val();
		if(tipoDieta == "usuarios"){
			$("#div-usuarios").show();
			$("#div-perfiles").hide();
		} else if (tipoDieta == "perfiles"){
			$("#div-usuarios").hide();
			$("#div-perfiles").show();
		}


	});

});

function guardaDieta(){
	var dieta = new Object;
	dieta.nombre = $("#nombre").val();
	dieta.codigo = $("#codigo").val();
	dieta.descripcion = $("#descripcion").val();

	var perfiles = {};
	var usuarios = {};

	if($("#div-perfiles").is(":visible")){
		$(".checkbox-perfil").each(function(index){
			var idperfil = $(this).attr("idperfil"); 
			perfiles[idperfil] = {};
			if($(this).is(":checked")){
				perfiles[idperfil]["checked"] = true;
			} else {
				perfiles[idperfil]["checked"] = false;
			}
			if($("#principal-"+idperfil).is(":checked")){
				perfiles[idperfil]["principal"] = true;
			}else{
				perfiles[idperfil]["principal"] = false;
			}
		});
	} else if($("#div-usuarios").is(":visible")){
		usuarios = $("#usuarios").val();
	}
		


	dieta.usuarios = usuarios;
	dieta.perfiles = perfiles;
	
	var horario_grupo = {};
	$(".horario-grupo").each(function(index){
		horario_grupo[$(this).attr("id")] = {};
		horario_grupo[$(this).attr("id")]["id"] = $(this).attr("id");
		horario_grupo[$(this).attr("id")]["idgrupo"] = $(this).attr("idgrupo");
		horario_grupo[$(this).attr("id")]["idhorario"] = $(this).attr("idhorario");
		horario_grupo[$(this).attr("id")]["valor"] = $(this).val();
	});
	dieta.horario_grupo = horario_grupo;
	dieta.iddieta = $("#iddieta").val();
	$.ajax({
			type: "POST",
			url: $("#base_url").val()+"index.php/admin/guardaDieta",
			dataType: "json",
			data: { 
				dieta: JSON.stringify(dieta)
			}/*,
			success: function(response) {
				console.log(response);
				if(response.valid == "true"){
					alert("felicidades");
					$("#labelCodigoUnico").hide();
					guardaDieta();
				} else {
					$("#labelCodigoUnico").show();
				}*/
			//}
		});
	console.log(JSON.stringify(dieta));


}
