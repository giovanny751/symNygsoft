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
class Presupuesto extends My_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function presupuestoExamenesMedicos(){

        $this->load->model(array("Parametrosnomina_model","Presupuestoexamen_model"));
        $this->data['parametros'] = $this->Parametrosnomina_model->detalle();
        $this->data['examenes'] = $this->Presupuestoexamen_model->detalle();
        
        
        $this->layout->view("presupuesto/presupuestoExamenesMedicos",$this->data);
    }
    
    function guardarExamenes(){
        try{
            $this->load->model(array("Presupuestoexamenvalor_model","Presupuestoexamen_model"));
            if(empty($this->input->post())){
                throw new Exception('No existen datos para almacenar');
            }
            
            foreach($this->input->post() as $key => $val){
                $this->Presupuestoexamenvalor_model->guardarValor($key,$val,$this->data['usu_id'],date("Y-m-d H:i:s"));
            }
        }catch(exception $e){
            
        }finally{
            
        }
    }
    function examenesPersonal(){
        $this->layout->view("presupuesto/examenesPersonal");
    }
    function guardarExamenMedico(){
        try{
            if(empty($this->input->post())){
                $data['color'] = "rojo";
                throw new Exception("No existen datos para guardar");
            }
            
//            $this->load->model("");
            
        }catch(exception $e){
            $data['message'] = $e->getMessage();
        }finally{
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    function examenesRealizados(){
        $this->layout->view("presupuesto/presupuestoExamenesMedicos");
    }
    
}
