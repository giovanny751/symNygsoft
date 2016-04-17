<?php

class Repositoriodocumento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function saveFile($data) {

        if (!empty($this->input->post("nueva_version"))) {
            $this->db->set('est_id', 5);
            $this->db->where('repDoc_id', $this->input->post("nueva_version"));
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
            $this->db->update('repositorio_documento');

            $id_version = $this->nueva_version($this->input->post("nueva_version"));
            $this->db->set('repDoc_id_padre', $id_version);
        }
        $this->db->set('creatorUser', $this->session->userdata('usu_id'));
        $this->db->set('creatorDate', date("Y-m-d H:i:s"));
        $this->db->insert("repositorio_documento", $data);
    }

    function documentos($carpeta = "", $orden = null) {
        $carpetaPadre = "";
        if (!empty($orden) && $orden == 1 || empty($orden))
            $orden = " order by numero,nombre asc";
        if (!empty($orden) && $orden == 2)
            $orden = " order by numero,nombre desc";
        if (!empty($carpeta)) {
            $carpetaWhere = "and carDoc_id = " . $carpeta . " ";
            $carpetaPadre = " and IF(carDoc_id_padre != '',carDoc_id_padre,0) = " . $carpeta . " ";
        } else {
            $carpetaWhere = "and carDoc_id = 0";
            $carpetaPadre = " and IF(carDoc_id_padre != '',carDoc_id_padre,0) = 0";
        }
        $sql = "select * from ((select CONVERT(carDoc_nombre USING latin1) as nombre,carDoc_id,carDoc_descripcion,IF(carDoc_id_padre != '',carDoc_id_padre,0) as idpadre ,'carpeta' as extension,'1' as numero,'' as archivoId from carpeta_documento  where est_id = 1 {$carpetaPadre} {$orden})
            union
            (select CONVERT(repDoc_nombre USING latin1) as nombre,'',carDoc_id as idpadre,'' carDoc_descripcion,repDoc_extension as extension,'2' as numero,repDoc_id as archivoId  from repositorio_documento where est_id = 1 {$carpetaWhere}  {$orden})) tabla {$orden}";

        $repositorio = $this->db->query($sql);

//        echo $this->db->last_query();die;
        return $repositorio->result_array();
    }

    function eliminarArchivo($idCarpeta) {
        $this->db->trans_begin();
        $this->db->where("repDoc_id", $idCarpeta);
        $this->db->set("est_id", 3);
        $this->db->set('modificationUser', $this->session->userdata('usu_id'));
        $this->db->set('modificationDate', date("Y-m-d H:i:s"));
        $date = $this->db->update('repositorio_documento');
//        echo $this->db->last_query();die;
        if ($this->db->trans_status() === FALSE) {
            $respuesta = $this->db->trans_rollback();
        } else {
            $respuesta = $this->db->insert_id();
            $this->db->trans_commit();
        }
        return $this->db->trans_status();
    }

    function nueva_version($id) {
        $this->db->where('repDoc_id', $id);
        $datos = $this->db->get('repositorio_documento');
        $datos = $datos->result();
        if (!empty($datos[0]->repDoc_id_padre)) {
            return $datos[0]->repDoc_id_padre;
        } else
            return $id;
    }

    function oter_version($id) {
        $this->db->where('repDoc_id', $id);
        $datos = $this->db->get('repositorio_documento');
        $datos = $datos->result();
        if (!empty($datos[0]->repDoc_id_padre)) {
            $this->db->select('repositorio_documento.*,user.usu_nombre,user.usu_apellido,uss.usu_nombre uno,uss.usu_apellido dos');
            $this->db->where('(repDoc_id', $datos[0]->repDoc_id_padre, false);
            $this->db->or_where('repDoc_id_padre', $datos[0]->repDoc_id_padre.")", false);
//            $this->db->or_where('1', '1)', false);
            $this->db->join('user', 'repositorio_documento.modificationUser=user.usu_id', 'left');
            $this->db->join('user uss', 'repositorio_documento.creatorUser=uss.usu_id', 'left');
            $this->db->order_by('modificationDate');
            $datos = $this->db->get('repositorio_documento');
            $datos = $datos->result();
//            echo $this->db->last_query();
            return $datos;
        }
        return '';
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

