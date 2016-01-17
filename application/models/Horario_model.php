<?php

class Horario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

   function tipos(){
       try{
           $tipo = $this->db->get("horario");
       }catch(exception $e){
           
       }finally{
           return $tipo->result();
       }
   }

}

?>