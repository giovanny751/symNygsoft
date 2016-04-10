<?php

class Tarea_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create() {
        try {
            $post = $this->input->post();
            if (isset($post['actividad']))
                if (!empty($post['actividad']))
                    $this->db->set("actPad_id", $this->input->post("actividad"));
            if (isset($post['cargo']))
                if (!empty($post['cargo']))
                    $this->db->set("car_id", $this->input->post("cargo"));
            if (isset($post['costrospresupuestados']))
                if (!empty($post['costrospresupuestados']))
                    $this->db->set("tar_costopresupuestado", $this->input->post("costrospresupuestados"));
            if (isset($post['descripcion']))
                if (!empty($post['descripcion']))
                    $this->db->set("tar_descripcion", $this->input->post("descripcion"));
            if (isset($post['dimensionuno']))
                if (!empty($post['dimensionuno']))
                    $this->db->set("dim_id", $this->input->post("dimensionuno"));
            if (isset($post['dimensiondos']))
                if (!empty($post['dimensiondos']))
                    $this->db->set("dim2_id", $this->input->post("dimensiondos"));
            if (isset($post['estado']))
                if (!empty($post['estado']))
                    $this->db->set("est_id", $this->input->post("estado"));
            if (isset($post['fechaIncio']))
                if (!empty($post['fechaIncio']))
                    $this->db->set("tar_fechaInicio", $this->input->post("fechaIncio"));

            $this->db->set("tar_fechaCreacion", date("Y-m-d H:i:s"));
            if (isset($post['fechafinalizacion']))
                if (!empty($post['fechafinalizacion']))
                    $this->db->set("tar_fechaFinalizacion", $this->input->post("fechafinalizacion"));
            if (isset($post['nombre']))
                if (!empty($post['nombre']))
                    $this->db->set("tar_nombre", $this->input->post("nombre"));
            if (isset($post['nombreempleado']))
                if (!empty($post['nombreempleado']))
                    $this->db->set("emp_id", $this->input->post("nombreempleado"));
            if (isset($post['peso']))
                if (!empty($post['peso']))
                    $this->db->set("tar_peso", $this->input->post("peso"));
            if (isset($post['plan']))
                if (!empty($post['plan']))
                    $this->db->set("pla_id", $this->input->post("plan"));
            if (isset($post['tipo']))
                if (!empty($post['tipo']))
                    $this->db->set("tip_id", $this->input->post("tipo"));
            if (isset($post['tareapadre']))
                if (!empty($post['tareapadre']))
                    $this->db->set("tar_idpadre", $this->input->post("tareapadre"));
            if (isset($post['norma']))
                if (!empty($post['norma']))
                    $this->db->set("nor_id", $this->input->post("norma"));
            if (isset($post['rutinario']))
                if (!empty($post['rutinario']))
                    $this->db->set("tar_rutinario", $this->input->post("rutinario"));
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
            $this->db->insert("tarea");
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function tareanorma($data, $idtarea) {
        try {
            $this->db->where("tar_id", $idtarea);
            $this->db->delete("norma_tarea");

            $this->db->insert_batch("norma_tarea", $data);
        } catch (exception $e) {
            
        }
    }

    function traer_tarea_registro($data) {
        try {
            $this->db->where("pla_id", $data['pla_id']);
            $this->db->where("tar_id", $data['tar_id']);
            $this->db->join("user", "user.usu_id=tarea_registro.usu_id");
            $datos = $this->db->get("tarea_registro");
            return $datos->result();
        } catch (exception $e) {
            
        }
    }

    function crear_norma($post) {
        try {
            $this->db->set('nor_norma', $post['norma']);
            $this->db->set('nor_descripcion', $post['descripcion']);
//            $this->db->where('nor_id', $post['nor_id']);
            $this->db->set('creatorUser', $this->session->userdata('usu_id'));
            $this->db->set('creatorDate', date("Y-m-d H:i:s"));
            $this->db->insert("norma");
            return $this->lista_norma();
        } catch (exception $e) {
            
        }
    }

    function actualizar_norma($post) {
        try {
            if (!isset($post['est_id'])) {
                $this->db->set('nor_norma', $post['norma']);
                $this->db->set('nor_descripcion', $post['descripcion']);
            } else {
                $this->db->set('est_id', 3);
            }
            $this->db->where('nor_id', $post['nor_id']);
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
            $this->db->update("norma");
//            echo $this->db->last_query();
            return $this->lista_norma();
        } catch (exception $e) {
            
        }
    }

    function lista_norma() {
        try {
            $this->db->select("norma.*,(select count(*) from norma_articulo where norma_articulo.nor_id=norma.nor_id and norma_articulo.est_id=1) cantidad_articulos", false);
//            $this->db->join("norma_articulo", "norma_articulo.nor_id=norma.nor_id");
            $this->db->where("est_id", 1);
            $datos = $this->db->get("norma");
            return $datos->result();
        } catch (exception $e) {
            
        }
    }

    function lista_articulos($post) {
        try {
            $this->db->select("norma_articulo.*");
            $this->db->where("nor_id", $post['nor_id']);
            $this->db->where("est_id", 1);
//            $this->db->join("norma_articulo", "norma_articulo.nor_id=norma.nor_id");
            $datos = $this->db->get("norma_articulo");
            return $datos->result();
        } catch (exception $e) {
            
        }
    }

    function actualizar_articulo($post) {
        try {
            if (isset($post['articulo_mod'])) {
                $this->db->set('norArt_articulo', $post['articulo_mod']);
                $this->db->set('nor_id', $post['nor_id']);
            } else {
                $this->db->set('est_id', 3);
            }
            if (!empty($post['norArt_id'])) {
                $this->db->where('norArt_id', $post['norArt_id']);
                $this->db->set('modificationUser', $this->session->userdata('usu_id'));
                $this->db->set('modificationDate', date("Y-m-d H:i:s"));
                $this->db->update("norma_articulo");
            } else {
                $this->db->set('creatorUser', $this->session->userdata('usu_id'));
                $this->db->set('creatorDate', date("Y-m-d H:i:s"));
                $this->db->insert("norma_articulo");
            }
//            echo $this->db->last_query();
            return $this->lista_articulos($post);
        } catch (exception $e) {
            
        }
    }

    function update($idtarea) {
        try {
            $post = $this->input->post();

            if (isset($post['actividad']))
                if (!empty($post['actividad']))
                    $this->db->set("actPad_id", $this->input->post("actividad"));
            if (isset($post['cargo']))
                if (!empty($post['cargo']))
                    $this->db->set("car_id", $this->input->post("cargo"));
            if (isset($post['costrospresupuestados']))
                if (!empty($post['costrospresupuestados']))
                    $this->db->set("tar_costopresupuestado", $this->input->post("costrospresupuestados"));
            if (isset($post['descripcion']))
                if (!empty($post['descripcion']))
                    $this->db->set("tar_descripcion", $this->input->post("descripcion"));
            if (isset($post['dimensionuno']))
                if (!empty($post['dimensionuno']))
                    $this->db->set("dim_id", (!empty($this->input->post("dimensionuno")) ? $this->input->post("dimensionuno") : null));
            if (isset($post['dimensiondos']))
                if (!empty($post['dimensiondos']))
                    $this->db->set("dim2_id", (!empty($this->input->post("dimensiondos")) ? $this->input->post("dimensiondos") : null));
            if (isset($post['estado']))
                if (!empty($post['estado']))
                    $this->db->set("est_id", $this->input->post("estado"));
            if (isset($post['fechaIncio']))
                if (!empty($post['fechaIncio']))
                    $this->db->set("tar_fechaInicio", $this->input->post("fechaIncio"));
            $this->db->set("tar_fechaUltimaMod", date("Y-m-d H:i:s"));
            if (isset($post['fechafinalizacion']))
                if (!empty($post['fechafinalizacion']))
                    $this->db->set("tar_fechaFinalizacion", $this->input->post("fechafinalizacion"));
            if (isset($post['nombre']))
                if (!empty($post['nombre']))
                    $this->db->set("tar_nombre", $this->input->post("nombre"));
            if (isset($post['nombreempleado']))
                if (!empty($post['nombreempleado']))
                    $this->db->set("emp_id", $this->input->post("nombreempleado"));
            if (isset($post['peso']))
                if (!empty($post['peso']))
                    $this->db->set("tar_peso", $this->input->post("peso"));
            if (isset($post['plan']))
                if (!empty($post['plan']))
                    $this->db->set("pla_id", $this->input->post("plan"));
            if (isset($post['tipo']))
                if (!empty($post['tipo']))
                    $this->db->set("tip_id", $this->input->post("tipo"));
            if (isset($post['tareapadre']))
                if (!empty($post['tareapadre']))
                    $this->db->set("tar_idpadre", $this->input->post("tareapadre"));
            if (isset($post['norma']))
                if (!empty($post['norma']))
                    $this->db->set("nor_id", $this->input->post("norma"));
            if (isset($post['rutinario']))
                if (!empty($post['rutinario']))
                    $this->db->set("tar_rutinario", $this->input->post("rutinario"));

            $this->db->where("tar_id", $idtarea);
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
            $this->db->update("tarea");
        } catch (exception $e) {
            
        }
    }

    function eliminartarea($tar_id) {
        try {
            $this->db->trans_begin();
            $this->db->where("tar_id", $tar_id);
            $this->db->set("est_id", 3);
            $this->db->set('modificationUser', $this->session->userdata('usu_id'));
            $this->db->set('modificationDate', date("Y-m-d H:i:s"));
            $this->db->update("tarea");
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

    function detail() {
        try {
            $this->db->order_by("tar_nombre");
            $tarea = $this->db->get("tarea");
            return $tarea->result();
        } catch (exception $e) {
            
        }
    }

    function detailxid($id) {
        try {
            $this->db->where("tar_id", $id);
            $tarea = $this->db->get("tarea");
            return $tarea->result();
        } catch (exception $e) {
            
        }
    }

    function tarea_norma($id) {
        try {
            $this->db->where("tar_id", $id);
            $tarea = $this->db->get("norma_tarea");
            return $tarea->result();
        } catch (exception $e) {
            
        }
    }

    function detailxidplan($id) {
        try {
            $this->db->where("pla_id", $id);
            $tarea = $this->db->get("tarea");
            return $tarea->result();
        } catch (exception $e) {
            
        }
    }

    function responsables() {
        try {
            $this->db->select("empleado.emp_id");
            $this->db->select("empleado.Emp_Nombre");
            $this->db->select("empleado.Emp_Apellidos");
            $this->db->order_by("empleado.Emp_Nombre");
            $this->db->distinct("empleado.emp_id,empleado.Emp_Nombre,empleado.Emp_Apellidos");
            $this->db->join("empleado", "empleado.Emp_id = tarea.emp_id");
            $tarea = $this->db->get("tarea");
            return $tarea->result();
        } catch (exception $e) {
            
        }
    }

    function filtrobusqueda($plan, $tarea, $responsable) {
        try {
            if (!empty($plan))
                $this->db->where("planes.pla_id", $plan);
            if (!empty($tarea))
                $this->db->where("tarea.tar_id", $tarea);
            if (!empty($responsable))
                $this->db->where("emp_id", $responsable);

            $this->db->where("planes.est_id", 1);
            $this->db->where("tarea.est_id", 1);
            $this->db->select("tarea.tar_fechaInicio");
            $this->db->select("DATEDIFF((tar_fechaFinalizacion),(tar_fechaInicio)) diferencia");
            $this->db->select("tarea.tar_nombre");
            $this->db->select("tarea.tar_fechaFinalizacion");
            $this->db->select("empleado.Emp_Nombre");
            $this->db->select("tarea.tar_id");
            $this->db->select("tipo.tip_tipo");
            $this->db->select("planes.pla_nombre");
            $this->db->select("(select count(tarea_riesgos.tarRie_id) from tarea_riesgos where tarea.tar_id = tarea_riesgos.tar_id ) as cantidadRiesgo");
            $this->db->select("max(avance_tarea.avaTar_fecha) as ultimoAvance");
            $this->db->select("(select avaTar_progreso  from avance_tarea where tar_id=tarea.tar_id ORDER BY avaTar_fecha desc limit 1  )  progreso", false);
            $this->db->select("planes.pla_id");
            $this->db->select("(select count(rie_id) as cantidadriesgo from tarea_riesgos where tarea_riesgos.tar_id = tarea.tar_id) cantidadriesgo", false);
            $this->db->order_by("planes.pla_id");
            $this->db->order_by("tarea.tar_id");
            $this->db->join("tarea", "planes.pla_id = tarea.pla_id", "left");
            $this->db->join("avance_tarea", "avance_tarea.tar_id = tarea.tar_id ", "LEFT");
            $this->db->join("tipo", "tipo.tip_id = tarea.tip_id", "left");
            $this->db->join("empleado", "empleado.Emp_id = tarea.emp_id", "left");
            $this->db->group_by('tarea.tar_id');
            $tarea = $this->db->get("planes");


            return $tarea->result();
        } catch (exception $e) {
            
        }
    }

    function consultaTareasFlechas($idTarea, $metodo) {
        try {
            switch ($metodo) {
                case "flechaIzquierdaDoble":
                    $this->db->where("tar_id = (select min(tar_id) from tarea)");
                    break;
                case "flechaIzquierda":
                    $this->db->where("tar_id < '" . $idTarea . "' ");
                    $this->db->order_by("tar_id desc");
                    break;
                case "flechaDerecha":
                    $this->db->where("tar_id > '" . $idTarea . "' ");
                    $this->db->order_by("tar_id asc");
                    break;
                case "flechaDerechaDoble":
                    $this->db->where("tar_id = (select max(tar_id) from tarea)");
                    break;
                default :
                    die;
                    break;
            }
            $usuario = $this->db->get("tarea", 1);
            return $usuario->result();
        } catch (exception $e) {
            
        }
    }

    function fechaFinalTareaxPlan($pla_id) {
        try {
            $this->db->select("MAX(tar_fechaFinalizacion) as fechafinalizacion", false);
            $this->db->where("pla_id", $pla_id);
            $fecha = $this->db->get("tarea");
            return $fecha->result();
        } catch (exception $e) {
            
        }
    }

    function lista_riesgos($clasificacionriesgo = null, $tiposriesgos = null) {
        try {
            if ($clasificacionriesgo != null && $tiposriesgos != null) {
                $this->db->select('riesgo.*,riesgo_clasificacion_tipo.rieClaTip_tipo');
                $this->db->join('riesgo_clasificacion_tipo', 'riesgo_clasificacion_tipo.rieClaTip_id=riesgo.rieClaTip_id');
                $this->db->where_in('riesgo.rieCla_id', $clasificacionriesgo);
                $this->db->where_in('riesgo.rieClaTip_id', $tiposriesgos);
            }
            $fecha = $this->db->get("riesgo");
            return $fecha->result();
        } catch (exception $e) {
            
        }
    }

    function tarea_riegos_clasificacion($id, $clasificacionriesgo, $tiposriesgos) {
        $this->db->where('tar_id', $id);
        $this->db->delete('tarea_riegos_clasificacion');
        $this->db->where('tar_id', $id);
        $this->db->delete('tarea_riesgo_clasificacion_tipo');
        if (count($clasificacionriesgo))
            foreach ($clasificacionriesgo as $key => $value) {
                $this->db->set('rieCla_id', $value);
                $this->db->set('tar_id', $id);
                $this->db->set('creatorUser', $this->session->userdata('usu_id'));
                $this->db->set('creatorDate', date("Y-m-d H:i:s"));
                $this->db->insert('tarea_riegos_clasificacion');
            }
        if (count($tiposriesgos))
            foreach ($tiposriesgos as $key => $value) {
                $this->db->set('rieClaTip_id', $value);
                $this->db->set('tar_id', $id);
                $this->db->set('creatorUser', $this->session->userdata('usu_id'));
                $this->db->set('creatorDate', date("Y-m-d H:i:s"));
                $this->db->insert('tarea_riesgo_clasificacion_tipo');
            }
    }

    function tarea_riegos_clasificacion2($id) {

        $this->db->where('tar_id', $id);
        $dotos = $this->db->get('tarea_riegos_clasificacion');
        $dotos = $dotos->result();
        return $dotos;
    }

    function tarea_riesgo_clasificacion_tipo2($id) {
        $this->db->where('tar_id', $id);
        $dotos = $this->db->get('tarea_riesgo_clasificacion_tipo');
        $dotos = $dotos->result();
        return $dotos;
    }

    function lista_riesgos_guardados($id_tarea) {
        try {
            $this->db->where("tar_id", $id_tarea);
            $fecha = $this->db->get("tarea_riesgos");
            return $fecha->result();
        } catch (exception $e) {
            
        }
    }

    function lista_riesgos_guardados2($id_tarea) {
        try {
            $this->db->where("tar_id", $id_tarea);
            $this->db->join("riesgo", 'riesgo.rie_id=tarea_riesgos.rie_id');
            $fecha = $this->db->get("tarea_riesgos");
            return $fecha->result();
        } catch (exception $e) {
            
        }
    }

    function tareaxRiesgo($id) {
        try {
            $planes = $this->db->query("select avaTar_id,tar_fechaInicio,Emp_Nombre,tip_tipo,tar_nombre,diferencia,tar_fechaFinalizacion,MAX(avaTar_fechaCreacion) as ultimafechacreacion,tar_id,progreso from (
                    SELECT 
                    avance_tarea.avaTar_fechaCreacion as avaTar_fechaCreacion,
                    tarea.tar_id,
                    avance_tarea.avaTar_id,
                    avance_tarea.avaTar_progreso as progreso, tarea.car_id, 
                    tipo.tip_tipo, tar_nombre, tarea.tar_fechaInicio, 
                    tarea.tar_fechaFinalizacion, 
                    timestampdiff(HOUR, (tar_fechaInicio),(tar_fechaFinalizacion)) as diferencia, 
                    empleado.Emp_Nombre 
                    FROM planes 
                    JOIN tarea ON tarea.pla_id = planes.pla_id 
                    LEFT JOIN avance_tarea ON avance_tarea.tar_id = tarea.tar_id 
                    LEFT JOIN empleado ON empleado.emp_id = tarea.emp_id 
                    LEFT JOIN tipo ON tipo.tip_id = tarea.tip_id 
                    WHERE planes.pla_id = '" . $id . "' AND tarea.est_id = 1
                    ORDER BY avance_tarea.avaTar_fechaCreacion desc
                    ) tabla
                    GROUP BY tar_id
                    ");
            return $planes->result();
        } catch (exception $e) {
            
        }
    }

    function guardar_lista_riesgos($idtarea, $lista_riesgos) {
        $this->db->where('tar_id', $idtarea);
        $this->db->delete('tarea_riesgos');

        if (!empty($lista_riesgos)) {
            foreach ($lista_riesgos as $value) {
                $this->db->set('tar_id', $idtarea);
                $this->db->set('rie_id', $value);
                $this->db->insert('tarea_riesgos');
            }
        }
    }

    /*

     * Función para obtener los presupuestos por categoria de riesgo, tiene como parámetros opcionales un plan y las dimensiones de las tareas 
     *      */

    function datosTareaPresupuesto($pla_id = null, $dim_id = null, $dim2_id = null) {
        $pla_id > 0 ? $whereplan = " AND pla_id = $pla_id" : $whereplan = "";
        $dim_id > 0 ? $wheredim = " AND dim_id = $dim_id" : $wheredim = "";
        $dim2_id > 0 ? $wheredim2 = " AND dim2_id = $dim2_id" : $wheredim2 = "";

        $query = "SELECT (t.tar_costopresupuestado) as costo, rc.rieCla_categoria as categoria
                FROM tarea t
                INNER JOIN tarea_riesgos tr ON tr.tar_id = t.tar_id
                INNER JOIN riesgo r ON r.rie_id = tr.rie_id
                INNER JOIN riesgo_clasificacion rc ON rc.rieCla_id = r.rieCla_id
                WHERE 1=1 
                $whereplan
                $wheredim
                $wheredim2    
                GROUP BY  rc.rieCla_categoria";



        $datos = $this->db->query($query);

        return $datos->result();
    }

    function tareasAsociadasPlan($pla_id) {
        try {
            $this->db->where("pla_id", $pla_id);
            $this->db->where("est_id", 1);
            $this->db->order_by("tar_nombre");
            $tarea = $this->db->get("tarea");
            return $tarea->result();
        } catch (exception $e) {
            
        }
    }

}

?>