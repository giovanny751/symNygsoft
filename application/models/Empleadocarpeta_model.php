<?php

class Empleadocarpeta_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($carpeta,$descripcion,$empleado) {
        try {
        $data = array(
            "empCar_nombre"=>$carpeta,
            "empCar_descripcion"=>$descripcion,
            "emp_id"=>$empleado
        );
        $this->db->insert("empleado_carpeta",$data);
        } catch (exception $e) {
            
        }
    }
    function detail($id){
        try {
        $this->db->where("emp_id",$id);
        $this->db->order_by("empCar_id",'asc');
        $carpeta = $this->db->get("empleado_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
        
    }
    function search($nombre,$descripcion,$empleado){
        try {
        $this->db->where("empCar_nombre",$nombre);
        $this->db->where("empCar_descripcion",$descripcion);
        $this->db->where("emp_id",$empleado);
        $this->db->order_by("empCar_id",'asc');
        $carpeta = $this->db->get("empleado_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function cargarcarpeta($car_id){
        try {
        $this->db->where("empCar_id",$car_id);
        $this->db->order_by("empCar_id",'asc');
        $carpeta = $this->db->get("empleado_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function actualizacarpeta($nombre,$descripcion,$empCar_id){
        try {
        $this->db->where("empCar_id",$empCar_id);
        $this->db->set("empCar_nombre",$nombre);        
        $this->db->set("empCar_descripcion",$descripcion);  
        $this->db->update("empleado_carpeta");
        } catch (exception $e) {
            
        }
    }
    function eliminarcarpeta($empCar_id){
        try {
            $this->db->where("empCar_id",$empCar_id);
            $this->db->delete("empleado_carpeta");
        } catch (exception $e) {
            
        }
    }
}

?>