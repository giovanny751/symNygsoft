<?php

class Presupuestoexamen_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function detalle(){
        $this->db->select("presupuesto_examen.preExa_id");
        $this->db->select("presupuesto_examen.preExa_examen");
        $this->db->select("(select preExaVal_valor from presupuesto_examen_valor where presupuesto_examen_valor.preExa_id =  presupuesto_examen.preExa_id order by preExaVal_id desc limit 1) as  valor",false,false);
        $this->db->select("(select preExaVal_id from presupuesto_examen_valor where presupuesto_examen_valor.preExa_id =  presupuesto_examen.preExa_id order by preExaVal_id desc limit 1) as  preExaVal_id",false,false);
        $presupuesto = $this->db->get("presupuesto_examen");
        return $presupuesto->result();
    }
    
    
    
}