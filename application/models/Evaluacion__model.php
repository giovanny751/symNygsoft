<?php

class Evaluacion__model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_evaluacion($post) {
        if (isset($post['campo'])) {
            $this->db->where($post["campo"], $post[$post["campo"]]);
            $id = $post[$post["campo"]];
            unset($post['campo']);
            $this->db->update('evaluacion', $post);
        } else {
            $this->db->insert('evaluacion', $post);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    function delete_evaluacion($post) {
        $this->db->set('ACTIVO', 'N');
        $this->db->where($post["campo"], $post[$post["campo"]]);
        $this->db->update('evaluacion');
    }

    function edit_evaluacion($post) {
        $this->db->where($post["campo"], $post[$post["campo"]]);
        $datos = $this->db->get('evaluacion', $post);
        return $datos = $datos->result();
    }

    function obtener_respuestas($id) {
        $this->db->where('pre_id', $id);
        $this->db->where('activo', 'S');
        $datos = $this->db->get('respuestas');
        return $datos = $datos->result();
    }

    function consult_evaluacion($post) {
        if (isset($post['eva_id']))
            if ($post['eva_id'] != "")
                $this->db->like('eva_id', $post['eva_id']);
        if (isset($post['eva_nombre']))
            if ($post['eva_nombre'] != "")
                $this->db->like('eva_nombre', $post['eva_nombre']);
        $this->db->select('eva_id');
        $this->db->select('eva_nombre');
        $this->db->where('ACTIVO', 'S');
        $datos = $this->db->get('evaluacion');
        $datos = $datos->result();
        return $datos;
    }

    function nombre_evaluacion($post) {
        if (isset($post['eva_id']))
            if ($post['eva_id'] != "")
                $this->db->where('eva_id', $post['eva_id']);
        if (isset($post['eva_nombre']))
            if ($post['eva_nombre'] != "")
                $this->db->like('eva_nombre', $post['eva_nombre']);
        $this->db->select('eva_id');
        $this->db->select('eva_nombre');
        $this->db->where('ACTIVO', 'S');
        $datos = $this->db->get('evaluacion');
        $datos = $datos->result();
        return $datos;
    }

    function preguntas_evaluacion($post) {

        $this->db->select('preguntas.pre_id,preguntas.pre_contexto, preguntas.pre_nombre,'
                . '  tipo_pregunta.tipPre_nombre');
        $this->db->where('preguntas.activo', 'S');
        $this->db->where('pre_visible', 'S');
        $this->db->where('eva_id', $post['eva_id']);
//        $this->db->join('tema', 'tema.tem_id=preguntas.tem_id');
//        $this->db->join('area', 'area.are_id=preguntas.are_id');
        $this->db->join('tipo_pregunta', 'tipo_pregunta.tipPre_id=preguntas.tipPre_id');
        $this->db->order_by('preguntas.eva_id,preguntas.are_id,preguntas.tem_id,preguntas.tipPre_id');
        $datos = $this->db->get('preguntas');
        $datos = $datos->result();
        return $datos;
    }
    function preguntas_evaluacion2($post) {

        $this->db->select('preguntas.pre_id,preguntas.pre_contexto, preguntas.pre_nombre,'
                . 'tipo_pregunta.tipPre_nombre,preguntas.res_id');
        $this->db->where('preguntas.activo', 'S');
        $this->db->where('pre_visible', 'S');
        $this->db->where('preguntas.eva_id', $post['eva_id']);
//        $this->db->join('tema', 'tema.tem_id=preguntas.tem_id');
//        $this->db->join('area', 'area.are_id=preguntas.are_id');
        $this->db->join('tipo_pregunta', 'tipo_pregunta.tipPre_id=preguntas.tipPre_id');
        $this->db->join('respuesta_evaluacion', 'respuesta_evaluacion.pre_id=preguntas.pre_id and respuesta_evaluacion.eva_id=preguntas.eva_id');
        $this->db->order_by('preguntas.eva_id,preguntas.are_id,preguntas.tem_id,preguntas.tipPre_id');
        $datos = $this->db->get('preguntas');
        $datos = $datos->result();
        return $datos;
    }

    function ver_evaluaciones($post) {
        $this->db->select('evaluacion.eva_id, eva_nombre,user_evaluacion.use_id', false);
        $this->db->join('user_evaluacion', "user_evaluacion.eva_id=evaluacion.eva_id and user_evaluacion.useEva_activo='S' and user_evaluacion.use_id=" . $post['usuarioid'], 'left', false);
        $this->db->where('ACTIVO', 'S');
        $datos = $this->db->get('evaluacion');
//        echo $this->db->last_query();
        $datos = $datos->result();
        return $datos;
    }
    function respondio($post) {
        $this->db->select('*', false);
        $this->db->where('eva_id', $post['eva_id']);
        $this->db->where('usu_id', $post['user']);
        $datos = $this->db->get('respuesta_evaluacion');
//        echo $this->db->last_query();
        $datos = $datos->result();
        return $datos;
    }
    function ver_evaluaciones_resueltas($post) {
        $this->db->select('evaluacion.eva_id, eva_nombre,user_evaluacion.use_id', false);
        $this->db->join('user_evaluacion', "user_evaluacion.eva_id=evaluacion.eva_id and user_evaluacion.useEva_activo='S' and user_evaluacion.use_id=" . $post['usuarioid'], 'inner', false);
        $this->db->join('respuesta_evaluacion', "respuesta_evaluacion.eva_id=evaluacion.eva_id", 'inner', false);
        $this->db->where('ACTIVO', 'S');
        $this->db->where('respuesta_evaluacion.usu_id',$post['usuarioid']);
        $this->db->group_by('evaluacion.eva_id');
        $datos = $this->db->get('evaluacion');
//        echo $this->db->last_query();
        $datos = $datos->result();
        return $datos;
    }

    function arignar_evaluacion($post) {
        $this->db->set('useEva_activo', 'N');
        $this->db->where('use_id', $post['usuarioid']);
        $this->db->update('user_evaluacion');

        $info = explode('||', $post['info']);
        for ($i = 0; $i < count($info); $i++) {
            if (!empty($info[$i])) {
                $this->db->select('useEva_id');
                $this->db->where('use_id', $post['usuarioid']);
                $this->db->where('eva_id', $info[$i]);
                $datos = $this->db->get('user_evaluacion');
                $datos = $datos->result();

                $this->db->set('eva_id', $info[$i]);
                $this->db->set('use_id', $post['usuarioid']);
                if (count($datos)) {
                    $this->db->set('useEva_activo', 'S');
                    $this->db->where('useEva_id', $datos[0]->useEva_id);
                    $this->db->update('user_evaluacion');
                } else {
                    $this->db->insert('user_evaluacion');
                }
//                echo $this->db->last_query();
            }
        }
    }

    function calificar($post) {
        try {
            foreach ($post as $key => $value) {
                $id = $key;
            }
            $this->db->select('eva_id');
            $this->db->where('pre_id', $id);
            $datos = $this->db->get('preguntas');
            $datos = $datos->result();
            $hoy = date("Y-m-d H:i:s");
            foreach ($post as $key => $value) {
                $this->db->set('eva_id', $datos[0]->eva_id);
                $this->db->set('usu_id', $this->data['usu_id']);
                $this->db->set('pre_id', $key);
                $this->db->set('res_id', $value);
                $this->db->set('resEva_fecha_creacion', $hoy);
                $this->db->insert('respuesta_evaluacion');
            }
        } catch (Exception $exc) {
            
        }
    }

}

?>
