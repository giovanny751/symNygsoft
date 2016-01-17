<?php 
class Aseguradora_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function consulta_aseguradora($post){
        try{
        $this->db->select("aseguradoras.ase_id");
        $this->db->select("aseguradoras.ase_nombre");
        $this->db->where("tipAse_Id",$post);
        $this->db->where("aseguradoras.activo",'S');             
        $datos=$this->db->get('aseguradoras'); 
        $datos=$datos->result();
        return $datos;
        }catch(exception $e){
            
        }
    }

}
?>
