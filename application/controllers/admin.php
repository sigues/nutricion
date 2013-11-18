<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata("is_logged") != true && $this->session->userdata("perfil") != 2){
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
			$crud->callback_column('nombre',array($this,'linkEditaGrupo'));

			$output = $crud->render();
			$output->titulo = "Administrar grupos alimenticios";
			$output->subtitulo = "Aquí se podrán administrar los diferentes grupos alimenticios, como son: Cereales y tubérculos, Cereales con grasa, Frutas, Verduras, etc.";

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
			$crud->set_field_upload('img_url','assets/uploads/files');

			$output = $crud->render();
			$output->titulo = "Administrar perfiles";
			$output->subtitulo = "Aquí se podrán administrar los perfiles de los usuarios, como son: Adultos, ancianos, niños, deportistas, etc.";

			$data["contenido"] = $this->_example_output($output);

			$this->load->view("template",$data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function catalogoDietas(){
		$this->load->model("grupomodel");
		$this->load->model("perfilmodel");
		$this->load->model("horariomodel");
		$data["grupos"] = $this->grupomodel->getGrupos();
		$data["perfiles"] = $this->perfilmodel->getPerfiles();
		$data["horarios"] = $this->horariomodel->getHorarios();
		$data["contenido"] = $this->load->view("admin/administrarDietas",$data,true);
		echo $this->load->view("template",$data);
	}

	public function _example_output($output = null)
	{
		$ex_output = $this->load->view('example.php',$output,true);
		return $ex_output;
	}

	public function linkEditaGrupo($value,$row){
		return "<a href=".site_url("admin/editaGrupos/".$row->idgrupo).">".$value."</a>";
	}

	public function verificaCodigoDieta(){
		$codigo = $_POST["codigo"];
		$this->load->model("dietamodel");
		$dieta = $this->dietamodel->verificaCodigo($codigo);
		$data = array("valid"=>"false");
		if($dieta == false){
			$data["valid"] = "true";
		}else{
			$data["valid"] = "false";
		}
		echo json_encode($data);
	}

	public function guardaDieta(){
		$dieta["info"] = $_POST["dieta"];
		$dieta["horario_grupo"] = $_POST["horario_grupo"];
		$dieta["perfiles"] = $_POST["perfiles"];

		echo json_encode($dieta);
	}

}

