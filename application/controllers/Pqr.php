<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pqr extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Pqr__model');
        $this->load->helper('security');
        $this->load->helper('miscellaneous');
        $this->load->library('tcpdf/tcpdf.php');
        validate_login($this->session->userdata('usu_id'));
    }
    function index(){
        $this->data['post']=$this->input->post();
        $this->layout->view('pqr/index', $this->data);
    }
    function consult_pqr(){
        $post=$this->input->post();
        $this->data['post']=$this->input->post();
        $this->data['datos']=$this->Pqr__model->consult_pqr($post);
        $this->layout->view('pqr/consult_pqr', $this->data);
    }
    function save_pqr(){
        $post=$this->input->post();
                $id=$this->Pqr__model->save_pqr($post);         
        redirect('index.php/Pqr/consult_pqr', 'location');
    }
    function delete_pqr(){
        $post=$this->input->post();
        $this->Pqr__model->delete_pqr($post);
        redirect('index.php/Pqr/consult_pqr', 'location');
    }
    function edit_pqr(){
        $this->data['post']=$this->input->post();
        if(!isset($this->data['post']['campo']))
        redirect('index.php/Pqr/consult_pqr', 'location');
        $this->data['datos']=$this->Pqr__model->edit_pqr($this->data['post']);
        $this->layout->view('pqr/index', $this->data);
    }
    }
?>
