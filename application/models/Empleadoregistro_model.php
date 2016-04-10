<?php

class Empleadoregistro_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->where("empleado_carpeta.est_id",1);
            $this->db->select("empleado_carpeta.empCar_id");
            $this->db->select("empleado_carpeta.empCar_nombre");
            $this->db->select("empleado_carpeta.empCar_descripcion");
            $this->db->select("CONCAT(empleado.Emp_Nombre,' ',empleado.Emp_Apellidos) as nombreempleado ", false);
            $this->db->select("empleado_registro.empReg_archivo");
            $this->db->select("empleado_registro.empReg_descripcion");
            $this->db->select("empleado_registro.empReg_version");
            $this->db->select("empleado_registro.empReg_id");
            $this->db->select("empleado_registro.empReg_tamano");
            $this->db->select("empleado_registro.empgReg_fecha");
            $this->db->join("empleado_registro", "empleado_carpeta.empCar_id = empleado_registro.empReg_carpeta", "LEFT");
            $this->db->join("empleado", "empleado.emp_id = empleado_registro.emp_id", "LEFT");
            $this->db->where("empleado_registro.est_id", 1);
            $data = $this->db->get("empleado_carpeta");
            return $data->result();
        } catch (exception $e) {
            
        }
    }
    function detailxIdEmpleado($emp_id) {
        try {
        $this->db->select("empleado_carpeta.empCar_id");
        $this->db->select("empleado_carpeta.empCar_nombre");
        $this->db->select("empleado_carpeta.empCar_descripcion");
        $this->db->select("CONCAT(empleado.Emp_Nombre,' ',empleado.Emp_Apellidos) as nombreempleado ", false);
        $this->db->select("empleado_registro.empReg_archivo");
        $this->db->select("empleado_registro.empReg_descripcion");
        $this->db->select("empleado_registro.empReg_version");
        $this->db->select("empleado_registro.empReg_id");
        $this->db->select("empleado_registro.empReg_tamano");
        $this->db->select("empleado_registro.empgReg_fecha");
        $this->db->where("empleado_carpeta.emp_id",$emp_id);
        $this->db->join("empleado_registro", "empleado_carpeta.empCar_id = empleado_registro.empReg_carpeta", "LEFT");
        $this->db->join("empleado", "empleado.emp_id = empleado_registro.emp_id", "LEFT");
        $this->db->where("empleado_carpeta.est_id",1);
        $this->db->where("empleado_registro.est_id", 1);
        $data = $this->db->get("empleado_carpeta");
        return $data->result();
        } catch (exception $e) {
            
        }
    }

    function empleado_registroactualizar($post, $empReg_id) {
        try {
        $this->db->where("empReg_id", $empReg_id);
        $this->db->update('empleado_registro', $post);
        return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function empleado_registro($post) {
        try {
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
        $this->db->insert('empleado_registro', $post);
        return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function detallexcarpeta($id) {
        try {
        $this->db->select("empleado_registro.*");
        $this->db->select("CONCAT(empleado.Emp_Nombre,' ',empleado.Emp_Apellidos) as nombre", false);
        $this->db->where("empReg_carpeta", $id);
        $this->db->join("empleado", "empleado.emp_id = empleado_registro.emp_id ");
        $this->db->where("est_id", 1);
        $data = $this->db->get("empleado_registro");
        return $data->result();
        } catch (exception $e) {
            
        }
    }

    function eliminarregistroempleado($id) {
        try {
        $this->db->where("empReg_id", $id);
        $this->db->set("est_id", 3);
        $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
        $this->db->delete("empleado_registro");
        } catch (exception $e) {
            
        }
    }

    function searchxid($id) {
        try {
        $this->db->where("empReg_id", $id);
        $this->db->where("empleado_registro.est_id", 1);
        $data = $this->db->get("empleado_registro");
        return $data->result();
        } catch (exception $e) {
            
        }
    }

}

?>