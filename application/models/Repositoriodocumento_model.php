<?php

class Repositoriodocumento_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function saveFile($data){
        $this->db->insert("repositorio_documento",$data);
    }
    function documentos(){
        $repositorio = $this->db->get("repositorio_documento");
        return $repositorio->result();
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

