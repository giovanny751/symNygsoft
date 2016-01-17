<?php

class Solicitudriesgo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data){
        try{
            $id = false;
            $this->db->trans_begin();
            $this->db->insert("solicitud_riesgo",$data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $id = $this->db->insert_id();
                $this->db->trans_commit();
            }
        }  catch (Exception $e){
            $id = false;
        } finally {
            return $id;
        }
    }
    
    function filtroempleados($solicitud, $empleado, $dim1, $dim2, $fInicial, $fFinal){
        try {
            if (!empty($solicitud))
                $this->db->where('solicitud_riesgo.solRie_id', $solicitud);
            if (!empty($empleado))
                $this->db->where('empleado.Emp_Id', $empleado);
            if (!empty($dim1))
                $this->db->where('dimension.dim_id', $dim1);
            if (!empty($dim2))
                $this->db->where('dimension2.dim_id', $dim2);
            if((!empty($fInicial)) && (!empty($fFinal))){
                $this->db->where("solicitud_riesgo.creationDate >= '".$fInicial."' and solicitud_riesgo.creationDate <= '".$fFinal."'");
            }else if(!empty($fInicial)){
                $this->db->where("solicitud_riesgo.creationDate >= '".$fInicial."'");
            }else if (!empty($fFinal)){
                $this->db->where("solicitud_riesgo.creationDate <= '".$fFinal."'");
            }
            
            $this->db->select("solicitud_riesgo.solRie_id as solicitud");
            $this->db->select("solicitud_riesgo.solRie_correo as correo");
            $this->db->select("solicitud_riesgo.creationDate as fechaCreacion");
            $this->db->select("concat(empleado.Emp_Nombre,' ',empleado.Emp_Apellidos) as empleado",false);
            $this->db->select("dimension.dim_descripcion as dimension1");
            $this->db->select("dimension2.dim_descripcion as dimension2");
            
            $this->db->join("empleado","empleado.Emp_Id = solicitud_riesgo.emp_id","left");
            $this->db->join("dimension","dimension.dim_id = solicitud_riesgo.dim_id","left");
            $this->db->join("dimension2","dimension2.dim_id = solicitud_riesgo.dim2_id","left");
            
            $tabla = $this->db->get("solicitud_riesgo");
            return $tabla->result();
        } catch (exception $e) {
            
        }
    }
    
    function detailxid($solicitud){
        try {
            /** Pendiente */
            $this->db->where('solicitud_riesgo.solRie_id', $solicitud);
            
            
            $this->db->select("solicitud_riesgo.solRie_id as solicitud");
            $this->db->select("solicitud_riesgo.solRie_correo as correo");
            $this->db->select("solicitud_riesgo.creationDate as fechaCreacion");
            $this->db->select("solicitud_riesgo.solRie_descripcion as descripcion");
            $this->db->select("concat(empleado.Emp_Nombre,' ',empleado.Emp_Apellidos) as empleado",false);
            $this->db->select("dimension.dim_descripcion as dimension1");
            $this->db->select("dimension2.dim_descripcion as dimension2");
            
            $this->db->join("empleado","empleado.Emp_Id = solicitud_riesgo.emp_id","left");
            $this->db->join("dimension","dimension.dim_id = solicitud_riesgo.dim_id","left");
            $this->db->join("dimension2","dimension2.dim_id = solicitud_riesgo.dim2_id","left");
            
            $tabla = $this->db->get("solicitud_riesgo");
            return $tabla->result();
        } catch (exception $e) {
            
        }
    }
    
        

}

?>