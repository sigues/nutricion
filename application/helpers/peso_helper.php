<?php

// Helper para seguimiento de peso

if ( ! function_exists('grafica_peso'))
{
	function grafica_peso($idusuario)
	{
		$CI =& get_instance();
		$CI->load->model("propiedad_usuariomodel");
		//var_dump($this->session->userdata("idusuario"));
		//$usuario = $CI->session->userdata("idusuario");
		$propiedades = $CI->propiedad_usuariomodel->getPropiedades("registro",$idusuario,true);
		/*echo "<pre>";
		var_dump($propiedades);
		echo "</pre>";*/
		$data["peso"] = array();
		$data["talla"] = array();
		$data["pesoString"] = "";
		$data["tallaString"] = "";
		foreach($propiedades as $propiedad){
			if($propiedad->codigo == "peso"){
				$data["peso"][$propiedad->fecha] = $propiedad->valor;
				$data["pesoString"] .= '["'.date("Y-m-d",strtotime($propiedad->fecha)).'",'.$propiedad->valor.'],';
			}
			if($propiedad->codigo == "talla"){
				$data["talla"][$propiedad->fecha] = $propiedad->valor;
				$data["tallaString"] .= '["'.date("Y-m-d",strtotime($propiedad->fecha)).'",'.$propiedad->valor.'],';
			}
		}
		$data["pesoString"] = ($data["pesoString"] != "") ? "[".substr($data["pesoString"],0,-1)."]" : $data["pesoString"];
		$data["tallaString"] = ($data["tallaString"] != "") ? "[".substr($data["tallaString"],0,-1)."]" : $data["tallaString"];
		$contenido = $CI->load->view("usuario/graficaPeso",$data,true);
		//$this->load->view("usuario/datosPersonales",$data);


		return $contenido;
	}
}

	function listado_peso($idusuario){
		$CI =& get_instance();
		$CI->load->model("propiedad_usuariomodel");
		$propiedades = $CI->propiedad_usuariomodel->getPropiedades("registro",$idusuario,true);
		$data["peso"] = array();
		$data["talla"] = array();
		$data["pesoString"] = "";
		$data["tallaString"] = "";
		foreach($propiedades as $propiedad){
			if($propiedad->codigo == "peso"){
				$data["peso"][$propiedad->fecha] = $propiedad->valor;
				$data["pesoString"] .= '["'.date("Y-m-d",strtotime($propiedad->fecha)).'",'.$propiedad->valor.'],';
			}
			if($propiedad->codigo == "talla"){
				$data["talla"][$propiedad->fecha] = $propiedad->valor;
				$data["tallaString"] .= '["'.date("Y-m-d",strtotime($propiedad->fecha)).'",'.$propiedad->valor.'],';
			}
		}
		$data["pesoString"] = ($data["pesoString"] != "") ? "[".substr($data["pesoString"],0,-1)."]" : $data["pesoString"];
		$data["tallaString"] = ($data["tallaString"] != "") ? "[".substr($data["tallaString"],0,-1)."]" : $data["tallaString"];
		$contenido = $CI->load->view("usuario/listadoPeso",$data,true);
		return $contenido;
	}
