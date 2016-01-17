<?php

class Indicadortipo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
            $this->db->insert_batch("indicador_tipo", $data);
        } catch (exception $e) {
            
        }
    }

    function update($data) {
        try {
            $this->db->update("indicador_tipo", $data);
        } catch (exception $e) {
            
        }
    }

    function detail() {
        try {
            $tipoind = $this->db->get("indicador_tipo");
            return $tipoind->result();
        } catch (exception $e) {
            
        }
    }

    function consultxname($name) {
        try {
            $this->db->where("indTip_tipo", $name);
            $tipoIndicador = $this->db->get("indicador_tipo");
            return $tipoIndicador->result();
        } catch (exception $e) {
            
        }
    }

    function delete($id) {
        try {
            $this->db->where("indTip_id", $id);
            $this->db->delete("indicador_tipo");
        } catch (exception $e) {
            
        }
    }

    function consultadimensionxid($indTip_id) {
        try {
            $this->db->where("indTip_id", $indTip_id);
            $dim = $this->db->get("indicador_tipo");
            return $dim->result();
        } catch (exception $e) {
            
        }
    }

    function guardarmodificaciondimension($Tipo, $id) {
        try {
            $this->db->where("indTip_id", $id);
            $this->db->set("indTip_tipo", $Tipo);
            $this->db->update("indicador_tipo");
        } catch (exception $e) {
            
        }
    }

    function tipoIndicadorxId($id) {
        try {
            $this->db->where("indTip_id", $id);
            $tipoIndicador = $this->db->get("indicador_tipo");
            return $tipoIndicador->result();
        } catch (exception $e) {
            
        }
    }
    function delete_indicador_valores($id) {
        try {
            $this->db->where("indVal_id", $id);
            $this->db->delete("indicador_valores");
        } catch (exception $e) {
            
        }
    }
    function modificar_indicador_valores($id) {
        try {
            $this->db->where("indVal_id", $id);
            $datos=$this->db->get("indicador_valores");
            return $datos->result();
        } catch (exception $e) {
            
        }
    }
    

}

?>