<?php

class Notificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $notificacion = $this->db->get("notificacion");
            return $notificacion->result();
        } catch (exception $e) {
            
        }
    }

}

?>