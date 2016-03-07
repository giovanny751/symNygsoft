<?php
class Rolnotificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardarNotificacion($info) {
        $this->db->insert_batch("rol_notificacion",$info);
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

