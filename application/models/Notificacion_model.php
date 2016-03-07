<?php

class Notificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("not_notificacion");
            $notificacion = $this->db->get("notificacion");
            return $notificacion->result();
        } catch (exception $e) {
            
        }
    }

}

?>