<?php

class Estadocivil_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("estCiv_Estado");
            $estadoCivil = $this->db->get("estado_civil");
            return $estadoCivil->result();
        } catch (exception $e) {
            
        }
    }

}

?>