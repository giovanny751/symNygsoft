<?php 
class Actividad_padre__model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function save_actividad_padre($post){
        try{
        if(isset($post['campo'])){ 
        $this->db->where($post["campo"],$post[$post["campo"]]);
        $id=$post[$post["campo"]];
            unset($post['campo']);
            $this->db->update('actividad_padre',$post);
        }else{
            $this->db->insert('actividad_padre',$post);
            $id=$this->db->insert_id();
        }
        return $id;
        }catch(exception $e){
            
        }
        
    }
    function delete_actividad_padre($post){
        try{
        $this->db->set('ACTIVO','N');
        $this->db->where($post["campo"],$post[$post["campo"]]);
        $this->db->update('actividad_padre');
        }catch(exception $e){
            
        }
    }
    function edit_actividad_padre($post){
        try{
        $this->db->where($post["campo"],$post[$post["campo"]]);
        $datos=$this->db->get('actividad_padre',$post);
        return $datos=$datos->result();
        }catch(exception $e){
            
        }
    }
    function consult_actividad_padre($post){
        try{
            if(isset($post['actPad_id']))
        if($post['actPad_id']!="")
        $this->db->like('actPad_id',$post['actPad_id']);
                    if(isset($post['actPad_nombre']))
        if($post['actPad_nombre']!="")
        $this->db->like('actPad_nombre',$post['actPad_nombre']);
                    if(isset($post['activo']))
        if($post['activo']!="")
        $this->db->like('activo',$post['activo']);
                                    $this->db->select('actPad_nombre');
                        $this->db->where('ACTIVO','S');
        $datos=$this->db->get('actividad_padre');
        $datos=$datos->result();
        return $datos;
        }catch(exception $e){
            
        }
    }
    function detail($id){
        try{
        $this->db->where("pla_id",$id);
        $this->db->order_by("actPad_nombre");
        $datos = $this->db->get("actividad_padre");
        return $datos->result();
        }catch(exception $e){
            
        }
    }
    
}
?>
