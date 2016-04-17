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
                    $this->db->set('emp_id',$post['empleados'][$i]);
                    $this->db->set('dot_nombre',$post['elementop'][$j]);
                    $this->db->set('dot_talla',$post['talla'][$j]);
                    $this->db->set('dot_indicacion',$post['indicacion_uso'][$j]);
                    $this->db->set('doc_fecha_caducidad',$post['vida_util'][$j]);
                    $this->db->set('doc_unidades',$post['unidades'][$j]);
                    $this->db->set('doc_fecha_entrega',$post['fecha_entrega'][$j]);
                    $this->db->set('doc_indicaciones',$post['indicacion_alm'][$j]);
                    $this->db->set('creatorUser', $this->session->userdata('usu_id'));
                    $this->db->set('creatorDate', date("Y-m-d H:i:s"));
                    $this->db->insert('dotacion');
                }
            }
        } catch (Exeption $e) {
            
        } finally {
            
        }
    }
    function consultar_empreado(){
        $post = $this->input->post();
        $this->db->select_max('doc_fecha_entrega');
        $this->db->where('emp_id',$post['empleado']);
        $datos=$this->db->get('dotacion');
        return $datos->result();
    }
    function detail($id){
        $this->db->where('emp_id',$id);
        $this->db->order_by('creatorDate');
        $datos=$this->db->get('dotacion');
        return $datos->result();
    }

}

?>