<?php

class Documentogrupo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function creaciongrupo($data) {
        try {
            $this->db->insert("documento_grupo", $data);
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function actualizaciongrupo($data, $id) {
        try {
            $this->db->where("docGru_id", $id);
            $this->db->update("documento_grupo", $data);
        } catch (exception $e) {
            
        }
    }

    function detailgroup() {
        try {
            $this->db->order_by("documento_grupo.docGru_orden");
            $grupo = $this->db->get("documento_grupo");
            return $grupo->result();
        } catch (exception $e) {
            
        }
    }

    function eliminargrupo($id) {
        try {
            $this->db->where("docGru_id", $id);
            $this->db->delete("documento_grupo");
        } catch (exception $e) {
            
        }
    }

    function consultagrupo($id) {
        try {
            $this->db->where("docGru_id", $id);
            $grupo = $this->db->get("documento_grupo");
            return $grupo->result();
        } catch (exception $e) {
            
        }
    }

}

?>