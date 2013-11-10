<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Horariomodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getHorarios(){
    	$query = $this->db->get("horario");
    	$horarios = array();
    	foreach($query->result() as $row){
            $horarios[$row->idhorario] = $row;
        }
        return $horarios;
    }
}