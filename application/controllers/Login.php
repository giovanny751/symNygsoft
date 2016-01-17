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
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Ingreso_model');
    }

    public function index() {
        $datos = $this->session->userdata('usu_id');
        if (!empty($datos)) {
            redirect('index.php/presentacion/principal', 'location');
        } else {
            $this->load->view('login/index');
        }
    }

    public function make_hash($var = 1) {
        echo make_hash($var);
    }

    public function politica() {
        $this->user_model->listo_politica($this->input->post('username'), $this->input->post('password'));
        $this->verify($this->input->post('password'));
    }

    function verify($pass=null) {
//        echo $this->input->post('username')."***".$this->input->post('password');die;

        $user = $this->user_model->get_user($this->input->post('username'), (isset($pass)?$pass:sha1($this->input->post('password'))));
        if (!empty($user) > 0) {
            $this->data['username'] = $user[0]["usu_usuario"];
            $this->data['password'] = $user[0]["usu_contrasena"];
            if ($user[0]['usu_politicas'] == 0) {
                $this->data['inicio'] = $this->user_model->admin_inicio();
                $this->load->view('login/politicas', $this->data);
            } else {
                $this->acceso($user);
                $data[] = array(
                    'usu_id' => $user[0]['usu_id'],
                    'ing_fechaIngreso' => date('Y-m-d H:i:s')
                );
                $this->Ingreso_model->insertingreso($data);
                if ($user[0]['usu_cambiocontrasena'] == 1) {
                    redirect('index.php/presentacion/recordarcontrasena', 'location');
                    die;
                }
                if (!empty($user[0]['rol_id'])) {
                    redirect('index.php/presentacion/principal', 'location');
                } else {
                    redirect('index.php/presentacion/rol', 'location');
                }
            }
        } else {
            $this->session->set_flashdata(array('message' => 'Su n&uacute;mero de documento no se encuentra registrado en el sistema.', 'message_type' => 'warning'));
            redirect('', 'refresh');
        }
    }

    public function logout() {
        $this->session->set_userdata('logged_in', FALSE);
        $this->session->sess_destroy();
        redirect('index.php/login', 'location');
    }

    function acceso($user = null, $id = NULL) {
        $i = 0;
        if (!empty($id)) {
            $user = $this->user_model->validacionusuario(deencrypt_id($id));
            $i = 1;
        }
        $this->session->set_userdata($user[0]);
        if ($i == 1) {
            $ruta = 'index.php/presentacion/principal';
            redirect($ruta, 'location');
        }
    }

    function reset() {
        $mail = $this->input->post('email');
        $password = $this->user_model->reset($mail);
        $actualizar = $this->user_model->actualizar($mail);
        $data = mail($mail, "Actualizacion de Contraseña", 'clave: ' . $password);
        redirect('index.php', 'location');
    }

}
