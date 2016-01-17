<?php

class Roles_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function cantidadroles($id) {
        try {
            $this->db->select('roles.rol_id,rol_nombre');
            $this->db->distinct('roles.rol_id,rol_nombre');
            $this->db->where('permisos.usu_id', $id);
            $this->db->join('permisos', 'permisos.rol_id = roles.rol_id');
            $roles = $this->db->get('roles');
            return $roles->result_array();
        } catch (exception $e) {
            
        }
    }

    function roles() {
        try {
            $consulta = $this->db->get('roles');
            return $consulta->result_array();
        } catch (exception $e) {
            
        }
    }

    function rolesall() {
        try {
            $this->db->select("rol_id");
            $this->db->select("rol_nombre");
            $this->db->select("rol_fechaModificacion");
            $this->db->select("rol_fechaCreacion");
            $consulta = $this->db->get('roles');
            return $consulta->result();
        } catch (exception $e) {
            
        }
    }

    function guardarrol($nombre) {
        try {
            $this->db->set('rol_nombre', $nombre);
            $this->db->set('rol_fechaCreacion', date("Y-m-d"));
            $this->db->insert('roles');
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function modificarrol($id) {
        try {
            $this->db->where("rol_id", $id);
            $this->db->set("rol_fechaModificacion", date('Y-m-d H:i:s'));
            $this->db->update('roles');
        } catch (exception $e) {
            
        }
    }

    function insertapermisos($insert) {
        try {
            $this->db->insert_batch('permisos_rol', $insert);
        } catch (exception $e) {
            
        }
    }

    function eliminarrol($id) {
        try {
            $this->db->where('rol_id', $id);
            $this->db->delete('roles');
        } catch (exception $e) {
            
        }
    }

    function eliminpermisosrol($idrol) {
        try {
            $this->db->where('rol_id', $idrol);
            $this->db->delete('permisos_rol');
        } catch (exception $e) {
            
        }
    }

    function rolxusuario($usu_id) {
        try {
            $this->db->where("rol_estado", 1);
            $this->db->where("permisos.usu_id", $usu_id);
            $this->db->join("permisos", "permisos.rol_id = roles.rol_id");
            $rol = $this->db->get("roles");
            return $rol->result();
        } catch (exception $e) {
            
        }
    }

    function totalroles($usu_id) {
        try {
            $this->db->where("permisos.usu_id", $usu_id);
            $rol = $this->db->get("permisos");
            return $rol->result();
        } catch (exception $e) {
            
        }
    }

    function permisosusuario($iduser, $idrol) {
        try {
            $data = array(
                "usu_id" => $iduser,
                "rol_id" => $idrol
            );
            $this->db->insert("permisos", $data);
        } catch (exception $e) {
            
        }
    }

}
