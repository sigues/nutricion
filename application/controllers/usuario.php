<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function registro(){
		$this->load->helper(array('form', 'url'));
		$this->load->model("usuariomodel");
		$data = array();

		if($this->input->post("inputRegistro") == "registro"){
			$registro = $this->validarFormulario($this->input->post());
			if($registro == true){
				redirect('/', 'refresh');
			} 
		}

		$data["contenido"]=$this->load->view("usuario/registro",null,true);
		$this->load->view("template",$data);
	}

	public function validarFormulario($datos){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[usuario.correo]');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == TRUE)
		{
			$this->load->model("usuariomodel");
			$this->usuariomodel->correo = $this->input->post("email");
			$this->usuariomodel->nombre = $this->input->post("nombre");
			$this->usuariomodel->apellido = $this->input->post("apellido");
			$this->usuariomodel->contrasena = $this->input->post("password");
			$this->usuariomodel->perfil = 1;
			$this->usuariomodel->registroUsuario();
			$usuario = $this->usuariomodel->getUsuarioLogin($this->input->post("email"),md5($this->input->post("password")));

			$newdata = array(
				   'idusuario' => $usuario["idusuario"],
                   'nombre'  => $this->input->post("nombre"),
                   'correo'  => $this->input->post("correo"),
                   'perfil'	 => $this->input->post("email"),
                   'is_logged' => TRUE,
                   'tiene_propiedades' => FALSE,
                   'tiene_historial' => FALSE
               );
			$this->session->set_userdata($newdata);

			return true;
		}
		else
		{
			return false;
		}
	}

	public function validarCorreo(){
		$correo = $this->input->post("correo");
		$this->load->model("usuariomodel");
		$validar = $this->usuariomodel->validarCorreo($correo);
		if(sizeof($validar)>0){
			$valido = false;
		} else {
			$valido = true;
		}
		$validar = array("valido"=>false);
		echo json_encode($validar);
	}

	public function iniciarSesion(){
		$correo = mysql_real_escape_string($this->input->post("correo"));
		$contrasena = md5(mysql_real_escape_string($this->input->post("contrasena")));

		if(isset($correo) && isset($contrasena) && $contrasena != "" && $correo != ""){
			$this->load->model("usuariomodel");
			$this->load->model("propiedad_usuariomodel");
			$this->load->model("preguntamodel");

			$data["falloLogin"] = false;
			$usuario = $this->usuariomodel->getUsuarioLogin($correo,$contrasena);

			if(sizeof($usuario)>0){
				$propiedad_usuario = $this->propiedad_usuariomodel->getPropiedad_usuarios($usuario["idusuario"]);
				if(sizeof($propiedad_usuario)>0){
					$tiene_propiedades = true;
				} else {
					$tiene_propiedades = false;
				}

				$preguntasHistorial = $this->preguntamodel->estadoPreguntas("historial",$usuario["idusuario"]);
				$tiene_historial = true;
				if($preguntasHistorial == false){
					$tiene_historial = false;
				}

					$newdata = array(
					   'idusuario' => $usuario["idusuario"],
	                   'correo'  => $usuario["correo"],
	                   'perfil'	 => $usuario["perfil"],
	                   'is_logged' => true,
	                   'tiene_propiedades' => $tiene_propiedades,
	                   'tiene_historial' => $tiene_historial
	               );
				$this->session->set_userdata($newdata);
			} else {
				$data["falloLogin"] = true;
			}

			$data["contenido"] = $this->load->view('usuario/controlPanel',$data,true);
			$this->load->view('template',$data);

		}elseif($this->session->userdata('is_logged') == true){
			$data["contenido"] = $this->load->view('usuario/controlPanel',$data,true);
			$this->load->view('template',$data);
		} else {
			$data = array();
			$data["contenido"] = $this->load->view('login',$data,true);
			$this->load->view('template',$data);

		}

	}

	public function cerrarSesion(){
		$this->session->set_userdata('is_logged',false);
		$this->session->set_userdata('datos_personales_cerrado',false);
		$data["main"] = true;
		$data["contenido"] = $this->load->view('bootstrap',$data,true);
		$this->load->view('template',$data);


	}

	public function datosPersonales(){
		$this->load->model("propiedad_usuariomodel");
		//var_dump($this->session->userdata("idusuario"));
		$usuario = $this->session->userdata("idusuario");
		$data["propiedades"] = $this->propiedad_usuariomodel->getPropiedades("registro",$usuario);
		$this->load->view("usuario/datosPersonales",$data);
	}

	public function historiaNutricion(){
		$this->load->model("preguntamodel");
		$data["preguntas"] = $this->preguntamodel->getPreguntasCuestionario("historial",$this->session->userdata("idusuario"));
		//var_dump($data["preguntas"]);
		$this->load->view("usuario/historiaNutricion",$data);
		
	}


	public function guardaDatosPersonales(){
		$this->load->model("usuario_has_propiedad_usuario");
		$datos = $_POST["datos"];
		foreach($datos as $c=>$dato){
			if(is_numeric($c)){
				$this->usuario_has_propiedad_usuario->usuario_idusuario = $this->session->userdata('idusuario');
				$this->usuario_has_propiedad_usuario->idpropiedad_usuario = $dato["idpropiedad_usuario"];
				$this->usuario_has_propiedad_usuario->valor = $dato["valor"];
				$this->usuario_has_propiedad_usuario->guardar();
			}
		}
		$val = array("value"=>"ok");
		echo json_encode($val);
	}

	public function guardaHistorial(){
		$this->load->model("preguntamodel");
		$datos = $_POST["datos"];
		foreach($datos as $c=>$dato){
			if(is_numeric($c)){
				$this->preguntamodel->usuario_idusuario = $this->session->userdata('idusuario');
				$this->preguntamodel->idpregunta = $dato["idpregunta"];
				$this->preguntamodel->tipo_pregunta = $dato["tipo_pregunta"];
				if($dato["tipo_pregunta"] == "radio" || $dato["tipo_pregunta"] == "checkbox"){
					$this->preguntamodel->idrespuesta = $dato["id"];
					$this->preguntamodel->valor = $dato["valor"];
				}else{
					$this->preguntamodel->valor = $dato["valor"];
				}
				$this->preguntamodel->guardarRespuestaPaciente();
			}
		}
		$this->session->set_userdata('tiene_historial',true);
		$val = array("value"=>"ok");
		echo json_encode($val);
	}

	public function cierraDatosPersonales(){
		$this->session->set_userdata('datos_personales_cerrado',true);
		$tiene_propiedades = $this->session->userdata("tiene_propiedades");
		if($tiene_propiedades == true){
			$this->session->set_userdata('historial_cerrado',true);
		}else{
			$this->session->set_userdata('tiene_propiedades',true);
		}
		echo json_encode(array("ok"=>"ok"));
	}

	public function guardaPeso(){
		if(is_numeric($_POST["peso"])){
			$this->load->model("usuario_has_propiedad_usuario");
			$this->usuario_has_propiedad_usuario->usuario_idusuario = $this->session->userdata("idusuario");
			$this->usuario_has_propiedad_usuario->idpropiedad_usuario = 1;
			$this->usuario_has_propiedad_usuario->valor = $_POST["peso"];
			$this->usuario_has_propiedad_usuario->guardar();
			$usuario = $this->session->userdata("idusuario");
			$this->load->model("propiedad_usuariomodel");
			$propiedades = $this->propiedad_usuariomodel->getPropiedades("registro",$usuario,true);
			$respuesta = array();
			foreach($propiedades as $propiedad){
				if($propiedad->codigo == "peso"){
					$respuesta[date("Y-m-d",strtotime($propiedad->fecha))] = $propiedad->valor;
				}
			}
		}else{
			$respuesta = array("error"=>"El peso debe ser numerico");
		}
		echo json_encode($respuesta);
	}

	public function tablaListadoPeso(){
		$idusuario = $this->session->userdata("idusuario");
		echo listado_peso($idusuario,true);
	}

}