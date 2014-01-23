<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Propiedad_usuariomodel extends CI_Model {

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

    function registroUsuario(){
    	$datos = array("correo"=>$this->correo,
                        "nombre"=>$this->nombre,
                        "apellido"=>$this->apellido,
                        "perfil"=>$this->perfil,
                        "contrasena"=>md5($this->contrasena));
        $usuario = $this->db->insert("usuario",$datos);
        return $usuario;
    }

    function getPropiedad_usuarios($idusuario){
        $this->db->select("usuario_has_propiedad_usuario.*");
        $this->db->select("propiedad_usuario.*");
        $this->db->from("propiedad_usuario");
        $this->db->join("usuario_has_propiedad_usuario","usuario_has_propiedad_usuario.propiedad_usuario_idpropiedad_usuario = propiedad_usuario.idpropiedad_usuario");

        $this->db->where("usuario_has_propiedad_usuario.usuario_idusuario",$idusuario);



        $result = $this->db->get();


        $propiedad_usuario = array();
        foreach($result->result() as $usuario){
            $propiedad_usuario[] = $usuario;
        }
        return $propiedad_usuario;
    }

    function getPropiedades($cuestionario = null,$usuario=null,$historico=false){
        $condicionUsuario="";
        if($usuario != null){
            $condicionUsuario = "AND (usuario_has_propiedad_usuario.usuario_idusuario = $usuario OR usuario_has_propiedad_usuario.usuario_idusuario = NULL) ";
        }

        $this->db->select("propiedad_usuario.*,usuario_has_propiedad_usuario.valor respuesta, usuario_has_propiedad_usuario.*");
        $this->db->from("propiedad_usuario");
        $this->db->join("usuario_has_propiedad_usuario","propiedad_usuario.idpropiedad_usuario = usuario_has_propiedad_usuario.propiedad_usuario_idpropiedad_usuario $condicionUsuario","left");
        if($cuestionario != null){
            $propiedades = array("cuestionario"=>$cuestionario);
            $this->db->where($propiedades);
        }

        if($historico == false){
            $this->db->group_by("idpropiedad_usuario");
        }
        $res = $this->db->get();
        $propiedades_usuario = array();
        foreach($res->result() as $row){
            $propiedades_usuario[] = $row;
        }
        return $propiedades_usuario;
    }

    function getUsuarioLogin($correo,$contrasena){
        $result = $this->db->get_where("usuario",array("correo"=>$correo,"contrasena"=>$contrasena));
        return $result->row_array();
    }
}