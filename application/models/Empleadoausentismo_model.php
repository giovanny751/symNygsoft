<?php

class Empleadoausentismo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detailxEmpleado($emp_id) {
        try{
            $this->db->select("timestampdiff(DAY, (empAus_fechaInicial),(empAus_fechaFinal)) as  diferencia",false);
            $this->db->select("empAus_fechaInicial");
            $this->db->select("empAus_fechaFinal");
            $this->db->select("empAus_id");
            $this->db->select("empAus_observaciones");
            $this->db->where("emp_id",$emp_id);
            $vacaciones = $this->db->get("empleado_ausentismo");
            return $vacaciones->result();
        }catch(excete $e){
            
        }
    }
    function dataHolidaysxId($vac_id) {
        try{
            $this->db->where("empAus_id",$vac_id);
            $vacaciones = $this->db->get("empleado_ausentismo");
            return $vacaciones->result();
        }catch(excete $e){
            
        }
    }
    function removeHolidays($vac_id){
        try{
            $this->db->trans_begin();
            $this->db->where("empAus_id",$vac_id);
            $this->db->delete("empleado_ausentismo");
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
        }catch(exception $e){
            
        }finally{
            return $this->db->trans_status();
        }
    }
    function saveVacation($data){
        try{
            $this->db->trans_begin();
            $this->db->set('UserCreator', $this->session->userdata('usu_id'));
            $this->db->set('fechaCreacion', date("Y-m-d H:i:s"));
            $this->db->insert("empleado_ausentismo",$data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
        }catch(exception $e){
            
        }finally{
            return $this->db->trans_status();
        }
    }
    function updateHolidays($data,$id){
        try{
            $this->db->trans_begin();
            $this->db->where("empAus_id",$id);
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('fechaModificacion', date("Y-m-d H:i:s"));
            $this->db->update("empleado_ausentismo",$data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
        }catch(exception $e){
            
        }finally{
            return $this->db->trans_status();
        }
    }
    
    function modificaXId($aus){
        try{
            $this->db->where("empAus_id",$aus);
            $vacaciones = $this->db->get("empleado_ausentismo");
            return $vacaciones->result();
        }catch(excete $e){
            
        }
    }
}

?>