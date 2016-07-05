<?php

class Vehiculopropietario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function save($post){
        $this->db->set("veh_id", $post['veh_id']);
        $this->db->set("vehPro_pertenece", $post['perteneceCompania']);
        $this->db->set("tipIde_id", $post['tipoIdentificacion']);
        $this->db->set("vehPro_documento", $post['NoDocumento']);
        $this->db->set("vehPro_direccion", $post['direccionPropietario']);
        $this->db->set("vehPro_telefono", $post['telefonoPropietario']);
        $this->db->set("vehPro_correo", $post['correoPropietario']);
        $this->db->set("vehPro_comparendo", $post['tieneComparendosActualmente']);
        $this->db->insert("vehiculo_propietario");
    }
    function saveEdit($post){
        $this->db->where("veh_id",$post["veh_id"]);
        $this->db->set("vehPro_pertenece", $post['perteneceCompania']);
        $this->db->set("tipIde_id", $post['tipoIdentificacion']);
        $this->db->set("vehPro_documento", $post['NoDocumento']);
        $this->db->set("vehPro_direccion", $post['direccionPropietario']);
        $this->db->set("vehPro_telefono", $post['telefonoPropietario']);
        $this->db->set("vehPro_correo", $post['correoPropietario']);
        $this->db->set("vehPro_comparendo", $post['tieneComparendosActualmente']);
        $this->db->update("vehiculo_propietario");
    }
    function consultaPropietarioVehiculo($veh_id){
        $this->db->where("veh_id",$veh_id);
        $vehPropietario = $this->db->get("vehiculo_propietario");
        return $vehPropietario->row();
    }
    
}