<?php

class Tipoexamen_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function detail() {
        try {
            $this->db->order_by("tipExa_tipo","asc");
            $tipo = $this->db->get("tipo_examen");
            return $tipo->result();
        } catch (exception $e) {
            
        }
    }
}