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
class Informes extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    function informeactividades() {


        $this->layout->view("informes/informeactividades");
    }

    function phva() {
        $this->load->model('Tipo_model');
        $this->data['tipo'] = $this->Tipo_model->avanceciclophva();
        $this->layout->view("informes/informephva", $this->data);
    }

    function informeHorasExtras() {
        $this->load->model("Empleado_model");
        $this->data['empleado'] = $this->Empleado_model->detail();
//        echo "<pre>";
//        var_dump($this->data['empleado']);die;
        $this->layout->view("informes/informeHorasExtras", $this->data);
    }

    function consultaInformeHorasExtras() {
        try {
            $this->load->model('Informes_model');
            $respuesta = $this->Informes_model->horasExtras($this->input->post('empleado'), $this->input->post('fechaDesde'), $this->input->post('fechaHasta'));
            if (!empty($respuesta)) {
                $data['Json'] = $respuesta;
            } else {
                throw new Exception("No existen horas extras");
            }
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function listadoDotacion() {
        try {
            $this->load->model("Dotacion_model");
            $this->data['consulta'] = $this->Dotacion_model->listadoDotacion();
            $this->data['titulo'] = array('EMPLEADO', 'DOTACION', 'TALLA', 'INDICACION', 'FECHA CADUCIDAD', 'UNIDADES', 'FECHA ENTREGA', 'RESPONSABE DE LA ENTREGA');
            $this->layout->view("reportes/reporte_general", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function generarExcelCompleto() {
        try {
            
        } catch (exception $e) {
            
        } finally {
            
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */