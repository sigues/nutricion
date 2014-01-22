<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preguntamodel extends CI_Model {

    var $idusuario = '';
    var $correo = '';
    var $contrasena = '';
    var $nombre = '';
    var $apellido = '';
    var $sexo = '';
    var $fechaNacimiento = '';
    var $perfil = '';
    var $ciudad_idciudad = '';

    function __construct()
    {
        parent::__construct();
    }

    function getPreguntasCuestionario($codigo,$usuario=null){
        $condicionUsuario = "";
        if($usuario != null){
            $condicionUsuario = " AND (usuario_has_respuesta.usuario_idusuario = $usuario OR usuario_has_respuesta.usuario_idusuario = null) ";
        }
        $this->db->select("cuestionario.*, pregunta.*, respuesta.*, usuario_has_respuesta.*, cuestionario.nombre nombreCuestionario, pregunta.nombre nombrePregunta, respuesta.nombre nombreRespuesta");
        $this->db->from("respuesta");
        $this->db->join("pregunta","pregunta.idpregunta=respuesta.pregunta_idpregunta");
        $this->db->join("cuestionario","cuestionario.idcuestionario=pregunta.cuestionario_idcuestionario");
        $this->db->join("usuario_has_respuesta","usuario_has_respuesta.respuesta_idrespuesta=respuesta.idrespuesta $condicionUsuario ","left");
        $this->db->where("cuestionario.codigo",$codigo);

        $result = $this->db->get();

        $preguntas = array();
        foreach($result->result() as $pregunta){
            $preguntas[] = $pregunta;
        }
        return $preguntas;


    }

    function estadoPreguntas($codigo,$usuario=null){
        $condicionUsuario = "";
        if($usuario != null){
            $condicionUsuario = " AND (usuario_has_respuesta.usuario_idusuario = $usuario OR usuario_has_respuesta.usuario_idusuario = null) ";
        }
        $this->db->select("cuestionario.*, pregunta.*, respuesta.*, usuario_has_respuesta.*, cuestionario.nombre nombreCuestionario, pregunta.nombre nombrePregunta, respuesta.nombre nombreRespuesta");
        $this->db->from("respuesta");
        $this->db->join("pregunta","pregunta.idpregunta=respuesta.pregunta_idpregunta");
        $this->db->join("cuestionario","cuestionario.idcuestionario=pregunta.cuestionario_idcuestionario");
        $this->db->join("usuario_has_respuesta","usuario_has_respuesta.respuesta_idrespuesta=respuesta.idrespuesta $condicionUsuario ","left");
        $this->db->where("cuestionario.codigo",$codigo);
        $this->db->where("pregunta.obligatoria",true);
        $result = $this->db->get();
        $preguntas = array();
        $estado = true;
        foreach ($result->result() as $pregunta){
            if ($pregunta->tipo == "radio" || $pregunta->tipo == "checkbox" ){
                if($pregunta->idusuario_has_respuesta == null){
                    $estado = false;
                }
            } else if ($pregunta->tipo == "text" || $pregunta->tipo == "int"){
                if($pregunta->idusuario_has_respuesta == null){
                    $estado = false;
                }
            }
        }

        return $estado;
    }

    public function guardarRespuestaPaciente(){
        $data = array();
        $data["usuario_idusuario"] = $this->usuario_idusuario;
        $data["pregunta_idpregunta"] = $this->idpregunta;
        $data["fecha"] = date("Y-m-d H:i:s");
        if($this->tipo_pregunta == "checkbox" || $this->tipo_pregunta == "radio"){
            $data["valor"] = $this->valor;
            $data["respuesta_idrespuesta"] = $this->idrespuesta;
        }else{
            $data["valor"] = $this->valor;
        }
        $this->db->insert("usuario_has_respuesta",$data);
    }


}