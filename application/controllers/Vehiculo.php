<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehiculo extends My_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        
        $this->layout->view("vehiculo/index");
    }

}
