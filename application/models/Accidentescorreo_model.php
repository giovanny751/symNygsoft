<?php

class Accidentescorreo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data){
        try{
            $this->db->trans_begin();
            $this->db->insert_batch("accidentes_correo",$data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
        }  catch (Exception $e){
            
        } finally {
            return $this->db->trans_status();
        }
    }
    function insert($data){
        try{
            $this->db->trans_begin();
            $this->db->where("acc_id",$id);
            $this->db->delete("accidentes_correo");
            $this->db->insert_batch("accidentes_correo",$data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
        }  catch (Exception $e){
            
        } finally {
            return $this->db->trans_status();
        }
    }

}

?>