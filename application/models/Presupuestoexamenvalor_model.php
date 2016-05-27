<?php

class Presupuestoexamenvalor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function guardarValor($id,$valor,$user,$date){
        $this->db->set("preExa_id",$id);
        $this->db->set("preExaVal_valor",$valor);
        $this->db->set("creatorUser",$user);
        $this->db->set("creatorDate",$date);
        $this->db->insert("presupuesto_examen_valor");
    }
}