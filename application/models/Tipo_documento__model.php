<?php

class Tipo_documento__model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_tipo_documento($post) {
        try {
            if (isset($post['campo'])) {
                $this->db->where($post["campo"], $post[$post["campo"]]);
                $id = $post[$post["campo"]];
                unset($post['campo']);
                $this->db->update('tipo_documento', $post);
            } else {
                $this->db->insert('tipo_documento', $post);
                $id = $this->db->insert_id();
            }
            return $id;
        } catch (exception $e) {
            
        }
    }

    function delete_tipo_documento($post) {
        try {
            $this->db->set('ACTIVO', 'N');
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $this->db->update('tipo_documento');
        } catch (exception $e) {
            
        }
    }

    function edit_tipo_documento($post) {
        try {
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $datos = $this->db->get('tipo_documento', $post);
            return $datos = $datos->result();
        } catch (exception $e) {
            
        }
    }

    function consult_tipo_documento($post) {
        try {
            if (isset($post['tipDoc_tipo']))
                if ($post['tipDoc_tipo'] != "")
                    $this->db->like('tipDoc_tipo', $post['tipDoc_tipo']);
            if (isset($post['tipDoc_Descripcion']))
                if ($post['tipDoc_Descripcion'] != "")
                    $this->db->like('tipDoc_Descripcion', $post['tipDoc_Descripcion']);
            if (isset($post['ACTIVO']))
                if ($post['ACTIVO'] != "")
                    $this->db->like('ACTIVO', $post['ACTIVO']);
            $this->db->select('tipDoc_Id,tipDoc_Descripcion');
            $this->db->where('ACTIVO', 'S');
            $datos = $this->db->get('tipo_documento');
            $datos = $datos->result();
            return $datos;
        } catch (exception $e) {
            
        }
    }

}

?>
