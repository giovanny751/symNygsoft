<?php

class Actividadeconomica_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function detail() {
        try{
        $this->db->select("*",false);
        $actividad = $this->db->get("actividad_economica");
        return $actividad->result();
        }catch(exception $e){
            
        }
    }
    function create($data){
        try{
        $this->db->insert_batch("actividad_hijo",$data);
        }catch(exception $e){
            
        }
    }


}

?>