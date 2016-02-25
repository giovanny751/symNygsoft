<?php 
class Indicadorclasificaciontipo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
     function detail(){
        
         $tipo = $this->db->get("indicador_clasificacion_tipo");
         return $tipo->result();
         
    }
    function detailXClasificacion($idclasificacion){
        
        $this->db->where("claInd_id",$idclasificacion);
        $tipo = $this->db->get("indicador_clasificacion_tipo");
         return $tipo->result();
    }
}
?>
