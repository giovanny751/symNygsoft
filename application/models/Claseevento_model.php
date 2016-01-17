<?php

class Claseevento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("claEve_descripcion","asc");
            $clase = $this->db->get("clase_evento");
            return $clase->result();
        } catch (exception $e) {
            
        }
    }

}

?>