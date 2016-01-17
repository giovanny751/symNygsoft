<?php

class Tamano_empresa_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
            $this->db->insert_batch("tamano_empresa", $data);
        } catch (exception $e) {
            
        }
    }

    function update($data) {
        try {
            $this->db->update("tamano_empresa", $data);
        } catch (exception $e) {
            
        }
    }

    function detail() {
        try {
            $cargo = $this->db->get("tamano_empresa");
            return $cargo->result();
        } catch (exception $e) {
            
        }
    }

    function delete($id) {
        try {
            $this->db->where("tamEmp_tamano", $id);
            $this->db->delete("tamano_empresa");
        } catch (exception $e) {
            
        }
    }

}

?>