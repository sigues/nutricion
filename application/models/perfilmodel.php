<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfilmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getPerfiles(){
    	$query = $this->db->get("perfil");
    	$perfiles = array();
    	foreach($query->result() as $row){
            $perfiles[$row->idperfil] = $row;
        }
        return $perfiles;
    }
}