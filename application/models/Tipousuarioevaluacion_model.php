<?php

class Tipousuarioevaluacion_model extends CI_Model{
        function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("tipUsuEva_tipo","asc");
            $datos = $this->db->get("tipo_usuario_evaluacion");
            return $datos->result();
        } catch (exception $e) {
            
        }
    }
}
