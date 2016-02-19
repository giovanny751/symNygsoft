<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @package     NYGSOFT
 * @author      Gerson J Barbosa / Nelson G Barbosa
 * @Pagina      www.nygsoft.com
 * @celular     301 385 9952
 * @email       javierbr12@hotmail.com    
 */
class Presentacion extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Roles_model");
    }

    function menu() {
        $this->layout->view("presentacion/prueba");
    }

    function principal() {
        
        if ($this->data['user']['rol_id'] != 60) {
            $id = $this->data['user']['emp_id'];
            
            $this->layout->view('presentacion/principal', $this->data);
        } else {
            $this->load->model("User_model");
            $this->data['evaluacion']=$this->User_model->evaluacion_usuario($this->data['user']['usu_id']);
            $this->layout->view('evaluacion/quiz', $this->data);
        }
    }

    function NoTienePermisos() {
        $this->layout->view("permisos");
    }

    function modulos($datosmodulos, $html = null, $usuarioid) {
        $tipo = 2;
        $menu = $this->Ingreso_model->menu($datosmodulos, $usuarioid, $tipo);
        $i = array();
        foreach ($menu as $modulo)
            $i[$modulo['menu_id']][$modulo['menu_nombrepadre']][$modulo['menu_idpadre']] [] = array($modulo['menu_idhijo'], $modulo['menu_controlador'], $modulo['menu_accion']);
        if ($datosmodulos == 'prueba')
            $html .="<ul class='nav navbar-nav'>";
        else
            $html .="<ul class='dropdown-menu'>";
        foreach ($i as $padre => $nombrepapa)
            foreach ($nombrepapa as $nombrepapa => $menuidpadre)
                foreach ($menuidpadre as $modulos => $menu)
                    foreach ($menu as $submenus):
                        $html .= "<li><a href='" . base_url("index.php/" . $submenus[1] . "/" . $submenus[2]) . "' >" . strtoupper($nombrepapa) . "</a>";
                        if (!empty($submenus[0]))
                            $html .=$this->modulos($submenus[0], null, $usuarioid);
                        $html .= "</li>";
                    endforeach;
        $html.="</ul>";
        return $html;
    }

    function principal_menu() {
        return $menu = $this->load->view('presentacion/modulos');
    }

    function consultadatosmenu() {
        $idgeneral = $this->input->post('idgeneral');
        if (!empty($idgeneral)) {
            $datos = $this->Ingreso_model->consultamenu($idgeneral);
            $this->output->set_content_type('application/json')->set_output(json_encode($datos[0]));
        } else {
            redirect('auth/login', 'refresh');
        }
    }

    public function creacionmenu() {
        $this->data['hijo'] = $this->input->post('menu');
        $this->data['nombrepadre'] = $this->input->post('nombrepadre');
        $this->data['idgeneral'] = $this->input->post('idgeneral');
        if (empty($this->data['idgeneral']))
            $this->data['hijo'] = 0;
        $this->data['menu'] = $this->Ingreso_model->consultahijos($this->data['idgeneral']);
        if (!empty($this->data['idgeneral']))
            $this->data['menu'] = $this->Ingreso_model->hijos($this->data['idgeneral']);
        $this->layout->view('presentacion/creacionmenu', $this->data);
    }

    function guardarmodulo() {
        try {
            $modulo = $this->input->post('modulo');
            $padre = $this->input->post('padre');
            $general = $this->input->post('general');
            $actualizamodulo = $this->Ingreso_model->actualizahijos($general);
            $guardamodulo = $this->Ingreso_model->guardarmodulo($modulo, $padre, $general);
            $menu['Json'] = $this->Ingreso_model->cargamenu($general);
            $this->output->set_content_type('application/json')->set_output(json_encode($menu));
        } catch (exception $e) {
            
        }
    }

    function guardaatribustosmodulo() {
        try {
            $idgeneral = $this->input->post('idgeneral');
            if (!empty($idgeneral)) {
                $this->Ingreso_model->guardaatributos($idgeneral, $this->input->post('controlador'), $this->input->post('accion'), $this->input->post('estado'), $this->input->post('nombre'));
            } else {
                redirect('auth/login', 'refresh');
            }
        } catch (exception $e) {
            
        }
    }

    function consultarolxrolidusuario() {
        try {
            $data['Json'] = $this->Roles_model->totalroles($this->input->post('id'));
        } catch (exception $e) {
            
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function permisosporrol() {
        try {
            $idrol = $this->input->post('idrol');
            $idusuario = $this->input->post('idusuario');
            $data = array();
            for ($i = 0; $i < count($idrol); $i++) {
                $data[$i] = array("" => $idrol, "" => $idusuario);
            }
            $permisos = $this->permisorolporusuario('prueba', $idrol, $idusuario);
            echo $permisos;
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminarmodulo() {
        try {
            if ($this->Ingreso_model->eliminar($this->input->post('idgeneral')) == false)
                throw new Exception("Error al eliminar en la base de datos");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function permisosmenu($iduser, $datosmodulos = 'prueba', $dato = null) {
        $menu = $this->Ingreso_model->menu($iduser, $datosmodulos, 1);
        $i = array();
        foreach ($menu as $modulo)
            $i[$modulo['menu_id']][$modulo['menu_nombrepadre']][$modulo['menu_idpadre']][$modulo['modulo_menuid']] [] = $modulo['menu_idhijo'];

        if ($datosmodulos == 'prueba')
            echo "<ul class='principal'>";
        else
            echo "<ul>";
        foreach ($i as $padre => $nombrepapa)
            foreach ($nombrepapa as $nombrepapa => $menuidpadre)
                foreach ($menuidpadre as $modulos => $menu)
                    foreach ($menu as $permiosos => $menuprincipal)
                        foreach ($menuprincipal as $submenus):
                            if (!empty($permiosos))
                                echo "<li><a href=''>" . strtoupper($nombrepapa) . "</a><input type='checkbox' checked='checked' value='" . $padre . "' name='" . $padre . "' papa='" . $padre . "'>";
                            else
                                echo "<li><a href=''>" . strtoupper($nombrepapa) . "</a><input type='checkbox'  value='" . $padre . "' name='" . $padre . "' papa='" . $padre . "'>";
                            if (!empty($submenus))
                                $this->permisosmenu($iduser, $submenus);
                            echo "</li>";
                        endforeach;
        echo "</ul>";
    }

    function retornamenutotal() {
        return $this->permisosmenu($this->input->post('usuario'));
    }

    function savepermissionsuser() {
        try {
            $this->data['user'] = $this->input->post('usuario');
            $eliminarpermisos = $this->Ingreso_model->eliminarpermisos($this->data['user']);
            $usuario = $this->input->post();
            $datos = array();
            foreach ($usuario as $papa => $modulos) {
                $datos[] = array('usu_id' => $this->data['user'], 'modulo_menuid' => $modulos);
            }

            $guardarpermisos = $this->Ingreso_model->permisosmodulo($datos);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function permisoroles($datosmodulos, $html = null, $s = null, $numero = 1) {
        $menu = $this->Ingreso_model->permisoroles($datosmodulos);
        $i = array();
        if (count($menu))
            foreach ($menu as $modulo)
                $i[$modulo['menu_id']][$modulo['menu_nombrepadre']][$modulo['menu_idpadre']] [] = array($modulo['menu_idhijo'], $modulo['menu_controlador'], $modulo['menu_accion']);
        $html .="<ul>";
        foreach ($i as $padre => $nombrepapa)
            foreach ($nombrepapa as $nombrepapa => $menuidpadre)
                foreach ($menuidpadre as $modulos => $menu)
                    foreach ($menu as $submenus):
                        $html .= "<li>" . strtoupper($nombrepapa)
                                . "<div  class='derechaCheck'>"
                                . "<input title='Mostrar Menu' style='margin:0;' type='checkbox' class='seleccionados " . ($s == null ? '' : $s) . "'  atr='" . str_replace(' ', '', strtoupper($nombrepapa)) . "' name='permisorol[]' value='" . $padre . "' >"
                                . "&nbsp;&nbsp;&nbsp;<input title='Crear'        style='margin:0;' type='checkbox' class='crear2 " . ($s == null ? '' : $s) . "_c'  atr='" . str_replace(' ', '', strtoupper($nombrepapa)) . "' name='crear[]' value='" . $padre . "' >"
                                . "&nbsp;&nbsp;&nbsp;<input title='Modificar'    style='margin:0;' type='checkbox' class='modificar2 " . ($s == null ? '' : $s) . "_m'  atr='" . str_replace(' ', '', strtoupper($nombrepapa)) . "' name='modificar[]' value='" . $padre . "' >"
                                . "&nbsp;&nbsp;&nbsp;<input title='Eliminar'     style='margin:0;' type='checkbox' class='eliminar2 " . ($s == null ? '' : $s) . "_e'  atr='" . str_replace(' ', '', strtoupper($nombrepapa)) . "' name='eliminar[]' value='" . $padre . "' >"
                                . "&nbsp;</div>";
                        if (!empty($submenus[0]))
                            $html .=$this->permisoroles($submenus[0], ' ', str_replace(' ', '', strtoupper($nombrepapa)), 2);
                        $html .= "</li>";
                    endforeach;
        $html.="</ul>";
        if ($numero = 1)
            $html .="</div>";
        return $html;
    }

    function roles() {
        try {
            $this->data['title'] = "Administración de Roles";
            $this->load->model("Roles_model");
            $this->data['content'] = "<table border='0' width='100%'>" . $this->permisoroles('prueba', null) . "</table>";
            $this->data['roles'] = $this->Roles_model->roles();
            $this->layout->view('presentacion/roles', $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarroles() {
        try {
            $nombre = $this->input->post('nombre');
            if (!empty($nombre)) {
                $permisorol = $this->input->post('permisorol');
                $id = $this->Roles_model->guardarrol($nombre);
                $insert = array();
                for ($i = 0; $i < count($permisorol); $i++) {
                    $insert[] = array('rol_id' => $id, 'menu_id' => $permisorol[$i]);
                }
                if (!empty($insert)) {
                    $this->Roles_model->insertapermisos($insert);
                }
                $roles = $this->Roles_model->rolesall();
                echo json_encode($roles);
                die;
            } else {
                $id = $this->input->post('rol');
                $this->Roles_model->eliminpermisosrol($id);
                $this->Roles_model->modificarrol($id);
            }
            $permisorol = $this->input->post('permisorol');
            $crear = $this->input->post('crear');
            $modificar = $this->input->post('modificar');
            $eliminar = $this->input->post('eliminar');
            $insert = array();
            $c = 0;
            $m = 0;
            $e = 0;
            for ($i = 0; $i < count($permisorol); $i++) {
                if (isset($crear[$c]))
                    if ($crear[$c] == $permisorol[$i]) {
                        $crear2 = $crear[$c];
                        $c++;
                    } else
                        $crear2 = 0;
                else
                    $crear2 = 0;
                if (isset($modificar[$m]))
                    if ($modificar[$m] == $permisorol[$i]) {
                        $modificar2 = $modificar[$m];
                        $m++;
                    } else
                        $modificar2 = 0;
                else
                    $modificar2 = 0;
                if (isset($eliminar[$e]))
                    if ($eliminar[$e] == $permisorol[$i]) {
                        $eliminar2 = $eliminar[$e];
                        $e++;
                    } else
                        $eliminar2 = 0;
                else
                    $eliminar2 = 0;

                $insert[] = array('rol_id' => $id, 'menu_id' => $permisorol[$i], 'perRol_crear' => $crear2, 'perRol_modificar' => $modificar2, 'perRol_eliminar' => $eliminar2);
            }
            $this->Roles_model->insertapermisos($insert);
            $roles = $this->Roles_model->rolesall();
            echo json_encode($roles);
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            
        }
    }

    function eliminarrol() {
        try {
            $this->load->model("User_model");
            $data = array();
            if (!empty($this->User_model->buscar_rol_usuario($this->input->post()))) {
                throw new Exception("Usuarios asociados al rol");
            } else {
                $id = $this->input->post('id');
                $this->Roles_model->eliminpermisosrol($id);
                $this->Roles_model->eliminarrol($id);
                $data['Json'] = true;
            }
        } catch (exception $e) {
            $data["message"] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardaratributosmenu() {
        try {
            $this->Ingreso_model->guardaratributosmenu($this->input->post('nombre'), $this->input->post('controlador'), $this->input->post('accion'), $this->input->post('estado'), $this->input->post('id'));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function actualizarIcono() {
        try {
            $nuevoIcono = $this->input->post('nuevoIcono');
            $idgeneral = $this->input->post('idgeneral');
            $this->Ingreso_model->actualizarIcono($nuevoIcono, $idgeneral);
        } catch (Exception $e) {
            
        } finally {
            
        }
    }

    function permisousuarios($datosmodulos, $html = null, $idusuario) {
        try {
            $tipo = 1;
            $menu = $this->Ingreso_model->menu($datosmodulos, $idusuario, $tipo);
            $i = array();

            foreach ($menu as $modulo)
                $i[$modulo['menu_id']][$modulo['menu_nombrepadre']][$modulo['menu_idpadre']] [] = array($modulo['menu_idhijo'], $modulo['menu_controlador'], $modulo['menu_accion'], $modulo['menudos']);
            if ($datosmodulos == 'prueba')
                $html .="<ul>";
            else
                $html .="<ul>";
            foreach ($i as $padre => $nombrepapa)
                foreach ($nombrepapa as $nombrepapa => $menuidpadre)
                    foreach ($menuidpadre as $modulos => $menu)
                        foreach ($menu as $submenus):
                            if ($submenus[3] == $padre) {
                                $checked = 'checked';
                            } else {
                                $checked = '';
                            }
                            $html .= "<li> <div>" . strtoupper($nombrepapa) . "</div><div align='center'><input type='checkbox' " . $checked . " name='permisousuario[]' value='" . $padre . "'></div>";
                            if (!empty($submenus[0]))
                                $html .=$this->permisousuarios($submenus[0], null, $idusuario);
                            $html .= "</li>";
                        endforeach;
            $html.="</ul>";
            return $html;
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function permisos() {
        try {
            echo $this->permisousuarios('prueba', null, $this->input->post('id'));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarpermisos() {
        try {
            $rol = $this->input->post('idrol');
            $usuario = $this->input->post('idusuario');
            $eliminacion = $this->Ingreso_model->eliminarpermisosusuario($usuario);
            if ($eliminacion == false)
                throw new Exception("Error en la base de datos");
            $data = array();
            $i = 0;
            for ($i = 0; $i < count($rol); $i++) {
                $data[$i] = array(
                    "rol_id" => $rol[$i],
                    "usu_id" => $usuario
                );
            }
            $msg['Json'] = $this->Ingreso_model->permisosusuariomenu($data);
            if ($msg == false)
                throw new Exception("Error en la base de datos");
        } catch (exception $e) {
            $msg['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($msg));
        }
    }

    function rolesasignados() {
        try {
            $roles = $this->Ingreso_model->rolesasignados($this->input->post('id'));
            echo json_encode($roles);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function recordarcontrasena() {
        try {
            $this->layout->view('presentacion/recordarcontrasena');
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarcontrasena() {
        try {
            $this->Ingreso_model->guardarcontrasena(sha1($this->input->post('password')), $this->data["usu_id"]);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function rol() {
        try {
            $this->data['roles'] = $this->Roles_model->rolxusuario($this->session->userdata('usu_id'));
            $this->layout->view("presentacion/rol", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarroldefecto() {
        try {
            $this->load->model("User_model");
            $rol = $this->input->post("rol");
            $this->User_model->rolxdefecto($rol, $this->data['usu_id']);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function obtener_clasificacion($id) {
        try {
            $this->load->model('Planes_model');
            return $this->Planes_model->obtener_clasificacion($id);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function obtener_tipo($id) {
        try {
            $this->load->model('Planes_model');
            return $this->Planes_model->obtener_tipo($id);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarMetodos() {
        try {
            $this->load->model('Planes_model');
            $modulo = $this->input->post("modulo");
            $metodoEliminar = $this->input->post("TxtMetodoEliminar");
            $claseEliminar = $this->input->post("TxtClaseEliminar");
            $data = array();
            if (!empty($metodoEliminar[0]) && !empty($claseEliminar[0]))
                for ($i = 0; $i < count($metodoEliminar); $i++) {
                    $crud = 1;
                    $data[] = array(
                        "mod_id" => $modulo,
                        "perMet_metodo" => $metodoEliminar[$i],
                        "perMet_clase" => $claseEliminar[$i],
                        "tipCru_id" => $crud
                    );
                }

            $metodoConsultar = $this->input->post("TxtMetodoConsultar");
            $claseConsultar = $this->input->post("TxtClaseConsultar");
            if (!empty($metodoConsultar[0]) && !empty($claseConsultar[0]))
                for ($i = 0; $i < count($metodoConsultar); $i++) {
                    $crud = 3;
                    $data[] = array(
                        "mod_id" => $modulo,
                        "perMet_metodo" => $metodoConsultar[$i],
                        "perMet_clase" => $claseConsultar[$i],
                        "tipCru_id" => $crud
                    );
                }

            $metodoActualizar = $this->input->post("TxtMetodoActualizar");
            $claseActualizar = $this->input->post("TxtClaseActualizar");
            if (!empty($metodoActualizar[0]) && !empty($claseActualizar[0]))
                for ($i = 0; $i < count($metodoActualizar); $i++) {
                    $crud = 2;
                    $data[] = array(
                        "mod_id" => $modulo,
                        "perMet_metodo" => $metodoActualizar[$i],
                        "perMet_clase" => $claseActualizar[$i],
                        "tipCru_id" => $crud
                    );
                }

            $metodoInsertar = $this->input->post("TxtMetodoInsertar");
            $claseInsertar = $this->input->post("TxtClaseInsertar");
            if (!empty($metodoInsertar[0]) && !empty($claseInsertar[0]))
                for ($i = 0; $i < count($metodoInsertar); $i++) {
                    $crud = 4;
                    $data[] = array(
                        "mod_id" => $modulo,
                        "perMet_metodo" => $metodoInsertar[$i],
                        "perMet_clase" => $claseInsertar[$i],
                        "tipCru_id" => $crud
                    );
                }
            $this->Ingreso_model->eliminarPermisoMetodo($modulo);
            $this->Ingreso_model->guardarPermisosMetodo($data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function cargarMetodos() {
        try {
            $this->load->model("Ingreso_model");
            $datos = $this->Ingreso_model->cargarPermisoMetodo($this->input->post("modulo"));
            $array = array();
            foreach ($datos as $value):
                $array[$value->crud][] = array($value->clase, $value->metodo);
            endforeach;
            $this->output->set_content_type('application/json')->set_output(json_encode($array));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */