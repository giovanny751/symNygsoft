<?php

class Norma_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("nor_norma");
            $this->db->where("est_id",1);
            $norma = $this->db->get("norma");
            return $norma->result();
        } catch (exception $e) {
            
        }
    }
    function normaarticulo($norma){
        try {
            $this->db->order_by("norArt_articulo");
            $this->db->where("nor_id",$norma);
            $norma = $this->db->get("norma_articulo");
            return $norma->result();
        } catch (exception $e) {
            
        }
    }

}

?>