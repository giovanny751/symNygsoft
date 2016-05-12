<?php

class Empleado_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function empleadosNomina(){
//        $this->db->join("empleado_contratos","empleado_contratos.emp_id = empleado.Emp_id");
        $this->db->join("cargo","cargo.Car_id = empleado.Car_id");
        $empleado = $this->db->get("empleado");
        return $empleado->result();
    }
    
    function empleados(){
        try{
        $this->db->distinct("empleado.Emp_id");
        $this->db->select("empleado.Emp_id");
        $this->db->select("empleado.Emp_cedula");
        $this->db->select("empleado.Emp_Nombre");
        $this->db->select("empleado.Emp_Apellidos");
        $this->db->where("est_id",1);
        $this->db->where("empleado_contratos.empCon_fechaHasta >=",date("Y-m-d"));
        $this->db->or_where("empleado_contratos.empCon_fechaHasta","0000-00-00 00:00:00");
        $this->db->join("empleado_contratos","empleado_contratos.emp_id = empleado.Emp_id");
        $empleado = $this->db->get("empleado");
//        echo $this->db->last_query();die;
        return $empleado->result();
        }catch(exception $e){
            
        }finally{
            
        }
    }
    
    function detail() {
        try {
            $this->db->distinct("empleado.Emp_id");
            $this->db->select("empleado.Emp_id");
            $this->db->select("empleado.Emp_cedula");
            $this->db->select("empleado.Emp_Nombre");
            $this->db->select("empleado.Emp_Apellidos");
            $this->db->order_by("empleado.Emp_Nombre");
            $this->db->where("est_id",1);
            $this->db->where("(empleado_contratos.empCon_fechaHasta >= '".date("Y-m-d")."' or empleado_contratos.empCon_fechaHasta = '0000-00-00 00:00:00')" ,false,false);
            $this->db->join("empleado_contratos","empleado_contratos.emp_id = empleado.Emp_id");
            $empleado = $this->db->get("empleado");
//            echo $this->db->last_query();die;
            return $empleado->result();
        } catch (exception $e) {
            
        }
    }

    function create() {
        try {
            $post=$this->input->post();
            if(!empty($post['codigo']))
                $this->db->set('Emp_codigo',$post['codigo']);
            if(!empty($post['cedula']))
                $this->db->set('Emp_Cedula',$post['cedula']);
            if(!empty($post['tipodocumento']))
                $this->db->set('TipDoc_id',$post['tipodocumento']);
            if(!empty($post['nombre']))
                $this->db->set('Emp_Nombre',$post['nombre']);
            if(!empty($post['apellidos']))
                $this->db->set('Emp_Apellidos',$post['apellidos']);
            if(!empty($post['horario']))
                $this->db->set('hor_id',$post['horario']);
            if(!empty($post['sexo']))
                $this->db->set('sex_Id',$post['sexo']);
            if(!empty($post['fechadenacimiento']))
                $this->db->set('Emp_FechaNacimiento',$post['fechadenacimiento']);
            if(!empty($post['estatura']))
                $this->db->set('Emp_Estatura',$post['estatura']);
            if(!empty($post['peso']))
                $this->db->set('Emp_Peso',$post['peso']);
            if(!empty($post['telefono']))
                $this->db->set('Emp_Telefono',$post['telefono']);
            if(!empty($post['direccion']))
                $this->db->set('Emp_Direccion',$post['direccion']);
            if(!empty($post['contacto']))
                $this->db->set('Emp_Contacto',$post['contacto']);
            if(!empty($post['telefonocontacto']))
                $this->db->set('Emp_TelefonoContacto',$post['telefonocontacto']);
            if(!empty($post['email']))
                $this->db->set('Emp_Email',$post['email']);
            if(!empty($post['estadocivil']))
                $this->db->set('EstCiv_id',$post['estadocivil']);
            if(!empty($post['fechainiciocontrato']))
                $this->db->set('Emp_FechaInicioContrato',$post['fechainiciocontrato']);
            if(!empty($post['fechafincontrato']))
                $this->db->set('Emp_FechaFinContrato',$post['fechafincontrato']);
            if(!empty($post['planobligatoriodesalud']))
                $this->db->set('Emp_PlanObligatorioSalud',$post['planobligatoriodesalud']);
            if(!empty($post['fechaafiliacionarl']))
                $this->db->set('Emp_FechaAfiliacionArl',$post['fechaafiliacionarl']);
            if(!empty($post['dimension1']))
                $this->db->set('Dim_id',$post['dimension1']);
            if(!empty($post['dimension2']))
                $this->db->set('Dim_IdDos',$post['dimension2']);                
            if(!empty($post['cargo']))
                $this->db->set('Car_id',$post['cargo']);
            if(!empty($post['salario']))
                $this->db->set('emp_salario',$post['salario']);
            if(!empty($post['fondo']))
                $this->db->set('emp_fondo',$post['fondo']);
            if(!empty($post['correoConctacto']))
                $this->db->set('emp_correoContacto',$post['correoConctacto']);
            if(!empty($post['Emp_celularContacto']))
                $this->db->set('Emp_celularContacto',$post['Emp_celularContacto']);
            if(!empty($post['emp_celular']))
                $this->db->set('emp_celular',$post['celular']);
            if(!empty($post['contactoApellido']))
                $this->db->set('Emp_contactoApellido',$post['contactoApellido']);
            if(!empty($post['fechaExpedicion']))
                $this->db->set('Emp_fechaExpedicionDocumento',$post['fechaExpedicion']);
            
            $this->db->set('Est_id' , 1);
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
            $this->db->insert("empleado");
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function update($data, $id) {
        try {
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
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
            $this->db->set("Est_id", 3);
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
            $this->db->update("empleado");
        } catch (exception $e) {
            
        }
    }

    function filtroempleados($cedula, $nombre, $apellido, $codigo, $cargo, $estado, $contratosvencidos, $tipocontrato, $dim1, $dim2) {
        try {
            
            if(!empty($contratosvencidos)){
                $this->db->where("(empleado_contratos.empCon_fechaHasta <=",date("Y-m-d")." or empleado_contratos.empCon_fechaHasta is null)",false,false);
            }else{
                $this->db->where("(empleado_contratos.empCon_fechaHasta >= '".date("Y-m-d")."' or empleado_contratos.empCon_fechaHasta = '0000-00-00 00:00:00')" );
            }            
            if (!empty($dim1))
                $this->db->where('empleado.Dim_id', $dim1);
            if (!empty($dim2))
                $this->db->where('empleado.Dim_IdDos', $dim2);
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
            
            $this->db->select("empleado.*");
            $this->db->select("estados.*");
            $this->db->select("cargo.*");
            $this->db->select("empleado_contratos.empCon_fechaDesde");
            $this->db->select("empleado_contratos.empCon_fechaHasta");
            $this->db->where("empleado.est_id ",1);
            $this->db->join("empleado_contratos","empleado_contratos.emp_id = empleado.Emp_id",'left');
            $this->db->join("estados", "estados.est_id = empleado.est_id");
            $this->db->join("cargo", "cargo.car_id = empleado.car_id","LEFT");
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
            $this->db->order_by('Emp_Nombre');
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
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
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
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
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
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
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
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
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
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
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
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
            $this->db->insert('aseguradoras');
            return $this->db->insert_id();
        }
    }
    function validarExistencia($id){
        $this->db->where("car_id",$id);
        $empleado = $this->db->get('empleado');
        return $empleado->result();
    }
    function consultaCorreoEmpleado($empId){
        $this->db->select("Emp_Email");
        $this->db->select("Emp_Cedula");
        $this->db->where("Emp_id",$empId);
        $correo = $this->db->get("empleado");
        
        return $correo->result();
    }

}

?>