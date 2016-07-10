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
class Planes extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    function guardarregistroempleado() {
        try {
            $post = $this->input->post();
            print_y($post);
            $this->load->model('Registro_model');


            $fecha = new DateTime();
            $post["reg_fechaCreacion"] = $fecha->format('Y-m-d H:i:s');

            //Creamos carpeta con el ID del registro
            if (isset($_FILES['archivo']['name']))
                if (!empty($_FILES['archivo']['name'])) {
                    $post['reg_ruta'] = basename($_FILES['archivo']['name']);
                    $tamano = round($_FILES["archivo"]["size"] / 1024, 1) . " KB";
                    $post["reg_tamano"] = $tamano;
                    $post['reg_archivo'] = basename($_FILES['archivo']['name']);
                    $pla_id = $post['pla_id'];
                    $targetPath = "./uploads/tareas/";

                    //De la carpeta idRegistro, creamos carpeta con el id del empleado
                    if (!file_exists($targetPath)) {
                        mkdir($targetPath, 0777, true);
                    }
                    $targetPath = "./uploads/tareas/" . $pla_id;
                    if (!file_exists($targetPath)) {
                        mkdir($targetPath, 0777, true);
                    }

                    $post['reg_ruta'] = $targetPath;
                }



            if (empty($this->input->post('reg_id'))) {
                $post['userCreator'] = $this->data["usu_id"];
                $id = $this->Registro_model->guardar_registro($post);
            } else
                $id = $this->Registro_model->actualizar_registro($post, $this->input->post('reg_id'));

            if (isset($_FILES['archivo']['name']))
                if (!empty($_FILES['archivo']['name'])) {
                    $target_path = $targetPath . '/' . $id . '/';
                    if (!file_exists($target_path)) {
                        mkdir($target_path, 0777, true);
                    }
                    $target_path = $target_path . basename($_FILES['archivo']['name']);
                    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) {
                        
                    }
                }

