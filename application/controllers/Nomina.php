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
class Nomina extends My_Controller {

    function __construct() {
        parent::__construct();
        
    }
    
    function parametrica(){
        $this->load->model("Parametrosnomina_model");
        $this->data['parametros'] = $this->Parametrosnomina_model->detalle();
        $this->layout->view("nomina/parametricaNomina",$this->data);
    }
    function guardarParametros(){
        $this->load->model("Parametrosnomina_model");
        $parametros = array(
            "parNom_salarioMinimo"=>$this->input->post("salario"),
            "parNom_auxilioTransporte"=>$this->input->post("auxTransorte"),
            "parNom_aporteSalud"=>$this->input->post("aportesSalud"),
            "parNom_aportePension"=>$this->input->post("aportesPension"),
            "creatorUser"=>$this->data['usu_id'],
            "creatorDate"=>date("Y-m-d H:i:s"),
            "parNom_aporteSena"=>$this->input->post('aporteSena'),
            "parNom_aporteICBF"=>$this->input->post('aporteICBF'),
            "parNom_aporteCajaCompensacion"=>$this->input->post('aporteCajaComensacion')
        );
        $this->Parametrosnomina_model->guardarParametros($parametros);
    }
    
}