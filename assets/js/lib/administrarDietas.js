$(document).ready(function(){
	$("#guardarDieta").click(function(){
		if($("#nombre").val() == ""){
			$("#labelNombre").show();
			//style="border-color: #B94A48;"
			//border-color: #B94A48;
			return false;
		}else{
			$("#labelNombre").hide();
			
		}
/*		$.ajax({
			type: "POST",
			url: "some.php",
			data: { 
				name: "John", 
				location: "Boston" 
			}
		})
		alert("huevos");*/
		$(".horario-grupo").each(function(index){
			console.log($(this).val()+" - "+$(this).attr("id"));
		});
//		console.log();
	});

});