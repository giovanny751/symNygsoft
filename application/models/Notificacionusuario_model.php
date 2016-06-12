<?php
class Notificacionusuario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->order_by("notUsu_fecha");
            $this->db->join("notificacion","notificacion.not_id = notificacion_usuario.not_id");
            $notificacion = $this->db->get("notificacion_usuario");
            return $notificacion->result();
        } catch (exception $e) {
            
        }
    }
    
    function guardaNotificacionUsuario($notId,$user){
        $this->db->set("not_id",$notId);
        $this->db->set("creatorUser",$user);
        $this->db->set("creatorDate",date("Y-m-d H:i:s"));
        $this->db->insert("notificacion_usuario");
    }
    
}
