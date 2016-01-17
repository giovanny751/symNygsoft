<?php

class Color_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("col_color");
            $color = $this->db->get("color");
            return $color->result();
        } catch (exception $e) {
            
        }
    }

    function exist($estado, $color) {
        try {
            $this->db->where("estAce_id", $estado);
            $this->db->where("col_color", $color);
            $color = $this->db->get("color");
            return $color->result();
        } catch (exception $e) {
            
        }
    }

    function create($estado, $color) {
        try {
            $this->db->set("estAce_id", $estado);
            $this->db->set("col_color", $color);
            $this->db->insert("color");
        } catch (exception $e) {
            
        }
    }

    function colorxestado($estado) {
        try {
            $this->db->order_by("col_color");
            $this->db->where("estAce_id", $estado);
            $color = $this->db->get("color");
            return $color->result();
        } catch (exception $e) {
            
        }
    }

}

?>