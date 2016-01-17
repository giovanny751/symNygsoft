<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout {

    var $obj;
    var $layout;
    var $id;
    var $nombre;

    function __construct() {
        $this->obj = & get_instance();
        if (!empty($this->obj->session->userdata['usu_id'])) {
            $this->id = $this->obj->session->userdata['usu_id'];
            $this->nombre = $this->obj->session->userdata['usu_id'];
        } else {
            $this->id = "";
            $this->nombre = "";
        }
        $this->layout = 'layout_main';
    }

    function view($view, $data = null, $return = false) {
        $loadedData = array();
        $loadedData['id'] = $this->obj->session->userdata['usu_id'];
        $loadedData['nombre'] = $this->obj->session->userdata['usu_nombre']." ";
        $loadedData['nombre'] .= $this->obj->session->userdata['usu_apellido']." ";
        $loadedData['content_for_layout'] = $this->obj->load->view($view, $data, true);

        if ($return) {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        } else {
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }

}

?> 