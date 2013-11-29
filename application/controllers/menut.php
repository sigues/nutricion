<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menut extends CI_Controller {
	function cursos(){
//		$data["main"] = true;
		$data["contenido"] = $this->load->view('cursos',"",true);
		$this->load->view('template',$data);
	}

	function productos(){
//		$data["main"] = true;
		$data["contenido"] = $this->load->view('cursos',"",true);
		$this->load->view('template',$data);
	}
}