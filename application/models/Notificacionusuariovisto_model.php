<?php
class Notificacionusuariovisto_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail($user,$rol_id) {
        try {
            $this->db->select("user.usu_id");
            $this->db->select("user.usu_nombre");
            $this->db->select("user.usu_apellido");
            $this->db->select("notificacion.not_notificacion");
            $this->db->select("notificacion_usuario_visto.est_id");
            
            $this->db->where("rol_notificacion.rol_id",$rol_id);
            
            
            $this->db->join("rol_notificacion","rol_notificacion.not_id = notificacion.not_id");
            $this->db->join("permisos","permisos.rol_id = rol_notificacion.rol_id");
            $this->db->join("user","user.usu_id = permisos.usu_id and user.usu_id = $user");
            $this->db->join("notificacion_usuario","notificacion.not_id = notificacion_usuario.not_id");
            $this->db->join("notificacion_usuario_visto","notificacion_usuario_visto.notUsu_id = notificacion_usuario.notUsu_id and notificacion_usuario_visto.est_id != 7","left");
            $notificacion = $this->db->get("notificacion");
            
            return $notificacion->result();
        } catch (exception $e) {
            
        }
    }
    
    function insertaVistoNotificacionUsuario($usu_id,$rol_id,$notUsuId){
        $this->db->set("est_id",7);
        $this->db->set("notUsuVis_fecha",date("Y-m-d H:i:s"));
        $this->db->set("usu_id",$usu_id);
        $this->db->set("rol_id",$rol_id);
        $this->db->set("notUsu_id",$notUsuId);
        $this->db->insert("notificacion_usuario_visto");
    }
    
}
