<?php

class Informes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function horasExtras($empleado, $fechaDesde, $fechaHasta) {
        $this->db->order_by('empHorExt_fecha');
        if (!empty($empleado))
            $this->db->where("empleado.emp_id ", $empleado);
        if (!empty($fechaDesde))
            $this->db->where("empleado_horas_extra.empHorExt_fecha >=", $fechaDesde);
        if (!empty($fechaHasta))
            $this->db->where("empleado_horas_extra.empHorExt_fecha <=", $fechaHasta);
        $this->db->select("empleado.Emp_Nombre");
        $this->db->select("empleado.Emp_Apellidos");
        $this->db->select("empleado_horas_extra.empHorExt_horas");
        $this->db->select("empleado_horas_extra.empHorExt_fecha");
        $this->db->select("hora_extra_tipo.horExtTip_tipo");
        $this->db->join("hora_extra_tipo", "hora_extra_tipo.horExtTip_id = empleado_horas_extra.horExtTip_id");
        $this->db->join("empleado", "empleado.Emp_Id = empleado_horas_extra.emp_id");
        $horas = $this->db->get("empleado_horas_extra");
        return $horas->result();
    }

    function informeGeneral() {
        $query = "
            select 
                (select count(pla_id) from planes where est_id = 1) as planes,
                (select count(pla_id) from planes where est_id = 2) as planesInactivos,
                (select count(pla_id) from planes where est_id = 3) as planesEliminadas,
                (select count(actHij_id) from actividad_hijo where est_id = 1) as actividades,
                (select count(tar_id) from tarea where est_id = 1) as tarea,
                (select count(tar_id) from tarea where est_id = 2) as tareaInactiva,
                (select count(tar_id) from tarea where est_id = 3) as tareaEliminada,
                (select count(acc_id) from accidentes where Est_id = 1) as accidentes,
                (select count(cap_id) from capacitacion where Est_id = 1) as capacitaciones,
                (select count(empInc_id) from empleado_incapacidad where Est_id = 1) as incapacidades,
                (select count(vac_id) from vacaciones where Est_id = 1) as vacaciones,
                (select count(vac_id) from vacaciones where Est_id = 1) as vacacionesEliminadas,
                (select count(usu_id) from user where est_id = 1 ) as usuarios,
                (select count(usu_id) from user where est_id = 2 ) as usuariosInactivos,
                (select count(usu_id) from user where est_id = 3 ) as usuariosEliminados,
                (select count(ext_id) from extintor where est_id = 1 ) as extintor,
                (select count(ext_id) from extintor where est_id = 3 ) as extintorEliminado,
                (select count(ins_id) from inspeccion where est_id = 1 ) as inspeccionGeneral,
                (select count(ins_id) from inspeccion where est_id = 3 ) as inspeccionGeneralEliminada,
                (select count(bot_id) from botiquin where est_id = 1 ) as botiquin,
                (select count(bot_id) from botiquin where est_id = 3 ) as botiquinEliminados
                    ";
        return $this->db->query($query)->result();
    }

    function informeEmpleado() {
        $query = "select 
	sum(if(Est_id = 1,1,0)) as empleadosActivos, 
        (
        select sum(if(est_id = 1,1,0)) from empleado 
        join empleado_contratos on empleado_contratos.emp_id = empleado.Emp_id
        where 
        est_id = 1 and 
        ( empleado_contratos.empCon_fechaHasta <= '" . date("Y-m-d") . "' and empleado_contratos.empCon_fechaHasta != '0000-00-00 00:00:00')
        ) as empleadosInactivos,
        sum(if(Est_id = 3,1,0)) as empleadosEliminados,
              sum(if(sex_Id = 1 and Est_id = 1,1,0)) as empleadosHombres, 
              (
        select sum(if(sex_id = 1,1,0)) from empleado 
        join empleado_contratos on empleado_contratos.emp_id = empleado.Emp_id
        where 
        est_id = 1 and 
        ( empleado_contratos.empCon_fechaHasta <= '" . date("Y-m-d") . "' and empleado_contratos.empCon_fechaHasta != '0000-00-00 00:00:00')
        ) as empleadosHombresInactivos,
              sum(if(sex_Id = 1 and Est_id = 3,1,0)) as empleadosHombresEliminados,
              sum(if(sex_Id = 2 and Est_id = 1,1,0)) as empleadosMujeres,
              (
        select sum(if(sex_id = 2,1,0)) from empleado 
        join empleado_contratos on empleado_contratos.emp_id = empleado.Emp_id
        where 
        est_id = 1 and 
        ( empleado_contratos.empCon_fechaHasta <= '" . date("Y-m-d") . "' and empleado_contratos.empCon_fechaHasta != '0000-00-00 00:00:00')
        ) as empleadosMujeresInactivos,
              sum(if(sex_Id = 2 and Est_id = 3,1,0)) as empleadosMujeresEliminados
      from empleado;";

        return $this->db->query($query)->result();
    }

    function informePqr() {
        $query = "select 
                        sum(if(tipSol_id = 1 and est_id = 1,1,0)) as queja,
                        sum(if(tipSol_id = 2 and est_id = 1,1,0)) as peticion, 
                        sum(if(tipSol_id = 3 and est_id = 1,1,0)) as sugerencia, 
                        sum(if(tipSol_id = 4 and est_id = 1,1,0)) as felicitaciones,
                        sum(if(tipSol_id = 1 and est_id = 2,1,0)) as quejaInactiva,
                        sum(if(tipSol_id = 2 and est_id = 2,1,0)) as peticionInactiva, 
                        sum(if(tipSol_id = 3 and est_id = 2,1,0)) as sugerenciaInactiva, 
                        sum(if(tipSol_id = 4 and est_id = 2,1,0)) as felicitacionesInactiva,
                        sum(if(tipSol_id = 1 and est_id = 3,1,0)) as quejaEliminada,
                        sum(if(tipSol_id = 2 and est_id = 3,1,0)) as peticionEliminada, 
                        sum(if(tipSol_id = 3 and est_id = 3,1,0)) as sugerenciaEliminada, 
                        sum(if(tipSol_id = 4 and est_id = 3,1,0)) as felicitacionesEliminada
                    from 
                        pqr";
        return $this->db->query($query)->result();
    }

}
