<?php

class Copasstagendacomite_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function keepCommitteeMeetings($data){
        $this->db->insert_batch("copasst_agenda_comite",$data);
    }
}