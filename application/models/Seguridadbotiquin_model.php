<?php

class Seguridadbotiquin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function grupos(){
        $this->db->order_by("seguridad_grupo.segGru_id");
        $this->db->join("seguridad_grupo_elemento","seguridad_grupo_elemento.segGru_id = seguridad_grupo.segGru_id");
        $seguridad = $this->db->get("seguridad_grupo");
        return $seguridad->result();
    }

}

?>