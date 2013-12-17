<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function registro(){
		$this->load->helper(array('form', 'url'));
		$this->load->model("usuariomodel");
		$data = array();

		if($this->input->post("inputRegistro") == "registro"){
			$registro = $this->validarFormulario($this->input->post());
			if($registro == true){
				//redirect('/usuario/controlpanel/', 'refresh');
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

			$newdata = array(
                   'nombre'  => $this->input->post("nombre"),
                   'correo'  => $this->input->post("correo"),
                   'perfil'	 => $this->input->post("email"),
                   'is_logged' => TRUE
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

		$this->load->model("usuariomodel");
		$this->load->model("propiedad_usuariomodel");
		$data["falloLogin"] = false;
		$usuario = $this->usuariomodel->getUsuarioLogin($correo,$contrasena);

		if(sizeof($usuario)>0){
			$propiedad_usuario = $this->propiedad_usuariomodel->getPropiedad_usuarios($usuario["idusuario"]);
			if(sizeof($propiedad_usuario)>0){
				$tiene_propiedades = true;
			} else {
				$tiene_propiedades = false;
			}
				$newdata = array(
                   'correo'  => $usuario["correo"],
                   'perfil'	 => $usuario["perfil"],
                   'is_logged' => true,
                   'tiene_propiedades' => $tiene_propiedades
               );
			$this->session->set_userdata($newdata);
		} else {
			$data["falloLogin"] = true;
		}

		$data["main"] = true;
		$data["contenido"] = $this->load->view('bootstrap',$data,true);
		$this->load->view('template',$data);

	}

	public function cerrarSesion(){
		$this->session->set_userdata('is_logged',false);
		$data["main"] = true;
		$data["contenido"] = $this->load->view('bootstrap',$data,true);
		$this->load->view('template',$data);


	}

	public function datosPersonales(){
		$this->load->model("propiedad_usuariomodel");
		$data["propiedades"] = $this->propiedad_usuariomodel->getPropiedades();
		$this->load->view("usuario/datosPersonales",$data);

		//var_dump($propiedades);

	}

}