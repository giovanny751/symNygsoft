<?php

class Cargofuncion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function create($data){
        $this->db->insert_batch("cargo_funcion",$data);
    }
    function consultaXIdCargo($car_id){
        $this->db->where("car_id",$car_id);
        $funcion = $this->db->get("cargo_funcion");
        return $funcion->result();
    }
    function eliminarFuncionesXIdCargo($car_id){
        $this->db->where("car_id",$car_id);
        $this->db->delete("cargo_funcion");
    }
}