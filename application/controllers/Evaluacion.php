<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Evaluacion extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Evaluacion__model');
    }

    function index() {
        try {
            $this->data['post'] = $this->input->post();
            $this->layout->view('evaluacion/index', $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function prueba() {
        try {
            $post = $this->input->post();
            $this->data['nombre_evaluacion'] = $this->Evaluacion__model->nombre_evaluacion($post);
            $this->data['preguntas_evaluacion'] = $this->Evaluacion__model->preguntas_evaluacion($post);
            $this->layout->view('evaluacion/prueba', $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consult_evaluacion() {
        try {
            $post = $this->input->post();
            $this->data['post'] = $this->input->post();
            $this->data['datos'] = $this->Evaluacion__model->consult_evaluacion($post);
            $this->layout->view('evaluacion/consult_evaluacion', $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function save_evaluacion() {
        try {
            $post = $this->input->post();
            $id = $this->Evaluacion__model->save_evaluacion($post);
            redirect('index.php/Evaluacion/consult_evaluacion', 'location');
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function delete_evaluacion() {
        try {
            $post = $this->input->post();
            $this->Evaluacion__model->delete_evaluacion($post);
            redirect('index.php/Evaluacion/consult_evaluacion', 'location');
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function edit_evaluacion() {
        try {
            $this->data['post'] = $this->input->post();
            if (!isset($this->data['post']['campo']))
                redirect('index.php/Evaluacion/consult_evaluacion', 'location');
            $this->data['datos'] = $this->Evaluacion__model->edit_evaluacion($this->data['post']);
            $this->layout->view('evaluacion/index', $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadousuarios() {
        try {
            $this->load->model('Tipo_documento_model');
            $this->load->model('Estados_model');
            $this->load->model('User_model');
            $this->load->model('Roles_model');
            $this->data['roles'] = $this->Roles_model->roles();
            $this->data['estado'] = $this->Estados_model->detail();
            $this->data["tipodocumento"] = $this->Tipo_documento_model->detail();
            $this->data["usuarios"] = $this->User_model->consultageneral_evaluacion();
            $this->layout->view("evaluacion/listadousuarios", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultarusuario() {
        try {
            $this->load->model('User_model');
            $data['Json'] = $this->User_model->filteruser_evaluacion(
                    $this->input->post('apellido')
                    , $this->input->post('cedula')
                    , $this->input->post('estado')
                    , $this->input->post('nombre')
            );
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function ver_evaluaciones() {
        try {
            $data['Json'] = $this->Evaluacion__model->ver_evaluaciones($this->input->post());
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function ver_evaluaciones_resueltas() {
        try {
            $data['Json'] = $this->Evaluacion__model->ver_evaluaciones_resueltas($this->input->post());
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function arignar_evaluacion() {
        try {
            $this->Evaluacion__model->arignar_evaluacion($this->input->post());
        } catch (exception $e) {
            $e->getMessage();
        }
    }

    function obtener_respuestas($id) {
        try {
            return $respuestas = $this->Evaluacion__model->obtener_respuestas($id);
        } catch (exception $e) {
            $e->getMessage();
        }
    }

    function calificar() {
        try {
            $post = $this->input->post();
            $this->Evaluacion__model->calificar($post);
            redirect('index.php', 'location');
        } catch (exception $e) {
            $e->getMessage();
        }
    }

    function evaluando($eva_id = null, $user = null) {
        try {
            if (!empty($eva_id) || !empty($user)) {
                $eva_id=substr($eva_id,4);
                $post['eva_id']=substr($eva_id,0,-4);
                $user=substr($user,4);
                $post['user']=substr($user,0,-4);
                $this->data['nombre_evaluacion'] = $this->Evaluacion__model->nombre_evaluacion($post);
                $this->data['preguntas_evaluacion'] = $this->Evaluacion__model->preguntas_evaluacion2($post);
                $this->data['respondio'] = $this->Evaluacion__model->respondio($post);
//                echo $this->db->last_query();
                $this->load->view('evaluacion/prueba2', $this->data);
            } else
                redirect('index.php/Evaluacion/listadousuarios', 'location');
        } catch (exception $e) {
            $e->getMessage();
        }
    }

}

?>
