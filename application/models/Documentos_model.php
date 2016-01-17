<?php

class Documentos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardardocumento($data) {
        try {
            $this->db->insert("documentos", $data);
        } catch (exception $e) {
            
        }
    }

}

?>