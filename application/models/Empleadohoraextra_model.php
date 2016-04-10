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
        $this->db->where("empleado_horas_extra.est_id",1);
        $this->db->join("hora_extra_tipo","hora_extra_tipo.horExtTip_id = empleado_horas_extra.horExtTip_id ");
        $emp = $this->db->get("empleado_horas_extra");
        return $emp->result();
    }
    function detalleHoraTodosEmpleados(){
        $this->db->select("empleado_horas_extra.*");
        $this->db->select("hora_extra_tipo.horExtTip_tipo");
        $this->db->select("empleado.Emp_Nombre");
        $this->db->select("empleado.Emp_Apellidos");
        $this->db->where("empleado_horas_extra.est_id",1);
        $this->db->join("empleado","empleado.Emp_id = empleado_horas_extra.emp_id");
        $this->db->join("hora_extra_tipo","hora_extra_tipo.horExtTip_id = empleado_horas_extra.horExtTip_id ");
        $emp = $this->db->get("empleado_horas_extra");
        return $emp->result();
    }
    function horasGuardadasHoy(){
        $this->db->select("empleado_horas_extra.*");
        $this->db->select("hora_extra_tipo.horExtTip_tipo");
        $this->db->select("empleado.Emp_Nombre");
        $this->db->select("empleado.Emp_Apellidos");
        $this->db->where("empleado_horas_extra.est_id",1);
        $this->db->where("DATE(empleado_horas_extra.creatorDate)",date("Y-m-d"));
        $this->db->join("empleado","empleado.Emp_id = empleado_horas_extra.emp_id");
        $this->db->join("hora_extra_tipo","hora_extra_tipo.horExtTip_id = empleado_horas_extra.horExtTip_id ");
        $emp = $this->db->get("empleado_horas_extra");
//        echo $this->db->last_query();die;
        return $emp->result();
    }
    function eliminarHoraExtra($id){
        try{
            $this->db->where("empHorExt_id",$id);
            $this->db->set("empleado_horas_extra.est_id",3);
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
            $this->db->update("empleado_horas_extra");
        }catch(Exception $e){
            
        }finally{
            
        }
    }
    
}

?>