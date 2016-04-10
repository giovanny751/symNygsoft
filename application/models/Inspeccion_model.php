<?php 
class Inspeccion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function save($inspeccion){
        
        try {
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
            $this->db->insert("inspeccion",$inspeccion);
            
        } catch (exception $e) {
            
        }finally{
            return $this->db->insert_id();
        }
    }
    function consultaInspeccion(){
        $inspeccion=$this->db->get("inspeccion");
        
        return $inspeccion->result();
    }
}
?>
