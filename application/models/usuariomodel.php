<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuariomodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        parent::__construct();
    }

    function altaUsuario(){
    	$query = $this->db->get("pais");
    	$paises = array();
    	foreach($query->result() as $row){
            $paises[$row->idpais] = $row;
        }
        return $paises;
    }
}