<?php

class Avancenotificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($notificar) {
        try{
        $this->db->insert_batch("avance_notificacion", $notificar);
        return $this->db->insert_id();
        }catch(exception $e){
            
        }
    }

}

?>