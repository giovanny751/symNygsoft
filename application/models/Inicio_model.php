<?php

class Inicio_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function guardarPoliticaEmpresa($politica){
        $this->db->where(1,1);
        $this->db->set("ini_politicaEmpresarial",$politica);
        $this->db->update("inicio");
    }
    function consultaPoliticaGeneral(){
        $politica = $this->db->get("inicio");
        return $politica->result();
    }
}