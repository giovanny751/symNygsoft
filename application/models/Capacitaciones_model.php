<?php

class Capacitaciones_model extends CI_Model{
    
    
    function guardarCapacitacion($data){
        $this->db->insert("capacitacion",$data);
        return $this->db->insert_id();
    }
    
}