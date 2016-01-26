<?php

class Empresa_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
            $this->db->insert_batch("empresa", $data);
            $this->db->select('*');
            $datos = $this->db->get('empresa');
            $datos = $datos->result();
            return $datos;
        } catch (exception $e) {
            
        }
    }

    function detail() {
        try {
            $this->db->select("emp_id");
            $this->db->select("emp_razonSocial");
            $this->db->select("emp_nit");
            $this->db->select("emp_direccion");
            $this->db->select("ciu_id");
            $this->db->select("tam_id");
            $this->db->select("numEmp_id");
            $this->db->select("actEco_id");
            $this->db->select("Dim_id");
            $this->db->select("Dimdos_id");
            $this->db->select("emp_representante");
            $this->db->select("emp_logo");
            $this->db->select("emp_arl");
            $this->db->select("secEco_id");
            $this->db->select("(select distinct count(*) from "
                    . "empleado "
                    . "join empleado_contratos on empleado_contratos.emp_id = empleado.Emp_id "
                    . "where est_id = 1 and empleado_contratos.empCon_fechaHasta > '".date('Y-m-d')."' ) as numEmpleados");
            $empresa = $this->db->get("empresa");
                        
            return $empresa->result();
        } catch (exception $e) {
            
        }
    }

    function update($data) {
        try {
            $this->db->update("empresa", $data);
            $this->db->select('*');
            $datos = $this->db->get('empresa');
            $datos = $datos->result();
            return $datos;
        } catch (exception $e) {
            
        }
    }

}

?>