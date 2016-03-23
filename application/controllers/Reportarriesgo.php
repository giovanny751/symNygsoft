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
class Reportarriesgo extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Pqr__model');
        $this->load->helper('miscellaneous');
    }

    function index() {
        try {
            $this->load->model(array("Dimension2_model"
                , "Dimension_model"
                , "Empresa_model"));

            $this->data['dimension'] = $this->Dimension_model->detail();
            $this->data['dimension2'] = $this->Dimension2_model->detail();
            $this->data['empresa'] = $this->Empresa_model->detail()[0];

            $this->load->view("reportarriesgo/reporteusuario", $this->data);
        } catch (Exeception $e) {
            
        } finally {
            
        }
    }
    public function traer_dimencion() {
        try {
            $this->load->model('Dimension2_model');
            $data['Json'] = $this->Dimension2_model->traer_dimencion();
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardaSolicitud() {
        try {
            $this->load->model(array("Empleado_model"
                , "Solicitudriesgo_model"));

            $empleado = $this->Empleado_model->validacedula($this->input->post("cedula"));

            if (count($empleado) > 0) {
                $datos = array(
                    "dim_id" => $this->input->post("dimension1")
                    , "dim2_id" => $this->input->post("dimension2")
                    , "solRie_correo" => $this->input->post("correo")
                    , "solRie_descripcion" => $this->input->post("descripcion")
                    , "emp_id" => $empleado[0]->Emp_Id
                    , "creationDate" => date("Y-m-d H:i:s")
                );
                $resultado = $this->Solicitudriesgo_model->insert($datos);
                if ($resultado === false) {
                    throw new Exception("Error insertar dato");
                } else {
                    $this->output->set_content_type('application/json')->set_output(json_encode($resultado));
                }
            } else {
                throw new Exception("Cedula no encontrada en el sistema");
            }
        } catch (Exception $e) {
            $data["message"] = $e->getMessage();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } finally {
            
        }
    }

    function pqr() {
        $this->data['post'] = array();
        $this->load->view('reportarriesgo/pqr', $this->data);
    }

    function buscar_sol() {
        $post= $this->input->post();
        $data = $this->Pqr__model->buscar_sol($post);
        if (count($data)) {
            echo 'su estado se encuentra en estado: ' . $data[0]->estSol_nombre;
        } else {
            echo 'Solicitud no encontrada. ';
        }
    }

    function save_pqr() {
        $post = $this->input->post();
        $id = $this->Pqr__model->save_pqr($post);
        $this->session->set_flashdata(array('message' => 'Los datos fueron guardado con exito, Numero de solicitud ' . $id, 'message_type' => 'success'));
        redirect('index.php/reportarriesgo/pqr', 'refresh');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */