<?php

class Tipo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $tipo = $this->db->get("tipo");
            return $tipo->result();
        } catch (exception $e) {
            
        }
    }

    function detailxid($id) {
        try {
            $this->db->where("tip_id", $id);
            $tipo = $this->db->get("tipo");
            return $tipo->result();
        } catch (exception $e) {
            
        }
    }
    function avanceciclophva(){
        try{
            $this->db->select("sum(tarea.tar_costopresupuestado) as tar_costopresupuestado");
            $this->db->select("sum(avance_tarea.avaTar_costo) as costo");
            $this->db->select("avg(avance_tarea.avaTar_progreso) as progreso");
            $this->db->select("tipo.tip_tipo as tip_tipo");
            $this->db->select("count(tarea.tar_id) as numerotareas");
            $this->db->join("tarea","tarea.tip_id =  tipo.tip_id","LEFT");
            $this->db->join("avance_tarea","avance_tarea.tar_id = tarea.tar_id","LEFT");
            $this->db->group_by("tip_tipo");
            $tipo = $this->db->get("tipo");
//            echo $this->db->last_query();die;
            return $tipo->result();
        }  catch (exception $e){
            
        }
    }

}

?>