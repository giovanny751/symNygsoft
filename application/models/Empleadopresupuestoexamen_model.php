<?php

class Empleadopresupuestoexamen_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function save($data){
        $this->db->insert("empleado_presupuesto_examen",$data);
        return $this->db->insert_id();
    }
    function consultaExamenesEmpleados($post){
        
        if(!empty($post['apellidos']))$this->db->where("empleado_presupuesto_examen.empPreExa_apellido",$post['apellidos']);
        if(!empty($post['noDocumento']))$this->db->where("empleado_presupuesto_examen.empPreExa_documento",$post['noDocumento']);
        if(!empty($post['nombre']))$this->db->where("empleado_presupuesto_examen.empPreExa_nombre",$post['nombre']);
        if(!empty($post['pertenece']))$this->db->where("empleado_presupuesto_examen.empPreExa_pertenece",$post['pertenece']);
        if(!empty($post['proveedor']))$this->db->where("empleado_presupuesto_examen.pro_id",$post['proveedor']);
        if(!empty($post['sexo']))$this->db->where("sexo.Sex_id",$post['sexo']);
//        if(!empty($post['tipoExamen']))$this->db->where("",$post['tipoExamen']);
        
        $this->db->select("empleado_presupuesto_examen.empPreExa_id");
        $this->db->select("if(empleado_presupuesto_examen.empPreExa_pertenece = 1,'SI','NO') AS empPreExa_pertenece");
        $this->db->select("empleado_presupuesto_examen.empPreExa_nombre");
        $this->db->select("tipo_examen.tipExa_tipo");
        $this->db->select("empleado_presupuesto_examen.empPreExa_apellido");
        $this->db->select("empleado_presupuesto_examen.empPreExa_documento");
        $this->db->select("empleado_presupuesto_examen.empPreExa_telefono");
        $this->db->select("empleado_presupuesto_examen.empPreExa_correo");
        $this->db->select("group_concat(presupuesto_examen.preExa_examen) as preExa_examen");
        $this->db->select("sexo.Sex_Sexo");
        $this->db->select("tipo_identificacion.tipIde_tipo");
        $this->db->join("empleado_presupuesto_examen_valor","empleado_presupuesto_examen_valor.empPreExa_id = empleado_presupuesto_examen.empPreExa_id ","left");
        $this->db->join("presupuesto_examen_valor","presupuesto_examen_valor.preExaVal_id = empleado_presupuesto_examen_valor.preExaVal_id ");
        $this->db->join("presupuesto_examen","presupuesto_examen.preExa_id = presupuesto_examen_valor.preExa_id ");
        $this->db->join("sexo","sexo.sex_id = empleado_presupuesto_examen.sex_id");
        $this->db->join("tipo_identificacion","tipo_identificacion.tipIde_id = empleado_presupuesto_examen.tipIde_id");
        $this->db->join("tipo_examen","tipo_examen.tipExa_id = empleado_presupuesto_examen.tipExa_id");
        $this->db->group_by("empleado_presupuesto_examen.empPreExa_id");
        
        
        $examenes = $this->db->get("empleado_presupuesto_examen");
        
//        echo $this->db->last_query();die;
        return $examenes->result();
    }
}