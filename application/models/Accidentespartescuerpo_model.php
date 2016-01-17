<?php

class Accidentespartescuerpo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data){
        try{
            $this->db->trans_begin();
            $this->db->insert_batch("accidentes_partes_cuerpo",$data);
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