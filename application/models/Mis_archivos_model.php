<?php

class Mis_archivos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function carpetas2($id = null) {
        $this->db->select('*');
        if ($id != null) {
//            $this->db->where('(1', '1', FALSE);
            $this->db->where('carDoc_id_padre', $id);
//            $this->db->or_where('carDoc_id', $id . ')', false);
        } else
            $this->db->where('carDoc_id_padre', null);
        $this->db->where('ACTIVO', 'S');
        $this->db->order_by('carDoc_id_padre,carDoc_nombre');
        $datos = $this->db->get('carpeta_documento');

//        echo $this->db->last_query();
        return $datos = $datos->result();
    }

    function new_folder() {
        $post = $this->input->post();
        if (!empty($post['id_carpeta']))
            $this->db->set('carDoc_id_padre', $post['id_carpeta']);
        $this->db->set('carDoc_nombre', $post['nueva_carpeta']);
        $this->db->insert('carpeta_documento');
        $id = $this->db->insert_id();
        if (!empty($post['id_carpeta']))
            $this->db->where('carDoc_id_padre', $post['id_carpeta']);
        else
            $this->db->where('carDoc_id_padre', null);
        $date = $this->db->get('carpeta_documento');
        return $date->result();
    }

    function traer_folder() {
        $post = $this->input->post();
        if (!empty($post['id_carpeta']))
            $this->db->where('carDoc_id_padre', $post['id_carpeta']);
        else
            $this->db->where('carDoc_id_padre', null);
        $date = $this->db->get('carpeta_documento');
//        echo $this->db->last_query();
        return $date->result();
    }

    function traer_atras() {
        $post = $this->input->post();
        if (!empty($post['id_carpeta']))
            $this->db->where('carDoc_id_padre', $post['id_carpeta']);
        else
            $this->db->where('carDoc_id_padre', null);
        $date = $this->db->get('carpeta_documento');
        $date = $date->result();
        if (empty($date[0]->carDoc_id_padre)) {
            $this->db->where('carDoc_id_padre', null);
            $date = $this->db->get('carpeta_documento');
            $date = $date->result();
        }

//        echo $this->db->last_query();
        return $date;
    }

}

?>