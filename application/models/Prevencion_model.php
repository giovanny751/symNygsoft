<?php

class Prevencion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardarPrevencion($post) {
        try {
            $this->db->set('tipAcc_id', $post['tipAcc_id']);
            $this->db->set('pertenece', $post['pertenece']);
            $this->db->set('dimUno_id', $post['dimUno']);
            $this->db->set('dimDos_id', $post['dimDos']);
            $this->db->set('pre_lugar', $post['lugar']);
            $this->db->set('pre_observacion', $post['observacion']);

            if ($post['pertenece'] == 1) {
                $this->db->set('car_id', $post['cargo']);
                $this->db->set('emp_id', $post['empleado']);
            } else {
                $this->db->set('pre_cargo_externo', $post['cargo_externo']);
                $this->db->set('pre_empleado_externo', $post['empleado_externo']);
            }
            $this->db->set('pre_control_antes', $post['control_antes']);
            $this->db->set('pre_control_despues', $post['control_despues']);
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
            $this->db->insert("prevencion");
            $id = $this->db->insert_id();

            $this->fuenteOrigen($post, $id);
            $this->prevencion_causa($post, $id);
            $this->prevencion_plan_accion($post, $id);
        } catch (exception $e) {
            
        } finally {
            return $id;
        }
    }

    function fuenteOrigen($post, $id) {
        $this->db->where('pre_id', $id);
        $this->db->delete('prevencion_fuenteOrigen');
        for ($i = 0; $i < count($post['fueOri_id']); $i++) {
            if ($post['fueOri_id'][$i] != -1) {
                $this->db->set('pre_id', $id);
                $this->db->set('fueOri_id', $post['fueOri_id'][$i]);
                $this->db->insert('prevencion_fuenteOrigen');
            }
        }
    }

    function prevencion_plan_accion($post, $id) {
        $this->db->where('pre_id', $id);
        $this->db->delete('prevencion_plan_accion');
        for ($i = 0; $i < count($post['fueOri_id']); $i++) {
            if ($post['fueOri_id'][$i] != -1) {
                $this->db->set('pre_id', $id);
                $this->db->set('prePlanAcc_acciones', $post['plan_accion_acciones'][$i]);
                $this->db->set('prePlanAcc_responsable', $post['plan_accion_responsable'][$i]);
                $this->db->set('prePlanAcc_fecha_ini', $post['plan_accion_fecha_ini'][$i]);
                $this->db->set('prePlanAcc_fecha_fin', $post['plan_accion_fecha_fin'][$i]);
                $this->db->insert('prevencion_plan_accion');
            }
        }
    }

    function prevencion_causa($post, $id) {
        $this->db->where('pre_id', $id);
        $datos = $this->db->get('prevencion_causa');
        $datos = $datos->result();
        if (count($datos)) {
            foreach ($datos as $key => $value) {
                $this->db->where('preCau_id', $value->preCau_id);
                $this->db->delete('prevencion_causa_detalle');
            }
        }
        for ($i = 0; $i < count($post['fueOri_id']); $i++) {
            if ($post['fueOri_id'][$i] != -1) {
                $this->db->set('pre_id', $id);
                $this->db->set('preCau_causa', $post['causa'][$i]);
                $this->db->set('preCau_sub_causa', $post['subcausa'][$i]);
                $this->db->set('preCau_ultra_causa', $post['ultracausa'][$i]);
                $this->db->insert('prevencion_causa');
                $preCau_id = $this->db->insert_id();
                for ($j = 0; $j < count($post['fueOri_id']); $j++) {
                    $this->db->set('preCau_id', $preCau_id);
                    $this->db->set('detCau_id', $post['detCau_id'][$j]);
                    $this->db->insert('prevencion_causa_detalle');
                }
            }
        }
    }

    function prevencionRiesgo_inactivar($post) {
        try {
            $this->db->set('est_id', '3');
            $this->db->where('pre_id', $post['pre_id']);
            $this->db->update('prevencion');
        } catch (exception $e) {
            
        } finally {
            return $id;
        }
    }

}
