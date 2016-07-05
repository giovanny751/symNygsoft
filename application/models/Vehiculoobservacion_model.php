<?php

class Vehiculoobservacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function save($post){
        $this->db->set("vehObs_observacion",$post['observacion']);
        $this->db->set("vehObs_precio",$post['precio']);
        $this->db->set("est_id",$post['estado']);
        $this->db->set("veh_id",$post['vehiculo']);
        $this->db->insert("vehiculo_observacion");
    }
    function detail($veh_id){
        $this->db->where("veh_id",$veh_id);
        $this->db->where("vehiculo_observacion.est_id",8);
        $this->db->or_where("vehiculo_observacion.est_id",9);
        $this->db->or_where("vehiculo_observacion.est_id",10);
        $this->db->join("estados","estados.est_id = vehiculo_observacion.est_id");
        $vehiculo = $this->db->get("vehiculo_observacion");
        return $vehiculo->result();
    }
    function delete($observacionId){
        $this->db->where("vehObs_id",$observacionId);
        $this->db->set("est_id",3);
        $this->db->update("vehiculo_observacion");
    }
}