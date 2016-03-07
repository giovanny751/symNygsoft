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
        
        $this->layout->view("notificacion/notificaciones",$this->data);
    }
}
?>