<?php

class Prevencioncontrol_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function guardarControl($control){
        $this->db->insert("prevencion_control",$control);
    }
    function filtroMatrizPrevencion($info){
        
        if(!empty($info['fechaDesde']))$this->db->where("pre_fechaInicio >= ",$info['fechaDesde']);
        if(!empty($info['fechaHasta']))$this->db->where("pre_fechaFin <=",$info['fechaHasta']);
        
        $this->db->select("prevencion.pre_id");
        $this->db->select("prevencion.pre_nombre");
        $this->db->select("prevencion.pre_fechaInicio");
        $this->db->select("prevencion.pre_fechaFin");
        $this->db->select("empleado.Emp_nombre");
        $this->db->select("empleado.Emp_Apellidos");
        $this->db->select("cargo.car_nombre");
        $this->db->join("cargo","cargo.car_id = prevencion.car_id");
        $this->db->join("empleado","prevencion.emp_id = empleado.emp_id");
        $prevencion = $this->db->get("prevencion");
        
        return $prevencion->result();
    }
    function consultaPrevencionxId($pre_id){
        $this->db->where("pre_id",$pre_id);
        $prevencion = $this->db->get("prevencion");
        return $prevencion->result();
    }
}