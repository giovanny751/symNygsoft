<?php

class Mis_archivos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function carpetas2($id = null) {

        $this->db->select('carpeta_documento.carDoc_id as idCarpeta');
        $this->db->select('carpeta_documento.carDoc_nombre as nombre');
        $this->db->select('carpeta_documento.carDoc_id_padre idpadre');
        if ($id != null)
            $this->db->where('carpeta_documento.carDoc_id_padre', $id);
        else
            $this->db->where('carpeta_documento.carDoc_id_padre', null);
        $this->db->where('est_id', '1');
        $this->db->order_by('carDoc_nombre');
        $datos = $this->db->get('carpeta_documento');

//        echo $this->db->last_query();
        return $datos = $datos->result();
    }

    function nombre_arbol($id) {
        $this->db->where('carDoc_id', $id);
        $this->db->where('est_id', '1');
        $datos = $this->db->get('carDoc_id');
        $datos = $datos->result();
        return $datos[0]->carDoc_nombre;
    }

    function new_folder($nuevaCarpeta, $idCarpetaPadre = null, $descripcion = null) {
        try {
            $this->db->trans_begin();
            if (!empty($idCarpetaPadre))
                $this->db->set('carDoc_id_padre', $idCarpetaPadre);
            $this->db->set('carDoc_nombre', $nuevaCarpeta);
            $this->db->set('carDoc_descripcion', $descripcion);
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date('Y-m-d H:i:s'));
            $this->db->insert('carpeta_documento');
            if ($this->db->trans_status() === FALSE) {
                $respuesta = $this->db->trans_rollback();
            } else {
                $respuesta = $this->db->insert_id();
                $this->db->trans_commit();
            }
        } catch (Exception $e) {
            
        } finally {
            return $respuesta;
        }
    }

    function consultaCarpetaXId($idCarpeta) {

        $this->db->where("carDoc_id", $idCarpeta);
        $this->db->order_by('carDoc_nombre');
        $carpeta = $this->db->get('carpeta_documento');
        return $carpeta->result();
    }

    function eliminarCarpeta($idCarpeta) {
        $this->db->trans_begin();
        $this->db->where("carDoc_id", $idCarpeta);
        $this->db->set("est_id", 3);
        $date = $this->db->update('carpeta_documento');
        if ($this->db->trans_status() === FALSE) {
            $respuesta = $this->db->trans_rollback();
        } else {
            $respuesta = $this->db->insert_id();
            $this->db->trans_commit();
        }
        return $this->db->trans_status();
    }

    function actualizarCarpeta($idCarpeta, $nombreCarpeta, $descripcion) {
        $this->db->trans_begin();
        $this->db->where("carDoc_id", $idCarpeta);
        $this->db->set("carDoc_nombre", $nombreCarpeta);
        $this->db->set("carDoc_descripcion", $descripcion);
        $this->db->set('modificationUser', $this->session->userdata('usu_id'));
        $date = $this->db->update('carpeta_documento');
        if ($this->db->trans_status() === FALSE) {
            $respuesta = $this->db->trans_rollback();
        } else {
            $respuesta = $this->db->insert_id();
            $this->db->trans_commit();
        }
        return $this->db->trans_status();
    }

    function carpetaDocumento($idCarpeta) {
        if (!empty($idCarpeta))
            $this->db->where('carDoc_id_padre', $idCarpeta);
        else
            $this->db->where('carDoc_id_padre', null);
        $this->db->order_by('carDoc_nombre');
        $date = $this->db->get('carpeta_documento');
        return $date->result();
    }

    function traer_folder() {
        $post = $this->input->post();
        if (!empty($post['id_carpeta']))
            $this->db->where('carDoc_id_padre', $post['id_carpeta']);
        else
            $this->db->where('carDoc_id_padre', null);
        $this->db->order_by('carDoc_nombre');
        $date = $this->db->get('carpeta_documento');
        return $date->result();
    }

    function traer_atras() {
        $post = $this->input->post();
        if (!empty($post['id_carpeta']))
            $this->db->where('carDoc_id', $post['id_carpeta']);
        else
            $this->db->where('carDoc_id_padre', null);
        $date = $this->db->get('carpeta_documento');
        $date = $date->result();
        return $date;
    }

    function descarga($id) {
        $this->db->where('repDoc_id', $id);
        $datos = $this->db->get('repositorio_documento');
        $datos = $datos->result();
        return $datos;
    }

    

}

?>