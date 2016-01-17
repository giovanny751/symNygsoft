<?php

class Avancetarea_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try{
            $avance = $this->db->get("avance_tarea");
            return $avance->result();
        }catch(excete $e){
            
        }
    }

    function detailxid($id, $cantidad = null, $orden,$inicia = null) {
        try{
        if (!empty($orden)):
            $data = array(
                "avaTar_fecha",
                "tar_id",
                "nombre",
                "avaTar_horasTrabajadas",
                "avaTar_costo",
                "avaTar_comentarios"
            );
            $this->db->order_by($data[$orden], "asc");
        endif;
        if($cantidad == -1)$cantidad = "";             
        $this->db->select("avaTar_fecha ");
        $this->db->select("tar_id ");
        $this->db->select("CONCAT(`user`.`usu_nombre`,' ',`user`.`usu_apellido`) as nombre", false);
        $this->db->select("avaTar_horasTrabajadas");
        $this->db->select("avaTar_costo ");
        $this->db->select("avaTar_comentarios");
        $this->db->where("tar_id", $id);
        $this->db->join("user", "user.usu_id = avance_tarea.usu_id");
        if(!empty($inicia))
        $avance = $this->db->get("avance_tarea", $inicia ,$cantidad);
        else
            $avance = $this->db->get("avance_tarea",$cantidad);
        return $avance->result_array();
        }catch(excete $e){
            
        }
    }
    function detailxidcount($id, $cantidad = null, $orden,$inicia = null){
        try{
        $this->db->select("avaTar_fecha ");
        $this->db->select("tar_id ");
        $this->db->select("CONCAT(`user`.`usu_nombre`,' ',`user`.`usu_apellido`) as nombre", false);
        $this->db->select("avaTar_horasTrabajadas");
        $this->db->select("avaTar_costo ");
        $this->db->select("avaTar_comentarios");
        $this->db->where("tar_id", $id);
        $this->db->join("user", "user.usu_id = avance_tarea.usu_id");
        $avance = $this->db->get("avance_tarea");
        return $avance->num_rows();
        }catch(excete $e){
            
        }
    }

    function create($data,$post) {
        try{
        if(empty($post['avaTar_id'])){
        $this->db->insert("avance_tarea", $data);
        $id=$this->db->insert_id();
        }else{
        $this->db->where("avaTar_id", $post['avaTar_id']);    
        $this->db->update("avance_tarea", $data);    
        $id=$post['avaTar_id'];
        }
        return $id;
        }catch(excete $e){
            
        }
    }
    function listado_avance($id){
        try{
        $this->db->select("avance_tarea.avaTar_id ");
        $this->db->select("avaTar_fecha ");
        $this->db->select("avance_tarea.tar_id ");
        $this->db->select("CONCAT(`user`.`usu_nombre`,' ',`user`.`usu_apellido`) as nombre", false);
        $this->db->select("avaTar_horasTrabajadas");
        $this->db->select("avaTar_costo ");
        $this->db->select("avaTar_comentarios");
        $this->db->select("tarea.tar_nombre");
        $this->db->where("avance_tarea.tar_id", $id);
        $this->db->join("tarea","tarea.tar_id = avance_tarea.tar_id");
        $this->db->join("user", "user.usu_id = avance_tarea.usu_id");
        $avance = $this->db->get("avance_tarea");
        return $avance->result();
        }catch(excete $e){
            
        }
    }
    function listado_avanceriesgo($rieCla_id){
        try{
        $this->db->select("avance_tarea.avaTar_id ");
        $this->db->select("avaTar_fecha ");
        $this->db->select("avance_tarea.tar_id ");
        $this->db->select("CONCAT(user.usu_nombre,' ',user.usu_apellido) as nombre", false);
        $this->db->select("avaTar_horasTrabajadas");
        $this->db->select("avaTar_costo ");
        $this->db->select("avaTar_comentarios");
        $this->db->select("tarea.tar_nombre");
        $this->db->where("tarea.rieCla_id", $rieCla_id);
        $this->db->join("tarea","tarea.tar_id = avance_tarea.tar_id");
        $this->db->join("user", "user.usu_id = avance_tarea.usu_id");
        $avance = $this->db->get("avance_tarea");
        return $avance->result();
        }catch(excete $e){
            
        }
    }
    function listadoAvancexPlan($id){
        try{
        $this->db->select("avance_tarea.avaTar_id ");
        $this->db->select("avaTar_fecha ");
        $this->db->select("avance_tarea.tar_id ");
        $this->db->select("CONCAT(`user`.`usu_nombre`,' ',`user`.`usu_apellido`) as nombre", false);
        $this->db->select("avaTar_horasTrabajadas");
        $this->db->select("avaTar_costo ");
        $this->db->select("avaTar_comentarios");
        $this->db->select("tarea.tar_nombre");
        $this->db->where("tarea.pla_id", $id);
        $this->db->join("tarea","tarea.tar_id = avance_tarea.tar_id");
        $this->db->join("user", "user.usu_id = avance_tarea.usu_id");
        $avance = $this->db->get("avance_tarea");
        return $avance->result();
        }catch(excete $e){
            
        }
    }
    
    function consulta($id_tarea){
        try{
        $this->db->select("avance_tarea.*", false);
        $this->db->select("CONCAT(`user`.`usu_nombre`,' ',`user`.`usu_apellido`) as nombre", false);
        $this->db->where('tar_id',$id_tarea);
        $this->db->join("user", "user.usu_id = avance_tarea.usu_id");
        $avance = $this->db->get("avance_tarea");
        return $avance->result();
        }catch(excete $e){
            
        }
    }
    function consulta2($id_tarea){
        try{
        $this->db->select("avance_tarea.*", false);
        $this->db->select("CONCAT(`user`.`usu_nombre`,' ',`user`.`usu_apellido`) as nombre", false);
        $this->db->where('avaTar_id',$id_tarea);
        $this->db->join("user", "user.usu_id = avance_tarea.usu_id");
        $avance = $this->db->get("avance_tarea");
        return $avance->result();
        }catch(excete $e){
            
        }
    }
    function eliminaravance($avaTar_id){
        try{
        $this->db->where("avaTar_id",$avaTar_id);
        $this->db->delete("avance_tarea");
        }catch(excete $e){
            
        }
        
    }
    function avancexTarea($avaTar_id){
        try{
        $this->db->where("avaTar_id",$avaTar_id);
        $data = $this->db->get("avance_tarea");
        return $data->result();
        }catch(excete $e){
            
        }
    }

}

?>