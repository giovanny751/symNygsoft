<?php

class Parametrosnomina_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detalle(){
        $this->db->select("parametros_nomina.parNom_id");
        $this->db->select("parametros_nomina.parNom_salarioMinimo");
        $this->db->select("parametros_nomina.parNom_auxilioTransporte");
        $this->db->select("parametros_nomina.parNom_aporteSalud");
        $this->db->select("parametros_nomina.parNom_aportePension");
        $this->db->select("parametros_nomina.parNom_aporteSena");
        $this->db->select("parametros_nomina.parNom_aporteICBF");
        $this->db->select("parametros_nomina.parNom_aporteCajaCompensacion");
        $this->db->order_by("parNom_id","desc");
        $parametros = $this->db->get("parametros_nomina");
        return $parametros->result();
    }
    
    function parametrosNomina(){
        $this->db->select("parametros_nomina.parNom_id");
        $this->db->select("parametros_nomina.parNom_salarioMinimo");
        $this->db->select("parametros_nomina.parNom_auxilioTransporte");
        $this->db->select("parametros_nomina.parNom_aporteSalud");
        $this->db->select("parametros_nomina.parNom_aportePension");
        $this->db->select("parametros_nomina.parNom_aporteSena");
        $this->db->select("parametros_nomina.parNom_aporteICBF");
        $this->db->select("parametros_nomina.parNom_aporteCajaCompensacion");
        $this->db->order_by("parNom_id","desc");
        $parametros = $this->db->get("parametros_nomina");
        return $parametros->result();
    }
    
    function guardarParametros($parametros){
        
        $this->db->insert("parametros_nomina",$parametros);
        
    }

}

?>