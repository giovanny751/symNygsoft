<?php

class Tipoaseguradora_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->where("activo", "S");
            $tipoaseguradora = $this->db->get("tipo_aseguradora");
            return $tipoaseguradora->result();
        } catch (exception $e) {
            
        }
    }

    function consultatipoaseguradora($id) {
        try {
            $this->db->where("TipAse_Id", $id);
            $tipoaseguradora = $this->db->get("tipo_aseguradora");
            return $tipoaseguradora->result();
        } catch (exception $e) {
            
        }
    }

}

?>