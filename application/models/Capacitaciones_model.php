<?php

class Capacitaciones_model extends CI_Model{
    
    
    function guardarCapacitacion($data){
        $this->db->insert("capacitacion",$data);
        return $this->db->insert_id();
    }
    function capacitacionesXidEmpleado($emp_id){
        
        $this->db->where("empleado_capacitacion.emp_id",$emp_id);
        $this->db->distinct("capacitacion.cap_nombreCapacitacion");
        $this->db->select("capacitacion.cap_nombreCapacitacion");
        $this->db->select("capacitacion.cap_fechaCapacitacion");
        $this->db->select("capacitacion.cap_observacion");
        $this->db->join("empleado_capacitacion","empleado_capacitacion.cap_id = capacitacion.cap_id");
        $capacitacion = $this->db->get("capacitacion");
        return $capacitacion->result();
    }
    
}