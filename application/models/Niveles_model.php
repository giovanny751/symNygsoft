<?php

class Niveles_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function nivelDeficiencia() {
        try {
            $this->db->select("nivDef_id");
            $this->db->select("nivDef_nivel");
            $this->db->select("nivDef_valor");
            $this->db->select("nivDef_significado");
            $nivel = $this->db->get("nivel_deficiencia");
            return $nivel->result();
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function nivelExposicion() {
        try {
            $this->db->select("nivExp_id");
            $this->db->select("nivExp_nivel");
            $this->db->select("nivExp_valor");
            $this->db->select("nivExp_Significado");
            $nivel = $this->db->get("nivel_exposicion");
            return $nivel->result();
        } catch (exception $e) {
            
        } finally {
            
        }
    }
    function nivelConsecuencia() {
        try {
            $this->db->select("nivCon_nivel");
            $this->db->select("nivCon_nc");
            $this->db->select("nivCon_significado");
            $nivel = $this->db->get("nivel_consecuencias");
            return $nivel->result();
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function nivelProbabilidad($deficiencia,$exposicion,$consecuencia = null) {
        try {
            $multiplicacion =  $deficiencia * $exposicion;
            
            $this->db->select("nivPro_Nivel");
            $this->db->select("nivPro_valMax");
            $this->db->select("nivPro_valMin");
            if(!empty($consecuencia)){
                $nivelRiesgo = $consecuencia * $multiplicacion;
            $this->db->select("(select nivRie_nivel from nivel_riesgo where nivRie_valorMax >= $nivelRiesgo and nivRie_valorMin <= $nivelRiesgo) as nivRie_nivel") ;
            $this->db->select("(select nivRie_tipo from nivel_riesgo where nivRie_valorMax >= $nivelRiesgo and nivRie_valorMin <= $nivelRiesgo) as nivRie_tipo") ;
            }
            $this->db->select("nivPro_significado");
            $this->db->where("nivPro_valMax >= ", $multiplicacion);
            $this->db->where("nivPro_valMin <= ", $multiplicacion);
            $nivel = $this->db->get("nivel_probabilidad");
            
//            echo $this->db->last_query();die;
            
            return $nivel->result();
        } catch (exception $e) {
            
        } finally {
            
        }
    }

}

?>