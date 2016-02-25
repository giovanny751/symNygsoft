<?php 
class Indicadoresclasificacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function detail(){
        
         $clasificacion = $this->db->get("indicadores_clasificacion");
         return $clasificacion->result();
         
    }
}
?>
