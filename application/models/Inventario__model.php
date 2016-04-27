<?php

class Inventario__model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_inventario($post) {
        if (isset($post['campo'])) {
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $id = $post[$post["campo"]];
            unset($post['campo']);
            $this->db->update('inventario', $post);
        } else {
            $this->db->insert('inventario', $post);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    function delete_inventario($post) {
        if($post["campo"]!=1){
        $this->db->set('est_id', '3');
        $this->db->where($post["campo"], $post[$post["campo"]]);
        $this->db->update('inventario');
        }
    }

    function edit_inventario($post) {
        $this->db->where($post["campo"], $post[$post["campo"]]);
        $datos = $this->db->get('inventario', $post);
        return $datos = $datos->result();
    }

    function consult_inventario($post) {
        if (isset($post['inv_id']))
            if ($post['inv_id'] != "")
                $this->db->like('inv_id', $post['inv_id']);
        if (isset($post['inv_referencia']))
            if ($post['inv_referencia'] != "")
                $this->db->like('inv_referencia', $post['inv_referencia']);
        if (isset($post['inv_nombre']))
            if ($post['inv_nombre'] != "")
                $this->db->like('inv_nombre', $post['inv_nombre']);
        if (isset($post['inv_unidades']))
            if ($post['inv_unidades'] != "")
                $this->db->like('inv_unidades', $post['inv_unidades']);
        if (isset($post['inv_marca']))
            if ($post['inv_marca'] != "")
                $this->db->like('inv_marca', $post['inv_marca']);
        if (isset($post['inv_modelo']))
            if ($post['inv_modelo'] != "")
                $this->db->like('inv_modelo', $post['inv_modelo']);
        if (isset($post['inv_serie']))
            if ($post['inv_serie'] != "")
                $this->db->like('inv_serie', $post['inv_serie']);
        if (isset($post['inv_fecha_ingreso']))
            if ($post['inv_fecha_ingreso'] != "")
                $this->db->like('inv_fecha_ingreso', $post['inv_fecha_ingreso']);
        if (isset($post['inv_imagen']))
            if ($post['inv_imagen'] != "")
                $this->db->like('inv_imagen', $post['inv_imagen']);
        if (isset($post['inv_dias_vencimiento']))
            if ($post['inv_dias_vencimiento'] != "")
                $this->db->like('inv_dias_vencimiento', $post['inv_dias_vencimiento']);
        if (isset($post['est_id']))
            if ($post['est_id'] != "")
                $this->db->like('est_id', $post['est_id']);
        $this->db->select('inv_id');
        $this->db->select('inv_referencia');
        $this->db->select('inv_nombre');
        $this->db->select('inv_unidades');
        $this->db->select('inv_marca');
        $this->db->select('inv_modelo');
        $this->db->select('inv_serie');
        $this->db->select('inv_fecha_ingreso');
        $this->db->select('inv_dias_vencimiento');
        $this->db->where('est_id', '1');
        $datos = $this->db->get('inventario');
        $datos = $datos->result();
        return $datos;
    }

}

?>
