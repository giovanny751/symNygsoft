<?php

class Copasstreuniones_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function saveMeetings($post) {
        $info = array(
            "est_id" => $post['estadoReunion'],
            "copReu_fecha" => $post['fechaReunion'],
            "copReu_horaInicial" => $post['horaInicial'],
            "copReu_horaFinal" => $post['horaInicial'],
            "copReu_nombre" => $post['nombreReunion'],
            "emp_id" => $post['responsable'],
            "copReu_fechaProximaReunion" => $post['fechaProximaReunion'],
            "copReu_horaInicialProximaReunion" => (!empty($post['horaInicialProximaReunion'])) ? $post['horaInicialProximaReunion'] : null,
            "copReu_horaFinalProximaReunion" => (!empty($post['horaFinalProximaReunion'])) ? $post['horaFinalProximaReunion'] : null,
            "creatorUser" => $this->data['usu_id'],
            "creatorDate" => date("Y-m-d H:i:s")
        );
        $this->db->insert("copasst_reuniones", $info);
        return $this->db->insert_id();
    }

    function consultationMeetings($post) {

        $this->db->select("copReu_fecha");
        $this->db->select("copReu_horaInicial");
        $this->db->select("copReu_horaFinal");
        $this->db->select("Emp_Nombre");
        $this->db->select("Emp_Apellidos");
        $this->db->select("est_nombre");

        if (!empty($post['fechaDesde']))
            $this->db->where("copReu_fecha >=", $post['fechaDesde']);
        if (!empty($post['fechaHasta']))
            $this->db->where("copReu_fecha <=", $post['fechaHasta']);
        if (!empty($post['estadoReunion']))
            $this->db->where("copasst_reuniones.est_id", $post['estadoReunion']);
        if (!empty($post['responsable']))
            $this->db->where("copasst_reuniones.emp_id", $post['responsable']);

        $condicion = "";
        if (!empty($post['agenda'])):
            for ($i = 0; $i < count($post['agenda']); $i++):
                $condicion = " and copasst_agenda_comite.ageCom_id = ".$post['agenda'][$i]." ";
            endfor;
            $condicion = "and copasst_reuniones.copReu_id IN (select copReu_id from copasst_agenda_comite where 1 = 1 $condicion)";
        endif;

        $this->db->group_by("copasst_reuniones.copReu_id");
        $this->db->select("GROUP_CONCAT(DISTINCT agenda_comite.ageCom_agenda) as agenda");
        $this->db->join("copasst_agenda_comite", "copasst_agenda_comite.copReu_id = copasst_reuniones.copReu_id  $condicion", "left",false);
        $this->db->join("agenda_comite", "agenda_comite.ageCom_id = copasst_agenda_comite.ageCom_id");
        $this->db->join("estados", "estados.est_id = copasst_reuniones.est_id");
        $this->db->join("empleado", "empleado.emp_id = copasst_reuniones.emp_id");
        $reuniones = $this->db->get("copasst_reuniones");

        return $reuniones->result();
    }
    
    function reunionesAnterioresCopasst(){
        
        $this->db->select("copReu_id");
        $this->db->select("copReu_nombre");
        $this->db->where("est_id",1);
        $reuniones = $this->db->get("copasst_reuniones");
        return $reuniones->result();
    }

}
