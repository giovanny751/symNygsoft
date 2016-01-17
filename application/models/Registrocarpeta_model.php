<?php

class Registrocarpeta_model extends CI_Model {

    function __construct() { 
        parent::__construct();
    } 
    
    function detail(){
        try {
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function detailxplan($pla_id){
        try {
        $this->db->where("registro_carpeta.pla_id",$pla_id);
        $this->db->select("registro_carpeta.regCar_id");
        $this->db->select("registro_carpeta.regCar_nombre");
        $this->db->select("registro_carpeta.regCar_descripcion");
        $this->db->select("registro.reg_version");
        $this->db->select("registro.reg_descripcion");
        $this->db->select("registro.reg_fechaCreacion");
        $this->db->select("registro.reg_id");
        $this->db->select("registro.reg_archivo");
        $this->db->select("registro.reg_tamano");
        $this->db->select("user.usu_nombre");
        $this->db->select("user.usu_apellido");
        $this->db->join("registro","registro.regCar_id = registro_carpeta.regCar_id","LEFT");
        $this->db->join("user","user.usu_id = registro.userCreator");
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function detailxriesgo($rie_id){
        try {
        $this->db->where("registro_carpeta.rie_id",$rie_id);
        $this->db->select("registro_carpeta.regCar_id");
        $this->db->select("registro_carpeta.regCar_nombre");
        $this->db->select("registro_carpeta.regCar_descripcion");
        $this->db->select("registro.reg_version");
        $this->db->select("registro.reg_descripcion");
        $this->db->select("registro.reg_fechaCreacion");
        $this->db->select("registro.reg_ruta");
        $this->db->select("registro.reg_id");
        $this->db->select("registro.reg_archivo");
        $this->db->select("registro.reg_tamano");
        $this->db->select("user.usu_nombre");
        $this->db->select("user.usu_apellido");
        $this->db->join("registro","registro.regCar_id = registro_carpeta.regCar_id","LEFT");
        $this->db->join("user","user.usu_id = registro.userCreator","left");
        $carpeta = $this->db->get("registro_carpeta");
//        echo $this->db->last_query();die; 
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function consultaCarpetaxIdIndicador($regCar_id){
        try {
        $this->db->where("registro_carpeta.regCar_id",$regCar_id);
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function detailxindicador($ind_id){
        try {
        $this->db->where("registro_carpeta.ind_id",$ind_id);
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    
    function consultaIndicadoryRegistroxInd($id) {
        try {
            $this->db->select("registro_carpeta.regCar_id");
            $this->db->select("registro_carpeta.ind_id");
            $this->db->select("registro_carpeta.regCar_nombre");
            $this->db->select("registro_carpeta.regCar_descripcion");
            $this->db->select("registro.reg_tamano");
            $this->db->select("registro.reg_version");
            $this->db->select("registro.reg_descripcion");
            $this->db->select("registro.reg_id");
            $this->db->select("registro.reg_ruta");
            $this->db->select("registro.reg_archivo");
            $this->db->select("registro.reg_fechaCreacion");
            $this->db->select("user.usu_nombre");
            $this->db->select("user.usu_apellido");
            $this->db->where("registro_carpeta.ind_id", $id);
            $this->db->join("registro","registro.regCar_id = registro_carpeta.regCar_id","left");
            $this->db->join("user","user.usu_id = registro.userCreator","Left");
            $valor = $this->db->get("registro_carpeta");
            return $valor->result();
        } catch (exception $e) {
            
        }
    }
    
    function detailxtarea($tar_id,$regCar_id = null){
        try {
        if(!empty($regCar_id))$this->db->where("registro_carpeta.regCar_id",$regCar_id);
        $this->db->select("registro_carpeta.regCar_id");
        $this->db->select("registro_carpeta.regCar_nombre");
        $this->db->select("registro_carpeta.regCar_descripcion");
        $this->db->select("registro.reg_version");
        $this->db->select("registro.reg_descripcion");
        $this->db->select("registro.reg_fechaCreacion");
        $this->db->select("registro.reg_id");
        $this->db->select("registro.reg_archivo");
        $this->db->select("registro.reg_tamano");
        $this->db->select("user.usu_nombre");
        $this->db->select("user.usu_apellido");
        $this->db->join("registro","registro.regCar_id = registro_carpeta.regCar_id","LEFT");
        $this->db->join("user","user.usu_id = registro_carpeta.userCreator");
        $this->db->where("registro_carpeta.tar_id",$tar_id);
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function detailxtareas($tar_id){
        try {
        $this->db->where("registro_carpeta.tar_id",$tar_id);
        $this->db->select("registro_carpeta.regCar_id");
        $this->db->select("registro_carpeta.regCar_nombre");
        $this->db->select("registro_carpeta.regCar_descripcion");
        $this->db->select("registro.reg_id");
        $this->db->select("registro.reg_version");
        $this->db->select("registro.reg_descripcion");
        $this->db->select("registro.reg_ruta");
        $this->db->select("registro.reg_archivo");
        $this->db->select("registro.reg_tamano");
        $this->db->select("registro.reg_fechaCreacion");
        $this->db->select("user.usu_nombre");
        $this->db->select("user.usu_apellido");
        $this->db->join("registro","registro.regCar_id = registro_carpeta.regCar_id","LEFT");
        $this->db->join("user","user.usu_id = registro.userCreator","LEFT");
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function detailxtareascarpetas($tar_id){
        try {
        $this->db->where("registro_carpeta.tar_id",$tar_id);
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function detailxplancarpetas($pla_id){
        try {
        $this->db->where("registro_carpeta.pla_id",$pla_id);
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function detailxriesgocarpetas($rie_id){
        try {
        $this->db->where("registro_carpeta.rie_id",$rie_id);
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function allfolders(){
        try {
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function detailxid($regCar_id){
        try {
        $this->db->select("regCar_id as uno, regCar_nombre as dos,regCar_descripcion as tres");
        $this->db->where("regCar_id",$regCar_id);
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function allfolders2($id) {
        try {
            $this->db->where("tar_id", $id);
            $carpeta = $this->db->get("registro_carpeta");
            return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function detailxplannombre($pla_id,$nombre,$descripcion){
        try {
        $this->db->where("regCar_nombre",$nombre);
        $this->db->where("regCar_descripcion",$descripcion);
        $this->db->where("pla_id",$pla_id);
        $carpeta = $this->db->get("registro_carpeta");
        echo $this->db->last_query();die;
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }

    function create($nombre,$descripcion,$pla_id) {
        try {
        $data = array(
          "regCar_nombre"=>$nombre,  
          "regCar_descripcion"=>$descripcion,
          "regCar_fechaCreacion"=>date('Y-m-d H:i:s'),
          "pla_id"=> $pla_id 
        );
        $this->db->insert("registro_carpeta",$data);
        return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }
    function createRiesgo($nombre,$descripcion,$rie_id,$usu_id) {
        try {
        $data = array(
          "regCar_nombre"=>$nombre,  
          "regCar_descripcion"=>$descripcion,
          "regCar_fechaCreacion"=>date('Y-m-d H:i:s'),
          "rie_id"=> $rie_id,
          "userCreator"=>$usu_id  
        );
        $this->db->insert("registro_carpeta",$data);
        return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }
    function guardarCarpeta($data) {
        try {
        $this->db->insert("registro_carpeta",$data);
        return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }
    function createtarea($nombre,$descripcion,$tar_id,$usu_id) {
        try {
        $data = array(
          "regCar_nombre"=>$nombre,  
          "regCar_descripcion"=>$descripcion,
          "regCar_fechaCreacion"=>date('Y-m-d H:i:s'),
          "tar_id"=> $tar_id, 
          "userCreator"=>$usu_id
        );
        $this->db->insert("registro_carpeta",$data);
        return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }
    function cargarcarpetas($regCar_id){
        try {
        $this->db->where("regCar_id",$regCar_id);
        $carpeta = $this->db->get("registro_carpeta");
        return $carpeta->result();
        } catch (exception $e) {
            
        }
    }
    function eliminarcarpeta($regCar_id){
        try {
        $this->db->where("regCar_id",$regCar_id);
        $this->db->delete("registro_carpeta");
        } catch (exception $e) {
            
        }
    }
    function modificarpeta($nombre,$descripcion,$regCar_id){
        try {
        $this->db->where("regCar_id",$regCar_id);
        $this->db->set("regCar_nombre",$nombre);
        $this->db->set("regCar_descripcion",$descripcion);
        $this->db->set("regCar_fechaModificacion",date('Y-m-d H:i:s'));
        $this->db->update("registro_carpeta");
        } catch (exception $e) {
            
        }
    }
}

?>