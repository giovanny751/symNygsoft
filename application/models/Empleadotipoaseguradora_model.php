<?php

class Empleadotipoaseguradora_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
            $this->db->insert_batch("empleado_tipo_aseguradora", $data);
        } catch (exception $e) {
            
        }
    }

    function consult_empleado($idEmpleado) {
        try {
            $this->db->select("eta.*");
            $this->db->select("ta.tipAse_nombre");
            $this->db->select("eta.ase_id");
            $this->db->join("tipo_aseguradora as ta", "ta.tipAse_id = eta.tipAse_id");
            $this->db->where("eta.emp_id = '" . $idEmpleado . "'");
            $resultado = $this->db->get("empleado_tipo_aseguradora as eta");
            return $resultado->result();
        } catch (exception $e) {
            
        }
    }

    function actualizatipo($idEmpleado, $datosActualizar) {
        try {
            $this->db->where("emp_id = '" . $idEmpleado . "'");
            $this->db->delete("empleado_tipo_aseguradora");
            $this->db->insert_batch("empleado_tipo_aseguradora", $datosActualizar);
        } catch (exception $e) {
            
        }
    }

}

?>