<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ciudadmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        parent::__construct();
    }

    function getPaises(){
    	$query = $this->db->get("pais");
    	$paises = array();
    	foreach($query->result() as $row){
            $paises[$row->idpais] = $row;
        }
        return $paises;
    }
}