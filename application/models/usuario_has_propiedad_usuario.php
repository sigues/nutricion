<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_has_propiedad_usuario extends CI_Model {
	var $usuario_idusuario;
	var $idpropiedad_usuario;
	var $valor;

    function __construct()
    {
        parent::__construct();
    }

    function guardar(){
    	$datos = array("usuario_idusuario"=>$this->usuario_idusuario,
                        "propiedad_usuario_idpropiedad_usuario"=>$this->idpropiedad_usuario,
                        "valor"=>$this->valor);
        $valor = $this->db->insert("usuario_has_propiedad_usuario",$datos);
        return $valor;
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

    function getPropiedades($cuestionario = null,$usuario=null){
        $this->db->select("propiedad_usuario.*,usuario_has_propiedad_usuario.valor respuesta");
        $this->db->from("propiedad_usuario");
        $this->db->join("usuario_has_propiedad_usuario","propiedad_usuario.idpropiedad_usuario = usuario_has_propiedad_usuario.propiedad_usuario_idpropiedad_usuario","left");
        if($cuestionario != null){
            $propiedades = array("cuestionario"=>$cuestionario);
            $this->db->where($propiedades);
        }
        if($usuario != null){
            $propiedades = array("usuario_has_propiedad_usuario.usuario_idusuario"=>$usuario);
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