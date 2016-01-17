<?php

class Ingreso_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function menu($padre = null, $idusuario, $tipo) {
        try {
            $idpadre = ($padre != "prueba") ? $padre : 0;
            $this->db->where('menu_idpadre', $idpadre);
            $this->db->where('menu_estado', 1);
            $this->db->where('user.usu_id', $idusuario);
            $this->db->select('modulo.menu_id,modulo.menu_idpadre,modulo.menu_nombrepadre,modulo.menu_idhijo,'
                    . 'modulo.menu_controlador,modulo.menu_accion,modulo.menu_estado,permisos_rol.menu_id menudos,modulo.mod_icons');
            $this->db->join("permisos", "user.rol_id = permisos.rol_id and user.usu_id = permisos.usu_id");
            $this->db->join('permisos_rol', ' permisos_rol.rol_id = permisos.rol_id');
            $this->db->join("modulo", "modulo.menu_id = permisos_rol.menu_id");
            $dato = $this->db->get('user');
            $envio = $dato->result_array();
            return $envio;
        } catch (exception $e) {
            
        }
    }

    function sectorEconomico() {
        $data = $this->db->get("sector_economico");
        return $data->result();
    }

    function guardarPermisosMetodo($data) {

        $this->db->insert_batch("permisos_metodo", $data);
    }

    function eliminarPermisoMetodo($modulo) {
        $this->db->where("mod_id", $modulo);
        $this->db->delete("permisos_metodo");
    }

    function cargarPermisoMetodo($mod) {
        try {
            $this->db->select("perMet_clase as clase");
            $this->db->select("perMet_metodo as metodo");
            $this->db->select("tipCru_id as crud");
            $this->db->where("mod_id", $mod);
            $resultado = $this->db->get("permisos_metodo");
            return $resultado->result();
        } catch (Exception $e) {
            
        }
    }

    function permisoroles($padre = null) {
        try {
            $idusuario = 1;
            if ($padre != "prueba")
                $this->db->where('menu_idpadre', $padre);
            else
                $this->db->where('menu_idpadre', 0);
            $dato = $this->db->get('modulo');
            $envio = $dato->result_array();
            return $envio;
        } catch (exception $e) {
            
        }
    }

    function consultamenu($idgeneral) {
        try {
            $this->db->where('menu_id', $idgeneral);
            $datos = $this->db->get('modulo');
            return $datos->result_array();
        } catch (exception $e) {
            
        }
    }

    function cargamenu($padre) {
        try {
            if (empty($padre))
                $this->db->where('menu_idpadre', '0');
            else
                $this->db->where('menu_idpadre', $padre);
            $dato = $this->db->get('modulo');
            $envio = $dato->result_array();
            return $envio;
        } catch (exception $e) {
            
        }
    }

    function consultahijos($idgeneral = 0) {
        try {
            if (!empty($idgeneral))
                $this->db->where('menu_idpadre', $idgeneral);
            else
                $this->db->where('menu_idpadre', '0');
            $dato = $this->db->get('modulo');
            return $dato->result_array();
        } catch (exception $e) {
            
        }
    }

    function hijos($hijo) {
        try {
            $this->db->where('menu_idpadre', $hijo);
            $dato = $this->db->get('modulo');
            $envio = $dato->result_array();
            return $envio;
        } catch (exception $e) {
            
        }
    }

    function guardarmodulo($modulo, $padre = null, $general) {
        try {
            $data = array('menu_nombrepadre' => $modulo,
                'menu_idpadre' => $general
            );
            $this->db->insert('modulo', $data);
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function actualizarIcono($nuevoIcono, $idgeneral) {
        try {
            $this->db->where("menu_id", $idgeneral);
            $this->db->set("mod_icons", $nuevoIcono);
            $this->db->update("modulo");
        } catch (exception $e) {
            
        }
    }

    function actualizahijos($padre) {
        try {
            $data = array('menu_idhijo' => $padre);
            $this->db->where('menu_id', $padre);
            $this->db->update('modulo', $data);
        } catch (exception $e) {
            
        }
    }

    function guardarusuario($usuario, $email, $contrasena, $celular) {
        try {
            $data = array('username' => $usuario,
                'password' => sha1($contrasena),
                'email' => $email,
                'phone' => $celular,
                'active' => 1
            );
            $this->db->insert('users', $data);
        } catch (exception $e) {
            
        }
    }

    function eliminar($eliminar) {
        try {
            $this->db->trans_begin();
            $this->db->where('menu_id', $eliminar);
            $this->db->delete('modulo');
            
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                throw new Exception("Error al eliminar en la base de datos");
            }
            else{
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            return $e->getMessage();
        } finally {
            return $this->db->trans_status();
        }
    }

    function usuarios() {
        try {
            $usuarios = $this->db->get('user');
            return $usuarios->result_array();
        } catch (exception $e) {
            
        }
    }

    function menutotal() {
        try {
            $dato = $this->db->get('modulo');
            $envio = $dato->result_array();
            return $envio;
        } catch (exception $e) {
            
        }
    }

    function permisosmodulo($datos) {
        try {
            $this->db->insert_batch('usermodule', $datos);
        } catch (exception $e) {
            
        }
    }

    function eliminarpermisos($user) {
        try {
            $this->db->where('user_id', $user);
            $this->db->delete('usermodule');
        } catch (exception $e) {
            
        }
    }

    function guardaatributos($idgeneral, $controlador, $accion, $estado, $nombre) {
        try {
            if (!empty($controlador))
                $this->db->set('menu_controlador', $controlador);
            if (!empty($accion))
                $this->db->set('menu_accion', $accion);
            if (!empty($estado))
                $this->db->set('menu_estado', $estado);
            if (!empty($nombre))
                $this->db->set('menu_nombrepadre', $nombre);
            $this->db->where('menu_id', $idgeneral);
            $this->db->update('modulo');
        } catch (exception $e) {
            
        }
    }

    function totalusuarios() {
        try {
            $usuarios = $this->db->get('user');
            return $usuarios->result_array();
        } catch (exception $e) {
            
        }
    }

    function consultausuario($id) {
        try {
            $this->db->where('usu_id', $id);
            $usuarios = $this->db->get('user');
            return $usuarios->result_array();
        } catch (exception $e) {
            
        }
    }

    function guardaratributosmenu($nombre, $controlador, $accion, $estado, $id) {
        try {
            $this->db->set('menu_nombrepadre', $nombre);
            $this->db->set('menu_controlador', $controlador);
            $this->db->set('menu_accion', $accion);
            $this->db->set('menu_estado', $estado);
            $this->db->where('menu_id', $id);
            $this->db->update('modulo');
        } catch (exception $e) {
            
        }
    }

    function eliminarpermisosmenu($usuarioid) {
        try {
            $this->db->where('usu_id', $usuarioid);
            $this->db->delete('permisos');
        } catch (exception $e) {
            
        }
    }

    function permisosusuariomenu($data) {
        try {
            $this->db->trans_begin();
            $this->db->insert_batch('permisos', $data);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        } finally {
            return $this->db->trans_status();
        }
    }

    function eliminarpermisosusuario($id) {
        try {
            $this->db->trans_begin();
            $this->db->where("usu_id", $id);
            $this->db->delete("permisos");
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        } finally {
            return $this->db->trans_status();
        }
    }

    function actualizausuariorol($id) {
        try {
            $this->db->where("usu_id", $id);
            $this->db->set("rol_id", "");
            $this->db->update("user");
        } catch (exception $e) {
            
        }
    }

    function eliminarpermisosrol($idrol, $usu_id) {
        try {
            $this->db->where("rol_id", $idrol);
            $this->db->where("usu_id", $usu_id);
            $this->db->delete('permisos');
        } catch (exception $e) {
            
        }
    }

    function rolesasignados($id) {
        try {
            $this->db->select('permisos_rol.menu_id,perRol_crear,perRol_modificar,perRol_eliminar');
            $this->db->where('rol_id', $id);
            $rol = $this->db->get('permisos_rol');
            return $rol->result_array();
        } catch (exception $e) {
            
        }
    }

    function eliminapermisosusuario($rol, $usuario) {
        try {
            $this->db->where('rol_id', $rol);
            $this->db->where('usu_id', $usuario);
            $this->db->delete('permisos');
        } catch (exception $e) {
            
        }
    }

    function guardarcontrasena($contrasena, $id) {
        try {
            $this->db->where('usu_id', $id);
            $this->db->set('usu_contrasena', $contrasena);
            $this->db->set('usu_cambiocontrasena', 0);
            $this->db->update('user');
        } catch (exception $e) {
            
        }
    }

    function admin_inicio() {
        try {
            $dato = $this->db->get('inicio');
            return $dato->result();
        } catch (exception $e) {
            
        }
    }

    function insertingreso($data) {
        try {
            $this->db->insert_batch("ingreso", $data);
        } catch (exception $e) {
            
        }
    }

    function consultapermisosmenu($usu_id, $controller, $method, $rol_id) {
        try {
            $this->db->select("modulo.menu_controlador clase");
            $this->db->select("modulo.menu_accion metodo");
            $this->db->select("permisos.usu_id");
            $this->db->where("modulo.menu_controlador", $controller);
            $this->db->where("modulo.menu_accion", $method);
            $this->db->where("roles.rol_id", $rol_id);
            $this->db->join("permisos_rol", "permisos_rol.menu_id = modulo.menu_id ", "left");
            $this->db->join("roles", "roles.rol_id = permisos_rol.rol_id", "left");
            $this->db->join("permisos", "permisos.rol_id = roles.rol_id and usu_id = $usu_id");
            $query = $this->db->get("modulo");
//            echo $this->db->last_query();die;
            return $query->result_array();
        } catch (exception $e) {
            
        }
    }

    function consultaPermisosAccion($usu_id, $controller, $method) {


        $this->db->select("permisos_metodo.perMet_clase clase");
        $this->db->select("permisos_metodo.perMet_metodo metodo");
        $this->db->select("permisos_metodo.tipCru_id accion");
        $this->db->select("permisos_rol.*");
        $this->db->select("permisos.usu_id");
        $this->db->where("permisos_metodo.perMet_clase", $controller);
        $this->db->where("permisos_metodo.perMet_metodo", $method);
        $this->db->join("permisos_rol", "permisos_rol.menu_id = modulo.menu_id ", "left");
        $this->db->join("roles", "roles.rol_id = permisos_rol.rol_id", "left");
        $this->db->join("permisos", "permisos.rol_id = roles.rol_id and usu_id = $usu_id");
        $this->db->join("permisos_metodo", "permisos_metodo.mod_id = modulo.menu_id", "LEFT");
        $query = $this->db->get("modulo");
//        echo $this->db->last_query();die;
        return $query->result_array();
    }

    function eliminarusuario($usu_id) {
        try {
            $this->db->where("usu_id", $usu_id);
            $this->db->delete("user");
        } catch (exception $e) {
            
        }
    }

    function ciudades() {
        try {
            $data = $this->db->get("ciudad");
            return $data->result();
        } catch (exception $e) {
            
        }
    }

}
