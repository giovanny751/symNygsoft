<?php

class Cargofuncion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function create($data){
        $this->db->insert_batch("cargo_funcion",$data);
    }
}