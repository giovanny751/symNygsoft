<?php

class Numero_empleados_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
        $this->db->insert_batch("numero_empleados", $data);
        } catch (exception $e) {
            
        }
    }

    function update($data) {
        try {
        $this->db->update("numero_empleados", $data);
        } catch (exception $e) {
            
        }
    }

    function detail() {
        try {
        $cargo = $this->db->get("numero_empleados");
        return $cargo->result();
        } catch (exception $e) {
            
        }
    }

    function delete($id) {
        try {
        $this->db->where("numEmp_id", $id);
        $this->db->delete("numero_empleados");
        } catch (exception $e) {
            
        }
    }

}

?>