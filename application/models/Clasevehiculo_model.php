<?php

class Clasevehiculo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("claVeh_nombre","asc");
            $clase = $this->db->get("clase_vehiculo");
            return $clase->result();
        } catch (exception $e) {
            
        }
    }

}

?>