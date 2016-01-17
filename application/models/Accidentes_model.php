<?php

class Accidentes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert($data){
        try{
            $id = false;
            $this->db->trans_begin();
            $this->db->insert("accidentes",$data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                throw new Exception("Error al insertar en la base de datos");
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
    function update($data,$id){
        try{
            $id = false;
            $this->db->trans_begin();
            $this->db->where("acc_id",$id);
            $this->db->update("accidentes",$data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                throw new Exception("Error al modificar en la base de datos");
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
    
    function detail() {
        try {
            $this->db->order_by("tipEve_descripcion","asc");
            $tipo = $this->db->get("tipo_evento");
            return $tipo->result();
        } catch (exception $e) {
            
        }
    }
    
    function detailAccidente($idAccidente){
        try{
            
            $this->db->select("accidentes.acc_id as id");
            $this->db->select("accidentes.emp_id as empleado");
            $this->db->select("accidentes.acc_lugar as lugar");
            $this->db->select("accidentes.dim1_id as dimension1");
            $this->db->select("accidentes.dim2_id as dimension2");
            $this->db->select("accidentes.acc_zona as zona");
            $this->db->select("accidentes.acc_jefeInmediato as jefeInmediato");
            $this->db->select("accidentes.tipEve_id as tipoEvento");
            $this->db->select("accidentes.acc_lugarAccidente as lugarAccidente");
            $this->db->select("accidentes.acc_fechaAccidente as fechaAccidente");
            $this->db->select("accidentes.acc_descripcion as descripcion");
            $this->db->select("accidentes.acc_reportado as reportado");
            
            $this->db->select("empleado_incapacidad.empInc_fechaInicio as fechaInicio");
            $this->db->select("empleado_incapacidad.empInc_fechaFinal as fechaFinal");
            $this->db->select("empleado_incapacidad.empRes_id as responsable");
            
            $this->db->select("accidentes_clase_evento.accClaEve_id as accidenteEvento");
            $this->db->select("accidentes_clase_evento.claEve_id as claseEvento");
            $this->db->select("accidentes_partes_cuerpo.accParCue_id as accidenteParte");
            $this->db->select("accidentes_partes_cuerpo.parCue_id as parteCuerpo");
            $this->db->select("accidentes_correo.accCor_id as accidenteCorreo");
            $this->db->select("accidentes_correo.accCor_correo as correo");
            $this->db->select("accidentes_riesgo_clasificacion.accRieCla_id as accidenteRiesgoCla");
            $this->db->select("accidentes_riesgo_clasificacion.rieCla_id as riesgoCla");
            $this->db->select("accidentes_riesgo_clasificacion_tipo.accRieClaTip_id as accidenteRiesgoClaTip");
            $this->db->select("accidentes_riesgo_clasificacion_tipo.rieClaTip_id as RiesgoClaTip");
            
            $this->db->join("tipo_evento","tipo_evento.tipEve_id = accidentes.tipEve_id","left");
            $this->db->join("empleado_incapacidad","empleado_incapacidad.acc_id = accidentes.acc_id","left");
            $this->db->join("accidentes_clase_evento","accidentes_clase_evento.acc_id = accidentes.acc_id","left");
            $this->db->join("accidentes_correo","accidentes_correo.acc_id = accidentes.acc_id","left");
            $this->db->join("accidentes_partes_cuerpo","accidentes_partes_cuerpo.acc_id = accidentes.acc_id","left");
            $this->db->join("accidentes_riesgo_clasificacion","accidentes_riesgo_clasificacion.acc_id = accidentes.acc_id","left");
            $this->db->join("accidentes_riesgo_clasificacion_tipo","accidentes_riesgo_clasificacion_tipo.accRieCla_id = accidentes_riesgo_clasificacion.accRieCla_id","left");
            $this->db->join("dimension","dimension.dim_id = accidentes.dim1_id","left");
            $this->db->join("dimension2","dimension2.dim_id = accidentes.dim2_id","left");
            
            $this->db->where("accidentes.acc_id",9);
            
            $resultado = $this->db->get("accidentes");
            return $resultado->result();
        }catch(Exception $e){
            
        }  finally {
            
        }
    }
    
    function filtroaccidente($reporte, $empleado, $dim1, $dim2, $zona, $lugar, $fInicial, $fFinal, $fCreacion, $incapacidad){
        try {
            if (!empty($reporte))
                $this->db->where('accidentes.acc_id', $reporte);
            if (!empty($empleado))
                $this->db->where('empleado.Emp_Id', $empleado);
            if (!empty($dim1))
                $this->db->where('dimension.dim_id', $dim1);
            if (!empty($dim2))
                $this->db->where('dimension2.dim_id', $dim2);
            if (!empty($zona))
                $this->db->like('accidentes.acc_zona', $zona);
            if (!empty($lugar))
                $this->db->like('accidentes.acc_lugar', $lugar);
            if (!empty($fCreacion))
                $this->db->where("accidentes.creationDate > '".$fCreacion." 00:00:00' and accidentes.creationDate < '".$fCreacion." 23:59:59'" );
            
            if((!empty($fInicial)) && (!empty($fFinal))){
                $this->db->where("accidentes.acc_fechaAccidente >= '".$fInicial."' and accidentes.acc_fechaAccidente <= '".$fFinal." 23:59:59'");
            }else if(!empty($fInicial)){
                $this->db->where("accidentes.acc_fechaAccidente >= '".$fInicial."'");
            }else if (!empty($fFinal)){
                $this->db->where("accidentes.acc_fechaAccidente <= '".$fFinal." 23:59:59'");
            }
            if ($incapacidad != ""){
                if ($incapacidad == 0){
                    $this->db->where('empleado_incapacidad.acc_id is null');
                }else if ($incapacidad == 1){
                    $this->db->where('empleado_incapacidad.acc_id is not null');
                }
            }
            
            $this->db->select("accidentes.acc_id as accidente");
            $this->db->select("concat(empleado.Emp_Nombre,' ',empleado.Emp_Apellidos) as empleado",false);
            $this->db->select("accidentes.acc_zona as zona");
            $this->db->select("accidentes.acc_lugar as lugar");
            $this->db->select("dimension.dim_descripcion as dimension1");
            $this->db->select("dimension2.dim_descripcion as dimension2");
            $this->db->select("accidentes.acc_lugarAccidente as lugarAccidente");
            $this->db->select("accidentes.acc_fechaAccidente as fechaAccidente");
            $this->db->select("accidentes.acc_reportado as reportado");
            $this->db->select("accidentes.creationDate as fCreacion");
            $this->db->select("case ISNULL(empleado_incapacidad.acc_id) when 'null' then '1' else '0' end as incapacidad",false);
            //$this->db->select("case (select count(*) from empleado_incapacidad where empleado_incapacidad.acc_id = accidentes.acc_id) when 'null' then '0' else '1' end as incapacidad",false);
            
            $this->db->join("empleado","empleado.Emp_Id = accidentes.emp_id","left");
            $this->db->join("dimension","dimension.dim_id = accidentes.dim1_id","left");
            $this->db->join("dimension2","dimension2.dim_id = accidentes.dim2_id","left");
            $this->db->join("empleado_incapacidad","empleado_incapacidad.acc_id = accidentes.acc_id","left");
            $tabla = $this->db->get("accidentes");
            return $tabla->result();
        } catch (exception $e) {
            
        }
    }

}

?>