<?php

class Tipovehiculo_model extends CI_Model{
        function __construct() {
        parent::__construct();
    }

    function detail($clase = null) {
        try {
            $this->db->select("tipVeh_nombre","asc");
            $this->db->select("tipVeh_id");
            $this->db->select("tipVeh_nombre");
            if(!empty($clase))$this->db->where("claVeh_id",$clase); 
            $datos = $this->db->get("tipo_vehiculo");
            return $datos->result();
        } catch (exception $e) {
            
        }
    }
}
