<?php

class Tipoidentificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail(){
        $this->db->where("est_id",1);
        $ti = $this->db->get("tipo_identificacion");
        return $ti->result();
    }

}

?>