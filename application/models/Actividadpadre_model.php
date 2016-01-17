<?php 
class Actividadpadre_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function create($id,$nombre,$pla_id,$actPad_id){
        try{
          $this->db->set("actPad_codigo",$nombre);
          $this->db->set("actPad_nombre",$id);
          $this->db->set("pla_id",$pla_id);
          if(empty($actPad_id)){
             $this->db->insert("actividad_padre"); 
          }else{
              $this->db->where("actPad_id",$actPad_id);
              $this->db->update("actividad_padre"); 
          }
        }catch(exception $e){
            
        }    
    }
    function detailxplaid($pla_id){
        try{
        $this->db->where("pla_id",$pla_id);
        $retult=$this->db->get('actividad_padre');
        return $retult->result();
        }catch(exception $e){
            
        }
    }
    function consultar_actividad_padre($actPad_id){
        try{
        $this->db->where('actPad_id',$actPad_id);
        $retult=$this->db->get('actividad_padre');
        return $retult->result();
        }catch(exception $e){
            
        }
    }
    function detailxid($id){
        try{
        $this->db->where("actividad_padre.pla_id",$id);
        $this->db->join("planes","planes.pla_id = actividad_padre.pla_id");
        $plan = $this->db->get("actividad_padre");
        return $plan->result();
        }catch(exception $e){
            
        }
    }
    function searchregister($idactividad,$descripcion,$pla_id){
        try{
        $this->db->select("actPad_id as uno, actPad_nombre as dos, actPad_codigo as tres");
        $this->db->where("actPad_nombre",$idactividad);
        $this->db->where("actPad_codigo",$descripcion);
        $this->db->where("pla_id",$pla_id);
        $data = $this->db->get("actividad_padre");
        return $data->result();
        }catch(exception $e){
            
        }
    }
    function cargardatos($actividad){
        try{
        $this->db->where("actPad_id",$actividad);
        $data = $this->db->get("actividad_padre");
        return $data->result();
        }catch(exception $e){
            
        }
    }
    function eliminaractividad($actividad){
        try{
        $this->db->where("actPad_id",$actividad);
        $data = $this->db->delete("actividad_padre");
        }catch(exception $e){
            
        }
    }
    function modificardatos($actividad,$id,$nombre){
        try{
        $this->db->where("actPad_id",$actividad);
        $this->db->set("actPad_nombre",$id);
        $this->db->set("actPad_codigo",$nombre);
        $this->db->update("actividad_padre");
        }catch(exception $e){
            
        }
    }
}
?>
