<?php

class Sexo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $sexo = $this->db->get("sexo");
            return $sexo->result();
        } catch (exception $e) {
            
        }
    }

}

?>