<?php

class Extintor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        $extintor = $this->db->get("extintor");
        return $extintor->result();
    }

    function guardarExtintor($data) {
        try {
            $this->db->insert("extintor", $data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

}

?>