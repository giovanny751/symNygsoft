<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @package     NYGSOFT
 * @author      Gerson J Barbosa / Nelson G Barbosa
 * @Pagina      www.nygsoft.com
 * @celular     301 385 9952
 * @email       javierbr12@hotmail.com    
 */
class Tareas extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    function nuevatarea() {

        $this->load->model(
                array(
                    'Estados_model',
                    'Tarea_model',
                    'Cargo_model',
                    'Planes_model',
                    'Avancetarea_model',
                    'Actividad_model',
                    'Dimension2_model',
                    'Dimension_model',
                    'Tipo_model',
                    'Notificacion_model',
                    "Riesgoclasificacion_model",
                    "Registrocarpeta_model",
                    'Empresa_model',
                    'Norma_model',
                    'Planes_model',
                    'Normaarticulo_model'
                )
        );
        $this->data['tareas'] = $this->Tarea_model->detail();
        $this->data['empresa'] = $this->Empresa_model->detail();
        $this->data['norma'] = $this->Norma_model->detail();
        if (!empty($this->input->post('rie_id')))
            $this->data['rie_id'] = $this->input->post('rie_id');
        if ((!empty($this->data['empresa'][0]->Dim_id)) && (!empty($this->data['empresa'][0]->Dimdos_id))) {
            if (!empty($this->input->post("tar_id"))):

                $this->data['todo_izq'] = $this->Planes_model->min_id_tarea();
                $this->db->where('tar_id <', $this->input->post('tar_id'));
                $this->data['izq'] = $this->Planes_model->max_id_tarea();
                if (empty($this->data['izq'])) {
                    $this->data['izq'] = $this->data['todo_izq'];
                }
                $this->db->where('tar_id >', $this->input->post('tar_id'));
                $this->data['derecha'] = $this->Planes_model->select_id_tarea();
                $this->data['max_der'] = $this->Planes_model->max_id_tarea();

                if (empty($this->data['derecha'])) {
                    $this->data['derecha'] = $this->data['max_der'];
                }
                if (!empty($this->input->post("nuevoavance")))
                    $this->data["nuevoavance"] = $this->input->post("nuevoavance");
                $this->data['riesgos_guardada'] = $this->Tarea_model->lista_riesgos_guardados($this->input->post('tar_id'));
                $this->load->model('Empleado_model');
                $carpeta = $this->Registrocarpeta_model->detailxtareas($this->input->post('tar_id'));
                $this->data['carpetas'] = $this->Registrocarpeta_model->detailxtareascarpetas($this->input->post('tar_id'));
                $d = array();
                foreach ($carpeta as $c) {
                    $d[$c->regCar_id][$c->regCar_nombre . " - " . $c->regCar_descripcion][] = array(
                        '<a href="' . base_url('') . $c->reg_ruta . '/' . $c->reg_id . '/' . $c->reg_archivo . '">' . $c->reg_archivo . "</a>",
                        $c->reg_descripcion,
                        $c->reg_version,
                        $c->usu_nombre . " " . $c->usu_apellido,
                        $c->reg_tamano,
                        $c->reg_fechaCreacion,
                        $c->reg_id
                    );
                }
                $this->data["avance"] = "";
                if (!empty($this->input->post('avaTar_id'))):
                    $this->load->model("Avancetarea_model");
                    $this->data["avance"] = $this->Avancetarea_model->avancexTarea($this->input->post("avaTar_id"));
                endif;
                $this->data['carpeta'] = $d;
                $this->data['tarea'] = $this->Tarea_model->detailxid($this->input->post("tar_id"))[0];
                $this->load->model("Riesgoclasificaciontipo_model");
                $this->data['tipoClasificacion'] = $this->Riesgoclasificaciontipo_model->tipoxcategoria($this->data['tarea']->rieCla_id);

                $this->data['tarea_norma'] = $this->Tarea_model->tarea_norma($this->input->post("tar_id"));
                $this->data['normaarticulo'] = $this->Normaarticulo_model->detailxId($this->data['tarea']->nor_id);

                $this->data["hijo"] = $this->Actividad_model->actividadxPlan($this->data['tarea']->pla_id);
                $this->data['empleado'] = $this->Empleado_model->empleadoxcargo($this->data['tarea']->car_id);
            endif;
            $this->data['pla_id'] = "";
            if (!empty($this->input->post("pla_id")) || (!empty($this->data['tarea']->pla_id))) {
                if (!empty($this->input->post("pla_id")))
                    $this->data['pla_id'] = $this->input->post("pla_id");
                if (!empty($this->data['tarea']->pla_id))
                    $this->data['pla_id'] = $this->data['tarea']->pla_id;

                $this->load->model('Actividadpadre_model');
                $this->data["actividades"] = $this->Actividadpadre_model->detailxplaid($this->data['pla_id']);
                if (!empty($this->data['tarea']->actPad_id)) {
                    $this->load->model('Actividad_model');
                    $this->data["actividadhijo"] = $this->Actividad_model->consultaxActividad($this->data['tarea']->actPad_id);
                }
            }
            $this->data['categoria'] = $this->Riesgoclasificacion_model->detail();
            $this->data['notificacion'] = $this->Notificacion_model->detail();
            $this->data['estados'] = $this->Estados_model->detail();
            $this->data['tipo'] = $this->Tipo_model->detail();
            $this->data['planes'] = $this->Planes_model->detail();
            $this->data['cargo'] = $this->Cargo_model->allcargos();
            $this->data['dimension'] = $this->Dimension_model->detail();
            $this->data['dimension2'] = $this->Dimension2_model->detail();
            $this->data['post'] = $this->input->post();
            $this->data['riesgos'] = $this->Tarea_model->lista_riesgos();
            $this->layout->view("tareas/nuevatarea", $this->data);
        } else {
            redirect('index.php/administrativo/empresa', 'location');
        }
    }

    function consultacarpeta() {
        try {
            $this->load->model("Registrocarpeta_model");
            $data = $this->Registrocarpeta_model->detailxid($this->input->post("carpeta"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaTipoActividad() {
        try {
            $this->load->model("Actividad_model");
            if (!empty($this->input->post('actividad'))):
                $data = $this->Actividad_model->consultaXid($this->input->post('actividad'));
                echo $data[0]->tip_id;
            endif;
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaarticulo() {
        try {
            $this->load->model("Norma_model");
            $norma = $this->Norma_model->normaarticulo($this->input->post("norma"));
            $this->output->set_content_type('application/json')->set_output(json_encode($norma));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function actualizarcarpeta() {
        try {
            $this->load->model("Registrocarpeta_model");
            $this->Registrocarpeta_model->modificarpeta(
                    $this->input->post("nombrecarpeta")
                    , $this->input->post("descripcioncarpeta")
                    , $this->input->post("tarCar_id"));
            $data = $this->Registrocarpeta_model->detailxid($this->input->post("tarCar_id"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminarregistrocarpeta() {
        try {
            $this->load->model("Registrocarpeta_model");
            $this->Registrocarpeta_model->eliminarcarpeta($this->input->post("carpeta"));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function modificarregistro() {
        try {
            $this->load->model('Registro_model');
            $datos = $this->Registro_model->modificarregistro($this->input->post("registro"));
            $this->output->set_content_type('application/json')->set_output(json_encode($datos));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminartarea() {
        try {
            $this->load->model("Tarea_model");
            $data['Json'] = $this->Tarea_model->eliminartarea($this->input->post("tarea"));
            if ($data['Json'] == false)
                throw new Exception("Error en la base de datos");
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarregistrotarea() {
        try {
            $post = $this->input->post();
            $this->load->model('Registro_model');
            $tamano = round($_FILES["archivo"]["size"] / 1024, 1) . " KB";
            $post["reg_tamano"] = $tamano;
            $fecha = new DateTime();
            $post["reg_fechaCreacion"] = $fecha->format('Y-m-d H:i:s');

            //Creamos carpeta con el ID del registro
            if (isset($_FILES['archivo']['name']))
                if (!empty($_FILES['archivo']['name']))
                    $post['reg_ruta'] = basename($_FILES['archivo']['name']);

            $pla_id = $post['pla_id'];
            $targetPath = "./uploads/planes/";

            //De la carpeta idRegistro, creamos carpeta con el id del empleado
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            $targetPath = "./uploads/planes/" . $pla_id;
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }

            $post['reg_ruta'] = $target_path = $targetPath . '/' . basename($_FILES['archivo']['name']);
            $post['reg_archivo'] = basename($_FILES['archivo']['name']);
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) {
                
            }
            $this->Registro_model->guardar_registro($post);
            $data = $this->Registro_model->registroxcarpeta($post['regCar_id']);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarregistroindicador() {
        try {
            $post = $this->input->post();
            $this->load->model('Registro_model');
            $post["reg_tamano"] = round($_FILES["archivo"]["size"] / 1024, 1) . " KB";
            $fecha = new DateTime();
            $post["reg_fechaCreacion"] = $fecha->format('Y-m-d H:i:s');
            $post["userCreator"] = $this->data["usu_id"];
            $post['reg_archivo'] = basename($_FILES['archivo']['name']);
            //Creamos carpeta con el ID del registro
            if (isset($_FILES['archivo']['name']))
                if (!empty($_FILES['archivo']['name']))
                    $post['reg_archivo'] = basename($_FILES['archivo']['name']);

            $ind_id = $post['ind_id'];
            $targetPath = "./uploads/indicador/" . $ind_id . "/";
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            //De la carpeta idRegistro, creamos carpeta con el id del empleado
            $post['reg_ruta'] = $targetPath;
            $idregistro = $this->Registro_model->guardar_registro($post);
            $targetPath = $targetPath . '/' . $idregistro;
            if (!file_exists($targetPath))
                mkdir($targetPath, 0777, true);
            $targetPath = $targetPath . '/' . basename($_FILES['archivo']['name']);
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $targetPath)) {
                
            } else {
                
            }
            $data = $this->Registro_model->registroxcarpeta($post['regCar_id']);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardar_registro_tarea() {
        try {
            $this->load->model('Registro_model');
            $post = $this->input->post();
            $post["reg_tamano"] = round($_FILES["archivo"]["size"] / 1024, 1) . " KB";
            $fecha = new DateTime();
            $post["reg_fechaCreacion"] = $fecha->format('Y-m-d H:i:s');
            $post["userCreator"] = $this->data["usu_id"];
            $post["tar_id"] = $this->input->post("tar_id");
            $post["reg_id"] = $this->input->post("reg_id");
            $targetPath = "./uploads/tareas_registro/";
            //De la carpeta idRegistro, creamos carpeta con el id del empleado
            if (!file_exists($targetPath))
                mkdir($targetPath, 0777, true);
            $targetPath = "./uploads/tareas_registro/" . $post["tar_id"];
            if (!file_exists($targetPath))
                mkdir($targetPath, 0777, true);
            $post['reg_ruta'] = $target_path = $targetPath;
            $post["reg_archivo"] = basename($_FILES['archivo']['name']);

            $id = $this->Registro_model->guardar_registro($post);
            $target_path = $targetPath . '/' . $id;
            if (!file_exists($target_path))
                mkdir($target_path, 0777, true);

            $target_path = $targetPath . '/' . $id . '/' . basename($_FILES['archivo']['name']);
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) {
                
            }
            $data = $this->Registro_model->registroxcarpeta($this->input->post('regCar_id'));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadoavance() {
        try {
            $this->load->model('Avancetarea_model');
            $cantidad = $this->input->post("length");
            $orden = $this->input->post("order[0][column]");
            $inicia = intval($_REQUEST['start']);
            $tabla = $this->Avancetarea_model->detailxid(1, $cantidad, $orden, $inicia);
            $alldatacount = $this->Avancetarea_model->detailxidcount(1, $cantidad, $orden, $inicia);
            $data = array();
            $data['data'] = arregloconsulta($tabla);
            $data["draw"] = intval($_REQUEST['draw']);
            $data['recordsTotal'] = $alldatacount;
            $data['recordsFiltered'] = $alldatacount;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadoavance2() {
        try {
            $this->load->model('Avancetarea_model');
            $datos['Json'] = $this->Avancetarea_model->listado_avance($this->input->post('tar_id'));
            if (count($datos['Json']) == 0)
                $datos["message"] = "No hay avances";
            $this->output->set_content_type('application/json')->set_output(json_encode($datos));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadotareasxplanfiltro() {
        try {
            $this->load->model('Planes_model');
            $cantidad = $this->input->post("length");
            $orden = $this->input->post("order[0][column]");
            $inicia = intval($_REQUEST['start']);
            $tabla = $this->Planes_model->tareaxplan(7, $cantidad, $orden, $inicia);
            $alldatacount = $this->Planes_model->tareaxplancount(7, $cantidad, $orden, $inicia);
            $data = array();
            $data['data'] = arregloconsulta($tabla);
            $data["draw"] = intval($_REQUEST['draw']);
            $data['recordsTotal'] = $alldatacount;
            $data['recordsFiltered'] = $alldatacount;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadotareasxactividadhijo() {
        try {
            $this->load->model('Planes_model');
            $cantidad = $this->input->post("length");
            $orden = $this->input->post("order[0][column]");
            $inicia = intval($_REQUEST['start']);
//        $this->data['tareaxplan'] = $this->Planes_model->tareaxplan(1,$cantidad,$orden,$inicia);
            $tabla = $this->Planes_model->actividadhijoxplan(7, $cantidad, $orden, $inicia);
            $alldatacount = $this->Planes_model->actividadhijoxplancount(7, $cantidad, $orden, $inicia);
            $data = array();
            $data['data'] = arregloconsulta($tabla);
            $data["draw"] = intval($_REQUEST['draw']);
            $data['recordsTotal'] = $alldatacount;
            $data['recordsFiltered'] = $alldatacount;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadotareasinactivasxplanfiltro() {
        try {
            $this->load->model('Planes_model');
            $cantidad = $this->input->post("length");
            $orden = $this->input->post("order[0][column]");
            $inicia = intval($_REQUEST['start']);
            $tabla = $this->Planes_model->tareaxplaninactivas(6, $cantidad, $orden, $inicia);
            $alldatacount = $this->Planes_model->tareaxplaninactivascount(6, $cantidad, $orden, $inicia);
            $data = array();
            $data['data'] = arregloconsulta($tabla);
            $data["draw"] = intval($_REQUEST['draw']);
            $data['recordsTotal'] = $alldatacount;
            $data['recordsFiltered'] = $alldatacount;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardaravance() {

        try {
            $this->load->model('Avancetarea_model');
            $this->load->model('Avancenotificacion_model');
            $data = array(
                "tar_id" => $this->input->post('idtarea'),
                "avaTar_fecha" => $this->input->post("fecha"),
                "avaTar_progreso" => $this->input->post("progreso"),
                "avaTar_horasTrabajadas" => $this->input->post("horastrabajadas"),
                "avaTar_costo" => $this->input->post("costo"),
                "avaTar_comentarios" => $this->input->post("comentarios"),
                "avaTar_fechaCreacion" => date("Y-m-d H:i:s"),
                "usu_id" => $this->data["usu_id"]
            );
            $id = $this->Avancetarea_model->create($data, $this->input->post());
            $notificar = array();
            if (!empty($this->input->post("notificar"))):
                $notificacion = $this->input->post("notificar");
                for ($i = 0; $i < count($notificacion); $i++) {
                    $notificar[$i] = array(
                        "not_id" => $notificacion[$i],
                        "avaTar_id" => $id
                    );
                }
                $this->Avancenotificacion_model->create($notificar);
            endif;
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consulta() {
        try {
            $this->load->model('Avancetarea_model');
            $result = $this->Avancetarea_model->consulta($this->input->post('idtarea'));
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consulta2() {
        try {
            $this->load->model('Avancetarea_model');
            $result = $this->Avancetarea_model->consulta2($this->input->post('avaTar_id'));
            $this->output->set_content_type('application/json')->set_output(json_encode($result[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardartarea() {
        try {
            $this->load->model('Tarea_model');
            if (!empty($this->input->post('id'))):
                if (!empty($this->input->post("registro"))) {
                    $this->db->set('actHij_id', $this->input->post("registro"));
                }
                $data = array(
                    "actPad_id" => $this->input->post("actividad"),
                    "car_id" => $this->input->post("cargo"),
//                    "rieCla_id" => $this->input->post("clasificacionriesgo"),
//                    "tipRie_id" => $this->input->post("tiposriesgos"),
                    "tar_costopresupuestado" => $this->input->post("costrospresupuestados"),
                    "tar_descripcion" => $this->input->post("descripcion"),
                    "dim_id" => (!empty($this->input->post("dimensionuno")) ? $this->input->post("dimensionuno") : null),
                    "dim2_id" => (!empty($this->input->post("dimensiondos")) ? $this->input->post("dimensiondos") : null),
                    "est_id" => $this->input->post("estado"),
                    "tar_fechaInicio" => $this->input->post("fechaIncio"),
                    "tar_fechaUltimaMod" => date("Y-m-d H:i:s"),
                    "tar_fechaFinalizacion" => $this->input->post("fechafinalizacion"),
                    "tar_nombre" => $this->input->post("nombre"),
                    "emp_id" => $this->input->post("nombreempleado"),
                    "tar_peso" => $this->input->post("peso"),
                    "pla_id" => $this->input->post("plan"),
                    "tip_id" => $this->input->post("tipo"),
                    "tar_idpadre" => $this->input->post("tareapadre"),
                    "nor_id" => $this->input->post("norma"),
                    "tar_rutinario" => $this->input->post("rutinario")
                );
                $idtarea = $this->input->post('id');
                $actualizar = $this->Tarea_model->update($data, $idtarea);
                $consultaxid = $this->Tarea_model->detailxid($this->input->post('id'));
            else:
                if (!empty($this->input->post("registro"))) {
                    $this->db->set('actHij_id', $this->input->post("registro"));
                }
                $data = array(
                    "actPad_id" => $this->input->post("actividad"),
                    "car_id" => $this->input->post("cargo"),
//                    "rieCla_id" => $this->input->post("clasificacionriesgo"),
//                    "tipRie_id" => $this->input->post("tiposriesgos"),
                    "tar_costopresupuestado" => $this->input->post("costrospresupuestados"),
                    "tar_descripcion" => $this->input->post("descripcion"),
                    "dim_id" => $this->input->post("dimensionuno"),
                    "dim2_id" => $this->input->post("dimensiondos"),
                    "est_id" => $this->input->post("estado"),
                    "tar_fechaInicio" => $this->input->post("fechaIncio"),
                    "tar_fechaCreacion" => date("Y-m-d H:i:s"),
                    "tar_fechaFinalizacion" => $this->input->post("fechafinalizacion"),
                    "tar_nombre" => $this->input->post("nombre"),
                    "emp_id" => $this->input->post("nombreempleado"),
                    "tar_peso" => $this->input->post("peso"),
                    "pla_id" => $this->input->post("plan"),
                    "tip_id" => $this->input->post("tipo"),
                    "tar_idpadre" => $this->input->post("tareapadre"),
                    "nor_id" => $this->input->post("norma"),
                    "tar_rutinario" => $this->input->post("rutinario"),
                );
                $idtarea = $this->Tarea_model->create($data);
                $consultaxid = $this->Tarea_model->detailxid($idtarea);
            endif;
            $this->Tarea_model->tarea_riegos_clasificacion($idtarea, $this->input->post("clasificacionriesgo"), $this->input->post("tiposriesgos"));
            $this->Tarea_model->guardar_lista_riesgos($idtarea, $this->input->post("lista_riesgos"));
            $articulosnorma = $this->input->post("articulosnorma");
            $data = array();
            if (!empty($articulosnorma)) {
                for ($i = 0; $i < count($articulosnorma); $i++):
                    $data[$i] = array(
                        "norArt_id" => $articulosnorma[$i],
                        "tar_id" => $idtarea
                    );
                endfor;
                $this->Tarea_model->tareanorma($data, $idtarea);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($consultaxid[0]));
        } catch (Exception $e) {
            
        } finally {
            
        }
    }

    function consultaactividad() {
        try {
            $this->load->model('Registro_model');
            $data = $this->Registro_model->consultaxcarpeta($this->input->post("carpeta"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadotareas() {
        try {
            $this->load->model('Planes_model');
            $this->load->model('Tarea_model');
            $this->data["planes"] = $this->Planes_model->detail();
            $this->data["tareas"] = $this->Tarea_model->detail();
            $this->data["responsables"] = $this->Tarea_model->responsables();
            $this->layout->view("tareas/listadotareas", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultatareas() {

        try {
            $this->load->model('Tarea_model');
            $tareas = $this->Tarea_model->filtrobusqueda(
                    $this->input->post("Plan"), $this->input->post("filtrotarea"), $this->input->post("responsable")
            );
            if (count($tareas) == 0)
                throw new Exception("No se encontro información");
            $data = array();
            foreach ($tareas as $t):
                $data['Json'][$t->pla_id][$t->pla_nombre][$t->tar_id] = array(
                    "detalle" => array(
                        "fechainicio" => $t->tar_fechaInicio,
                        "fechafinalizacion" => $t->tar_fechaFinalizacion,
                        "diferencia" => $t->diferencia,
                        "nombretarea" => $t->tar_nombre,
                        "nombre" => $t->Emp_Nombre,
                        "tipo" => $t->tip_tipo,
                        "cantidadriesgo" => $t->cantidadriesgo,
                        "progreso" => (!empty($t->progreso) ? $t->progreso . '%' : '0%'),
                        "cantidadRiesgo" => $t->cantidadRiesgo
                    )
                );
            endforeach;
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function listadoactividades() {
        try {
            $this->load->model('Estados_model');
            $this->layout->view("tareas/listadoactividades");
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function registro() {
        try {
            $this->load->model('Registrocarpeta_model');
            $this->load->model('Planes_model');
            $this->data['carpeta'] = $this->Registrocarpeta_model->detail();
            $this->data['plan'] = $this->Planes_model->detail();
            $this->load->model("Registrocarpeta_model");
            $this->data['carpetas'] = $this->Registrocarpeta_model->allfolders($this->input->post('pla_id'));
            $this->layout->view("tareas/registro", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function busqueda_carpeta() {
        try {
            $this->load->model('Registrocarpeta_model');
            $this->data['carpetas'] = $this->Registrocarpeta_model->allfolders2($this->input->post('tar_id'));
            $this->output->set_content_type('application/json')->set_output(json_encode($this->data['carpetas']));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function tareaxidplan() {

        try {
            $this->load->model('Tarea_model');
            $this->data['tarea'] = $this->Tarea_model->detailxidplan($this->input->post('pla_id'));
            $this->output->set_content_type('application/json')->set_output(json_encode($this->data['tarea']));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function agregarregistro() {
        $this->layout->view("tareas/agregarregistro");
    }

    function eliminar_actividad_hijo() {
        try {
            $this->load->model('Registro_model');
            $id = $this->Registro_model->eliminar_actividad_hijo($this->input->post());
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function editar_actividad_hijo() {
        try {
            $this->load->model('Registro_model');
            $this->load->model('Tarea_model');
            $data = $this->Registro_model->editar_actividad_hijo($this->input->post());
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarcarpetatarea() {
        try {
            $this->load->model("Registrocarpeta_model");
            $id = $this->Registrocarpeta_model->createtarea(
                    $this->input->post("nombrecarpeta"), $this->input->post("descripcioncarpeta"), $this->input->post("tar_id"), $this->data["usu_id"]
            );
            $data = $this->Registrocarpeta_model->detailxtarea($this->input->post("tar_id"), $id);
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function actualizarplan() {
        try {
            $data = array(
                "pla_avanceProgramado" => $this->input->post("avanceprogramado"),
                "pla_avanceReal" => $this->input->post("avancereal"),
                "car_id" => $this->input->post("cargo"),
                "pla_costoReal" => $this->input->post("costoreal"),
                "pla_descripcion" => $this->input->post("descripcion"),
                "pla_eficiencia" => $this->input->post("eficiencia"),
                "emp_id" => $this->input->post("empleado"),
                "est_id" => $this->input->post("estado"),
                "pla_fechaFin" => $this->input->post("fechafin"),
                "pla_fechaInicio" => $this->input->post("fechainicio"),
                "pla_nombre" => $this->input->post("nombre"),
                "nor_id" => $this->input->post("norma"),
                "pla_presupuesto" => $this->input->post("presupuesto")
            );
            $this->load->model("Planes_model");
            $this->Planes_model->actualizar($data, $this->input->post('pla_id'));
        } catch (Exception $e) {
            
        } finally {
            
        }
    }

    function consultar_actividad_padre() {
        try {
            $this->load->model("Actividadpadre_model");
            $planes = $this->Actividadpadre_model->consultar_actividad_padre($this->input->post("actPad_id"));
            $this->output->set_content_type('application/json')->set_output(json_encode($planes[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaractividadpadre() {
        try {
            $this->load->model("Actividadpadre_model");
            $data = $this->Actividadpadre_model->detailxid($this->input->post('plan'));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadoregistros() {
        $this->layout->view("tareas/listadoregistros");
    }

    function guardarcarpeta() {
        try {
            $this->load->model("Registrocarpeta_model");
            $this->Registrocarpeta_model->create(
                    $this->input->post("nombrecarpeta"), $this->input->post("descripcioncarpeta")
            );
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarregistro() {
        try {
            $post = $this->input->post();
            $this->load->model('Registro_model');

            $post['empReg_archivo'] = "";
            if (isset($_FILES['archivo']['name']))
                if (!empty($_FILES['archivo']['name']))
                    $post['empReg_archivo'] = basename($_FILES['archivo']['name']);

            $targetPath = "./uploads/tareas/" . $this->input->post("plan") . '/';
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            $data = array(
                "pla_id" => $this->input->post("plan"),
                "tar_id" => $this->input->post("tarea"),
                "regCar_id" => $this->input->post("carpeta"),
                "reg_version" => $this->input->post("version"),
                "reg_descripcion" => $this->input->post("descripcion"),
                "reg_fechaCreacion" => date('Y-m-d H:i:s'),
                "userCreator" => $this->data["usu_id"],
                "reg_ruta" => $targetPath,
                "reg_archivo" => $post['empReg_archivo']
            );



            $id = $this->Registro_model->create($data);

            $targetPath = $targetPath . $id . '/';
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }

            $target_path = $targetPath . '/' . basename($_FILES['archivo']['name']);
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) {
                
            }
            redirect('index.php/tareas/registro', 'location');
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadoregistrotable() {
        try {
            $this->load->model('Registro_model');
            $cantidad = $this->input->post("length");
            $orden = $this->input->post("order[0][column]");
            $inicia = intval($_REQUEST['start']);
            $tabla = $this->Registro_model->detailxid(1, $cantidad, $orden, $inicia);
            $alldatacount = $this->Registro_model->detailxidcount(1, $cantidad, $orden, $inicia);
            $data = array();
            $data['data'] = arregloconsulta($tabla);
            $data["draw"] = intval($_REQUEST['draw']);
            $data['recordsTotal'] = $alldatacount;
            $data['recordsFiltered'] = $alldatacount;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function configuracionsistema() {
        $this->layout->view("tareas/configuracionsistema");
    }

    function autocompletar() {
        $info = auto("planes", "pla_id", "pla_nombre", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompleteactividadhijo() {
        $info = auto("actividad_hijo", "actHij_id", "actHij_nombre", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompletetareas() {
        $info = auto("tarea", "tar_id", "tar_nombre", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompletarfechainicio() {
        $info = auto("planes", "pla_id", "pla_fechaInicio", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompletarresponsable() {
        try {
            $info = auto("planes", "pla_id", "pla_nombre", $this->input->get('term'));
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaTareasFlechas() {
        try {
            $this->load->model("Tarea_model");
            $idTarea = $this->input->post("idTarea");
            $metodo = $this->input->post("metodo");
            $campos = $this->Tarea_model->consultaTareasFlechas($idTarea, $metodo);
            if (!empty($campos)) {
                $this->output->set_content_type('application/json')->set_output(json_encode($campos[0]));
            }
        } catch (Exception $e) {
            
        } finally {
            
        }
    }

    function eliminaravance() {
        try {
            $this->load->model("Avancetarea_model");
            $this->Avancetarea_model->eliminaravance($this->input->post("avaTar_id"));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaregistro() {
        try {
            $this->load->model("Registro_model");
            $campos["Json"] = $this->Registro_model->consultaregistro(
                    $this->input->post("plan"), $this->input->post("actividad"), $this->input->post("tarea")
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($campos));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminarregistro() {
        try {
            $this->load->model("Registro_model");
            $this->Registro_model->eliminarregistro($this->input->post("registro"));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function obtener_riesgos() {
        try {
            $this->load->model("Tarea_model");
            $datos = $this->Tarea_model->lista_riesgos_guardados2($this->input->post('tar_id'));
            if (count($datos) > 0)
                $data['Json'] = $datos;
            else
                throw new Exception("No se encontraron riesgos para esta tarea");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function traer_riesgos() {
        try {
            $this->load->model("Tarea_model");
            $this->data['riesgos'] = $this->Tarea_model->lista_riesgos($this->input->post('clasificacionriesgo'), $this->input->post('tiposriesgos'));
            $this->output->set_content_type('application/json')->set_output(json_encode($this->data['riesgos']));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */