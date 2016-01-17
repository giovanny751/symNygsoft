<?php

class Estadoaceptacioncolor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function consult($id) {
        try {
            $this->db->select("estado_aceptacion_color.rieCol_id");
            $this->db->select("riesgo_color.rieCol_color");
            $this->db->join("riesgo_color", "riesgo_color.rieCol_id = estado_aceptacion_color.rieCol_id", "LEFT");
            $this->db->where("estAceCol_id", $id);
            $aceptacion = $this->db->get("estado_aceptacion_color");
            return $aceptacion->result();
        } catch (exception $e) {
            
        }
    }
    function update($idColor,$idEstado) {
        try {
            $this->db->set("estado_aceptacion_color.rieCol_id", $idColor);
            $this->db->where("estado_aceptacion_color.estAceCol_id",$idEstado);
            $this->db->update("estado_aceptacion_color");
        } catch (exception $e) {
            
        }
    }
    function delete($idColor,$idEstado) {
        //Confirmamos si es el id que deseamos eliminar con el estado
        try {
            $this->db->where("estAce_id", $idEstado);
            $this->db->where("estAceCol_id",$idColor);
            $this->db->delete("estado_aceptacion_color");
        } catch (exception $e) {
            
        }
    }
    function exist($estado, $color) {
        try {
            $this->db->where("estAce_id", $estado);
            $this->db->where("rieCol_id", $color);
            $color = $this->db->get("estado_aceptacion_color");
            return $color->result();
        } catch (exception $e) {
            
        }
    }
    function create($estado, $color) {
        try {
            $this->db->set("estAce_id", $estado);
            $this->db->set("rieCol_id", $color);
            $this->db->insert("estado_aceptacion_color");
        } catch (exception $e) {
            
        }
    }
    function colorxestado($estado) {
        try {
            $this->db->select("estado_aceptacion_color.estAceCol_id"); 
            $this->db->select("riesgo_color.rieCol_color"); 
            $this->db->join("riesgo_color","riesgo_color.rieCol_id = estado_aceptacion_color.rieCol_id","left");
            $this->db->where("estAce_id", $estado);
            $this->db->order_by("estado_aceptacion_color.rieCol_id","asc");
            $color = $this->db->get("estado_aceptacion_color");
            return $color->result();
        } catch (exception $e) {
            
        }
    }
    
    /*
    function detail() {
        try {
            $this->db->order_by("col_color");
            $color = $this->db->get("color");
            return $color->result();
        } catch (exception $e) {
            
        }
    }
    */
}

?>