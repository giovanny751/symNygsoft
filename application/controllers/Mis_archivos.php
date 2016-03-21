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
            if(empty($this->input->post('nueva_carpeta')))
                throw new Exception("No ha ingresado el nombre de la carpeta");
            $idCarpeta = $this->Mis_archivos_model->new_folder($this->input->post('nueva_carpeta'),$this->input->post('IdCarpetaPadre'));
            if($idCarpeta == false)
                throw new Exception("Error al crear la carpeta en base de datos");
            
            $data['Json'] = $this->Mis_archivos_model->carpetaDocumento($this->input->post('IdCarpetaPadre'));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    function traer_folder() {
        try {
            $data['Json']=$this->Mis_archivos_model->traer_folder();
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    function traer_atras() {
        try {
            $data['Json']=$this->Mis_archivos_model->traer_atras();
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */