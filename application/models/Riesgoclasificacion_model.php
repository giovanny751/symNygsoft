<?php

class Riesgoclasificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("rieCla_categoria","asc");
            $datos = $this->db->get("riesgo_clasificacion");
            return $datos->result();
        } catch (exception $e) {
            
        }
    }

    function detailandtipo() {
        try {
            $this->db->select("riesgo_clasificacion_tipo.rieClaTip_id");
            $this->db->select("riesgo_clasificacion.rieCla_id");
            $this->db->select("riesgo_clasificacion.rieCla_categoria");
            $this->db->select("riesgo_clasificacion_tipo.rieClaTip_tipo");
            $this->db->join("riesgo_clasificacion_tipo", "riesgo_clasificacion_tipo.rieCla_id = riesgo_clasificacion.rieCla_id", "LEFT");
            $datos = $this->db->get("riesgo_clasificacion");
//            echo $this->db->last_query();die;
            return $datos->result();
        } catch (exception $e) {
            
        }
    }
    
    function detailandtipo_categoria($categoria_id) {
        try {
            $this->db->select("riesgo_clasificacion_tipo.rieClaTip_id as clasificacion_id");
            $this->db->select("riesgo_clasificacion_tipo.rieClaTip_tipo as tipo");
            $this->db->select("riesgo_clasificacion.rieCla_categoria as categoria");
            $this->db->select("riesgo_clasificacion.rieCla_id as clasificacion");
            $this->db->join("riesgo_clasificacion_tipo", "riesgo_clasificacion_tipo.rieCla_id = riesgo_clasificacion.rieCla_id", "LEFT");
            $this->db->where("riesgo_clasificacion.rieCla_id",$categoria_id);
            $datos = $this->db->get("riesgo_clasificacion");
//            echo $this->db->last_query();die;
            return $datos->result();
        } catch (exception $e) {
            
        }
    }
    function detailandtipo_categoria_batch($categoria_id) {
        try {
            $this->db->select("riesgo_clasificacion_tipo.rieClaTip_id as clasificacion_id");
            $this->db->select("riesgo_clasificacion_tipo.rieClaTip_tipo as tipo");
            $this->db->select("riesgo_clasificacion.rieCla_categoria as categoria");
            $this->db->select("riesgo_clasificacion.rieCla_id as clasificacion");
            $this->db->join("riesgo_clasificacion_tipo", "riesgo_clasificacion_tipo.rieCla_id = riesgo_clasificacion.rieCla_id", "LEFT");
            $this->db->where_in("riesgo_clasificacion.rieCla_id",$categoria_id);
            $this->db->order_by("riesgo_clasificacion.rieCla_categoria","asc");
            $this->db->order_by("riesgo_clasificacion_tipo.rieClaTip_tipo","asc");
            $datos = $this->db->get("riesgo_clasificacion");
//            echo $this->db->last_query();
            return $datos->result();
        } catch (exception $e) {
            
        }
    }

    function detailxcategoria($categoria) {
        try {
            $this->db->where("rieCla_categoria", $categoria);
            $datos = $this->db->get("riesgo_clasificacion");
            return $datos->result();
        } catch (exception $e) {
            
        }
    }

    function create($categoria, $rieCla_id = null) {
        try {
            if ($rieCla_id == null) {
                $this->db->set("rieCla_categoria", $categoria);
                $this->db->insert("riesgo_clasificacion");
            } else {
                $this->db->set("rieCla_categoria", $categoria);
                $this->db->where("rieCla_id", $rieCla_id);
                $this->db->update("riesgo_clasificacion");
            }
        } catch (exception $e) {
            
        }
    }

    function eliminar($id) {
        try {
            $this->db->where("rieClaTip_id", $id);
            $this->db->delete("riesgo_clasificacion_tipo");
        } catch (exception $e) {
            
        }
    }

    function eliminarCategoria($rieCat_id) {
        try {
            $this->db->where("rieCla_id", $rieCat_id);
            $this->db->delete("riesgo_clasificacion");
//            echo $this->db->last_query();die;
        } catch (exception $e) {
            
        }
    }
    
    function elementosXFactores(){
        $this->db->select("riesgo_clasificacion.rieCla_id");
        $this->db->select("riesgo_clasificacion.rieCla_categoria");
        $this->db->select("riesgo_clasificacion_tipo.rieClaTip_tipo");
        $this->db->select("riesgo_clasificacion_tipo.rieClaTip_id");
        $this->db->select("riesgo_clasificacion_elemento.rieClaEle_id");
        $this->db->select("riesgo_clasificacion_elemento.rieClaEle_elemento");
        $this->db->join("riesgo_clasificacion_tipo","riesgo_clasificacion_tipo.rieCla_id = riesgo_clasificacion.rieCla_id");
        $this->db->join("riesgo_clasificacion_elemento","riesgo_clasificacion_elemento.rieClaTip_id = riesgo_clasificacion_tipo.rieClaTip_id");
        $factores = $this->db->get("riesgo_clasificacion");
//        echo $this->db->last_query();die;
        return $factores->result();
    }

}

?>
