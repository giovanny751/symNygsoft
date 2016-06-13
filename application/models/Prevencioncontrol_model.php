<?php

class Prevencioncontrol_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardarControl($control) {
        $this->db->insert("prevencion_control", $control);
    }

    function filtroMatrizPrevencion($info) {

        if (!empty($info['tipAcc_id']))
            $this->db->where("prevencion.tipAcc_id", $info['tipAcc_id']);
        if (!empty($info['lugar']))
            $this->db->like("pre_lugar", $info['lugar']);
        if (!empty($info['cargo'])) {
            $this->db->where("(1",1,false);
            $this->db->or_like("car_nombre", $info['cargo']);
            $this->db->or_like("pre_cargo_externo", $info['cargo']);
            $this->db->where("1","1)",false);
        }
        if (!empty($info['responsable'])) {
            $this->db->where("(1",1,false);
            $this->db->or_like("pre_empleado_externo", $info['responsable']);
            $this->db->or_like("empleado.Emp_nombre", $info['responsable']);
            $this->db->or_like("empleado.Emp_Apellidos", $info['responsable']);
            $this->db->where("1","1)",false);
        }

        $this->db->select("prevencion.pre_id");
        $this->db->select("prevencion.pre_nombre");
        $this->db->select("prevencion.pre_fechaInicio");
        $this->db->select("prevencion.pre_fechaFin");
        $this->db->select("empleado.Emp_nombre");
        $this->db->select("empleado.Emp_Apellidos");
        $this->db->select("cargo.car_nombre");
        $this->db->select("pre_empleado_externo");
        $this->db->select("tipAcc_nombre,pre_lugar");
        $this->db->select("pre_cargo_externo");
        $this->db->select("if(pertenece=1,'SI','NO') pertenece", false);
        $this->db->join("cargo", "cargo.car_id = prevencion.car_id", 'left');
        $this->db->join("empleado", "prevencion.emp_id = empleado.emp_id", 'left');
        $this->db->join("tipoAccion", "tipoAccion.tipAcc_id=prevencion.tipAcc_id", 'left');
        $this->db->set('est_id', '1');
        $prevencion = $this->db->get("prevencion");

        return $prevencion->result();
    }

    function consultaPrevencionxId($pre_id) {
        $this->db->where("pre_id", $pre_id);
        $prevencion = $this->db->get("prevencion");
        return $prevencion->result();
    }
    function fuenteOrigen($pre_id) {
        $this->db->where("pre_id", $pre_id);
        $prevencion = $this->db->get("prevencion_fuenteOrigen");
        return $prevencion->result();
    }
    function causas($pre_id) {
        $this->db->where("pre_id", $pre_id);
        $prevencion = $this->db->get("prevencion_causa");
        return $prevencion->result();
    }
    function prevencion_plan_accion($pre_id) {
        $this->db->where("pre_id", $pre_id);
        $prevencion = $this->db->get("prevencion_plan_accion");
        return $prevencion->result();
    }
    function detalle_causa($id) {
        $this->db->where("preCauDet_id", $id);
        $prevencion = $this->db->get("prevencion_causa_detalle");
        return $prevencion->result();
    }

}
