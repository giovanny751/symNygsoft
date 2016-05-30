<?php

class Tipoidentificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail(){
        $this->db->where("est_id",1);
        $this->db->select("tipIde_id");
        $this->db->select("tipIde_tipo");
        $this->db->select("est_id");
        $ti = $this->db->get("tipo_identificacion");
        return $ti->result();
    }

}

?>