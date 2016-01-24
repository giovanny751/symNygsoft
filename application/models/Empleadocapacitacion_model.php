<?php

class Empleadocapacitacion_model extends CI_Model{
    
    function guardar($data){
        
        $this->db->insert_batch("empleado_capacitacion",$data);
    }
    
}