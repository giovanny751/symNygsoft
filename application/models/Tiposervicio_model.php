<?php

class Tiposervicio_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function detail(){
        $ti = $this->db->get("tipo_servicio");
        return $ti->result();
    }
}
