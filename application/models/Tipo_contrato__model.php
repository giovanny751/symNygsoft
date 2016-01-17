<?php

class Tipo_contrato__model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_tipo_contrato($post) {
        try {
            if (isset($post['campo'])) {
                $this->db->where($post["campo"], $post[$post["campo"]]);
                $id = $post[$post["campo"]];
                unset($post['campo']);
                $this->db->update('tipo_contrato', $post);
            } else {
                $this->db->insert('tipo_contrato', $post);
                $id = $this->db->insert_id();
            }
            return $id;
        } catch (exception $e) {
            
        }
    }

    function delete_tipo_contrato($post) {
        try {
            $this->db->set('ACTIVO', 'N');
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $this->db->update('tipo_contrato');
        } catch (exception $e) {
            
        }
    }

    function edit_tipo_contrato($post) {
        try {
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $datos = $this->db->get('tipo_contrato', $post);
            return $datos = $datos->result();
        } catch (exception $e) {
            
        }
    }

    function consult_tipo_contrato($post) {
        try {
            if (isset($post['TipCon_Id']))
                if ($post['TipCon_Id'] != "")
                    $this->db->like('TipCon_Id', $post['TipCon_Id']);
            if (isset($post['TipCon_Descripcion']))
                if ($post['TipCon_Descripcion'] != "")
                    $this->db->like('TipCon_Descripcion', $post['TipCon_Descripcion']);
            if (isset($post['activo']))
                if ($post['activo'] != "")
                    $this->db->like('activo', $post['activo']);
            $this->db->select('TipCon_Id,TipCon_Descripcion');
            $this->db->where('ACTIVO', 'S');
            $datos = $this->db->get('tipo_contrato');
            $datos = $datos->result();
            return $datos;
        } catch (exception $e) {
            
        }
    }

    function exist($name) {
        try {
            $this->db->where("TipCon_Descripcion", $name);
            $tipo = $this->db->get("tipo_contrato");
            return $tipo->result();
        } catch (exception $e) {
            
        }
    }

}

?>
