<?php

class Prevencioncontrol_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function guardarControl($control){
        $this->db->insert("prevencion_control",$control);
    }
}