            $data = $this->Registro_model->registroxcarpeta($post['regCar_id']);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        }
    }

    function guardarregistroriesgo() {
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

            $rie_id = $post['rie_id'];
            $targetPath = "./uploads/tareas/";

            //De la carpeta idRegistro, creamos carpeta con el id del empleado
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            $targetPath = "./uploads/tareas/" . $rie_id;
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }

            $post['reg_ruta'] = $target_path = $targetPath;
            $post['reg_archivo'] = basename($_FILES['archivo']['name']);

            $post['userCreator'] = $this->data["usu_id"];
            if (empty($this->input->post('reg_id')))
                $id = $this->Registro_model->guardar_registro($post);
            else {
                $id = $this->Registro_model->actualizar_registro($post, $this->input->post('reg_id'));
            }
            $targetPath = $targetPath . '/' . $id;
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }

            $target_path = $targetPath . '/' . basename($_FILES['archivo']['name']);
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) {
                
            }


            $data = $this->Registro_model->registroxcarpeta($post['regCar_id']);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminarregistroplan() {
        try {
            $this->load->model('Registro_model');
            $this->Registro_model->eliminarregistro($this->input->post("reg_id"));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadotareas() {
        try {
            $this->load->model(array('Planes_model', 'Tarea_model'));
            $this->data["planes"] = $this->Planes_model->detail();
            $this->data["tareas"] = $this->Tarea_model->detail();
            $this->data["responsables"] = $this->Tarea_model->responsables();
            $this->layout->view("tareas/listadotareas", $this->data);
        } catch (exception $e) {
            
        } finally {
            
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
            $this->load->model(array('Registrocarpeta_model', 'Planes_model'));
            $this->data['carpeta'] = $this->Registrocarpeta_model->detail();
            $this->data['plan'] = $this->Planes_model->detail();
            $this->layout->view("tareas/registro", $this->data);
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
        try {
            $this->layout->view("tareas/agregarregistro");
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardaractividadhijo() {
        $post = $this->input->post();
        try {
            $this->load->model('Actividad_model');
            $data = array(
                "actHij_padreid" => $this->input->post("idpadre"),
                "actHij_nombre" => $this->input->post("nombre"),
                "actHij_peso" => $this->input->post("peso"),
                "actHij_riesgoSancion" => $this->input->post("riesgosancion"),
                "tip_id" => $this->input->post("tipo"),
                "actHij_presupuestoTotal" => $this->input->post("presupuestototal"),
                "actHij_costoReal" => $this->input->post("costoreal"),
                "actHij_descripcion" => $this->input->post("descripcion"),
                "actHij_modoVerificacion" => $this->input->post("modoverificacion"),
                "pla_id" => $this->input->post("pla_id"),
                "actHij_fechaCreacion" => date("Y-m-d H:i:s")
            );
            $this->Actividad_model->create($data, $post);
            $data = $this->Actividad_model->search($this->input->post("idpadre"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function nuevoplan() {
        try {
            $this->load->model(array(
                'User_model'
                , 'Tipo_model'
                , "Estados_model"
                , "Cargo_model"
                , "Planes_model"
                , "Norma_model"
                , "Notificacion_model"
                , "Actividad_padre__model"
                , "Registrocarpeta_model"
                , "Avancetarea_model"
                , "Tarea_model"
                    )
            );

            $this->data['plan'] = array();
            if (!empty($this->input->post('pla_id'))) {

                $carpetaSistma = $this->Registrocarpeta_model->detailxplan($this->input->post('pla_id'));
                $this->data['carpetas'] = $this->Registrocarpeta_model->detailxplancarpetas($this->input->post('pla_id'));
                $d = array();
                foreach ($carpetaSistma as $c) {
                    $d[$c->regCar_id][$c->regCar_nombre . " - " . $c->regCar_descripcion][] = array(
                        $c->reg_archivo,
                        $c->reg_descripcion,
                        $c->reg_version,
                        $c->usu_nombre . " " . $c->usu_apellido,
                        $c->reg_tamano,
                        $c->reg_fechaCreacion,
                        $c->reg_id,
                        $c->reg_ruta
                    );
                }
                $this->data['carpeta'] = $d;
                $this->data["actividadpadre"] = $this->Actividad_padre__model->detail($this->input->post('pla_id'));
                $this->data['plan'] = $this->Planes_model->planxid($this->input->post('pla_id'));
                $actividades = $this->Planes_model->actividadhijoxplan($this->input->post('pla_id'));
                $i = array();
                foreach ($actividades as $ac) {
                    $i[$ac->actPad_id][$ac->nombre][] = array(
                        $ac->actHij_fechaInicio,
                        $ac->actHij_fechaFinalizacion,
                        $ac->actHij_presupuestoTotal,
                        $ac->actHij_descripcion,
                        $ac->actHij_nombre,
                        $ac->actHij_id,
                        $ac->fechainicio,
                        $ac->fechafin
                    );
                }
                $this->data["actividades"] = $i;
                $this->data['tipo'] = $this->Tipo_model->detail();
                $this->data['tareas'] = $this->Planes_model->tareaxplan($this->input->post('pla_id'));
                $this->data['tareasinactivas'] = $this->Planes_model->tareaxplaninactivas($this->input->post('pla_id'));
                $this->data['tareafechafinal'] = $this->Tarea_model->fechaFinalTareaxPlan($this->input->post('pla_id'));
                $this->data['plan_grant'] = $this->Planes_model->plan_grant($this->input->post('pla_id'));
                $this->data['avances'] = $this->Avancetarea_model->listadoAvancexPlan($this->input->post('pla_id'));
                $this->data['norma_planes'] = $this->Planes_model->norma_planes($this->input->post('pla_id'));
            }
            $this->data['notificacion'] = $this->Notificacion_model->detail();
            $this->data['norma'] = $this->Norma_model->detail();
            $this->data['estado'] = $this->Estados_model->detail();
            $this->data['cargo'] = $this->Cargo_model->allcargos();
            $this->layout->view("planes/planes", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function modificarregistro() {
        try {
            $this->load->model('Registro_model');
            $data = $this->Registro_model->detallexidregitro($this->input->post("registro"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function detailxplaid() {
        try {
            $this->load->model("Actividadpadre_model");
            $data = $this->Actividadpadre_model->detailxplaid($this->input->post("pla_id"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function detailxrieid() {
        try {
            $this->load->model("Actividadpadre_model");
            $data = $this->Actividadpadre_model->detailxplaid($this->input->post("rie_id"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
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
            $data = $this->Registro_model->editar_actividad_hijo($this->input->post());
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarcarpetaregistro() {
        try {
            $this->load->model("Registrocarpeta_model");
            $id = $this->Registrocarpeta_model->create(
                    $this->input->post("nombrecarpeta"), $this->input->post("descripcioncarpeta"), $this->input->post("pla_id")
            );
            $data = $this->Registrocarpeta_model->detailxid($id);
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarcarpetaregistroriesgo() {
        try {
            $this->load->model("Registrocarpeta_model");
            $id = $this->Registrocarpeta_model->createRiesgo(
                    $this->input->post("nombrecarpeta"), $this->input->post("descripcioncarpeta"), $this->input->post("rie_id"), $this->data["usu_id"]
            );
            $data = $this->Registrocarpeta_model->detailxid($id);
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function actualizarplan() {
        try {
            $this->load->model("Planes_model");
            $post = $this->input->post();
            $this->Planes_model->actualizar($post, $this->input->post('pla_id'));
            $id_plna = $this->input->post('pla_id');
            if (!empty($id_plna)) {
                $norma = $this->input->post('norma');
                if (isset($norma))
                    if (!empty($this->input->post('norma'))) {
                        $norma = $this->input->post('norma');
                        $data = array();
                        $i = 0;
                        foreach ($norma as $value) {
                            $data[$i] = array(
                                'nor_id' => $value,
                                'pla_id' => $this->input->post('pla_id')
                            );
                            $i++;
                        }

                        $this->Planes_model->create_plan_norma($data, $this->input->post('pla_id'));
                    }
            }
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

    function guardaractividadpadre() {

        try {
            $this->load->model("Actividadpadre_model");
            $this->Actividadpadre_model->create(
                    $this->input->post("idactividad"), $this->input->post("nombreactividad"), $this->input->post("pla_id"), $this->input->post("actPad_id")
            );
            $actividades = $this->Actividadpadre_model->searchregister(
                    $this->input->post("idactividad"), $this->input->post("nombreactividad"), $this->input->post("pla_id")
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($actividades[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarplan() {
        try {
            $this->load->model("Planes_model");
            $post = $this->input->post();
            if (!empty($post['estado']))
                $this->db->set('est_id', $post['estado']);
            if (!empty($post['nombre']))
                $this->db->set('pla_nombre', $post['nombre']);
            if (!empty($post['descripcion']))
                $this->db->set('pla_descripcion', $post['descripcion']);
            if (!empty($post['fechainicio']))
                $this->db->set('pla_fechaInicio', $post['fechainicio']);
            if (!empty($post['fechafin']))
                $this->db->set('pla_fechaFin', $post['fechafin']);
            if (!empty($post['avanceprogramado']))
                $this->db->set('pla_avanceProgramado', $post['avanceprogramado']);
            if (!empty($post['presupuesto']))
                $this->db->set('pla_presupuesto', $post['presupuesto']);
            if (!empty($post['avancereal']))
                $this->db->set('pla_avanceReal', $post['avancereal']);
            if (!empty($post['costoreal']))
                $this->db->set('pla_costoReal', $post['costoreal']);
            if (!empty($post['eficiencia']))
                $this->db->set('pla_eficiencia', $post['eficiencia']);
            if (!empty($post['empleado']))
                $this->db->set('emp_id', $post['empleado']);
            if (!empty($post['cargo']))
                $this->db->set('car_id', $post['cargo']);

            $id_plna = $this->Planes_model->create();
            if (!empty($id_plna)) {
                $norma = $this->input->post('norma');
                if (isset($norma))
                    if (!empty($this->input->post('norma'))) {
                        $norma = $this->input->post('norma');
                        $data = array();
                        $i = 0;
                        foreach ($norma as $value) {
                            $data[] = array(
                                'nor_id' => $value,
                                'pla_id' => $id_plna,
                                'creatorUser' => $this->data["usu_id"],
                                'creatorDate' => date('Y-m-d H:i:s')
                            );
                            $i++;
                        }

                        $this->Planes_model->create_plan_norma($data);
                    }
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadoplanes() {
        try {
            $this->load->model(array("Estados_model", "Planes_model"));
            $this->data['responsable'] = $this->Planes_model->responsables();
            $this->data['estados'] = $this->Estados_model->finalizados();
            $this->layout->view("planes/listadoplanes", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaDescripcion() {
        try {
            if (empty($this->input->post("pla_id")))
                throw new Exception("No existe plan para consultar descripción");
            $this->load->model("Planes_model");
            $respuesta = $this->Planes_model->cargarDescripcion($this->input->post("pla_id"));
            $data['Json'] = $respuesta[0]->pla_descripcion;
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function consultaplanes() {
        try {
            $this->load->model("Planes_model");
            $emp_id = $this->session->userdata()['emp_id'];
            $tareaspropias = (!empty($this->input->post('tareapropia'))) ? $this->session->userdata()['emp_id'] : $tareaspropias = "";
            $planes['Json'] = $this->Planes_model->filtrobusqueda(
                    $this->input->post("nombre"), $this->input->post("responsable"), $this->input->post("estado"), $tareaspropias, $emp_id
            );
            if (count($planes['Json']) == 0)
                throw new Exception("No se encontro información");
        } catch (exception $e) {
            $planes['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($planes));
        }
    }

    function eliminarplan() {
        try {
            $this->load->model("Planes_model");
            $data['Json'] = $this->Planes_model->delete($this->input->post('id'));
            if ($data['Json'] == false)
                throw new Exception("Error en la base de datos");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
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

            if (isset($_FILES['archivo']['name']))
                if (!empty($_FILES['archivo']['name']))
                    $post['empReg_archivo'] = basename($_FILES['archivo']['name']);

            $targetPath = "./uploads/empleado";
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            $targetPath = "./uploads/registro/";

            $data = array(
                "pla_id" => $this->input->post("plan"),
                "tar_id" => $this->input->post("tarea"),
                "regCar_id" => $this->input->post("carpeta"),
                "reg_version" => $this->input->post("version"),
                "reg_descripcion" => $this->input->post("descripcion"),
                "reg_fechaCreacion" => date('Y-m-d H:i:s'),
                "userCreator" => $this->data["usu_id"],
                "reg_ruta" => $targetPath
            );
            $this->Registro_model->create($data);
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


    function cargarplanescarpeta() {
        try {
            $this->load->model('Registrocarpeta_model');
            $data = $this->Registrocarpeta_model->cargarcarpetas(
                    $this->input->post("carpeta")
            );
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminarcarpeta() {
        try {
            $this->load->model('Registrocarpeta_model');
            $data = $this->Registrocarpeta_model->eliminarcarpeta($this->input->post("carpeta"));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function modificarpeta() {
        try {
            if (empty($this->input->post('nombrecarpeta')) || empty($this->input->post('descripcioncarpeta')))
                throw new Exception("Debe ingresar los datos correctamente");

            $this->load->model('Registrocarpeta_model');
            $this->Registrocarpeta_model->modificarpeta(
                    $this->input->post("nombrecarpeta"), $this->input->post("descripcioncarpeta"), $this->input->post("plaCar_id")
            );
            $respuesta = $this->Registrocarpeta_model->cargarcarpetas($this->input->post("plaCar_id"));
            if (!empty($respuesta)) {
                $data['Json'] = $respuesta[0];
            } else {
                throw new Exception("No existen carpetas para cargue");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function eliminaractividad() {
        try {
            $this->load->model('Actividadpadre_model');
            $data = $this->Actividadpadre_model->eliminaractividad($this->input->post("carpeta"));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function datosactividad() {
        try {
            $this->load->model('Actividadpadre_model');
            $data = $this->Actividadpadre_model->cargardatos($this->input->post("carpeta"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function modificaractividad() {
        try {
            $this->load->model('Actividadpadre_model');
            $this->Actividadpadre_model->modificardatos(
                    $this->input->post("actividadpadre"), $this->input->post("idactividad"), $this->input->post("nombreactividad")
            );
            $data = $this->Actividadpadre_model->cargardatos($this->input->post("actividadpadre"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */