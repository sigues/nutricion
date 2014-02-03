<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alimentomodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        parent::__construct();
    }

    function getAlimentosByGrupo($grupo){
        $this->db->select("alimento.*, medida.*, alimento.nombre nombreAlimento, medida.nombre nombreMedida");
        $this->db->from("alimento");
        $this->db->join("medida","alimento.medida_idmedida = medida.idmedida");
        $this->db->where("grupo_idgrupo",$grupo);
        $query = $this->db->get();
    	$alimentos = array();
    	foreach($query->result() as $row){
            $alimentos[$row->idalimento] = $row;
        }
        return $alimentos;
    }
}