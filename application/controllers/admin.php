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
//			$crud->callback_column('nombre',array($this,'linkEditaGrupo'));

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

	public function catalogoHorarios(){
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('horario');
			$crud->set_subject('Horarios');
			$crud->required_fields('nombre');
			$crud->columns('idhorario','nombre','descripcion');

			$output = $crud->render();
			$output->titulo = "Horarios";
			$output->subtitulo = "Aquí se podrán administrar los horarios de las comidas, como son: Desayuno, colación, comida, colación, cena, snack";

			$data["contenido"] = $this->_example_output($output);

			$this->load->view("template",$data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function catalogoCategorias(){
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('categoria');
			$crud->set_subject('Categorias de recetas');
			$crud->required_fields('nombre');
			$crud->required_fields('codigo');
			$crud->columns('idcategoria','nombre','descripcion','codigo');

			$output = $crud->render();
			$output->titulo = "Categorias de recetas";
			$output->subtitulo = "Aquí se podrán administrar las categorias de las recetas, como son: Vegetariano, pastas, mexicana, italiana, etc.";

			$data["contenido"] = $this->_example_output($output);

			$this->load->view("template",$data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function catalogoMedidas(){
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('medida');
			$crud->set_subject('Unidades de medida');
			$crud->required_fields('nombre');
			$crud->required_fields('abreviatura');
			$crud->columns('idmedida','nombre','abreviatura');

			$output = $crud->render();
			$output->titulo = "Unidades de medida";
			$output->subtitulo = "Aquí se podrán administrar las unidades de medida de los alimentos, como son: Kilo, cucharada, taza, etc.";

			$data["contenido"] = $this->_example_output($output);

			$this->load->view("template",$data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function catalogoAlimentos(){
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('alimento');

			$crud->set_relation('grupo_idgrupo','grupo','nombre');
			$crud->display_as('grupo_idgrupo','Grupo Alimenticio');

			$crud->set_relation('medida_idmedida','medida','nombre');
			$crud->display_as('medida_idmedida','Unidad de Medida');

			$crud->display_as('nombre','Alimento');
			$crud->set_subject('alimentos');
			$crud->required_fields('nombre');
			$crud->required_fields('codigo');
			$crud->columns('idalimento','nombre','descripcion','grupo_idgrupo');

			$crud->set_field_upload('imagen','assets/uploads/files/alimentos');

			$output = $crud->render();
			$output->titulo = "Catálogo de Alimentos";
			$output->subtitulo = "Aquí se podrán administrar los alimentos, agregarles categorias, cantidades, etc.";

			$data["contenido"] = $this->_example_output($output);

			$this->load->view("template",$data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function catalogoRecetas(){
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('receta');

			$crud->set_subject('recetas');
			$crud->required_fields('nombre');
			$crud->required_fields('codigo');
			$crud->columns('receta','nombre','descripcion');

			$crud->set_field_upload('imagen','assets/uploads/files/alimentos');

			$crud->set_relation_n_n('alimentos', 'receta_has_alimento', 'alimento', 'receta_idreceta', 'alimento_idalimento', 'nombre');

			$crud->set_relation_n_n('categorias', 'receta_has_categoria', 'categoria', 'receta_idreceta', 'categoria_idcategoria', 'nombre');
 
			$output = $crud->render();
			$output->titulo = "Catálogo de Recetas";
			$output->subtitulo = "Aquí se podrán administrar las recetas";

			$data["contenido"] = $this->_example_output($output);

			$this->load->view("template",$data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function catalogoDietas(){
		$this->load->model("dietamodel");
		$this->load->model("grupomodel");
		$this->load->model("perfilmodel");
		$this->load->model("horariomodel");
		$this->load->model("usuariomodel");

		$data["grupos"] = $this->grupomodel->getGrupos();
		$data["perfiles"] = $this->perfilmodel->getPerfiles();
		$data["horarios"] = $this->horariomodel->getHorarios();
		$data["usuarios"] = $this->usuariomodel->getUsuarios();
		$data["dietas"] = $this->dietamodel->getDietas();
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
		$dieta = $_POST["dieta"];

		if($dieta->iddieta != 0){
			$nueva_dieta = array("nombre"=>$dieta->nombre,"codigo"=>$dieta->codigo,"descripcion"=>$dieta->descripcion);
			$this->db->insert("dieta",$nueva_dieta);
			$iddieta = $this->db->insert_id();
			if(sizeof($dieta->usuarios)>0){

			} else if(sizeof($dieta->perfiles)>0){
				
			}
		}

		/*$dieta["horario_grupo"] = $_POST["horario_grupo"];
		$dieta["perfiles"] = $_POST["perfiles"];*/

		echo json_encode($dieta);
	}

	public function editaGrupos(){
		$grupo = $this->uri->segment(3);
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('alimento');
			$crud->set_subject('Alimentos');
			$crud->required_fields('nombre');
			$crud->required_fields('grupo_idgrupo');
			$crud->required_fields('medida_idmedida');
			$crud->columns('idalimento','nombre','descripcion','cantidad','grupo_idgrupo','medida_idmedida');
			$crud->set_field_upload('imagen','assets/uploads/files');

			$output = $crud->render();
			$output->titulo = "Administrar alimentos";
			$output->subtitulo = "Aquí se podrán administrar los alimentos.";

			$data["contenido"] = $this->_example_output($output);

			$this->load->view("template",$data);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function verAgenda(){
		$data["titulo"][0]="Agenda";
        $data["subtitulo"][0]="Citas de los pacientes";
        /*$this->db->select('*');
        $this->db->from('cita');
        $this->db->join('paciente', 'cita.paciente_idpaciente = paciente.idpaciente');*/
        $data["citas"] = new stdClass();//$this->db->get()->result();
        $data["empleados"] = new stdClass();//$this->db->get_where("empleado", array("puesto"=>"dentista","activo"=>"si"))->result();
        $this->db->where('cita.estado','pendiente');
        $data["scriptAjax"]=$this->load->view('ajax/citas',$data,TRUE);
        
        /*$row = $this->db->query("SHOW COLUMNS FROM cita LIKE 'estado'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$value] = $value;
        }*/

        $data["estados"]= new stdClass();//$enums;
        
        
        $data["contenido"]=$this->load->view('agenda',$data,TRUE);
        $data["seccion"]="personal";
        $this->load->view('template',$data);
	}

}

