<?php

class Prevencioncontrol_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function guardarControl($control){
        $this->db->insert("prevencion_control",$control);
    }
    function filtroMatrizPrevencion($fechaInicial,$fechaFinal){
        if(!empty($fechaInicial))$this->db->where("pre_fechaInicio >= ",$fechaInicial);
        if(!empty($fechaFinal))$this->db->where("pre_fechaFin <=",$fechaFinal);
        $prevencion = $this->db->get("prevencion");
        return $prevencion->result();
    }
}