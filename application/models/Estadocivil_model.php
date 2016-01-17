<?php

class Estadocivil_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $estadoCivil = $this->db->get("estado_civil");
            return $estadoCivil->result();
        } catch (exception $e) {
            
        }
    }

}

?>