<?php

class Riesgo_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardarriesgo($data) {
        try {
            $this->db->insert("riesgo", $data);
        } catch (exception $e) {
            
        }
    }

    function atualizarriesgo($id, $data) {
        try {
            $this->db->where("rie_id", $id);
            $this->db->update("riesgo", $data);
        } catch (exception $e) {
            
        }
    }

    function create($data) {
        try {
            $this->db->trans_begin();
            $this->db->insert("riesgo", $data);
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $id = $this->db->insert_id();
                $this->db->trans_commit();
                return $id;
            }
        } catch (exception $e) {
            
        }
    }

    function eliminar_riesgos($post) {
        $this->db->where("rie_id", $post['rie_id']);
        $this->db->delete('riesgo');
        return true;
    }
    function detailxid($id) {
        try {
            $this->db->where("rie_id", $id);
            $tarea = $this->db->get("riesgo");
            return $tarea->result();
        } catch (exception $e) {
            
        }
    }

    function filtrobusqueda($cargo, $categoria, $dimension, $dimension2, $tipo) {
        try {
            
            if (!empty($cargo))
                $this->db->where("riesgo_cargo.rieCar_id", $cargo);
            if (!empty($categoria))
                $this->db->where("riesgo.rieCla_id", $categoria);
            if (!empty($dimension2))
                $this->db->where("riesgo.dim2_id", $dimension2);
            if (!empty($dimension))
                $this->db->where("riesgo.dim1_id", $dimension);
            if (!empty($tipo))
                $this->db->where("riesgo.rieClaTip_id", $tipo);
            
            $this->db->select("riesgo.rie_id");
            $this->db->select("dimension2.dim_descripcion as des2");
            $this->db->select("dimension.dim_descripcion as des1");
            $this->db->select("estado_aceptacion.estAce_estado as estado");
            $this->db->select("riesgo.rie_zona");
            $this->db->select("riesgo.rie_descripcion");
            $this->db->select("riesgo.rie_fecha");
            $this->db->select("riesgo_clasificacion_tipo.rieClaTip_tipo");
            $this->db->select("riesgo_clasificacion.rieCla_id");
            $this->db->select("riesgo_clasificacion.rieCla_categoria");
            $this->db->select("riesgo_color.rieCol_colorhtml");
            $this->db->select("riesgo.rie_actividad");
            $this->db->select("(select count(tar_id) from tarea_riesgos where tarea_riesgos.rie_id = riesgo.rie_id) as cantidadTareas");
            $this->db->join("riesgo_clasificacion", "riesgo_clasificacion.rieCla_id = riesgo.rieCla_id","left");
            $this->db->join("riesgo_clasificacion_tipo", "riesgo_clasificacion_tipo.rieClaTip_id = riesgo.rieClaTip_id", "left");
            $this->db->join("dimension2", "dimension2.dim_id = riesgo.dim2_id","left");
            $this->db->join("dimension", "dimension.dim_id = riesgo.dim1_id","left");
            $this->db->join("estado_aceptacion", "estado_aceptacion.estAce_id = riesgo.estAce_id","left");
            $this->db->join("estado_aceptacion_color","estado_aceptacion_color.estAce_id = estado_aceptacion.estAce_id","LEFT");
            $this->db->join("riesgo_color","riesgo_color.rieCol_id = estado_aceptacion_color.rieCol_id","LEFT");
            $riesgo = $this->db->get("riesgo");
//            echo $this->db->last_query();die;
            return $riesgo->result();
        } catch (exception $e) {
            
        }
    }

    function riesgocargo($riesgocargo) {
        try {
            $this->db->insert_batch("riesgo_cargo", $riesgocargo);
        } catch (exception $e) {
            
        }
    }

    function consultaRiesgoFlechas($idRiesgo, $metodo) {
        try {
            switch ($metodo) {
                case "flechaIzquierdaDoble":
                    $this->db->where("rie_id = (select min(rie_id) from riesgo)");
                    break;
                case "flechaIzquierda":
                    $this->db->where("rie_id < '" . $idRiesgo . "' ");
                    $this->db->order_by("rie_id desc");
                    break;
                case "flechaDerecha":
                    $this->db->where("rie_id > '" . $idRiesgo . "' ");
                    $this->db->order_by("rie_id asc");
                    break;
                case "flechaDerechaDoble":
                    $this->db->where("rie_id = (select max(rie_id) from riesgo)");
                    break;
                default :
                    die;
                    break;
            }
            $usuario = $this->db->get("riesgo", 1);
            return $usuario->result();
        } catch (exception $e) {
            
        }
    }
    function matrizRiesgo(){
        try{
            $this->db->select("planes.pla_nombre");
            $this->db->select("actividad_padre.actPad_nombre");
            $this->db->select("actividad_hijo.actHij_nombre");
            $this->db->select("tarea.tar_descripcion");
            $this->db->select("riesgo.rie_descripcion");
            $this->db->select("tarea.tar_rutinario");
            $this->db->select("riesgo_clasificacion.rieCla_categoria");
            $this->db->select("riesgo_clasificacion_tipo.rieClaTip_tipo");
            $this->db->join("actividad_padre","actividad_padre.pla_id = planes.pla_id","left");  
            $this->db->join("actividad_hijo","actividad_hijo.actHij_padreid = actividad_padre.actPad_id","left");  
            $this->db->join("tarea","tarea.actHij_id = actividad_hijo.actHij_id","left");
            $this->db->join("tarea_riesgos","tarea_riesgos.tar_id = tarea.tar_id","left");
            $this->db->join("riesgo","riesgo.rie_id = tarea_riesgos.rie_id","left");
            $this->db->join("riesgo_clasificacion","riesgo_clasificacion.rieCla_id = riesgo.rieCla_id","left");
            $this->db->join("riesgo_clasificacion_tipo","riesgo_clasificacion_tipo.rieCla_id = riesgo_clasificacion.rieCla_id","left");
            $matriz = $this->db->get("planes");
//            echo $this->db->last_query();die;
        }catch(exception $e){
            
        }finally{
            return $matriz->result();
        }
    }

}

?>