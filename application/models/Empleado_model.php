<?php

class Empleado_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
            $this->db->insert("empleado", $data);
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function update($data, $id) {
        try {
            $this->db->where("emp_id", $id);
            $this->db->update("empleado", $data);
        } catch (exception $e) {
            
        }
    }

    function valormaxid() {
        try {
            $this->db->select("max(emp_id) as maximo", false);
            $maxId = $this->db->get("empleado");
            return $maxId->result();
        } catch (exception $e) {
            
        }
    }

    function detail() {
        try {
            $this->db->where("est_id",1);
            $empleado = $this->db->get("empleado");
            return $empleado->result();
        } catch (exception $e) {
            
        }
    }

    function detail_order() {
        try {
            $this->db->order_by("Emp_Nombre","asc");
            $empleado = $this->db->get("empleado");
            return $empleado->result();
        } catch (exception $e) {
            
        }
    }
    function delete($id) {
        try {
            $this->db->where("emp_id", $id);
            $this->db->delete("empleado");
        } catch (exception $e) {
            
        }
    }

    function filtroempleados($cedula, $nombre, $apellido, $codigo, $cargo, $estado, $contratosvencidos, $tipocontrato, $dim1, $dim2) {
        try {
            if (!empty($dim1))
                $this->db->where('empleado.Dim_id', $dim1);
            if (!empty($dim2))
                $this->db->where('empleado.Dim_IdDos', $dim2);
            if (!empty($tipocontrato))
                $this->db->where('tipo_contrato.TipCon_Id', $tipocontrato);
            if (!empty($cedula))
                $this->db->where('Emp_Cedula', $cedula);
            if (!empty($nombre))
                $this->db->where('Emp_Nombre', $nombre);
            if (!empty($apellido))
                $this->db->where('Emp_Apellidos', $apellido);
            if (!empty($codigo))
                $this->db->where('Emp_codigo', $codigo);
            if (!empty($cargo))
                $this->db->where('cargo.car_id', $cargo);
            if (!empty($estado))
                $this->db->where('estados.Est_id', $estado);
            if (!empty($contratosvencidos))
                $this->db->where("Emp_FechaFinContrato <", date('Y-m-d'));
            $this->db->select("(
            select count(tarea.tar_id)  
            from tarea
            join avance_tarea on avance_tarea.tar_id=tarea.tar_id
            where	avance_tarea.avaTar_progreso<100 and tarea.emp_id=empleado.Emp_Id 
            ) as tareas_emp,", false);
            $this->db->select("(
            select count(planes.pla_id)  
            from planes
            where	planes.emp_id=empleado.Emp_Id 
            ) as planes_emp,", false);
            $this->db->select("empleado.*");
            $this->db->select("estados.*");
            $this->db->select("tipo_contrato.*");
            $this->db->select("cargo.*");
            $this->db->where("empleado.est_id ",1);
            $this->db->join("estados", "estados.est_id = empleado.est_id");
            $this->db->join("cargo", "cargo.car_id = empleado.car_id","LEFT");
            $this->db->join("tipo_contrato", "tipo_contrato.TipCon_Id = empleado.TipCon_Id","LEFT");
            $empleado = $this->db->get("empleado");
            return $empleado->result();
        } catch (exception $e) {
            
        }
    }

    function contratosvencidos() {
        try {
            $this->db->where("Emp_FechaFinContrato <", date('Y-m-d'));
            $this->db->join("estados", "estados.est_id = empleado.est_id");
            $this->db->join("cargo", "cargo.car_id = empleado.car_id");
            $this->db->join("tipo_contrato", "tipo_contrato.TipCon_Id = empleado.TipCon_Id");
            $empleado = $this->db->get("empleado");
            return $empleado->result();
        } catch (exception $e) {
            
        }
    }

    function eliminarempleado($id) {
        try {
            $this->db->trans_begin();
            $this->db->where("emp_id", $id);
            $this->db->set("est_id",3);
            $this->db->update("empleado");
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        }finally{
            return $this->db->trans_status();
        }
    }

    function consultaempleadoxid($id) {
        try {
            $this->db->select("(
            select count(tarea.tar_id)  
            from tarea
            join avance_tarea on avance_tarea.tar_id=tarea.tar_id
            where	avance_tarea.avaTar_progreso<100 and tarea.emp_id=empleado.Emp_Id 
            ) as tareas_emp,", false);
            $this->db->select("(
            select count(planes.pla_id)  
            from planes
            where	planes.emp_id=empleado.Emp_Id 
            ) as planes_emp,", false);
            $this->db->select("empleado.*");
            $this->db->where("emp_id", $id);
            $empleado = $this->db->get("empleado");
            return $empleado->result();
        } catch (exception $e) {
            
        }
    }

    function empleadoxcargo($id) {
        try {
            $this->db->select('Emp_Apellidos,Emp_Nombre,Emp_Id');
            $this->db->where("car_id", $id);
            $empleado = $this->db->get("empleado");
            return $empleado->result();
        } catch (exception $e) {
            
        }
    }

    function consultaempleadoflechas($idEmpleadoCreado, $metodo) {
        try {
            switch ($metodo) {
                case "flechaIzquierdaDoble":
                    $this->db->where("Emp_Id = (select min(Emp_Id) from empleado)");
                    break;
                case "flechaIzquierda":
                    $this->db->where("Emp_Id < '" . $idEmpleadoCreado . "' ");
                    $this->db->order_by("Emp_Id desc");
                    break;
                case "flechaDerecha":
                    $this->db->where("Emp_Id > '" . $idEmpleadoCreado . "' ");
                    $this->db->order_by("Emp_Id asc");
                    break;
                case "flechaDerechaDoble":
                    $this->db->where("Emp_Id = (select max(Emp_Id) from empleado)");
                    break;
                default :
                    die;
                    break;
            }
            $usuario = $this->db->get("empleado", 1);
            return $usuario->result();
        } catch (exception $e) {
            
        }
    }

    function validacedula($cedula) {
        try {
            $this->db->where("Emp_Cedula", $cedula);
            $empleado = $this->db->get("empleado");
            return $empleado->result();
        } catch (exception $e) {
            
        }
    }

    function buscar_tipo_contrato($nombre_contrato) {
        $this->db->select('TipCon_Id');
        $this->db->like('TipCon_Descripcion', $nombre_contrato);
        $datos = $this->db->get('tipo_contrato');
        $datos = $datos->result();
        if (count($datos)) {
            return $datos[0]->TipCon_Id;
        } else {
            $this->db->set('TipCon_Descripcion', $nombre_contrato);
            $this->db->insert('tipo_contrato');
            return $this->db->insert_id();
        }
    }

    function buscar_tipo_aseguradora($nombre) {
        $this->db->select('TipAse_Id');
        $this->db->like('TipAse_Nombre', $nombre);
        $datos = $this->db->get('tipo_aseguradora');
        $datos = $datos->result();
        if (count($datos)) {
            return $datos[0]->TipAse_Id;
        } else {
            $this->db->set('TipAse_Nombre', $nombre);
            $this->db->insert('tipo_aseguradora');
            return $this->db->insert_id();
        }
    }
    function buscar_dimencion1($nombre) {
        $this->db->select('dim_id');
        $this->db->like('dim_descripcion', $nombre);
        $datos = $this->db->get('dimension');
        $datos = $datos->result();
        if (count($datos)) {
            return $datos[0]->dim_id;
        } else {
            $this->db->set('est_id', 1);
            $this->db->set('dim_descripcion', $nombre);
            $this->db->insert('dimension');
            return $this->db->insert_id();
        }
    }
    function buscar_dimencion2($nombre) {
        $this->db->select('dim_id');
        $this->db->like('dim_descripcion', $nombre);
        $datos = $this->db->get('dimension2');
        $datos = $datos->result();
        if (count($datos)) {
            return $datos[0]->dim_id;
        } else {
            $this->db->set('est_id', 1);
            $this->db->set('dim_descripcion', $nombre);
            $this->db->insert('dimension2');
            return $this->db->insert_id();
        }
    }
    function tipo_documento($nombre) {
//        echo $nombre;
        $this->db->select('tipDoc_id');
        $this->db->like('tipDoc_Descripcion', $nombre);
        $datos = $this->db->get('tipo_documento');
        $datos = $datos->result();
        if (count($datos)) {
            return $datos[0]->tipDoc_id;
        } else {
            $this->db->set('tipDoc_Descripcion', $nombre);
            $this->db->insert('tipo_documento');
            return $this->db->insert_id();
        }
    }
    function cargo($nombre) {
        $this->db->select('car_id');
        $this->db->where('est_id',1);
        $this->db->like('UPPER(car_nombre)', strtoupper($nombre),false);
        $datos = $this->db->get('cargo');
        $datos = $datos->result();
        if (count($datos)) {
            return $datos[0]->car_id;
        } else {
            return '';
        }
    }

    function buscar_aseguradora($nombre, $tipo) {
        $this->db->select('ase_id');
        $this->db->like('ase_nombre', $nombre);
        $this->db->like('tipAse_id', $tipo);
        $datos = $this->db->get('aseguradoras');
        $datos = $datos->result();
        if (count($datos)) {
            return $datos[0]->ase_id;
        } else {
            $this->db->set('ase_nombre', $nombre);
            $this->db->set('tipAse_id', $tipo);
            $this->db->insert('aseguradoras');
            return $this->db->insert_id();
        }
    }
    function validarExistencia($id){
        $this->db->where("car_id",$id);
        $empleado = $this->db->get('empleado');
        return $empleado->result();
    }

}

?>