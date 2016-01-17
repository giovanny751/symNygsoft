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
class Formulario extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Ingreso_model');
        $this->load->model('Roles_model');
        $this->data["usu_id"] = $this->session->userdata('usu_id');
        validate_login($this->data["usu_id"]);
    }
    function formulario(){
        
        $this->layout->view("formulario/formulario");
        
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */