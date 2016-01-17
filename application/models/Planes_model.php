<?php

class Planes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function detail() {
        try {
            $this->db->where("est_id", 1);
            $planes = $this->db->get("planes");
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function create($data) {
        try {
            $this->db->insert("planes", $data);
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function filtrobusqueda($nombre, $responsable, $estado, $tareaspropias, $emp_id) {
//        echo $emp_id;die;
        try {
            if (!empty($nombre))
                $this->db->where('pla_nombre', $nombre);
            if (!empty($responsable))
                $this->db->where('planes.emp_id', $responsable);
            if (!empty($estado))
                $this->db->where("planes.est_id", $estado);
            if (!empty($tareaspropias))
                $this->db->where("tarea.emp_id", $tareaspropias);

            $this->db->select("planes.*");
            $this->db->select("empleado.Emp_Nombre");
            $this->db->select("empleado.Emp_Apellidos,sum(replace(tar_costopresupuestado,LTRIM(RTRIM(',')),'')) AS tar_costopresupuestado", false);
            $this->db->select("(select COUNT(emp_id) i
                            from tarea
                            where pla_id = planes.pla_id and emp_id=" . $emp_id . "
                            ) as num_tareas ");
            $this->db->select("count(avance_tarea.avaTar_progreso) as count_progreso ,"
                    . "sum(avance_tarea.avaTar_progreso) as sum_progreso", false);
            $this->db->join("empleado", "empleado.Emp_id = planes.emp_id", "LEFT");
            $this->db->join("tarea", "tarea.pla_id = planes.pla_id and tarea.est_id=1 ", "LEFT");
            $this->db->join("avance_tarea", "avance_tarea.tar_id = tarea.tar_id ", "LEFT");
            $this->db->group_by('planes.pla_id');
            $planes = $this->db->get("planes");
//            echo $this->db->last_query();die;
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function delete($id) {
        try {
            $this->db->trans_begin();
            $this->db->where('pla_id', $id);
            $this->db->delete('planes');
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        } catch (exception $e) {
            
        } finally {
            return $this->db->trans_status();
        }
    }

    function min_plan() {
        try {
            $this->db->select('min(pla_id) as pla_id', FALSE);
            $datos = $this->db->get('planes');
            $datos = $datos->result();
            return $datos[0]->pla_id;
        } catch (exception $e) {
            
        }
    }

    function planxid($pla_id) {
        try {
            $query = "SELECT 
                `planes` . * 
                , ( select sum(replace( tarea.tar_costopresupuestado, ',', '' )) from tarea where planes.pla_id = tarea.pla_id  ) AS tar_costopresupuestado
                ,sum(replace( avance_tarea.avaTar_costo, ',', '' )) as avaTar_costo
                    FROM `planes`
                    LEFT JOIN `tarea` ON `tarea`.`pla_id` = `planes`.`pla_id`
                    LEFT JOIN avance_tarea ON avance_tarea.tar_id = tarea.tar_id
                    WHERE `planes`.`pla_id` = '" . $pla_id . "'  "
                    . "group by pla_id ";
//            $this->db->select("planes.*,sum(replace(tar_costopresupuestado,',','')) as tar_costopresupuestado",false);
//            $this->db->where('planes.pla_id', $pla_id);
//            $this->db->join("tarea","tarea.pla_id = planes.pla_id","LEFT");
            $planes = $this->db->query($query);
//            echo $this->db->last_query();die;
//            echo $this->db->last_query();die;
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function responsables() {
        try {
            $this->db->select("empleado.Emp_Id");
            $this->db->select("empleado.Emp_Nombre");
            $this->db->select("empleado.Emp_Apellidos");
            $this->db->distinct("empleado.Emp_Id");
            $this->db->distinct("empleado.Emp_Nombre");
            $this->db->distinct("empleado.Emp_Apellidos");
            $this->db->join("empleado", "empleado.Emp_Id = planes.emp_id");
            $planes = $this->db->get("planes");
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function actualizar($data, $pla_id) {
        try {
            $this->db->where('pla_id', $pla_id);
            $this->db->update("planes", $data);
        } catch (exception $e) {
            
        }
    }

    function actividadhijoxplan($id) {
        try {
            $this->db->select("tarea.tar_fechaInicio as fechainicio");
            $this->db->select("tarea.tar_fechaFinalizacion as fechafin");
            $this->db->select("actividad_padre.actPad_id");
            $this->db->select("CONCAT(actividad_padre.actPad_nombre,' - ',actividad_padre.actPad_codigo) as nombre", false);
            $this->db->select("actividad_hijo.actHij_nombre");
            $this->db->select("actividad_hijo.actHij_padreid");
            $this->db->select("actividad_hijo.actHij_fechaInicio");
            $this->db->select("actividad_hijo.actHij_fechaFinalizacion");
            $this->db->select("actividad_hijo.actHij_presupuestoTotal");
            $this->db->select("actividad_hijo.actHij_descripcion");
            $this->db->select("actividad_hijo.actHij_id");
            $this->db->order_by("actividad_padre.actPad_nombre");
            $this->db->where("actividad_padre.pla_id", $id);
            $this->db->join("actividad_hijo", "actividad_hijo.actHij_padreid = actividad_padre.actPad_id", "LEFT");
            $this->db->join("tarea", "tarea.actHij_id = actividad_hijo.actHij_id", "LEFT");
            $planes = $this->db->get("actividad_padre");
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function actividadhijoxplancount($id, $cantidad = null, $orden, $inicia = null) {
        try {
            $this->db->select("actividad_hijo.actHij_padreid");
            $this->db->select("actividad_hijo.actHij_fechaInicio");
            $this->db->select("actividad_hijo.actHij_fechaFinalizacion");
            $this->db->select("actividad_hijo.actHij_presupuestoTotal");
            $this->db->select("actividad_hijo.actHij_descripcion");
            $this->db->where("planes.pla_id", $id);
            $this->db->join("actividad_hijo", "actividad_hijo.pla_id = planes.pla_id");
            $planes = $this->db->get("planes");
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function tareaxplan($id) {
        try {
            $sql = "
            select avaTar_id,tar_fechaInicio,Emp_Nombre,tip_tipo,tar_nombre,diferencia,tar_fechaFinalizacion
            ,MAX(avaTar_fechaCreacion) as ultimafechacreacion,tar_id,progreso,rieCla_id,tipRie_id from (
                    SELECT 
                    avance_tarea.avaTar_fechaCreacion as avaTar_fechaCreacion,
                    tarea.tar_id,
                    avance_tarea.avaTar_id,
                    `avance_tarea`.`avaTar_progreso` as `progreso`, `tarea`.`car_id`, 
                    `tipo`.`tip_tipo`, `tar_nombre`, `tarea`.`tar_fechaInicio`, 
                    `tarea`.`tar_fechaFinalizacion`, 
                    timestampdiff(HOUR, (tar_fechaInicio),(tar_fechaFinalizacion)) as diferencia, 
                    `empleado`.`Emp_Nombre`,tarea.rieCla_id,tarea.tipRie_id
                    FROM `planes` 
                    JOIN `tarea` ON `tarea`.`pla_id` = `planes`.`pla_id` 
                    LEFT JOIN `avance_tarea` ON `avance_tarea`.`tar_id` = `tarea`.`tar_id` 
                    LEFT JOIN `empleado` ON `empleado`.`emp_id` = `tarea`.`emp_id` 
                    LEFT JOIN `tipo` ON `tipo`.`tip_id` = `tarea`.`tip_id` 
                    WHERE `planes`.`pla_id` = '" . $id . "' AND `tarea`.`est_id` = 1
                    ORDER BY avance_tarea.avaTar_fechaCreacion desc
                    ) tabla
                    GROUP BY tar_id
                    ";
            $planes = $this->db->query($sql);
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function tareaxplanriesgo($id) {
        try {
            $planes = $this->db->query("select avaTar_id,tar_fechaInicio,Emp_Nombre,tip_tipo,tar_nombre,diferencia,tar_fechaFinalizacion,MAX(avaTar_fechaCreacion) as ultimafechacreacion,tar_id,progreso from (
                    SELECT 
                    avance_tarea.avaTar_fechaCreacion as avaTar_fechaCreacion,
                    tarea.tar_id,
                    avance_tarea.avaTar_id,
                    `avance_tarea`.`avaTar_progreso` as `progreso`, `tarea`.`car_id`, 
                    `tipo`.`tip_tipo`, `tar_nombre`, `tarea`.`tar_fechaInicio`, 
                    `tarea`.`tar_fechaFinalizacion`, 
                    timestampdiff(HOUR, (tar_fechaInicio),(tar_fechaFinalizacion)) as diferencia, 
                    `empleado`.`Emp_Nombre` 
                    FROM `planes` 
                    JOIN `tarea` ON `tarea`.`pla_id` = `planes`.`pla_id` 
                    LEFT JOIN `avance_tarea` ON `avance_tarea`.`tar_id` = `tarea`.`tar_id` 
                    LEFT JOIN `empleado` ON `empleado`.`emp_id` = `tarea`.`emp_id` 
                    LEFT JOIN `tipo` ON `tipo`.`tip_id` = `tarea`.`tip_id` 
                    WHERE `tarea`.`rieCla_id` = '" . $id . "' AND `tarea`.`est_id` = 1
                    ORDER BY avance_tarea.avaTar_fechaCreacion desc
                    ) tabla
                    GROUP BY tar_id
                    ");
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function tareaxplancount($id, $cantidad = null, $orden, $inicia = null) {
        try {
            $this->db->select("'falta'");
            $this->db->select("'falta'");
            $this->db->select("tipo.tip_tipo");
            $this->db->select("tar_nombre");
            $this->db->select("tarea.tar_fechaInicio");
            $this->db->select("tarea.tar_fechaFinalizacion");
            $this->db->select("DATEDIFF((tar_fechaFinalizacion),(tar_fechaInicio)) as diferencia");
            $this->db->select("empleado.Emp_Nombre");
            $this->db->where("planes.pla_id", $id);
            $this->db->join("tarea", "tarea.pla_id = planes.pla_id");
            $this->db->join("empleado", "empleado.emp_id = tarea.emp_id", "LEFT");
            $this->db->join("tipo", "tipo.tip_id = tarea.tip_id", "LEFT");
            $planes = $this->db->get("planes");
            return $planes->num_rows();
        } catch (exception $e) {
            
        }
    }

    function tareaxplaninactivas($id) {
        try {
            $planes = $this->db->query("select avaTar_id,tar_fechaInicio,Emp_Nombre,tip_tipo,tar_nombre,diferencia,tar_fechaFinalizacion,MAX(avaTar_fechaCreacion) as ultimafechacreacion,tar_id,progreso from (
                    SELECT 
                    avance_tarea.avaTar_fechaCreacion as avaTar_fechaCreacion,
                    tarea.tar_id,
                    avance_tarea.avaTar_id,
                    `avance_tarea`.`avaTar_progreso` as `progreso`, `tarea`.`car_id`, 
                    `tipo`.`tip_tipo`, `tar_nombre`, `tarea`.`tar_fechaInicio`, 
                    `tarea`.`tar_fechaFinalizacion`, 
                    timestampdiff(HOUR, (tar_fechaInicio),(tar_fechaFinalizacion)) as diferencia, 
                    `empleado`.`Emp_Nombre` 
                    FROM `planes` 
                    JOIN `tarea` ON `tarea`.`pla_id` = `planes`.`pla_id` 
                    LEFT JOIN `avance_tarea` ON `avance_tarea`.`tar_id` = `tarea`.`tar_id` 
                    LEFT JOIN `empleado` ON `empleado`.`emp_id` = `tarea`.`emp_id` 
                    LEFT JOIN `tipo` ON `tipo`.`tip_id` = `tarea`.`tip_id` 
                    WHERE `planes`.`pla_id` = '" . $id . "' AND `tarea`.`est_id` = 2
                    ORDER BY avance_tarea.avaTar_fechaCreacion desc
                    ) tabla
                    GROUP BY tar_id
                    ");
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function tareaxplaninactivasriesgo($id) {
        try {
            $planes = $this->db->query("select avaTar_id,tar_fechaInicio,Emp_Nombre,tip_tipo,tar_nombre,diferencia,tar_fechaFinalizacion,MAX(avaTar_fechaCreacion) as ultimafechacreacion,tar_id,progreso from (
                    SELECT 
                    avance_tarea.avaTar_fechaCreacion as avaTar_fechaCreacion,
                    tarea.tar_id,
                    avance_tarea.avaTar_id,
                    `avance_tarea`.`avaTar_progreso` as `progreso`, `tarea`.`car_id`, 
                    `tipo`.`tip_tipo`, `tar_nombre`, `tarea`.`tar_fechaInicio`, 
                    `tarea`.`tar_fechaFinalizacion`, 
                    timestampdiff(HOUR, (tar_fechaInicio),(tar_fechaFinalizacion)) as diferencia, 
                    `empleado`.`Emp_Nombre` 
                    FROM `planes` 
                    JOIN `tarea` ON `tarea`.`pla_id` = `planes`.`pla_id` 
                    LEFT JOIN `avance_tarea` ON `avance_tarea`.`tar_id` = `tarea`.`tar_id` 
                    LEFT JOIN `empleado` ON `empleado`.`emp_id` = `tarea`.`emp_id` 
                    LEFT JOIN `tipo` ON `tipo`.`tip_id` = `tarea`.`tip_id` 
                    WHERE `tarea`.`rieCla_id` = '" . $id . "' AND `tarea`.`est_id` = 2
                    ORDER BY avance_tarea.avaTar_fechaCreacion desc
                    ) tabla
                    GROUP BY tar_id
                    ");
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function plan_grant($ID) {
        try {
            $datos = $this->db->query("SELECT max(tar_fechaFinalizacion) as fecha_maxima,
            min(tarea.tar_fechaInicio) as fecha_minima
            FROM planes 
            JOIN tarea ON tarea.pla_id = planes.pla_id 
            LEFT JOIN avance_tarea ON avance_tarea.tar_id = tarea.tar_id 
            LEFT JOIN empleado ON empleado.emp_id = tarea.emp_id 
            LEFT JOIN tipo ON tipo.tip_id = tarea.tip_id 
            WHERE planes.pla_id = '" . $ID . "' AND tarea.est_id = 1
            ORDER BY avance_tarea.avaTar_fechaCreacion desc");

            $sql = "select 
                tar_fechaInicio,
                tar_nombre,diferencia,
                tar_fechaFinalizacion,MAX(avaTar_fechaCreacion) as ultimafechacreacion,
                tar_id,progreso from (
                    SELECT 
                    avance_tarea.avaTar_fechaCreacion as avaTar_fechaCreacion,
                    tarea.tar_id,
                    avance_tarea.avaTar_id,
                    avance_tarea.avaTar_progreso as progreso, tarea.car_id, 
                    tipo.tip_tipo, tar_nombre, tarea.tar_fechaInicio, 
                    tarea.tar_fechaFinalizacion, 
                    DATEDIFF((tar_fechaFinalizacion), (tar_fechaInicio)) as diferencia, 
                    empleado.Emp_Nombre 
                    FROM planes 
                    JOIN tarea ON tarea.pla_id = planes.pla_id 
                    LEFT JOIN avance_tarea ON avance_tarea.tar_id = tarea.tar_id 
                    LEFT JOIN empleado ON empleado.emp_id = tarea.emp_id 
                    LEFT JOIN tipo ON tipo.tip_id = tarea.tip_id 
                    WHERE planes.pla_id = '" . $ID . "' AND tarea.est_id = 1
                    ORDER BY avance_tarea.avaTar_fechaCreacion desc
                    ) tabla
                GROUP BY tar_id";
            $datos2 = $this->db->query($sql);

            return array($datos->result(), $datos2->result());
        } catch (exception $e) {
            
        }
    }

    function max_id() {
        try {
            $this->db->select_max('pla_id');
            $datos = $this->db->get('planes');
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->pla_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function min_id() {
        try {
            $this->db->select_min('pla_id');
            $datos = $this->db->get('planes');
            $datos = $datos->result();
//        echo $this->db->last_query();
            if (count($datos) > 0)
                return $datos[0]->pla_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function max_id_next($id) {
        try {
            $this->db->select('pla_id');
            $datos = $this->db->get('planes', 1, 1);
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->pla_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function select_id() {
        try {
            $this->db->select('pla_id');
            $datos = $this->db->get('planes', 1, 1);
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->pla_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function max_id_tarea() {
        try {
            $this->db->select_max('tar_id');
            $datos = $this->db->get('tarea');
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->tar_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function min_id_tarea() {
        try {
            $this->db->select_min('tar_id');
            $datos = $this->db->get('tarea');
            $datos = $datos->result();
//        echo $this->db->last_query();
            if (count($datos) > 0)
                return $datos[0]->tar_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function max_id_next_tarea($id) {
        try {
            $this->db->select('tar_id');
            $datos = $this->db->get('tarea', 1, 1);
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->tar_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function select_id_tarea() {
        try {
            $this->db->select('tar_id');
            $datos = $this->db->get('tarea', 1, 1);
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->tar_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function obtener_tipo($id) {
        $this->db->where('rieClaTip_id', $id);
        $datos = $this->db->get('riesgo_clasificacion_tipo');
        $datos = $datos->result();
        if (count($datos)) {
            return $datos[0]->rieClaTip_tipo;
        } else {
            return '';
        }
    }

    function obtener_clasificacion($id) {
        $this->db->where('rieCla_id', $id);
        $datos = $this->db->get('riesgo_clasificacion');
        $datos = $datos->result();
        if (count($datos)) {
            return $datos[0]->rieCla_categoria;
        } else {
            return '';
        }
    }

    /*
      Devuelve fecha inicio y fecha fin de un plan, para gráficas principalmente
     * 
     *      */

    function mesesPlan($pla_id = null, $dim_id = null, $dim2_id = null) {

        $pla_id > 0 ? $whereplan = " AND pla_id = $pla_id" : $whereplan = "";
        $dim_id > 0 ? $wheredim = " AND dim_id = $dim_id" : $wheredim = "";
        $dim2_id > 0 ? $wheredim2 = " AND dim2_id = $dim2_id" : $wheredim2 = "";

        $query = "SELECT MIN(DATE_FORMAT(tar_fechaInicio,'%d/%m/%Y')) desde, MAX(DATE_FORMAT(tar_fechaFinalizacion,'%d/%m/%Y')) hasta 
                FROM tarea t
                WHERE 1=1 
                $whereplan
                $wheredim
                $wheredim2    
                ";
        $datos = $this->db->query($query);
        return $datos->result();
    }

    /* Devuelve todos los meses de un plan en texto para imprimir columnas en gantt */

    function listaMesesPlan($pla_id = null, $dim_id = null, $dim2_id = null) {
        $pla_id > 0 ? $whereplan = " AND pla_id = $pla_id" : $whereplan = "";
        $dim_id > 0 ? $wheredim = " AND dim_id = $dim_id" : $wheredim = "";
        $dim2_id > 0 ? $wheredim2 = " AND dim2_id = $dim2_id" : $wheredim2 = "";
        $arreglo_meses[1][0] = "Enero";
        $arreglo_meses[2][0] = "Febrero";
        $arreglo_meses[3][0] = "Marzo";
        $arreglo_meses[4][0] = "Abril";
        $arreglo_meses[5][0] = "Mayo";
        $arreglo_meses[6][0] = "Junio";
        $arreglo_meses[7][0] = "Julio";
        $arreglo_meses[8][0] = "Agosto";
        $arreglo_meses[9][0] = "Septiembre";
        $arreglo_meses[10][0] = "Octubre";
        $arreglo_meses[11][0] = "Noviembre";
        $arreglo_meses[12][0] = "Diciembre";
        $arreglo_meses[13][0] = "Enero";
        $arreglo_meses[14][0] = "Febrero";

        $arreglo_meses[1][1] = "31";
        $arreglo_meses[2][1] = "28";
        $arreglo_meses[3][1] = "31";
        $arreglo_meses[4][1] = "30";
        $arreglo_meses[5][1] = "31";
        $arreglo_meses[6][1] = "30";
        $arreglo_meses[7][1] = "31";
        $arreglo_meses[8][1] = "31";
        $arreglo_meses[9][1] = "30";
        $arreglo_meses[10][1] = "31";
        $arreglo_meses[11][1] = "30";
        $arreglo_meses[12][1] = "31";
        $arreglo_meses[13][1] = "31";
        $arreglo_meses[14][1] = "28";
        //SELECT TIMESTAMPDIFF(MONTH, '2012-05-05', '2012-12-16')
        $query = "SELECT TIMESTAMPDIFF(MONTH,MIN(tar_fechaInicio), MAX(tar_fechaFinalizacion))  as meses 
                  FROM tarea t
                  WHERE 1=1 
                $whereplan
                $wheredim
                $wheredim2    
                ";
        $datos = $this->db->query($query);
        $datos = $datos->result();
        $numero_meses = $datos[0]->meses;

        $query = "SELECT MONTH(MIN(tar_fechaInicio))  as mesinicio 
                FROM tarea t
                WHERE 1=1 
                $whereplan
                $wheredim
                $wheredim2    
                ";
        $datos = $this->db->query($query);
        $datos = $datos->result();
        $mes_inicio = $datos[0]->mesinicio;

        for ($i = 0; $i <= $numero_meses; $i++) {
            $lista_meses[$i] = $arreglo_meses[$i + $mes_inicio];
        }

        return $lista_meses;
    }

    /*
      Devuelve fecha inicio y fecha fin de un plan, para gráficas principalmente
     * 
     *      */

    function tareasPlanGrafica($pla_id = null, $dim_id = null, $dim2_id = null) {

        $pla_id > 0 ? $whereplan = " AND pla_id = $pla_id" : $whereplan = "";
        $dim_id > 0 ? $wheredim = " AND dim_id = $dim_id" : $wheredim = "";
        $dim2_id > 0 ? $wheredim2 = " AND dim2_id = $dim2_id" : $wheredim2 = "";
        
       $this->db->select("tar_id as id,  tar_nombrecorto as nombre  , DATE_FORMAT(tar_fechaInicio,'%d/%m/%Y') as fechainicio, DATE_FORMAT(tar_fechaFinalizacion,'%d/%m/%Y')  as fechafin ");
       $this->db->where("1",1);
       $this->db->order_by("tar_fechaInicio");
       $datos = $this->db->get("tarea t");
//        var_dump($datos);die;
        return $datos->result();
    }

    function tareasPHVA($pla_id = null, $dim_id = null, $dim2_id = null) {

        $pla_id > 0 ? $whereplan = " AND pla_id = $pla_id" : $whereplan = "";
        $dim_id > 0 ? $wheredim = " AND dim_id = $dim_id" : $wheredim = "";
        $dim2_id > 0 ? $wheredim2 = " AND dim2_id = $dim2_id" : $wheredim2 = "";

        $query = "SELECT count(*) as cantidad, tip_tipo
                    FROM tarea t
                    INNER JOIN tipo ON tipo.tip_id = t.tip_id
                    
                WHERE 1=1 
                $whereplan
                $wheredim
                $wheredim2    
                    
                GROUP BY tip_tipo 
                ORDER BY tip_tipo
                ";
        $datos = $this->db->query($query);
        return $datos->result();
    }

    function tareasPHVAAvance($pla_id = null, $dim_id = null, $dim2_id = null) {

        $pla_id > 0 ? $whereplan = " AND pla_id = $pla_id" : $whereplan = "";
        $dim_id > 0 ? $wheredim = " AND dim_id = $dim_id" : $wheredim = "";
        $dim2_id > 0 ? $wheredim2 = " AND dim2_id = $dim2_id" : $wheredim2 = "";

        $query = "SELECT count(*), tip_tipo
                FROM tipo
                LEFT JOIN tarea t ON tipo.tip_id = t.tip_id
                INNER JOIN avance_tarea at ON at.tar_id = t.tar_id
                  WHERE 1=1 
                $whereplan
                $wheredim
                $wheredim2    
                    
                GROUP BY tip_tipo 
                ORDER BY tip_tipo
                ";
        $datos = $this->db->query($query);
        return $datos->result();
    }

}

?>