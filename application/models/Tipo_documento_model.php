<?php

class Tipo_documento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $tipodocumento = $this->db->get("tipo_documento");
            return $tipodocumento->result();
        } catch (exception $e) {
            
        }
    }

}

?>