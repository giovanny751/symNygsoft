<?php

class Empleadocontrato_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    function CreacionContrato($data){
        try{
            $this->db->trans_begin();
            
            $this->db->insert("empleado_contratos",$data);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }catch(exception $e){
            
        }finally{
            return $this->db->trans_status();
        }
    }
    function contratosxEmpleado($emp_id){
        
        $this->db->where("emp_id",$emp_id);
        $this->db->join("tipo_contrato","tipo_contrato.tipCon_id = empleado_contratos.tipCon_id ");
        $data = $this->db->get("empleado_contratos");
        return $data->result();
    }
    
}
