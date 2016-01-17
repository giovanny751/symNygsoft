<?php

class Riesgoclasificaciontipo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($categoria, $tipo) {
        try {
            $this->db->set("rieCla_id", $categoria);
            $this->db->set("rieClaTip_tipo	", $tipo);
            $this->db->insert("riesgo_clasificacion_tipo");
        } catch (exception $e) {
            
        }
    }

    function exist($categoria, $tipo) {
        try {
            $this->db->where("riesgo_clasificacion_tipo.rieCla_id", $categoria);
            $this->db->where("riesgo_clasificacion_tipo.rieClaTip_tipo", $tipo);
            $data = $this->db->get("riesgo_clasificacion_tipo");
            return $data->result();
        } catch (exception $e) {
            
        }
    }

    function tipoxcategoria($categoria) {
        try {
            $this->db->select("riesgo_clasificacion_tipo.*,riesgo_clasificacion.rieCla_categoria");
            $this->db->where_in("riesgo_clasificacion_tipo.rieCla_id", $categoria);
            $this->db->join('riesgo_clasificacion','riesgo_clasificacion.rieCla_id=riesgo_clasificacion_tipo.rieCla_id');
            $data = $this->db->get("riesgo_clasificacion_tipo");
            return $data->result();
        } catch (exception $e) {
            
        }
    }
    function modificarClasificacionTipo($categoria,$idtipo,$tipo){
        $this->db->where("rieClaTip_id",$idtipo);
        $this->db->where("rieCla_id",$categoria);
        $this->db->set("rieClaTip_tipo",$tipo);
        $this->db->update('riesgo_clasificacion_tipo');
    }
    function consultaClasificacionTipo(){
        try {
            $data = $this->db->get("riesgo_clasificacion_tipo");
            return $data->result();
        } catch (exception $e) {
            
        }
    }
}

?>
