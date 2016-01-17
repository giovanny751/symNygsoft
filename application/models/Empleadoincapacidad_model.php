<?php

class Empleadoincapacidad_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function detailxid($idEmpleado) {
        try {
//            $this->db->select("empleado_incapacidad.empInc_id as incapacidad", false);
            $this->db->select("empleado_incapacidad.empInc_id as incapacidad");
            $this->db->select("empleado_responsable.empRes_descripcion as responsable");
            $this->db->select("empleado_incapacidad.empInc_fechaInicio as fechaInicio");
            $this->db->select("empleado_incapacidad.empInc_fechaFinal as fechaFinal");
            $this->db->select("timestampdiff(DAY, (empleado_incapacidad.empInc_fechaInicio),(empleado_incapacidad.empInc_fechaFinal)) as dias");
            $this->db->select("empleado_incapacidad.empInc_motivo as motivo");
            $this->db->select("empleado_incapacidad.empInc_observacion as observacion");
            $this->db->select("user.usu_usuario as usuario");
            $this->db->join("empleado","empleado.Emp_Id = empleado_incapacidad.emp_id");
            $this->db->join("empleado_responsable","empleado_responsable.empRes_id = empleado_incapacidad.empRes_id");
            $this->db->join("user","user.usu_id = empleado_incapacidad.usu_id");
            $this->db->where("empleado_incapacidad.emp_id","$idEmpleado");
            $this->db->order_by("empInc_id","asc");
            $detalle = $this->db->get("empleado_incapacidad");
            return $detalle->result();
        } catch (exception $e) {
            
        }
    }
    function create($data) {
        try {
            $this->db->insert("empleado_incapacidad", $data);
        } catch (exception $e) {
            
        }
    }
}

?>