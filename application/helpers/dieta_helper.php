<?php

function dieta_paciente($idpaciente = ""){
	$CI =& get_instance();
		
	$CI->load->model("dietamodel");
	
	$data["dieta"] = array();
	if($idpaciente != ""){
		$dietaUsuario = $CI->dietamodel->getDietaByUsuario($idpaciente);
		if($dietaUsuario != false){
			$data["dieta"] = $CI->dietamodel->getDieta($dietaUsuario->dieta_iddieta);
		}else{
			$contenido = $CI->load->view("usuario/noTieneDieta","",true);
			return $contenido;
		}
	}

	$CI->load->model("grupomodel");
	$CI->load->model("perfilmodel");
	$CI->load->model("horariomodel");
	$CI->load->model("usuariomodel");
	
	$data["grupos"] = $CI->grupomodel->getGrupos();
	$data["perfiles"] = $CI->perfilmodel->getPerfiles();
	$data["horarios"] = $CI->horariomodel->getHorarios();
	$data["usuarios"] = $CI->usuariomodel->getUsuarios();
	$data["dietas"] = $CI->dietamodel->getDietas();
	$contenido = $CI->load->view("usuario/verDieta",$data,true);
	return $contenido;
}