<?php

class Estados_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->where('est_id', 1);
            $this->db->or_where('est_id', 2);
            $estados = $this->db->get("estados");
            return $estados->result();
        } catch (exception $e) {
            
        }
    }

    function finalizados() {
        try {
            $this->db->where('est_id', 1);
            $this->db->or_where('est_id', 2);
            $this->db->or_where('est_id', 4);
            $estados = $this->db->get("estados");
            return $estados->result();
        } catch (exception $e) {
            
        }
    }

}

?>