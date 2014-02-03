<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Citamodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getCita($idcita){
    	$query = $this->db->get_where("cita",array("idcita"=>$idcita));
    	$cita = null;
    	foreach($query->result() as $row){
            $cita = $row;
        }
        return $cita;
    }
}