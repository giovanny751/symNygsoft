<?php

class Agendamientocomite_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function detail(){
        $agenda = $this->db->get("agenda_comite");
        return $agenda->result();
    }
}