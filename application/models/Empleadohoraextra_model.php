<?php

class Empleadohoraextra_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($data){
        
        $this->db->insert("empleado_horas_extra",$data);
    }
    
    function detalleHoraXEmpleado($emp_id){
        $this->db->where("emp_id",$emp_id);
        $this->db->join("hora_extra_tipo","hora_extra_tipo.horExtTip_id = empleado_horas_extra.horExtTip_id ");
        $emp = $this->db->get("empleado_horas_extra");
        return $emp->result();
    }
    
}

?>