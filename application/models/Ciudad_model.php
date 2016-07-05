<?php

class Ciudad_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function detail($dpto = null){
        if(!empty($dpto))$this->db->where("dep_id",$dpto);
        $pais = $this->db->get("ciudad");
        return $pais->result();
    }
}