<?php

class Cargonotificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function guardarCargoNotificacion($data){
        try {
            $this->db->trans_begin();
            $this->db->insert_batch("cargo_notificacion",$data);
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