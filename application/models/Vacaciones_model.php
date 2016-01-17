<?php

class Vacaciones_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detailxEmpleado($emp_id) {
        try{
            $this->db->select("timestampdiff(DAY, (vac_fechaInicio),(vac_fechaFin)) as  diferencia",false);
            $this->db->select("vac_fechaInicio");
            $this->db->select("vac_fechaFin");
            $this->db->select("vac_id");
            $this->db->select("vac_observaciones");
            $vacaciones = $this->db->get("vacaciones");
            return $vacaciones->result();
        }catch(excete $e){
            
        }
    }
    function dataHolidaysxId($vac_id) {
        try{
            $this->db->where("vac_id",$vac_id);
            $vacaciones = $this->db->get("vacaciones");
            return $vacaciones->result();
        }catch(excete $e){
            
        }
    }
    function removeHolidays($vac_id){
        try{
            $this->db->trans_begin();
            $this->db->where("vac_id",$vac_id);
            $this->db->delete("vacaciones");
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
            $this->db->insert("vacaciones",$data);
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
            $this->db->where("vac_id",$id);
            $this->db->update("vacaciones",$data);
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

}

?>