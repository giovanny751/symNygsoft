<?php

class Categoria_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function search($categoria) {
        try{
        $this->db->where("cat_categoria",$categoria);
        $categoria =$this->db->get("categoria");
        return $categoria->result();
        }catch(exception $e){
            
        }
    }
    function insert($categoria) {
        try{
        $this->db->set("cat_categoria",$categoria);
        $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
        $this->db->insert("categoria");
        }catch(exception $e){
            
        }
    }
    function detail(){
        try{
        $categoria =$this->db->get("categoria");
        return $categoria->result();
        }catch(exception $e){
            
        }
    }


}

?>