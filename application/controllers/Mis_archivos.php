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
class Mis_archivos extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Mis_archivos_model'));
    }

    function index() {
        
        $this->data['carpeta'] = $this->Mis_archivos_model->carpetas2();
        $this->layout->view("mis_archivos/index", $this->data);
    }

    function new_folder() {
        try {
            $data['Json']=$this->Mis_archivos_model->new_folder();
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */