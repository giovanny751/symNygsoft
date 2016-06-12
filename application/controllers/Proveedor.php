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
class Administrativo extends My_Controller {

    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->layout->view("proveedor/index");
    }
}