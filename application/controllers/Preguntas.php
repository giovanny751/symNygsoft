<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Preguntas extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Preguntas__model');
    }

    function index() {
        try {
            $this->data['post'] = $this->input->post();
            $this->layout->view('preguntas/index', $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consult_preguntas() {
        try {
            $post = $this->input->post();
            $this->data['post'] = $this->input->post();
            $this->data['datos'] = $this->Preguntas__model->consult_preguntas($post);
            $this->layout->view('preguntas/consult_preguntas', $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function save_preguntas() {
        try {
            $post = $this->input->post();
            $id = $this->Preguntas__model->save_preguntas($post);
            redirect('index.php/Preguntas/consult_preguntas', 'location');
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function pre_visible() {
        try {
            $post = $this->input->post();
            $id = $this->Preguntas__model->pre_visible($post);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function delete_preguntas() {
        try {
            $post = $this->input->post();
            $this->Preguntas__model->delete_preguntas($post);
            redirect('index.php/Preguntas/consult_preguntas', 'location');
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function edit_preguntas() {
        try {
            $this->data['post'] = $this->input->post();
            if (!isset($this->data['post']['campo']))
                redirect('index.php/Preguntas/consult_preguntas', 'location');
            $this->data['datos'] = $this->Preguntas__model->edit_preguntas($this->data['post']);
            $this->data['respuesta'] = $this->Preguntas__model->edit_respuesta($this->data['post']);
            $this->layout->view('preguntas/index', $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

}

?>
