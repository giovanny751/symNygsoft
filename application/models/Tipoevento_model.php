<?php

class Tipoevento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("tipEve_descripcion","asc");
            $tipo = $this->db->get("tipo_evento");
            return $tipo->result();
        } catch (exception $e) {
            
        }
    }

}

?>