<?php

class Botiquin_model extends CI_Model {

//    private $botiquin = null;
    
    function __construct() {
        parent::__construct();
    }

    function detail() {
        try{
            $botiquin = $this->db->get("botiquin");
            return $botiquin->result();
        }catch(exception $e){
            
        }
    }
    function save($data) {
        try{
            $this->db->insert("botiquin",$data);
            $this->db->insert_id();
        }catch(exception $e){
            
        }
    }
}

?>