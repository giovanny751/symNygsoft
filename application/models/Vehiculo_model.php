<?php

class Vehiculo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function consultaVehiculoXId($veh_id){
        $this->db->where("veh_id",$veh_id);
        $this->db->select("vehiculo.*");
        $this->db->select("IFNULL((select vehKil_kilometros from vehiculo_kilometro where vehiculo_kilometro.veh_id = vehiculo.veh_id order by creatorDate desc limit 1),0) as kilometraje",false,false);
        $vehiculo = $this->db->get("vehiculo");
        return $vehiculo->row();
    }
    
    function save($post){
        $this->db->set("dim_id",(!empty($post['dimension1']))?$post['dimension1']:null);
        $this->db->set("dim_id2",(!empty($post['dimension2']))?$post['dimension2']:null);
        $this->db->set("tipVeh_id",$post['tipoVehiculo']);
        $this->db->set("tipSer_id",$post['tipoServicio']);
        $this->db->set("pai_id",$post['pais']);
        $this->db->set("dep_id",$post['departamento']);
        $this->db->set("ciu_id",$post['ciudad']);
        $this->db->set("veh_placa",$post['placa']);
        $this->db->set("veh_marca",$post['marca']);
        $this->db->set("veh_color",$post['color']);
        $this->db->set("veh_numPuertas",$post['noPuertas']);
        $this->db->set("veh_linea",$post['linea']);
        $this->db->set("veh_toneladas",$post['toneladaCarga']);
        $this->db->set("veh_numMotor",$post['noMotor']);
        $this->db->set("veh_numSerie",$post['noSerie']);
//        $this->db->set("veh_numChasis",$post['noChasis']);
        $this->db->set("veh_numVin",$post['noVin']);
        $this->db->set("veh_cilindraje",$post['cilindraje']);
        $this->db->set("tipCar_id",$post['tipoCarroceria']);
        $this->db->set("veh_realizoMantenimiento",$post['centroRealizaMantenimiento']);
        $this->db->set("veh_observacion",$post['observaciones']);
        $this->db->insert("vehiculo");
        return $this->db->insert_id();
    }
    function saveEdit($post){
        $this->db->where("veh_id",$post['idVehiculo']);
        $this->db->set("dim_id",(!empty($post['dimension1']))?$post['dimension1']:null);
        $this->db->set("dim_id2",(!empty($post['dimension2']))?$post['dimension2']:null);
        $this->db->set("tipVeh_id",$post['tipoVehiculo']);
        $this->db->set("tipSer_id",$post['tipoServicio']);
        $this->db->set("pai_id",$post['pais']);
        $this->db->set("dep_id",$post['departamento']);
        $this->db->set("ciu_id",$post['ciudad']);
        $this->db->set("veh_placa",$post['placa']);
        $this->db->set("veh_marca",$post['marca']);
        $this->db->set("veh_color",$post['color']);
        $this->db->set("veh_numPuertas",$post['noPuertas']);
        $this->db->set("veh_linea",$post['linea']);
        $this->db->set("veh_toneladas",$post['toneladaCarga']);
        $this->db->set("veh_numMotor",$post['noMotor']);
        $this->db->set("veh_numSerie",$post['noSerie']);
        $this->db->set("veh_numChasis",$post['noChasis']);
        $this->db->set("veh_numVin",$post['noVin']);
        $this->db->set("veh_cilindraje",$post['cilindraje']);
//        $this->db->set("tipCar_id",$post['tipoCarroceria']);
        $this->db->set("veh_realizoMantenimiento",$post['centroRealizaMantenimiento']);
        $this->db->set("veh_observacion",$post['observaciones']);
        $this->db->update("vehiculo");
    }
    function consultaDetalle($post){
        $this->db->select("vehiculo.veh_id");
        $this->db->select("vehiculo.veh_placa");
        $this->db->select("vehiculo.veh_marca");
        $this->db->select("vehiculo.veh_numMotor");
        $this->db->select("vehiculo.veh_numChasis");
        $this->db->select("vehiculo.veh_numSerie");
        $this->db->select("dimension.dim_descripcion as dim1");
        $this->db->select("dimension2.dim_descripcion as dim2");
        $this->db->where("vehiculo.est_id",1);
        $this->db->join("dimension","dimension.dim_id = vehiculo.dim_id","left");
        $this->db->join("dimension2","dimension2.dim_id = vehiculo.dim_id2","left");
        $this->db->join("tipo_carroceria","tipo_carroceria.tipCar_id = vehiculo.tipCar_id","left");
        $this->db->join("tipo_servicio","tipo_servicio.tipSer_id = vehiculo.tipSer_id","left");
        $this->db->join("tipo_vehiculo","tipo_vehiculo.tipVeh_id = vehiculo.tipVeh_id");
        $vehiculo = $this->db->get("vehiculo");
        return $vehiculo->result();
    }
    function eliminarVehiculo($veh_id){
        $this->db->where("veh_id",$veh_id);
        $this->db->set("est_id",3);
        $this->db->update('vehiculo');
    }
}