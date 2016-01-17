<?php

class Indicadorcarpeta_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardarCarpeta($data) {
        try {
            $this->db->insert("indicador_carpeta", $data);
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function consultaCarpetaxId($id) {
        try {
            $this->db->where("indCar_id", $id);
            $valor = $this->db->get("indicador_carpeta");
            return $valor->result();
        } catch (exception $e) {
            
        }
    }

    

}

?>