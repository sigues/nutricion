$(document).ready(function(){
	$("#btn-registro").click(function(){
		//alert($(this).attr("url"));
		window.location.replace($(this).attr("url"));
		return false;
	});
});
