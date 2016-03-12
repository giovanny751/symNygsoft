<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user($username, $pass) {
        try {
            $this->db->where('usu_usuario', $username);
            $this->db->where('usu_contrasena', $pass);
            $this->db->where('est_id',1);
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

    function filteruser($apellido = null, $cedula = null, $estado = null, $nombre = null,$tipoUsuario = null) {
        try {
            if (!empty($apellido))
                $this->db->like('usu_apellido', $apellido);
            if (!empty($cedula))
                $this->db->like('usu_cedula', $cedula);
            if (!empty($estado))
                $this->db->where('est_id', $estado);
            if (!empty($nombre))
                $this->db->like('usu_nombre', $nombre);
            if (!empty($tipoUsuario))
                $this->db->where('tipUsuEva_id', $tipoUsuario);

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
            $where = "where 1 ";
            if (!empty($apellido))
                $where.=" and usu_apellido like '%" . $apellido."%'";
            if (!empty($cedula))
                $where.=" and usu_cedula like '%" . $cedula."%'";
            if (!empty($estado))
                $where.=" and est_id like '%" . $estado."%'";
            if (!empty($nombre))
                $where.=" and usu_nombre like '%" . $nombre."%'";


            $user = $this->db->query(""
                    . "SELECT "
                    . "GROUP_CONCAT(eva_nombre SEPARATOR ', ') conca, ww.* FROM "
                    . "(SELECT user.usu_nombre, evaluacion.eva_nombre, ingreso.ing_fechaIngreso, "
                    . "est_id, usu_cedula, usu_apellido, user.usu_id,usu_usuario "
                    . "FROM user "
                    . "LEFT JOIN ingreso ON ingreso.usu_id = user.usu_id and ingreso.ing_fechaIngreso = "
                    . "(select max(ing_fechaIngreso) from ingreso ) "
                    . "LEFT JOIN user_evaluacion ON user_evaluacion.use_id=user.usu_id and "
                    . "user_evaluacion.useEva_activo='S' "
                    . "LEFT JOIN evaluacion ON evaluacion.eva_id=user_evaluacion.eva_id "
                    . "JOIN permisos ON permisos.rol_id=user.rol_id "
                    . "WHERE user.est_id != 3  "
                    . "GROUP BY user.usu_id, evaluacion.eva_nombre) as ww " . $where . " GROUP BY usu_id");

            //echo $this->db->last_query();
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

            $datos = $this->db->query('select eva_id from respuesta_evaluacion where usu_id=' . $id . ' group by eva_id');
            $datos = $datos->result();
            $d = array();
            foreach ($datos as $value) {
                $d[] = $value->eva_id;
            }

            $this->db->select("evaluacion.*");
            $this->db->where("ue.use_id", $id);
            $this->db->where("ue.useEva_activo", 'S');
            if (count($d))
                $this->db->where_not_in("evaluacion.eva_id", $d);
            $this->db->join("user_evaluacion ue ", "ue.eva_id=evaluacion.eva_id", "inner", false);
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
            
            // se confirma primero el rol que tenia el usuario para quitarcelo
            $this->db->select('rol_id');
            $this->db->where("usu_id", $id);
            $datos=$this->db->get('user');
            $datos=$datos->result();
            
            
            $post = $this->input->post();
            if (!empty($post['contrasena']))
                $this->db->set('usu_contrasena', sha1($this->input->post('contrasena')));
            else
                $this->db->set('usu_contrasena', null);
            if (!empty($post['estado']))
                $this->db->set('est_id', $this->input->post('estado'));
            else
                $this->db->set('est_id', null);
            if (!empty($post['cedula']))
                $this->db->set('usu_cedula', $this->input->post('cedula'));
            else
                $this->db->set('usu_cedula', null);
            if (!empty($post['nombres']))
                $this->db->set('usu_nombre', $this->input->post('nombres'));
            else
                $this->db->set('usu_nombre', null);
            if (!empty($post['apellidos']))
                $this->db->set('usu_apellido', $this->input->post('apellidos'));
            else
                $this->db->set('usu_apellido', null);
            if (!empty($post['usuario']))
                $this->db->set('usu_usuario', $this->input->post('usuario'));
            else
                $this->db->set('usu_usuario', null);
            if (!empty($post['email']))
                $this->db->set('usu_email', $this->input->post('email'));
            else
                $this->db->set('usu_email', null);
            if (!empty($post['genero']))
                $this->db->set('sex_id', $this->input->post('genero'));
            else
                $this->db->set('sex_id', null);
            if (!empty($post['cargo']))
                $this->db->set('car_id', $this->input->post('cargo'));
            else
                $this->db->set('car_id', null);
            if (!empty($post['empleado']))
                $this->db->set('emp_id', $this->input->post('empleado'));
            else
                $this->db->set('emp_id', null);
            
            if (!empty($post['cambiocontrasena']))
                $this->db->set('usu_cambiocontrasena', $this->input->post('cambiocontrasena'));
            else
                $this->db->set('usu_cambiocontrasena', null);
            
            if (!empty($post['rol']))
                $this->db->set('rol_id', $this->input->post('rol'));
            else
                $this->db->set('rol_id', null);

            $this->db->where("usu_id", $id);
            $this->db->update("user");
            
            
            
            $this->db->where("usu_id", $id);
            $this->db->where("rol_id", $datos[0]->rol_id);
            $this->db->delete('permisos');
            
            
            $this->db->set("usu_id", $id);
            $this->db->set("rol_id", $this->input->post('rol'));
            $this->db->insert('permisos');
            
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
            echo $this->db->last_query();
            die;
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

    function buscar_rol_usuario($post) {
        try {
            $this->db->select('count(usu_id) as usu_id ');
            $this->db->where('rol_id', $post['id']);
            $datos = $this->db->get('permisos');
            $datos = $datos->result();
            return $datos[0]->usu_id;
        } catch (exception $e) {
            
        }
    }

}
