<?php 
class Inspeccion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function save($inspeccion){
        
        try {
            $this->db->insert("inspeccion",$inspeccion);
            
        } catch (exception $e) {
            
        }finally{
            return $this->db->insert_id();
        }
    }
}
?>
