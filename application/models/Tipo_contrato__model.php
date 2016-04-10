<?php

class Tipo_contrato__model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function tipoContrato() {
        $this->db->where("activo", "S");
        $tipo = $this->db->get("tipo_contrato");
        return $tipo->result();
    }

    function save_tipo_contrato($post) {
        try {
            if (isset($post['campo'])) {
                $this->db->where($post["campo"], $post[$post["campo"]]);
                $id = $post[$post["campo"]];
                unset($post['campo']);
                $this->db->set('modificationUser', $this->session->userdata('usu_id'));
                $this->db->set('modificationDate', date("Y-m-d H:i:s"));
                $this->db->update('tipo_contrato', $post);
            } else {
                $this->db->set('creatorUser', $this->session->userdata('usu_id'));
                $this->db->set('creatorDate', date("Y-m-d H:i:s"));
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
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
            $this->db->update('tipo_contrato');
        } catch (exception $e) {
            
        }
    }

    function edit_tipo_contrato($idTipoContrato, $tipoContrato) {
        try {
            $this->db->where('TipCon_Id', $idTipoContrato);
            $this->db->set("TipCon_Descripcion", $tipoContrato);
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
            $this->db->update('tipo_contrato');
//            echo $this->db->last_query();die;
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
