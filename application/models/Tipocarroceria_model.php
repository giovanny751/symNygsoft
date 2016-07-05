<?php

class Tipocarroceria_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        
        $tipoCarroceria = $this->db->get("tipo_carroceria");
        return $tipoCarroceria->result();
    }

}

?>