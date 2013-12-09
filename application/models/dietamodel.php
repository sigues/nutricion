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

    function getDietas(){
        $query = $this->db->get("dieta");
        $dietas = array();
        foreach($query->result() as $dieta){
            $dietas[] = $dieta;
        }
        return $dietas;
    }

    function getDieta($iddieta){
        $response = array();
        $query = $this->db->get_where("dieta",array("iddieta"=>$iddieta));
        $response["dieta"] = $query->row();
        $response["usuario_has_dieta"] = $this->getUsuariosByDieta($iddieta);
        $response["perfil_has_dieta"] = $this->getPerfilesByDieta($iddieta);
        $response["dieta_has_grupo"] = $this->getGruposByDieta($iddieta);
        return $response;
    }

    function getUsuariosByDieta($iddieta){
        $query = $this->db->get_where("usuario_has_dieta", array("dieta_iddieta"=>$iddieta));
        $response = array();
        foreach($query->result() as $row){
            $response[$row->usuario_idusuario] = $row;
        }
        return $response;
    }

    function getPerfilesByDieta($iddieta){
        $query = $this->db->get_where("perfil_has_dieta", array("dieta_iddieta"=>$iddieta));
        $response = array();
        foreach($query->result() as $row){
            $response[$row->perfil_idperfil] = $row;
        }
        return $response;
    }

    function getGruposByDieta($iddieta){
        $query = $this->db->get_where("dieta_has_grupo", array("dieta_iddieta"=>$iddieta));
        $response = array();
        foreach($query->result() as $row){
            $response[$row->grupo_idgrupo."-".$row->horario_idhorario] = $row;
        }
        return $response;
    }
}