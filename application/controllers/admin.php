<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata("is_logged") != true && $this->session->userdata("perfil") != 2){
			redirect(site_url(), 'refresh');
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
		error_reporting(-1);
		$this->load->model("dietamodel");
		$this->load->model("grupomodel");
		$this->load->model("perfilmodel");
		$this->load->model("horariomodel");
		$this->load->model("usuariomodel");
		$data["dieta"] = array();
		if ( $this->uri->segment(3) > 0 ){
			$data["dieta"] = $this->dietamodel->getDieta($this->uri->segment(3));
		}
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
		$tempData = str_replace("\\", "",$dieta);
		$dieta = json_decode($tempData);
		
		if($dieta->iddieta == 0){
			$nueva_dieta = array("nombre"=>$dieta->nombre,"codigo"=>$dieta->codigo,"descripcion"=>$dieta->descripcion);
			$this->db->insert("dieta",$nueva_dieta);
			$iddieta = $this->db->insert_id();
			if(sizeof($dieta->usuarios)>0 && is_array($dieta->usuarios)){
				foreach($dieta->usuarios as $usuario){
					$usuario_has_dieta = array("usuario_idusuario"=>$usuario,"dieta_iddieta"=>$iddieta);
					$this->db->insert("usuario_has_dieta",$usuario_has_dieta);
				}
			} 

			if(sizeof($dieta->perfiles)>0){
				foreach($dieta->perfiles as $c=>$perfil){
					if($perfil->checked == true){
						$principal = false;
						if($perfil->principal == true){
							$data = array(
				               'default' => false
				            );
							$this->db->where('perfil_idperfil', $c);
							$this->db->update('perfil_has_dieta', $data); 
							$perfil->principal = true;
						}
						$data = array('perfil_idperfil'=>$c,
										'dieta_iddieta'=>$iddieta,
										'default'=>$perfil->principal);
						$this->db->insert('perfil_has_dieta',$data);
					}
				}
			}
			if(sizeof($dieta->horario_grupo)>0){
				foreach($dieta->horario_grupo as $c=>$horario_grupo){
					$data = array('dieta_iddieta'=>$iddieta,
								'grupo_idgrupo'=>$horario_grupo->idgrupo,
								'horario_idhorario'=>$horario_grupo->idhorario,
								'porciones'=>$horario_grupo->valor);
					$this->db->insert('dieta_has_grupo',$data);	
				}
			}
		}
		$response = array("response"=>"ok");
		echo json_encode($response);
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
        $this->db->select('*');
        $this->db->from('cita');
        $this->db->join('usuario', 'cita.usuario_idusuario = usuario.idusuario');
        $data["citas"] = $this->db->get()->result();
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

	public function agendarCita(){
		$this->load->model("usuariomodel");
		$data["fecha"]=$this->uri->segment(3);
        $data["doctores"] = $this->usuariomodel->getUsuarios(2);
        $data["procedimientos"] = array();//$this->db->get_where("procedimiento",array("activo"=>"si","tratamiento"=>false));
        $this->load->view('ajax/agendarCita',$data);
	}

    public function buscaPaciente(){
        $cadena = $this->uri->segment(3);//$_POST["cadena"];
        $cadena = $_GET["term"];
        if($cadena != ""){
            $this->db->where("(nombre like '%$cadena%' OR apellido like '%$cadena%'
                            OR concat(nombre,' ',apellido) LIKE '%$cadena%')");
        }
        $data["pacientes"] = $this->db->get("usuario");
        $this->load->view("ajax/buscaPaciente",$data);
    }

    public function diaDoctor(){
        $data["nutriologo"] = $this->uri->segment(4);
        $fecha = explode("-",$this->uri->segment(3));
        $data["fecha"] = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        $this->db->order_by("horaInicio","asc");
        $data["citas"] = $this->db->get_where("cita",$data)->result();
        //echo $this->db->last_query();
        $this->load->view("ajax/diaDoctor",$data);
    }

    public function validaCita(){
        $error = array();
        if(!is_numeric($_POST["h_inicio"]) || $_POST["h_inicio"] < 0 || $_POST["h_inicio"] > 23){
            $error["h_inicio"] = "La hora de inicio de la cita debe ser un número entre 0 y 23";
        }
        if(!is_numeric($_POST["m_inicio"]) || $_POST["m_inicio"] < 0 || $_POST["m_inicio"] > 59){
            $error["m_inicio"] = "Los minutos de inicio de la cita debe ser un número entre 0 y 59";
        }
        $data["horaInicio"] = date("H:i:s",strtotime($_POST["h_inicio"].":".$_POST["m_inicio"]));

        if(!is_numeric($_POST["h_fin"]) || $_POST["h_fin"] < 0 || $_POST["h_fin"] > 23){
            $error["h_fin"] = "La hora de inicio de la cita debe ser un número entre 0 y 23";
        }
        if(!is_numeric($_POST["m_fin"]) || $_POST["m_fin"] < 0 || $_POST["m_fin"] > 59){
            $error["m_fin"] = "Los minutos de inicio de la cita debe ser un número entre 0 y 59";
        }
        $data["horaFin"] = date("H:i:s",strtotime($_POST["h_fin"].":".$_POST["m_fin"]));
        if(strtotime($data["horaFin"]) <= strtotime($data["horaInicio"])){
            $error["h_fin"] = "La hora de fin debe ser mayor a la de inicio.";
        }
        
        $data["nutriologo"] = $_POST["doctor"];
        $empleado = $this->db->get_where("usuario",array("idusuario"=>$data["nutriologo"]))->result();
        if(!$empleado){
            $error["nutriologo"] = "El doctor no existe";
        }

        $query = $this->db->query('select * from usuario where idusuario = "'.$_POST["paciente"].'"');
        foreach($query->result() as $usuario){
            $data["usuario_idusuario"]=$usuario->idusuario;
        }
        if(!isset($data["usuario_idusuario"])){
            $error["paciente"]="No existe el paciente";
        }
        $data["costo"] = $_POST["costo"];
        if(!isset($_POST["costo"]) || !is_numeric($_POST["costo"])){
            $error["costo"]="Debe ingresar un costo válido";
        }
        
        $fecha = explode("/",$_POST["fecha"]);
        $data["fecha"] = date("Y-m-d",strtotime($fecha[2]."-".$fecha[1]."-".$fecha[0]));
        if(strtotime($data["fecha"]) < strtotime("today")){
            $error["fecha"] = "La fecha de la cita debe ser mayor o igual a hoy.";
        }

        $data["comentario"] = $_POST["observaciones"];

        $citas = $this->db->query("SELECT * FROM cita WHERE nutriologo = ".$data["nutriologo"]." 
        	AND fecha = '".$data["fecha"]."' 
        	AND (horaInicio BETWEEN '".$data["horaInicio"]."' AND '".$data["horaFin"]."' 
                                		OR horaFin BETWEEN '".$data["horaInicio"]."' AND '".$data["horaFin"]."') 
        	ORDER BY horaInicio ")->result();
        
        if($citas){
            if(sizeof($citas) == 1){
                foreach($citas as $cita){
                    $error["hora"] = "La hora de la cita choca con otra cita programada de <strong>".$cita->horaInicio."</strong> a <strong>".$cita->horaFin."</strong>";
                }
            } else {
                $i=0;
                $error["hora"] = "La hora de la cita choca con otras citas programadas ";
                foreach($citas as $cita){
                    if($i>0){
                        $error["hora"] .= " y ";
                    }
                    $error["hora"] .= " de <strong>".$cita->horaInicio."</strong> a <strong>".$cita->horaFin."</strong>";
                    $i++;
                }
            }
        }
        if(sizeof($error)>0){
            $error["tipo"] = "error";
            echo json_encode($error);
            
        } else {

        	//var_dump($data);
            $this->db->insert("cita", $data);
            $data["tipo"] = "insert";
            echo json_encode($data);
        }
    }


    public function agendaAjax(){
        $idempleado = intval($_POST["personal"]);
        $estado = (isset($_POST["estado"]))?$_POST["estado"]:"";
        $this->db->select('cita.*');
        $this->db->select('cita.estado estado');
        $this->db->select('usuario.nombre, usuario.apellido');
        $this->db->from('cita');
        $this->db->join('usuario', 'cita.usuario_idusuario = usuario.idusuario');
        if($idempleado>0){
            $this->db->where('cita.nutriologo',$idempleado);
        }
        if($estado != ""){
            $this->db->where('cita.estado',$estado);
        }
        $data["citas"] = $this->db->get()->result();

/*        $row = $this->db->query("SHOW COLUMNS FROM cita LIKE 'estado'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$value] = $value;
        }
*/
        $enums = array("pendiente","cancelada","realizada");
        $data["estados"]=$enums;
        
        $this->load->view('ajax/citas',$data);
    }

    public function verCita(){
        $data["id"] = $this->uri->segment(3);
        $this->db->select("cita.*");
        $this->db->select("usuario.*");
        $this->db->select("usuario.nombre nombrePaciente");
        $this->db->select("nutriologo.*");
        $this->db->select("nutriologo.nombre nombreEmpleado");
        $this->db->from("cita");
        $this->db->join("usuario","usuario.idusuario = cita.usuario_idusuario");
        $this->db->join("usuario nutriologo","nutriologo.idusuario = cita.nutriologo");
        $this->db->where("cita.idcita",$data["id"]);
        $data["cita"] = $this->db->get()->result();
        //echo $this->db->last_query();
        $cita = $data["cita"][0];
        //$datos["cita"] = $cita;
        $this->load->view('verCita',$data);
    }

    public function cita(){
        $data["idcita"]=$this->uri->segment(3);
        $citas = $this->db->get_where("cita",array("idcita"=>$data["idcita"]))->result();
        foreach($citas as $cita){
            $data["cita"] = $cita;
        }
        $this->db->select("usuario.nombre nombrePaciente, paciente.*");
        $paciente = $this->db->get_where("usuario",array("idusuario"=>$data["cita"]->usuario_idusuario));
        foreach($paciente->result() as $pac){
            $data["paciente"]=$pac;
        }

        $this->db->select_sum("pago.cantidad");
        $this->db->select("cita.*");
        $this->db->select("empleado.nombre nombreEmpleado");
        $this->db->from("cita");
        $this->db->join("usuario empleado","empleado.idusuario=cita.nutriologo");
        $this->db->join("pago","cita.idcita = pago.cita_idcita","left");
        $this->db->where("cita.usuario_idusuario",$data["paciente"]->idusuario);
        $this->db->group_by("cita.idcita");
        $data["citas"] = $this->db->get()->result();
        $data["idpaciente"] = $data["paciente"]->idusuario;

/*        
        $this->db->select("producto.idproducto");
        $this->db->select("producto.descripcion");
        $this->db->select("producto.nombre");
        $this->db->select("cita_has_producto.costo");
        $this->db->from("producto");
        $this->db->join("cita_has_producto","cita_has_producto.producto_idproducto = producto.idproducto ");
        $this->db->where("cita_has_producto.cita_idcita",$data["idcita"]);
*/
        $data["productos"] = array();//$this->db->get()->result();

//        $data["productosActivos"] = $this->db->get_where("producto",array("activo"=>"si"))->result();

        /* valores enum de estado */
        $row = $this->db->query("SHOW COLUMNS FROM cita LIKE 'estado'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$value] = $value;
        }

        /* valores enum de estado */
        $row = $this->db->query("SHOW COLUMNS FROM cita LIKE 'estadoFinanciero'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enumsFinanciero[$value] = $value;
        }

        $this->db->from("observacion");
        $this->db->join("empleado", "observacion.empleado_idempleado = empleado.idempleado");
        $this->db->where("observacion.cita_idcita",$data["idcita"]);
        $data["observaciones"] = $this->db->get()->result();
        $data["estados"] = $enums;
        $data["estadosFinancieros"] = $enumsFinanciero;
        $data["titulo"][0]="Ficha del paciente Paciente Ejemplo";
        $data["subtitulo"][0]="En la pestaña de Cita puede ver la cita actual y en la de expediente las citas anteriores e información sobre el paciente";
        $data["contenido"][0] = $this->load->view('fichaPaciente',$data,TRUE);
        $data["seccion"] = 'personal';
        $this->load->view('template',$data);
    }


}

