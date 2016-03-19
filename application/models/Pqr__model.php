<?php

class Pqr__model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_pqr($post) {
        if (isset($post['campo'])) {
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $id = $post[$post["campo"]];
            unset($post['campo']);
            $this->db->update('pqr', $post);
        } else {
            $this->db->insert('pqr', $post);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    function delete_pqr($post) {
        $this->db->set('ACTIVO', 'N');
        $this->db->where($post["campo"], $post[$post["campo"]]);
        $this->db->update('pqr');
    }

    function edit_pqr($post) {
        $this->db->where($post["campo"], $post[$post["campo"]]);
        $datos = $this->db->get('pqr', $post);
        return $datos = $datos->result();
    }

    function consult_pqr($post) {
        if (isset($post['pqr_id']))
            if ($post['pqr_id'] != "")
                $this->db->where('pqr_id', $post['pqr_id']);
        if (isset($post['tipSol_id']))
            if ($post['tipSol_id'] != "")
                $this->db->like('tipSol_id', $post['tipSol_id']);
        if (isset($post['temSol_id']))
            if ($post['temSol_id'] != "")
                $this->db->like('temSol_id', $post['temSol_id']);
        if (isset($post['pqr_detalle']))
            if ($post['pqr_detalle'] != "")
                $this->db->like('pqr_detalle', $post['pqr_detalle']);
        if (isset($post['sol_id']))
            if ($post['sol_id'] != "")
                $this->db->like('sol_id', $post['sol_id']);
        if (isset($post['pqr_nombre']))
            if ($post['pqr_nombre'] != "")
                $this->db->like('pqr_nombre', $post['pqr_nombre']);
        if (isset($post['email']))
            if ($post['email'] != "")
                $this->db->like('email', $post['email']);
        if (isset($post['telefono']))
            if ($post['telefono'] != "")
                $this->db->like('telefono', $post['telefono']);
        if (isset($post['dep_id']))
            if ($post['dep_id'] != "")
                $this->db->like('dep_id', $post['dep_id']);
        if (isset($post['activo']))
            if ($post['activo'] != "")
                $this->db->like('activo', $post['activo']);
        $this->db->join('tipo_solicitud','tipo_solicitud.tipSol_id=pqr.tipSol_id');
        $this->db->join('temaSolicitud','temaSolicitud.temSol_id=pqr.temSol_id');
        $this->db->join('solicitante','solicitante.sol_id=pqr.sol_id');
        $this->db->join('departamento','departamento.dep_id=pqr.dep_id');
        $this->db->join('estado_solicitud','estado_solicitud.estSol_id=pqr.estSol_id');
        $this->db->select('pqr_id');
        $this->db->select('tipSol_nombre');
        $this->db->select('temSol_nombre');
        $this->db->select('pqr_detalle');
        $this->db->select('sol_nombre');
        $this->db->select('pqr_nombre');
        $this->db->select('email');
        $this->db->select('telefono');
        $this->db->select('dep_nombre');
        $this->db->select('estSol_nombre');
        $this->db->where('pqr.ACTIVO', 'S');
        $datos = $this->db->get('pqr');
        $datos = $datos->result();
        return $datos;
    }
    function buscar_sol($post){
        $this->db->select('estSol_nombre');
        $this->db->join('estado_solicitud','estado_solicitud.estSol_id=pqr.estSol_id');
        $this->db->where('pqr_id', $post['solicitud']);
        $datos = $this->db->get('pqr');
        $datos = $datos->result();
        return $datos;
    }

}

?>
