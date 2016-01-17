<?php

class Preguntas__model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_preguntas($post) {
        try {
            if (isset($post['res_id'])) {
                $res_id = $post['res_id'];
            }
            if (isset($post['respuesta'])) {
                $respuesta = $post['respuesta'];
            }
            unset($post['res_id']);
            unset($post['respuesta']);
            $res_id_1 = $post['res_id_1'];
            unset($post['res_id_1']);

            if (!empty($post[$post["campo"]])) {
                $this->db->where($post["campo"], $post[$post["campo"]]);
                $id = $post[$post["campo"]];
                unset($post['campo']);
                $this->db->update('preguntas', $post);
            } else {
                unset($post['campo']);
                $this->db->insert('preguntas', $post);
                $id = $this->db->insert_id();
            }
            $this->db->set('activo', 'N');
            $this->db->where('pre_id', $id);
            $this->db->update('respuestas');

            for ($i = 0; $i < count($respuesta); $i++) {
                $this->db->set('pre_id', $id);
                $this->db->set('activo', 'S');
                $this->db->set('res_nombre', $respuesta[$i]);
                if (!empty($res_id[$i])) {
                    $id_res = $res_id[$i];
                    $this->db->where('res_id', $res_id[$i]);
                    $this->db->update('respuestas');
                } else {
                    $this->db->insert('respuestas');
                    $id_res = $this->db->insert_id();
                }
                if ($i == $res_id_1) {
                    $id_respuesta = $id_res;
                }
            }
            $this->db->set('res_id', $id_respuesta);
            $this->db->where('pre_id', $id);
            $this->db->update('preguntas');


            return $id;
        } catch (exception $e) {
            
        }
    }

    function delete_preguntas($post) {
        try {
            $this->db->set('ACTIVO', 'N');
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $this->db->update('preguntas');
        } catch (exception $e) {
            
        }
    }
    function pre_visible($post) {
        try {
            $this->db->set('pre_visible', $post['pre_visible']);
            $this->db->where('pre_id', $post['pre_id']);
            $this->db->update('preguntas');
        } catch (exception $e) {
            
        }
    }
    function inactivar_preguntas($post) {
        try {
            $this->db->set('ACTIVO', 'N');
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $this->db->update('preguntas');
        } catch (exception $e) {
            
        }
    }

    function edit_preguntas($post) {
        try {
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $datos = $this->db->get('preguntas', $post);
            return $datos = $datos->result();
        } catch (exception $e) {
            
        }
    }

    function edit_respuesta($post) {
        try {
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $this->db->where('ACTIVO', 'S');
            $datos = $this->db->get('respuestas');
            return $datos = $datos->result();
        } catch (exception $e) {
            
        }
    }

    function consult_preguntas($post) {
        try {
            if (isset($post['pre_id']))
                if ($post['pre_id'] != "")
                    $this->db->like('pre_id', $post['pre_id']);
            if (isset($post['eva_id']))
                if ($post['eva_id'] != "")
                    $this->db->like('preguntas.eva_id', $post['eva_id']);
            if (isset($post['tem_id']))
                if ($post['tem_id'] != "")
                    $this->db->like('tem_id', $post['tem_id']);
            if (isset($post['are_id']))
                if ($post['are_id'] != "")
                    $this->db->like('are_id', $post['are_id']);
            if (isset($post['tipPre_id']))
                if ($post['tipPre_id'] != "")
                    $this->db->like('tipPre_id', $post['tipPre_id']);
            if (isset($post['pre_nombre']))
                if ($post['pre_nombre'] != "")
                    $this->db->like('pre_nombre', $post['pre_nombre']);
            if (isset($post['res_id']))
                if ($post['res_id'] != "")
                    $this->db->like('res_id', $post['res_id']);
            $this->db->select('pre_id');
            $this->db->select('eva_nombre');
//            $this->db->select('tem_nombre');
//            $this->db->select('are_nombre');
            $this->db->select('tipPre_nombre');
            $this->db->select('pre_nombre');
            $this->db->select('pre_res_num');
            $this->db->select('pre_visible');
            $this->db->where('preguntas.ACTIVO', 'S');
            $this->db->join('evaluacion e', 'e.eva_id=preguntas.eva_id');
//            $this->db->join('tema t', 't.tem_id=preguntas.tem_id');
//            $this->db->join('area a', 'a.are_id=preguntas.are_id');
            $this->db->join('tipo_pregunta tp', 'tp.tipPre_id=preguntas.tipPre_id');
            $datos = $this->db->get('preguntas');
            $datos = $datos->result();
            return $datos;
        } catch (exception $e) {
            
        }
    }

}

?>
