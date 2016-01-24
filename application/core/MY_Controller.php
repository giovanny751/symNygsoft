<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @package     NYGSOFT
 * @author      Gerson J Barbosa
 * @copyright   www.nygsoft.com
 * @celular     301 385 9952
 * @email       javierbr12@hotmail.com    
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        // creación dinámica del menú
        parent::__construct();
        header('Pragma: no-cache');
        $this->load->database();
        $this->load->model('Ingreso_model');
        $this->load->helper('miscellaneous');
        $this->load->helper('security');
        $this->load->library('tcpdf/tcpdf.php');
        $this->load->library('layout', 'layout_main');
        $this->data['user'] = $this->session->userdata();
        $this->data["usu_id"] = $this->session->userdata('usu_id');
        validate_login($this->data['user']['usu_id']);
//        $this->verificacion();
    }

    function verificacion() {
        try {
            $ci = & get_instance();
            $controller = $ci->router->fetch_class();
            $method = $ci->router->fetch_method();
            
            if (
                    ((strtoupper($controller) != strtoupper('login')) &&
                    (strtoupper($method) != strtoupper('index') || strtoupper($method) != strtoupper('verify'))
                    )
            ) {
                $view = $this->Ingreso_model->consultapermisosmenu($this->data['user']['usu_id'], $controller, $method,$this->data['user']['rol_id']);
                $permisosPeticion = $this->Ingreso_model->consultaPermisosAccion($this->data['user']['usu_id'], $controller, $method);
                if (!empty($view)) {
                    if (!empty($view[0]['clase']) && !empty($view[0]['metodo']) && empty($view[0]['usu_id']))
                        echo "No tiene permisos por favor comunicarse con el administrador";
                } else if (!empty($permisosPeticion)) {
                    if (!empty($permisosPeticion[0]['clase']) && !empty($permisosPeticion[0]['metodo']) && empty($permisosPeticion[0]['usu_id'])) {
                        throw new Exception("No tiene permisos de ejecutar la acción");
                    } else if ($permisosPeticion[0]['accion'] == 4 && empty($permisosPeticion[0]['perRol_crear'])) {
                        throw new Exception("No tiene permisos de crear");
                    } else if ($permisosPeticion[0]['accion'] == 1 && empty($permisosPeticion[0]['perRol_eliminar'])) {
                        throw new Exception("No tiene permisos de eliminar");
                    } else if ($permisosPeticion[0]['accion'] == 2 && empty($permisosPeticion[0]['perRol_modificar'])) {
                        throw new Exception("No tiene permisos de modificar");
                    } else if ($permisosPeticion[0]['accion'] == 3 && empty($permisosPeticion[0]['perRol_id'])) {
                        throw new Exception("No tiene permisos de consultar");
                    }
                } else if (empty($permisosPeticion) || empty($view)) {
                    throw new Exception("No tiene permisos por favor comunicarse con el administrador");
                }
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
            $this->output->set_content_type('application/json')->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->_display();
            exit;
        } finally {
            
        }
    }

}

/* End of file MY_Controller.php */
/* Location: /application/libraries/MY_Controller.php */