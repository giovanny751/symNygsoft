<?php

class Pais_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function detail(){
        $pais = $this->db->get("pais");
        return $pais->result();
    }
}