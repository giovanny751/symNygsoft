<?php

class Accidentesriesgoclasificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data){
        try{
            $id = false;
            $this->db->trans_begin();
            $this->db->insert("accidentes_riesgo_clasificacion",$data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $id = $this->db->insert_id();
                $this->db->trans_commit();
            }
        }  catch (Exception $e){
            $id = false;
        } finally {
            return $id;
        }
    }

}

?>