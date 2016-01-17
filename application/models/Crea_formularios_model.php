<?php

class Crea_formularios_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function tablas() {
        try {
            $datos = $this->db->query('show tables');
            return $datos->result();
        } catch (exception $e) {
            
        }
    }

    public function info_table($post) {
        try {
            $datos = $this->db->query('describe ' . $post['tabla']);
            return $datos->result();
        } catch (exception $e) {
            
        }
    }

    public function info_input() {
        try {
            $tipo = $this->db->get('tipo_inputs');
            return $tipo->result();
        } catch (exception $e) {
            
        }
    }

}
