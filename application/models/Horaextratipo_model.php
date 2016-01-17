<?php

class Horaextratipo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

   function tipos(){
       try{
           $tipo = $this->db->get("hora_extra_tipo");
       }catch(exception $e){
           
       }finally{
           return $tipo->result();
       }
   }
   function detalleXEmpleado($id){
       
       $this->db->join("hora_extra_tipo","empleado_horas_extra.horExtTip_id = hora_extra_tipo.horExtTip_id");
       $hora = $this->db->get("empleado_horas_extra");
       return $hora->result();
   }

}

?>