<?php

class Riesgocolor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function detail() {
        try {
            $this->db->order_by("rieCol_color","asc");
            $color = $this->db->get("riesgo_color");
            return $color->result();
        } catch (exception $e) {
            
        }
    }

}

?>