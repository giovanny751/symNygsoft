<?php

class FuenteOrigen extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardar_fuente_origen($post) {
        try {
            $this->db->select('fueOri_id');
            $this->db->where('fueOri_nombre', $post['campo_otro']);
            $datos = $this->db->get('fuenteOrigen');
            $datos = $datos->result();
            if (!count($datos)) {
                $this->db->set('fueOri_nombre', $post['campo_otro']);
                $this->db->insert('fuenteOrigen');
                return $this->db->insert_id();
            } else {
                return $datos[0]->fueOri_id;
            }
        } catch (exception $e) {
            
        }
    }

}

?>