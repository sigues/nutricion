<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuariomodel extends CI_Model {

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

    function validarCorreo($correo){
        $result = $this->db->get_where("usuario",array("correo"=>$correo));
        return $result->row_array();
    }

    function getUsuarios(){
        $result = $this->db->get("usuario");
        $usuarios = array();
        foreach($result->result() as $usuario){
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    function getUsuarioLogin($correo,$contrasena){
        $result = $this->db->get_where("usuario",array("correo"=>$correo,"contrasena"=>$contrasena));
        return $result->row_array();
    }
}