<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function registro(){
		$this->load->helper(array('form', 'url'));
		$this->load->model("usuariomodel");
		$data = array();

		if($this->input->post("inputRegistro") == "registro"){
			$registro = $this->validarFormulario($this->input->post());
			if($registro == true){
				redirect(base_url()."index.php", 'refresh');
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
                   'tiene_historial' => FALSE,
                   'datos_personales_cerrado' => FALSE,
                   'historial_cerrado' => FALSE
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
				$historial_cerrado = true;
				if($preguntasHistorial == false){
					$tiene_historial = false;
					$historial_cerrado = false;
				}

					$newdata = array(
					   'idusuario' => $usuario["idusuario"],
	                   'correo'  => $usuario["correo"],
	                   'perfil'	 => $usuario["perfil"],
	                   'is_logged' => true,
	                   'tiene_propiedades' => $tiene_propiedades,
	                   'tiene_historial' => $tiene_historial,
	                   'historial_cerrado' => $historial_cerrado
	               );
				$this->session->set_userdata($newdata);
				$data["contenido"] = $this->load->view('usuario/controlPanel',$data,true);
			
			} else {
				$data["error"] = "login";
				$data["contenido"] = $this->load->view('login',$data,true);
				$data["falloLogin"] = true;
			}

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
		var_dump($this->session->all_userdata());
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

	public function solicitarCita(){
		$data["contenido"] = $this->load->view("usuario/solicitarCita","",true);
		$this->load->view("template",$data);
	}

    public function diaDoctor(){
        $data["nutriologo"] = $this->uri->segment(4);
        $fecha = explode("-",$this->uri->segment(3));
        $data["fecha"] = $fecha[2]."-".$fecha[1]."-".$fecha[0];
        $this->db->order_by("horaInicio","asc");
        $data["citas"] = $this->db->get_where("cita",$data)->result();
        //echo $this->db->last_query();
        $this->load->view("ajax/diaDoctorUsuario",$data);
    }

    public function muestraAlimentosHorario(){
    	$usuario = $this->session->userdata("idusuario");
    	$horario = $this->input->post("horario");
    	$this->load->model("dietamodel");
    	$this->load->model("alimentomodel");
    	$dieta = $this->dietamodel->getDietaByUsuario($usuario);
    	$grupos = $this->dietamodel->getGruposByDieta($dieta->dieta_iddieta);

    	$grupos_horario = array();
    	$contenidoAlimentos = "";
    	$x = 0;
		echo "<div class='row'>";
    	foreach($grupos as $c=>$grupo){
    		if($grupo->horario_idhorario == $horario){
    			$grupos_horario[$c] = $grupo;
    			$data["grupo"] = $grupo;
    			$alimentos = $this->alimentomodel->getAlimentosByGrupo($grupo->grupo_idgrupo);
    			foreach($alimentos as $alimento){
					if($x == 4){
	    				echo "</div><div class='row'>";
	    				$x = 0;
	    			}
	    			$data["alimento"] = $alimento;
	    			$contenidoAlimentos .= $this->load->view("usuario/verAlimento",$data,true);
	    	
    			}
    		}
    	}
    	echo $contenidoAlimentos;
    	echo "</div>";
    }

    function solicitarCitaAjax(){
    	$this->load->model("usuariomodel");


    	$data["usuario_idusuario"] = $this->session->userdata("idusuario");

    	$myDateTime = DateTime::createFromFormat('d/m/Y', $this->input->post("fecha"));
		$newDateString = $myDateTime->format('Y-m-d');

    	$data["fecha"] = $newDateString;
    	$data["horaInicio"] = $this->input->post("horaInicio");
    	$data["horaFin"] = $this->input->post("horaFin");
    	$data["costo"] = 300;
    	$data["nutriologo"] = 1;
    	$data["estado"] = "reservada";
    	$data["estadoFinanciero"] = "pendiente";

    	$this->db->insert("cita",$data);
    	$data["idcita"] = $this->db->insert_id();

		$data["usuario"] = $this->usuariomodel->getUsuario($data["usuario_idusuario"]);
		$data["nutriologo"] = $this->usuariomodel->getUsuario($data["nutriologo"]);

		$this->correoSolicitarCita($data);
    	echo $data["idcita"];
//    	var_dump($data);
//    	echo $idusuario."->".$fecha."->".$horaInicio."->".$horaFin;
    }

    function correoSolicitarCita($data){

		$to = $data["usuario"]->correo;

		$subject = 'Solicitud de cita en Nutink.com';

		$headers = "From: " . strip_tags("nutricion@nutink.com") . "\r\n";
		$headers .= "Reply-To: ". strip_tags("nutricion@nutink.com") . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message = '<html><body>';
		//$message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
		$message .= '<h1>Solicitud de cita en Nutink.com</h1>';
		$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$message .= "<tr style='background: #eee;'><td><strong>Nombre:</strong> </td><td>" . $data["usuario"]->nombre." ".$data["usuario"]->apellido . "</td></tr>";
		$message .= "<tr><td><strong>Nutri&oacute;logo:</strong> </td><td>" . $data["nutriologo"]->nombre." ".$data["nutriologo"]->apellido . "</td></tr>";
		$message .= "<tr><td><strong>Fecha solicitada:</strong> </td><td>" . date("d-m-Y",strtotime($data["fecha"])) . "</td></tr>";
		$message .= "<tr><td><strong>Horario:</strong> </td><td>" . $data["horaInicio"]." - ".$data["horaFin"] . "</td></tr>";
		$message .= "<tr><td><strong>Confirmar cita:</strong> </td><td>" . base_url()."index.php/usuario/confirmarCita/".$data["idcita"] . "</td></tr>";
		//$addURLS = $_POST['addURLS'];
		$message .= "</table>";
		$message .= "</body></html>";

		mail($to, $subject, $message, $headers);
		mail("nutricion@nutink.com", $subject, $message, $headers);
    }

    function avisoConfirmarCita(){
    	$data["contenido"] = $this->load->view("usuario/avisoConfirmarCita","",true);
    	$this->load->view("template",$data);
    }

    function confirmarCita(){
    	$idcita = $this->uri->segment(3);
    	$this->load->model("citamodel");
    	$data["cita"] = $this->citamodel->getCita($idcita);
    	$data["contenido"] = $this->load->view("usuario/confirmarCita",$data,true);
    	$this->load->view("template",$data);
    }

}