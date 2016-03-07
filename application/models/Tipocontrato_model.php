<?php

class Tipocontrato_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->where("activo", "S");
            $this->db->order_by("TipCon_Descripcion");
            $tipocontrato = $this->db->get("tipo_contrato");
            return $tipocontrato->result();
        } catch (exception $e) {
            
        }
    }

}

?>