<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dietamodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        parent::__construct();
    }

    function verificaCodigo($codigo){
    	$query = $this->db->get_where("dieta",array("codigo"=>$codigo));
        $dieta = $query->row_array();
        if(sizeof($dieta)>0){
            return true;
        } else {
            return false;
        }
    }
}