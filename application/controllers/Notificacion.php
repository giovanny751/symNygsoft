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
class Notificacion extends My_Controller {

    function __construct() {
        parent::__construct();
    }
    function notificaciones(){
        
        $this->load->model("Notificacion_model");
        $this->data['notificacion'] = $this->Notificacion_model->detail();
        $this->layout->view("notificacion/notificaciones",$this->data);
    }
    function cargosAsociadosNotificacion(){
        try{
            if(empty($this->input->post("notificacion")))
                throw new Exception("No exite la notificación");
            
            $this->load->model("Cargo_model");
            $respuesta = $this->Cargo_model->notificacionesXCargo($this->input->post("notificacion"));
            if(empty($respuesta)) throw new Exception("No se encontraron cargos");
            else $data['Json'] = $respuesta;
        }catch(exception $e){
            $data['message'] = $e->getMessage();
        }finally{
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    function notificacionesCargo(){
        try{
            if(empty($this->input->post("cargos")) || empty($this->input->post("notificacion")))
                throw new Exception("No se encontro inforación valida para guardar");
            $this->load->model("Cargonotificacion_model");
            
            $cargosNotificados = $this->input->post("cargos");
            $dataGuardar = array();
            foreach($cargosNotificados as $campo):
                $dataGuardar[] = array(
                    "car_id"=>$campo,
                    "not_id"=>$this->input->post("notificacion")
                );
            endforeach;
            $respuesta = $this->Cargonotificacion_model->guardarCargoNotificacion($dataGuardar);
            if($respuesta == true){
                $data['Json'] = true;
            }else{
                throw new Exception("Error al guardar por favor comunicarse con el administrador");
            }
        }catch(exception $e){
            $data["message"] = $e->getMessage();
        }finally{
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
?>