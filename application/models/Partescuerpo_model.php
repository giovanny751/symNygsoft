<?php

class Partescuerpo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("parCue_descripcion","asc");
            $partes = $this->db->get("partes_cuerpo");
            return $partes->result();
        } catch (exception $e) {
            
        }
    }

}

?>