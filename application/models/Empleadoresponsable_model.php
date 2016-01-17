<?php

class Empleadoresponsable_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function detail() {
        try {
            $this->db->order_by("empRes_descripcion","asc");
            $empleadoresponsable = $this->db->get("empleado_responsable");
            return $empleadoresponsable->result();
        } catch (exception $e) {
            
        }
    }
   
}

?>