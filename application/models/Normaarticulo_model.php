<?php

class Normaarticulo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detailxId($idnorma){
        try {
            $this->db->order_by("norArt_articulo");
            $this->db->where("nor_id",$idnorma);
            $norma = $this->db->get("norma_articulo");
            return $norma->result();
        } catch (exception $e) {
            
        }
    }
    
    /*
    function detail() {
        try {
            $this->db->order_by("nor_norma");
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
     */

}

?>