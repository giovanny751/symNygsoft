<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user($username, $pass) {
        try {
            $this->db->where('usu_usuario', $username);
            $this->db->where('usu_contrasena', $pass);
            $query = $this->db->get('user');
            return $query->result_array();
        } catch (exception $e) {
            
        }
    }

    public function listo_politica($username, $pass) {
        try {
            $this->db->set('usu_politicas', '1');
            $this->db->where('usu_usuario', $username);
            $this->db->where('usu_contrasena', $pass);
            $this->db->update('user');
        } catch (exception $e) {
            
        }
    }

    public function validacionusuario($iduser) {
        try {
            $this->db->where('usu_id', $iduser);
            $query = $this->db->get('user');
            return $query->result();
        } catch (exception $e) {
            
        }
    }

    function admin_inicio() {
        try {
            $this->db->where('ini_id', 1);
            $dato = $this->db->get('inicio');
            return $dato->result();
        } catch (exception $e) {
            
        }
    }

    function reset($mail) {
        try {
            $datos = rand(10000000, 81555555);
            $this->db->set('usu_contrasena', sha1($datos));
            $this->db->where('usu_email', $mail);
            $this->db->update('user');
            return $datos;
        } catch (exception $e) {
            
        }
    }

    function actualizar($mail) {
        try {
            $this->db->set('usu_cambiocontrasena', 1);
            $this->db->where('usu_email', $mail);
            $this->db->get('user');
            return $datos;
        } catch (exception $e) {
            
        }
    }

    function create($data) {
        try {
            $this->db->insert('user', $data);
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function filteruser($apellido = null, $cedula = null, $estado = null, $nombre = null) {
        try {
            if (!empty($apellido))
                $this->db->where('usu_apellido', $apellido);
            if (!empty($cedula))
                $this->db->where('usu_cedula', $cedula);
            if (!empty($estado))
                $this->db->where('est_id', $estado);
            if (!empty($nombre))
                $this->db->where('usu_nombre', $nombre);

            $this->db->select("user.*");
            $this->db->select("ingreso.ing_fechaIngreso");
            $this->db->where("user.est_id != ", 3);
            $this->db->join("ingreso", "ingreso.usu_id = user.usu_id and ingreso.ing_fechaIngreso = (select max(ing_fechaIngreso) from ingreso )", "LEFT");
            $user = $this->db->get('user');
            return $user->result();
        } catch (exception $e) {
            
        }
    }
    function filteruser_evaluacion($apellido = null, $cedula = null, $estado = null, $nombre = null) {
        try {
            if (!empty($apellido))
                $this->db->where('usu_apellido', $apellido);
            if (!empty($cedula))
                $this->db->where('usu_cedula', $cedula);
            if (!empty($estado))
                $this->db->where('est_id', $estado);
            if (!empty($nombre))
                $this->db->where('usu_nombre', $nombre);

            $this->db->select('user.*,GROUP_CONCAT(evaluacion.eva_nombre SEPARATOR ",") conca',false);
            $this->db->select("ingreso.ing_fechaIngreso",false);
            $this->db->where("user.est_id != ", 3);
            $this->db->where("roles.rol_id", 60);
            $this->db->join("ingreso", "ingreso.usu_id = user.usu_id and ingreso.ing_fechaIngreso = (select max(ing_fechaIngreso) from ingreso )", "LEFT");
            $this->db->join("user_evaluacion", "user_evaluacion.use_id=user.usu_id and user_evaluacion.useEva_activo='S'",'left',false);
            $this->db->join("evaluacion", "evaluacion.eva_id=user_evaluacion.eva_id",'left');
            $this->db->join("roles", "roles.rol_id=user.rol_id");
            $this->db->group_by("user.usu_id");
            $user = $this->db->get('user');
//            echo $this->db->last_query();
            return $user->result();
        } catch (exception $e) {
            
        }
    }

    function consultageneral() {
        try {
            $this->db->select("user.usu_id as id,user.*,ingreso.Ing_fechaIngreso as ingreso");
            $this->db->where("user.est_id != ", 3);
            $this->db->join("ingreso", "ingreso.usu_id = user.usu_id and ingreso.ing_fechaIngreso = (select max(ing_fechaIngreso) from ingreso ) ", "LEFT");
            $user = $this->db->get('user');
            return $user->result();
        } catch (exception $e) {
            
        }
    }
    function consultageneral_evaluacion() {
        try {
            $this->db->select("user.usu_id as id,user.*,ingreso.Ing_fechaIngreso as ingreso");
            $this->db->where("user.est_id != ", 3);
            $this->db->join("ingreso", "ingreso.usu_id = user.usu_id and ingreso.ing_fechaIngreso = (select max(ing_fechaIngreso) from ingreso ) ", "LEFT");
            $user = $this->db->get('user');
            return $user->result();
        } catch (exception $e) {
            
        }
    }
    function evaluacion_usuario($id) {
        try {
            
            $datos=$this->db->query('select eva_id from respuesta_evaluacion where usu_id='.$id.' group by eva_id');
            $datos=$datos->result();
            foreach ($datos as $value) {
                $d[]=$value->eva_id;
            }
            
            $this->db->select("evaluacion.*");
            $this->db->where("ue.use_id", $id);
            $this->db->where("ue.useEva_activo", 'S');
            $this->db->where_not_in("evaluacion.eva_id", $d);
            $this->db->join("user_evaluacion ue ", "ue.eva_id=evaluacion.eva_id", "inner",false);
            $user = $this->db->get('evaluacion');
            return $user->result();
        } catch (exception $e) {
            
        }
    }

    function consultausuarioxid($id) {
        try {
            $this->db->where("usu_id", $id);
            $this->db->where("user.est_id != ", 3);
            $user = $this->db->get("user");
            return $user->result();
        } catch (exception $e) {
            
        }
    }

    function update($data, $id) {
        try {
            $this->db->where("usu_id", $id);
            $this->db->update("user", $data);
        } catch (exception $e) {
            
        }
    }

    function consultausuarioxcedula($cedula) {
        try {
            $this->db->where("usu_cedula", $cedula);
            $this->db->where("user.est_id != ", 3);
            $user = $this->db->get("user");
            return $user->result();
        } catch (exception $e) {
            
        }
    }

    function rolxdefecto($rol, $usu_id) {
        try {
            $this->db->where("usu_id", $usu_id);
            $this->db->set("rol_id", $rol);
            $this->db->update("user");
            echo $this->db->last_query();die;
        } catch (exception $e) {
            
        }
    }

    function consultausuariosflechas($idUsuarioCreado, $metodo) {
        try {
            switch ($metodo) {
                case "flechaIzquierdaDoble":
                    $this->db->where("usu_id = (select min(usu_id) from user)");
                    break;
                case "flechaIzquierda":
                    $this->db->where("usu_id < '" . $idUsuarioCreado . "' ");
                    $this->db->order_by("usu_id desc");
                    break;
                case "flechaDerecha":
                    $this->db->where("usu_id > '" . $idUsuarioCreado . "' ");
                    $this->db->order_by("usu_id asc");
                    break;
                case "flechaDerechaDoble":
                    $this->db->where("usu_id = (select max(usu_id) from user)");
                    break;
                default :
                    die;
                    break;
            }
            $this->db->select("user.*");
            $this->db->select("concat(empleado.emp_nombre,' ',empleado.emp_apellidos) as nombre", false);
            $this->db->where("user.est_id != ", 3);
            $this->db->join("empleado", "empleado.emp_id = user.emp_id", "left");
            $usuario = $this->db->get("user", 1);
            return $usuario->result();
        } catch (exception $e) {
            
        }
    }

    function eliminarusuario($id) {
        try {
            $this->db->trans_begin();
            $this->db->where("usu_id", $id);
            $this->db->set("est_id", "3");
            $this->db->update("user");
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        }finally{
            return $this->db->trans_status();
        }
    }

    function buscar_rol_usuario($post) {
        try {
            $this->db->select('count(usu_id) as usu_id ');
            $this->db->where('rol_id', $post['id']);
            $datos = $this->db->get('user');
            $datos = $datos->result();
            return $datos[0]->usu_id;
        } catch (exception $e) {
            
        }
    }

}
