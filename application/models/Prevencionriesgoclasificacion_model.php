<?php

class Prevencionriesgoclasificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardarPrevencionClasificacion($campos) {
        try {
            $this->db->trans_begin();
            $this->db->insert("prevencion_riesgo_clasificacion", $campos);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception("Error al insertar en la base de datos");
            } else {
                $id = $this->db->insert_id();
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        } finally {
            return $id;
        }
    }

}
