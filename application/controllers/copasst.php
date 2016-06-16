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
class copasst extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    function comiteConvivencia() {
        $this->load->model(array("Empresa_model", "Dimension_model", "Dimension2_model"));
        $this->data['empresa'] = $this->Empresa_model->detail();
        $this->data['dimension'] = $this->Dimension_model->detail();
        $this->data['dimension2'] = $this->Dimension2_model->detail();
        $this->layout->view("copasst/comiteConvivencia", $this->data);
    }

    function empleadosActivos() {
        try {
            $this->load->model("Empleado_model");
            $respuesta = $this->Empleado_model->empleados();
            if (!empty($respuesta)):
                $data['Json'] = $respuesta;
            else:
                throw new Exception("No existen empleados activos");
            endif;
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    
    function guardaComiteConvivencia(){
        try{
            
        }catch(exception $e){
            
        }finally{
            
        }
    }

}

?>