<?php

class Dimension_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
            $this->db->trans_begin();
            $this->db->insert("dimension", $data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        }finally{
            return $this->db->trans_status();
        }
    }

    function update($data) {
        try {
            $this->db->trans_begin();
            $this->db->update("dimension", $data);
//            echo $this->db->trans_status();die;
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        }
    }

    function detail() {
        try {
            $this->db->select("dim_id");
            $this->db->select("dim_codigo");
            $this->db->select("dim_descripcion");
            $this->db->select("est_id");
            $this->db->select("(select count(dim1_id) from riesgo where dimension.dim_id = riesgo.dim1_id) as cantidadRiesgo",false);
            $this->db->where("est_id", 1);
            $cargo = $this->db->get("dimension");
            return $cargo->result();
        } catch (exception $e) {
            
        }
    }

    function consultxname($name) {
        try {
            $this->db->where("dim_descripcion", $name);
            $this->db->where("est_id", 1);
            $cargo = $this->db->get("dimension");
            return $cargo->result();
        } catch (exception $e) {
            
        }
    }

    function delete($id) {
        try {
            $this->db->trans_begin();
            $this->db->where("dim_id", $id);
            $this->db->set("est_id", 3);
            $this->db->update("dimension");
            if($this->db->trans_status() === FALSE )
                $this->db->trans_rollback();
            else
                $this->db->trans_commit();
        } catch (exception $e) {
            
        }finally{
            return $this->db->trans_status();
        }
    }

    function consultadimensionxid($dimid) {
        try {
            $this->db->where("dim_id", $dimid);
            $this->db->where("est_id", 1);
            $dim = $this->db->get("dimension");
            return $dim->result();
        } catch (exception $e) {
            
        }
    }

    function guardarmodificaciondimension($descripcion, $id) {
        try {
            $this->db->trans_begin();
            $this->db->where("dim_id", $id);
            $this->db->set("dim_descripcion", $descripcion);
            $this->db->update("dimension");
            if ($this->db->trans_status() === FALSE) 
                $this->db->trans_rollback();
             else 
                $this->db->trans_commit();
        } catch (exception $e) {
            
        } finally {
            return $this->db->trans_status();
        }
    }

    function dimensionunoriesgo($dimriesgo) {
        try {
            $this->db->where("dimension.dim_id", $dimriesgo);
            $this->db->select("riesgo.rie_descripcion");
            $this->db->select("riesgo.rie_id");
            $this->db->distinct("riesgo.rie_descripcion");
            $this->db->join("riesgo", "riesgo.dim1_id = dimension.dim_id");
            $cargo = $this->db->get("dimension");
            return $cargo->result();
        } catch (exception $e) {
            
        }
    }

}

?>