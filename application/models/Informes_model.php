<?php

class Informes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function horasExtras($empleado,$fechaDesde,$fechaHasta){
        $this->db->order_by('empHorExt_fecha');
        if(!empty($empleado))$this->db->where("empleado.emp_id ",$empleado);
        if(!empty($fechaDesde))$this->db->where("empleado_horas_extra.empHorExt_fecha >=",$fechaDesde);
        if(!empty($fechaHasta))$this->db->where("empleado_horas_extra.empHorExt_fecha <=",$fechaHasta);
        $this->db->select("empleado.Emp_Nombre");
        $this->db->select("empleado.Emp_Apellidos");
        $this->db->select("empleado_horas_extra.empHorExt_horas");
        $this->db->select("empleado_horas_extra.empHorExt_fecha");
        $this->db->select("hora_extra_tipo.horExtTip_tipo");
        $this->db->join("hora_extra_tipo","hora_extra_tipo.horExtTip_id = empleado_horas_extra.horExtTip_id");
        $this->db->join("empleado","empleado.Emp_Id = empleado_horas_extra.emp_id");
        $horas = $this->db->get("empleado_horas_extra");
        return $horas->result();
    }
    
}
