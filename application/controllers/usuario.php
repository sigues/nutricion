<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function registro(){
		if($this->input->post("registrarse") == "Registrarse"){
			echo "<h1>registrando</h1>";
		}
		$this->load->model("ciudadmodel");
		$data["paises"] = $this->ciudadmodel->getPaises();
		$data["contenido"]=$this->load->view("usuario/registro",$data,true);
		$this->load->view("template",$data);
	}
}