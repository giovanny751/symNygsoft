<?php

class Riesgoclasificacionelemento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detailxIdTipo($id) {
        try {
            $this->db->where("rieClaTip_id", $id);
            $elemento = $this->db->get("riesgo_clasificacion_elemento");
            return $elemento->result();
        } catch (exception $e) {
            
        }
    }

    function save($data) {
        try {
            $this->db->trans_begin();
            $this->db->insert("riesgo_clasificacion_elemento", $data);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        } finally {
            return $this->db->trans_status();
        }
    }

}

?>