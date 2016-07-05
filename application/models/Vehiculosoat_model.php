<?php

class Vehiculosoat_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function save($post){
        $this->db->set("vehSoa_entidad",$post['fechaExpideSoat']);
        $this->db->set("vehSoa_numero",$post['numeroSoat']);
        $this->db->set("vehSoa_fechaInicio",$post['fechaInicioSoat']);
        $this->db->set("vehSoa_fechaFin",$post['fechaFinSoat']);
        $this->db->set("veh_id",$post['veh_id']);
        $this->db->insert("vehiculo_soat");
    }
}