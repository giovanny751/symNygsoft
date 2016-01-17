<?php

class Cargo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
            $this->db->trans_begin();
            $this->db->insert("cargo", $data);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        } finally {
            return $this->db->trans_status();
        }
    }

    function update($nombre, $jefe, $porcentaje, $id) {
        try {
            $this->db->trans_begin();
            $this->db->where("car_id", $id);
            $this->db->set("car_nombre", $nombre);
            $this->db->set("car_jefe", $jefe);
            $this->db->set("car_porcentajearl", $porcentaje);
            $this->db->update("cargo");
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        } finally {
            return $this->db->trans_status();
        }
    }

    function detail() {
        try {
            $this->db->select("cargo.car_id");
            $this->db->select("cargo.car_nombre");
            $this->db->select("c.car_nombre as jefe");
            $this->db->select("c.car_id as idjefe");
            $this->db->select("cargo.car_porcentajearl");
            $this->db->select("(select count(rieCar_id) from riesgo_cargo where riesgo_cargo.car_id = cargo.car_id) as cantidadRiesgos");
            $this->db->where("cargo.est_id ", 1);
            $this->db->join("cargo as c", "cargo.car_jefe = c.car_id", "left");
            $cargo = $this->db->get("cargo");
            return $cargo->result();
        } catch (exception $e) {
            
        }
    }

    function allcargos() {
        try {
            $this->db->where("est_id", 1);
            $cargo = $this->db->get("cargo");
            return $cargo->result();
        } catch (exception $e) {
            
        }
    }

    function delete($id) {
        try {
            $this->db->trans_begin();
            $this->db->where("car_id", $id);
            $this->db->set("est_id", "3");
            $this->db->update("cargo");
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        } finally {
            return $this->db->trans_status();
        }
    }

    function consultahijos($id) {
        try {
            $this->db->where("c.car_id", $id);
            $this->db->join("cargo as c", "cargo.car_jefe = c.car_id", "left");
            $this->db->where("cargo.est_id", 1);
            $cantidad = $this->db->count_all_results("cargo");
            return $cantidad;
        } catch (exception $e) {
            
        }
    }

    function consultacargoxid($car_id) {
        try {
            $this->db->select("cargo.car_id");
            $this->db->select("cargo.car_nombre");
            $this->db->select("c.car_nombre as jefe");
            $this->db->select("cargo.car_porcentajearl");
            $this->db->select("c.car_id as idjefe");
            $this->db->where("cargo.est_id ", 1);
            $this->db->join("cargo as c", "cargo.car_jefe = c.car_id", "left");
            $this->db->where("cargo.car_id", $car_id);
            $cargo = $this->db->get("cargo");
            return $cargo->result();
        } catch (exception $e) {
            
        }
    }

    function consultaorganigrama($id = null) {
        try {
            $this->db->select("cargo.car_id");
            $this->db->select("cargo.car_nombre");
            $this->db->select("c.car_nombre as jefe");
            $this->db->select("cargo.car_porcentajearl");
            $this->db->select("c.car_id as idjefe");
            $this->db->where("cargo.est_id ", 1);
            $this->db->join("cargo as c", "cargo.car_jefe = c.car_id", "left");
            if (empty($id))
                $this->db->where("c.car_id IS NULL");
            if (!empty($id))
                $this->db->where("c.car_id", $id);
            $cargo = $this->db->get("cargo");
            return $cargo->result_array();
        } catch (exception $e) {
            
        }
    }

    function cargoriesgo() {
        try {
            $this->db->select("riesgo.rie_descripcion");
            $this->db->distinct("riesgo.rie_descripcion");
            $this->db->join("riesgo_cargo", "riesgo_cargo.car_id = cargo.car_id");
            $this->db->join("riesgo", "riesgo.rie_id = riesgo_cargo.rie_id");
            $cargo = $this->db->get("cargo");
            return $cargo->result();
        } catch (exception $e) {
            
        }
    }

    function existe($cargo, $cargojefe) {
        try {
            $this->db->where("car_nombre", $cargo);
            $this->db->where("car_jefe", $cargojefe);
            $cargo = $this->db->get("cargo");
            return $cargo->result();
        } catch (exception $e) {
            
        }
    }

}

?>