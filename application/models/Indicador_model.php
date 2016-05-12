<?php

class Indicador_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
            $this->db->insert("indicador", $data);
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function actualizar($id, $data) {
        try {
            $this->db->where("ind_id", $id);
            $this->db->update("indicador", $data);
        } catch (exception $e) {
            
        }
    }

    function search($tipo, $dimension, $dimensiondos) {
        try {
            if (!empty($tipo))
                $this->db->where("indicador.indTip_id", $tipo);
            if (!empty($dimension))
                $this->db->where("indicador.dim_id", $dimension);
            if (!empty($dimensiondos))
                $this->db->where("indicador.dimdos_id", $dimensiondos);

            $this->db->select("indicador.ind_id");
            $this->db->select("indicador_tipo.indTip_tipo");
            $this->db->select("indicador_tipo.indTip_id");
            $this->db->select("indicador.ind_indicador");
            $this->db->select("dimension.dim_descripcion as dimuno");
            $this->db->select("dimension2.dim_descripcion as dimdos");
            $this->db->select("indicador.ind_mide");
            $this->db->select("indicador.ind_frecuencia");
            $this->db->select("indicador.ind_minimo");
            $this->db->select("indicador.ind_maximo");
            $this->db->select("CONCAT(`empleado`.`Emp_Nombre`,' ',`empleado`.`Emp_Apellidos`) as nombre", false);

            $this->db->join("dimension", "dimension.dim_id = indicador.dim_id", "LEFT");
            $this->db->join("dimension2", "dimension2.dim_id = indicador.dimdos_id", "LEFT");
            $this->db->join("indicador_tipo", "indicador_tipo.indTip_id = indicador.indTip_id",'left');
            $this->db->join("cargo", "cargo.car_id = indicador.car_id", "LEFT");
            $this->db->join("empleado", "empleado.emp_id = indicador.emp_id", "LEFT");
            $indicadores = $this->db->get("indicador");
            return $indicadores->result();
        } catch (exception $e) {
            
        }
    }
    function eliminar_Indicador($post) {
        $this->db->where("ind_id", $post['ind_id']);
        $this->db->delete('indicador');
    }

    function detailxid($id) {
        try {
            $this->db->where("ind_id", $id);
            $indicadores = $this->db->get("indicador");
            return $indicadores->result();
        } catch (exception $e) {
            
        }
    }

    function consultaIndicadorFlechas($idIndicador, $metodo) {
        try {
            switch ($metodo) {
                case "flechaIzquierdaDoble":
                    $this->db->where("ind_id = (select min(ind_id) from indicador)");
                    break;
                case "flechaIzquierda":
                    $this->db->where("ind_id < '" . $idIndicador . "' ");
                    $this->db->order_by("ind_id desc");
                    break;
                case "flechaDerecha":
                    $this->db->where("ind_id > '" . $idIndicador . "' ");
                    $this->db->order_by("ind_id asc");
                    break;
                case "flechaDerechaDoble":
                    $this->db->where("ind_id = (select max(ind_id) from indicador)");
                    break;
                default :
                    die;
                    break;
            }
            $usuario = $this->db->get("indicador"
                    . ""
                    . "", 1);
            return $usuario->result();
        } catch (exception $e) {
            
        }
    }
    function max_id() {
        try {
            $this->db->select_max('ind_id');
            $datos = $this->db->get('indicador');
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->ind_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function min_id() {
        try {
            $this->db->select_min('ind_id');
            $datos = $this->db->get('indicador');
            $datos = $datos->result();
//        echo $this->db->last_query();
            if (count($datos) > 0)
                return $datos[0]->ind_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    

    function max_id_next($id) {
        try {
            $this->db->select('ind_id');
            $datos = $this->db->get('indicador', 1, 1);
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->ind_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }
    
    function select_id() {
        try {
            $this->db->select('ind_id');
            $datos = $this->db->get('indicador', 1, 1);
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->ind_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }
    
    function indicadorAccidentes($cargo,$clasificacion,$dimensiondos,$dimensionuno,$fechaFinal,$fechaInicial,$tipoClasificacion){
        
        $this->db->group_by("date_format(ac1.acc_fechaAccidente,'%m-%Y')");
        $this->db->order_by("CAST(ac1.acc_fechaAccidente as DATE)");
        $this->db->select("date_format(ac1.acc_fechaAccidente, '%m-%Y') as Mes, SUM(if(ac3.tipEve_id = 2,1,0)) as incidente ,SUM(if(ac2.tipEve_id = 1,1,0))  as accidente",FALSE);
        $this->db->where("CAST(ac1.acc_fechaAccidente as DATE) >=",$fechaInicial);
        $this->db->where("CAST(ac1.acc_fechaAccidente as DATE) <=",$fechaFinal);
        $this->db->join("accidentes ac2","ac2.acc_id = ac1.acc_id and ac2.tipEve_id = 1","LEFT");
        $this->db->join("accidentes ac3","ac3.acc_id = ac1.acc_id and ac1.tipEve_id = 2","LEFT");
        $accidente = $this->db->get("accidentes ac1");
        
//        echo $this->db->last_query();die;
        
        return $accidente->result();
    }
    function indicadorAusentismo($cargo,$clasificacion,$dimensiondos,$dimensionuno,$fechaFinal,$fechaInicial,$tipoClasificacion){
        
        $this->db->select("date_format(empAus_fechaInicial,'%m-%Y') as fechaAusentados, count(*) as cantidadAusentismo");
        $this->db->group_by("date_format(empAus_fechaInicial,'%m-%Y')");
        $this->db->where("CAST(empAus_fechaInicial as DATE) >=",$fechaInicial);
        $this->db->where("CAST(empAus_fechaInicial as DATE) <=",$fechaFinal);
        $ausentismo = $this->db->get("empleado_ausentismo");
        
//        echo $this->db->last_query();die;
        
        return $ausentismo->result();
    }
    function indicadorAccidenteConIncapacidad($cargo,$clasificacion,$dimensiondos,$dimensionuno,$fechaFinal,$fechaInicial,$tipoClasificacion){
        
        $this->db->order_by("acc_fechaAccidente");
        $this->db->select("date_format(acc_fechaAccidente,'%m-%Y') as mesAccidente,COUNT(*) as cantidadAccidentes");
        $this->db->where("CAST(acc_fechaAccidente as DATE) >=",$fechaInicial);
        $this->db->where("CAST(acc_fechaAccidente as DATE) <=",$fechaFinal);
        $this->db->group_by("date_format(acc_fechaAccidente,'%m-%Y')");
        $this->db->join("empleado_incapacidad","empleado_incapacidad.acc_id = accidentes.acc_id");
        $accidentes = $this->db->get("accidentes");
        return $accidentes->result();
    }
    
    function indicadorInspeccion($cargo,$clasificacion,$dimensiondos,$dimensionuno,$fechaFinal,$fechaInicial,$tipoClasificacion){
        $query = "select distinct 
	fecha.fec_fecha,
        (
		select 
			 count(*)
		from extintor 
		where est_id = 1 
	   and SUBSTRING(fecha.fec_fecha,1,7) = SUBSTRING(extintor.ext_fechaInspeccion,1,7)
	) as cantidadInspeccionExtintor, 
	(
		select 
			DISTINCT SUBSTRING(extintor.ext_fechaInspeccion,1,7)
		from extintor 
		where est_id = 1 
	   and SUBSTRING(fecha.fec_fecha,1,7) = SUBSTRING(extintor.ext_fechaInspeccion,1,7)
		GROUP BY ext_fechaInspeccion
		order by ext_fechaInspeccion asc
	) as fechaInspeccion,
            (select 
                    count(*)
            from 
            botiquin where est_id = 1 
            and SUBSTRING(fecha.fec_fecha,1,7) = SUBSTRING(botiquin.bot_fechaInspeccion,1,7)
            ) as cantidadBotiquin,
            (
            select 
                    DISTINCT SUBSTRING(botiquin.bot_fechaInspeccion,1,7)
            from 
            botiquin where est_id = 1 
            and SUBSTRING(fecha.fec_fecha,1,7) = SUBSTRING(botiquin.bot_fechaInspeccion,1,7)
            group by bot_fechaInspeccion
            order by bot_fechaInspeccion asc
            ) as fechaInspeccionBotiquin,
            (
            select count(*) 
            from inspeccion 
            where est_id = 1 
            and SUBSTRING(fecha.fec_fecha,1,7) = SUBSTRING(inspeccion.ins_fecha,1,7)
            ) as cantidadInspeccionGeneral
            from fecha
            where fec_fecha >= '$fechaInicial' and fec_fecha <= '$fechaFinal' order by fec_fecha";
        
        return $this->db->query($query)->result();
    }
    
    function indicadorCapacitaciones($cargo,$clasificacion,$dimensiondos,$dimensionuno,$fechaFinal,$fechaInicial,$tipoClasificacion){
        $this->db->select("fecha.fec_fecha");
        $this->db->distinct("fecha.fec_fecha");
        $this->db->select("
                            (select count(*) 
                        from capacitacion 
                        where est_id = 1 
                        and SUBSTRING(fecha.fec_fecha,1,7) = SUBSTRING(capacitacion.cap_fechaCapacitacion,1,7)
                        ) as cantidadCapacitaciones
                        ",false,false);
        $this->db->order_by("fec_fecha");
        $this->db->where("fec_fecha >=",$fechaInicial);
        $this->db->where("fec_fecha <=",$fechaFinal);
        $fecha = $this->db->get("fecha");
        
//        echo  $this->db->last_query();die;
        return $fecha->result();
    }
    function indicadorReunionCopasst($cargo,$clasificacion,$dimensiondos,$dimensionuno,$fechaFinal,$fechaInicial,$tipoClasificacion){
        $this->db->select("fecha.fec_fecha");
        $this->db->distinct("fecha.fec_fecha");
        $this->db->select("
                            (select count(*) 
                        from copasst_reuniones 
                        where est_id = 1 
                        and SUBSTRING(fecha.fec_fecha,1,7) = SUBSTRING(copasst_reuniones.copReu_fecha,1,7)
                        ) as cantidadCapacitaciones
                        ",false,false);
        $this->db->order_by("fec_fecha");
        $this->db->where("fec_fecha >=",$fechaInicial);
        $this->db->where("fec_fecha <=",$fechaFinal);
        $fecha = $this->db->get("fecha");
        
//        echo  $this->db->last_query();die;
        return $fecha->result();
    }
}

?>
