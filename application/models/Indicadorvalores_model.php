<?php

class Indicadorvalores_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardarvalores($data,$id) {
        try {
            if (!empty($id)){
                $this->db->where("indVal_id", $id);    
                $this->db->update("indicador_valores", $data);    
            }else
            $this->db->insert("indicador_valores", $data);
        } catch (exception $e) {
            
        }
    }

    function consultaIndicadorxId($id) {
        try {
            $this->db->where("ind_id", $id);
            $this->db->order_by("indVal_fecha");
            $this->db->join("user","user.usu_id = indicador_valores.usu_id");
            $valor = $this->db->get("indicador_valores");
            return $valor->result();
        } catch (exception $e) {
            
        }
    }

}

?>