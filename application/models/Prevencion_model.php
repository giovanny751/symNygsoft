<?php

class Prevencion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardarPrevencion($campos) {
        try {
            $this->db->trans_begin();
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
            $this->db->insert("prevencion", $campos);
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
