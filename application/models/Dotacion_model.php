<?php

class Dotacion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardar_protexion() {
        try {
            $post = $this->input->post();

            for ($i = 0; $i < (count($post['empleados'])); $i++) {
                for ($j = 0; $j < (count($post['elementop'])); $j++) {
                    $this->db->set('emp_id', $post['empleados'][$i]);
                    $this->db->set('inv_id', $post['elementop'][$j]);
                    $this->db->set('dot_talla', $post['talla'][$j]);
                    $this->db->set('dot_indicacion', $post['indicacion_uso'][$j]);
                    $this->db->set('dot_fecha_caducidad', $post['vida_util'][$j]);
                    $this->db->set('dot_unidades', $post['unidades'][$j]);
                    $this->db->set('dot_fecha_entrega', $post['fecha_entrega'][$j]);
                    $this->db->set('dot_indicaciones', $post['indicacion_alm'][$j]);
                    $this->db->set('creatorUser', $this->session->userdata('usu_id'));
                    $this->db->set('creatorDate', date("Y-m-d H:i:s"));
                    $this->db->insert('dotacion');
                }
            }
        } catch (Exeption $e) {
            
        } finally {
            
        }
    }

    function consultar_empleado() {
        $post = $this->input->post();
        $this->db->select_max('dot_fecha_entrega');
        $this->db->where('emp_id', $post['empleado']);
        $datos = $this->db->get('dotacion');
        return $datos->result();
    }

    function detail($id) {
        $this->db->select('dotacion.*,inventario.inv_nombre');
        $this->db->where('emp_id', $id);
        $this->db->order_by('creatorDate');
        $this->db->join('inventario', 'inventario.inv_id=dotacion.inv_id');
        $datos = $this->db->get('dotacion');
        return $datos->result();
    }

    function listadoDotacion() {
        $this->db->select("
            CONCAT(Emp_Apellidos,' ',empleado.Emp_Nombre) empleado
            ,inventario.inv_nombre,dotacion.dot_talla
            ,dot_indicacion
            ,dotacion.dot_fecha_caducidad
            ,dot_unidades,dot_fecha_entrega
            ,CONCAT(user.usu_apellido,' ',user.usu_nombre) entregador", false);
        $this->db->join('empleado', 'empleado.emp_id=dotacion.emp_id');
        $this->db->join('inventario', 'inventario.inv_id=dotacion.inv_id');
        $this->db->join('user', 'user.usu_id=dotacion.creatorUser');
//        $this->db->join('','');
        $datos = $this->db->get('dotacion');
        return $datos->result();
    }

}

?>