<?php

class Vehiculokilometro_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function detail($veh_id = null){
        if(!empty($veh_id))$this->db->where("veh_id",$veh_id);
        $this->db->where("est_id",1);
        $this->db->order_by("creatorDate","asc");
        $vehiculo = $this->db->get("vehiculo_kilometro");
        return $vehiculo->result();
    }
    function ultimoKilometro($veh_id){
        $this->db->order_by("creatorDate","desc");
        $this->db->where("veh_id",$veh_id);
        $this->db->where("est_id",1);
        $this->db->order_by("creatorDate","asc");
        $vehiculo = $this->db->get("vehiculo_kilometro",1);
        return $vehiculo->row();
    }
    function save($kilometro,$vehiculo){
        $this->db->set("vehKil_kilometros",$kilometro);
        $this->db->set("veh_id",$vehiculo);
        $this->db->set("creatorUser",$this->data['usu_id']);
        $this->db->set("creatorDate",date("Y-m-d H:i:s"));
        $this->db->insert("vehiculo_kilometro");
    }
    function delete($vehKilId){
        
        $this->db->where("vehKil_id",$vehKilId);
        $this->db->set("est_id",3);
        $this->db->update("vehiculo_kilometro");
    }
}