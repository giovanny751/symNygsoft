<?php

class Vehiculortm_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save($post) {
        $this->db->set("vehrtm_entidad", $post['entidadExpideRtm']);
        $this->db->set("vehrtm_fechaInicio", $post['fechaInicioRtm']);
        $this->db->set("vehrtm_fechaFin", $post['fechaFinRTM']);
        $this->db->set("veh_id", $post['veh_id']);
        $this->db->insert("vehiculo_rtm");
    }

}
