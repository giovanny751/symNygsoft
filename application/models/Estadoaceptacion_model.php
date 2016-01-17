<?php

class Estadoaceptacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function search($estado) {
        try {
            $this->db->where("estAce_estado", $estado);
            $aceptacion = $this->db->get("estado_aceptacion");
            return $aceptacion->result();
        } catch (exception $e) {
            
        }
    }
    function consult($id) {
        try {
            $this->db->where("estAce_id", $id);
            $aceptacion = $this->db->get("estado_aceptacion");
            return $aceptacion->result();
        } catch (exception $e) {
            
        }
    }

    function insert($estado) {
        try {
            $this->db->set("estAce_estado", $estado);
            $this->db->insert("estado_aceptacion");
        } catch (exception $e) {
            
        }
    }
    function update($estado,$id) {
        try {
            $this->db->set("estAce_estado", $estado);
            $this->db->where("estAce_id",$id);
            $this->db->update("estado_aceptacion");
        } catch (exception $e) {
            
        }
    }
    function delete($id,$estado) {
        //Confirmamos si es el id que deseamos eliminar con el estado
        try {
            $this->db->where("estado_aceptacion.estAce_estado", $estado);
            $this->db->where("estado_aceptacion.estAce_id",$id);
            $this->db->delete("estado_aceptacion");
            
            //Eliminar Hijos
            $this->db->where("estado_aceptacion_color.estAce_id",$id);
            $this->db->delete("estado_aceptacion_color");
            
        } catch (exception $e) {
            
        }
    }

    function detail() {
        try {
            $aceptacion = $this->db->get("estado_aceptacion");
            return $aceptacion->result();
        } catch (exception $e) {
            
        }
    }

    function detailandcolor() {
        try {
            $this->db->select("estado_aceptacion.estAce_id");
            $this->db->select("estado_aceptacion.estAce_estado");
            $this->db->select("estado_aceptacion_color.estAceCol_id");
            $this->db->select("riesgo_color.rieCol_color");
            $this->db->join("estado_aceptacion_color", "estado_aceptacion_color.estAce_id = estado_aceptacion.estAce_id", "LEFT");
            $this->db->join("riesgo_color", "riesgo_color.rieCol_id = estado_aceptacion_color.rieCol_id", "LEFT");
            $this->db->order_by("estado_aceptacion.estAce_id","asc");
            $this->db->order_by("estado_aceptacion_color.estAceCol_id","asc");
            $aceptacion = $this->db->get("estado_aceptacion");
            return $aceptacion->result();
        } catch (exception $e) {
            
        }
    }

    function consultxname($name) {
        try {
            $this->db->where("estAce_estado", $name);
            $data = $this->db->get("estado_aceptacion");
            return $data->result();
        } catch (exception $e) {
            
        }
    }
    function consultxnamexid($name,$id) {
        try {
            $this->db->where("estAce_estado", $name);
            $this->db->where("estAce_id !=", $id);
            $data = $this->db->get("estado_aceptacion");
            return $data->result();
        } catch (exception $e) {
            
        }
    }

}

?>