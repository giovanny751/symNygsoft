<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @package     NYGSOFT
 * @author      Gerson J Barbosa
 * @copyright   www.nygsoft.com
 * @celular     301 385 9952
 * @email       javierbr12@hotmail.com    
 */
class MY_Pruebas extends CI_Controller {

    public function __construct() {
        // creación dinámica del menú
        parent::__construct();
        header('Pragma: no-cache');
        $this->load->database();
    }

}

/* End of file MY_Controller.php */
/* Location: /application/libraries/MY_Controller.php */