<?php

class Empleadopresupuestoexamenvalor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function save($data){
        $this->db->insert_batch("empleado_presupuesto_examen_valor",$data);
        return $this->db->insert_id();
    }
}