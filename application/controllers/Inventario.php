<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventario extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Inventario__model');
        $this->load->helper('security');
        $this->load->helper('miscellaneous');
        $this->load->library('tcpdf/tcpdf.php');
        validate_login($this->session->userdata('usu_id'));
    }
    function index(){
        $this->data['post']=$this->input->post();
        $this->layout->view('inventario/index', $this->data);
    }
    function consult_inventario(){
        $post=$this->input->post();
        $this->data['post']=$this->input->post();
        $this->data['datos']=$this->Inventario__model->consult_inventario($post);
        $this->layout->view('inventario/consult_inventario', $this->data);
    }
    function save_inventario(){
        $post=$this->input->post();
                            $post['inv_imagen']=basename($_FILES['inv_imagen']['name']);
                        $id=$this->Inventario__model->save_inventario($post);
        
                        $targetPath = "./uploads/inventario";
                if (!file_exists($targetPath)) {
                    mkdir($targetPath, 0777, true);
                }
                $targetPath = "./uploads/inventario/".$id;
                if (!file_exists($targetPath)) {
                    mkdir($targetPath, 0777, true);
                }
                $target_path = $targetPath.'/'. basename($_FILES['inv_imagen']['name']);
                if (move_uploaded_file($_FILES['inv_imagen']['tmp_name'], $target_path)) {

                }    
                                
        redirect('index.php/Inventario/consult_inventario', 'location');
    }
    function delete_inventario(){
        $post=$this->input->post();
        $this->Inventario__model->delete_inventario($post);
        redirect('index.php/Inventario/consult_inventario', 'location');
    }
    function edit_inventario(){
        $this->data['post']=$this->input->post();
        if(!isset($this->data['post']['campo']))
        redirect('index.php/Inventario/consult_inventario', 'location');
        $this->data['datos']=$this->Inventario__model->edit_inventario($this->data['post']);
        $this->layout->view('inventario/index', $this->data);
    }
    }
?>
