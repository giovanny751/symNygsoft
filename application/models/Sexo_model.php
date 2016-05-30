<?php

class Sexo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("Sex_Sexo");
            $this->db->select("Sex_id");
            $this->db->select("Sex_Sexo");
            $sexo = $this->db->get("sexo");
            return $sexo->result();
        } catch (exception $e) {
            
        }
    }

}

?>