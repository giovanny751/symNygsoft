<?php

class Departamento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function detail($pai_id = null){
        if(!empty($pai_id))$this->db->where("pai_id",$pai_id);
        $pais = $this->db->get("departamento");
        return $pais->result();
    }
}