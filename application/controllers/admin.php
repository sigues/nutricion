<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata("logged_in") != true && $this->session->userdata("perfil") != 2){
			redirect(page_url(), 'refresh');
		}
		$this->load->library('grocery_CRUD');
	}

	public function catalogoGrupos(){
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('grupo');
			$crud->set_subject('Grupos Alimenticios');
			$crud->required_fields('nombre','codigo');
			$crud->columns('idgrupo','nombre','codigo','descripcion');

			$output = $crud->render();

			$data["contenido"] = $this->_example_output($output);

			$this->load->view("template",$data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function catalogoPerfiles(){
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('perfil');
			$crud->set_subject('Perfiles');
			$crud->required_fields('nombre');
			$crud->required_fields('codigo');
			$crud->columns('idperfil','nombre','codigo','descripcion');

			$output = $crud->render();

			$data["contenido"] = $this->_example_output($output);

			$this->load->view("template",$data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function _example_output($output = null)
	{
		$ex_output = $this->load->view('example.php',$output,true);
		return $ex_output;
	}

}