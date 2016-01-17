<?php

class Actividad_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try{
        $actividad = $this->db->get("actividad");
        return $actividad->result();
        }catch(exception $e){
            
        }
    }
    function create($data,$post){
        try{
        if($post['actHij_id']==""){
        $this->db->insert("actividad_hijo",$data);
        }else{
        $this->db->where("actHij_id",$post['actHij_id']);    
        $this->db->update("actividad_hijo",$data);    
        }
        }catch(exception $e){
            
        }
    }
    function search($idpadre){
        try{
        $this->db->where("actHij_padreid",$idpadre);
        $actividad = $this->db->get("actividad_hijo");
        return $actividad->result();  
        }catch(exception $e){
            
        }
    }
    function actividadxPlan($plan){
        try{
        $this->db->where("pla_id",$plan);
        $avance = $this->db->get("actividad_hijo");
        return $avance->result();
        }catch(exception $e){
            
        }
    }
    function consultaxActividad($id){
        try{
        $this->db->where("actHij_padreid",$id);
        $avance = $this->db->get("actividad_hijo");
        return $avance->result();
        }catch(exception $e){
            
        }
    }
    function consultaXid($id){
        try{
            $this->db->where("actHij_id",$id);
            $avance = $this->db->get("actividad_hijo");
            return $avance->result();
        }catch(exception $e){
            
        }
    }

}

?>