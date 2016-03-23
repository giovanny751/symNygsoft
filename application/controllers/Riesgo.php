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
class Riesgo extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    function nuevoriesgo() {
        try {
            $this->load->model(array('Tarea_model',
                'Dimension2_model',
                'Dimension_model',
                'Empresa_model',
                "Riesgoclasificacion_model",
                "Riesgo_model",
                "Tipo_model",
                "Riesgoclasificaciontipo_model",
                "Registrocarpeta_model",
                "Riesgocargo_model",
                "Cargo_model",
                "Planes_model",
                "Niveles_model"
            ));
            $this->data['deficiencia'] = $this->Niveles_model->nivelDeficiencia();
            $this->data['exposicion'] = $this->Niveles_model->nivelExposicion();
            $this->data['consecuencia'] = $this->Niveles_model->nivelConsecuencia();
            $this->data['categoria'] = $this->Riesgoclasificacion_model->detail();
            $this->data['empresa'] = $this->Empresa_model->detail();
            $this->data['cargo'] = $this->Cargo_model->allcargos();
            if (!empty($this->data['empresa'][0]->Dim_id) && !empty($this->data['empresa'][0]->Dimdos_id)) {
                if (!empty($this->input->post("rie_id"))) {
                    $this->data['carpetas'] = $this->Registrocarpeta_model->detailxriesgocarpetas($this->input->post('rie_id'));
                    $carpeta = $this->Registrocarpeta_model->detailxriesgo($this->input->post('rie_id'));
                    $d = array();
                    foreach ($carpeta as $c) {
                        $d[$c->regCar_id][$c->regCar_nombre . " - " . $c->regCar_descripcion][] = array(
                            '<a target="_black" href="' . base_url() . $c->reg_ruta . "/" . $c->reg_id . '/' . $c->reg_archivo . '">' . $c->reg_archivo . "</a>",
                            $c->reg_descripcion,
                            $c->reg_version,
                            $c->usu_nombre . " " . $c->usu_apellido,
                            $c->reg_tamano,
                            $c->reg_fechaCreacion,
                            $c->reg_id
                        );
                    }
                    $this->data['carpeta'] = $d;
                    $this->data['rie_id'] = $this->input->post("rie_id");
                    $this->data['tarea'] = $this->Tarea_model->tareaxRiesgo($this->data['rie_id']);
                    $this->data['riesgo'] = $this->Riesgo_model->detailxid($this->input->post("rie_id"))[0];
                    $this->data['tipo'] = $this->Riesgoclasificaciontipo_model->tipoxcategoria($this->data['riesgo']->rieCla_id);
                    $this->data['cargoId'] = $this->Riesgocargo_model->detailxid($this->input->post("rie_id"));
                    $this->data['tareas'] = $this->Planes_model->tareaxplanriesgo($this->data['rie_id']);
                    $this->data['tareasinactivas'] = $this->Planes_model->tareaxplaninactivasriesgo($this->data['riesgo']->rieCla_id);
                }
                $this->data['dimension'] = $this->Dimension_model->detail();
                $this->data['dimension2'] = $this->Dimension2_model->detail();
                $this->layout->view("riesgo/nuevoriesgo", $this->data);
            } else {
                redirect('index.php/administrativo/empresa', 'location');
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarriesgo() {
        try {
            $this->load->model(array('Riesgo_model', 'Riesgocargo_model', 'Riesgoclasificaciontipo_model'));
            $data = array(
                "rie_descripcion" => $this->input->post("descripcion"),
                "rieCla_id" => $this->input->post("categoria"),
                "rieClaTip_id" => $this->input->post("tipo"),
                "dim1_id" => (!empty($this->input->post("dimensionuno")))?$this->input->post("dimensionuno"):null,
                "dim2_id" => (!empty($this->input->post("dimensiondos")))?$this->input->post("dimensiondos"):null,
                "rie_zona" => $this->input->post("zona"),
                "rie_requisito" => $this->input->post("requisito"),
                "rie_observaciones" => $this->input->post("observaciones"),
                "estAce_id" => $this->input->post("estado"),
                "col_id" => $this->input->post("color"),
                "rie_fecha" => $this->input->post("fecha"),
                "rie_fechaCreacion" => date("Y-m-d H:i:s"),
                "rie_actividad" => $this->input->post("actividades"),
                "nivDef_id" => $this->input->post("nivelDeficiencia"),
                "nivExp_id" => $this->input->post("nivelExposicion"),
                "nivCon_id" => $this->input->post("nivelConsecuencia"),
                "nivPro_Nivel" => $this->input->post("nivelProbabilidad"),
                "nivRie_nivel" => $this->input->post("nivelRiesgo")
            );
            $id = $this->Riesgo_model->create($data);
            if (!empty($this->input->post("cargo"))):
                $cargo = $this->input->post("cargo");
                for ($i = 0; $i < count($cargo); $i++):
                    $dataCargo[] = array("car_id" => $cargo[$i], "rie_id" => $id);
                endfor;
                $this->Riesgocargo_model->guardarcargo($dataCargo);
            endif;
            echo $id;
        } catch (Exception $ex) {
            
        } finally {
            
        }
    }

    function nivelProbabilidad() {
        try {
            $this->load->model(array(
                "Niveles_model"
                ));
            
            $deficiencia = $this->Niveles_model->nivelDeficienciaxId($this->input->post("deficiencia"));
            $exposicion = $this->Niveles_model->nivelExposicionxId($this->input->post("exposicion"));
            $consecuencia = "";            
            if(!empty($this->input->post("consecuencia"))){
                $nivelConsecuencia = $this->Niveles_model->nivelConsecuenciaxId($this->input->post("exposicion"));
                $consecuencia = $nivelConsecuencia[0]->nivCon_nc;
            }
            $data['Json'] = $this->Niveles_model->nivelProbabilidad($deficiencia[0]->nivDef_valor, $exposicion[0]->nivExp_valor,$consecuencia );
            if (count($data['Json']) == 0)
                throw new Exception("No se encontro nivel de probabilidad");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function actualizarriesgo() {
        try {
            $this->load->model(array('Riesgo_model', 'Riesgocargo_model'));
            $data = array(
                "rie_descripcion" => $this->input->post("descripcion"),
                "rieCla_id" => $this->input->post("categoria"),
                "rieClaTip_id" => $this->input->post("tipo"),
                "dim1_id" => $this->input->post("dimensionuno"),
                "dim2_id" => $this->input->post("dimensiondos"),
                "rie_zona" => $this->input->post("zona"),
                "rie_requisito" => $this->input->post("requisito"),
                "rie_observaciones" => $this->input->post("observaciones"),
                "estAce_id" => $this->input->post("estado"),
                "col_id" => $this->input->post("color"),
                "rie_fecha" => $this->input->post("fecha"),
                "rie_fechaModificacion" => date("Y-m-d H:i:s"),
                "rie_actividad" => $this->input->post("actividades")
            );
            $this->Riesgo_model->atualizarriesgo($this->input->post("rie_id"), $data);
            $this->Riesgocargo_model->eliminarcargoriesgo($this->input->post("rie_id"));
            if (!empty($this->input->post("cargo"))):
                $cargo = $this->input->post("cargo");
                for ($i = 0; $i < count($cargo); $i++):
                    $dataCargo[] = array("car_id" => $cargo[$i], "rie_id" => $this->input->post("rie_id"));
                endfor;
                $this->Riesgocargo_model->guardarcargo($dataCargo);
            endif;
        } catch (Exception $ex) {
            
        } finally {
            
        }
    }

    function listadoavance2() {
        try {
            $this->load->model('Avancetarea_model');
            $clasificacion = $this->Avancetarea_model->listado_avanceriesgo($this->input->post('rie_id'));
            $this->output->set_content_type('application/json')->set_output(json_encode($clasificacion));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaRiesgoFlechas() {
        try {
            $this->load->model(array("Riesgo_model", "Riesgocargo_model", "Riesgoclasificaciontipo_model"));
            $idRiesgo = $this->input->post("idRiesgo");
            $metodo = $this->input->post("metodo");
            $campos["campos"] = $this->Riesgo_model->consultaRiesgoFlechas($idRiesgo, $metodo)[0];
            die();
            if (!empty($campos)) {
                $data["tipo"] = $this->Riesgoclasificaciontipo_model->tipoxcategoria($campos["campos"]->cat_id);

                $data["cargoId"] = $this->Riesgocargo_model->detailxid($campos["campos"]->rie_id);
                $campos = array_merge($campos, $data);
                $this->output->set_content_type('application/json')->set_output(json_encode($campos));
            } else {
                $this->output->set_content_type('application/json')->set_output("vacio");
            }
        } catch (Exception $e) {
            echo $e;
            die;
        } finally {
            
        }
    }

    function consultatiporiesgo() {
        try {
            $this->load->model("Riesgoclasificaciontipo_model");
            $data['Json'] = $this->Riesgoclasificaciontipo_model->tipoxcategoria($this->input->post("categoria"));
            if (count($data['Json']) == 0)
                $data["message"] = "No hay tipos para la categoria";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function clasificacionriesgo() {
        try {
            $this->load->model("Riesgoclasificacion_model");
            $categoria = $this->Riesgoclasificacion_model->detailandtipo();

            $i = array();
            foreach ($categoria as $c) {
                $i[$c->rieCla_id][$c->rieCla_categoria][] = array(
                    $c->rieClaTip_id,
                    $c->rieClaTip_tipo
                );
            }
            $this->data['categoria'] = $i;
            $this->data['categoria2'] = $this->Riesgoclasificacion_model->detail();
            $this->layout->view("riesgo/clasificacionriesgo", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function elementos() {
        try {
            $this->load->model('Riesgoclasificacionelemento_model');
            $elemento = array(
                "rieClaTip_id" => $this->input->post("tipo"),
                "rieClaEle_elemento" => $this->input->post("elemento"),
                "creatorUser" => $this->data["usu_id"],
                "creationDate" => date("Y-m-d H:i:s"),
            );
            if ($this->Riesgoclasificacionelemento_model->save($elemento) == FALSE)
                throw new Exception("Error en la base de datos");

            $data["Json"] = $this->Riesgoclasificacionelemento_model->detailxIdTipo($this->input->post("tipo"));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function elementosXIdTipo() {
        try {
            $this->load->model('Riesgoclasificacionelemento_model');
            $data["Json"] = $this->Riesgoclasificacionelemento_model->detailxIdTipo($this->input->post("tipo"));
            if (count($data["Json"]) == 0)
                throw new Exception("No se encontraron elementos asociados");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function listadoriesgo() {
        try {
            $this->load->model(array('Dimension2_model', 'Dimension_model', 'Empresa_model', 'Cargo_model', "Riesgoclasificacion_model"));
            $this->data['empresa'] = $this->Empresa_model->detail();
            if (!empty($this->data['empresa'][0]->Dim_id) && !empty($this->data['empresa'][0]->Dimdos_id)) {
                $this->data['categoria'] = $this->Riesgoclasificacion_model->detail();
                $this->data['cargo'] = $this->Cargo_model->detail();
                $this->data['dimension'] = $this->Dimension_model->detail();
                $this->data['dimension2'] = $this->Dimension2_model->detail();
                $this->layout->view("riesgo/listadoriesgo", $this->data);
            } else {
                redirect('index.php/administrativo/empresa', 'location');
            }
        } catch (Exception $e) {
            
        } finally {
            
        }
    }

    function listadoriesgocargos() {
        try {
            $this->load->model('Riesgocargo_model');
            $data["Json"] = $this->Riesgocargo_model->detailxcargoxid($this->input->post('rie_id'));
            if (count($data["Json"]) == 0)
                $data["message"] = "No hay información";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function update() {
        try {
            $this->load->model("Riesgoclasificacion_model");
            $this->Riesgoclasificacion_model->create($this->input->post('categoria'), $this->input->post('id_categoria'));
            $categoria = $this->Riesgoclasificacion_model->detailandtipo();
            $i = array();
            foreach ($categoria as $c) {
                $i[$c->rieCla_id][$c->rieCla_categoria][] = array(
                    $c->rieClaTip_id,
                    $c->rieClaTip_tipo
                );
            }

            $this->output->set_content_type('application/json')->set_output(json_encode($i));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarclasificacionriesgo() {
        try {
            $this->load->model("Riesgoclasificacion_model");
            if (empty($this->Riesgoclasificacion_model->detailxcategoria($this->input->post('categoria')))) {
                $this->Riesgoclasificacion_model->create($this->input->post('categoria'));
                $categoria = $this->Riesgoclasificacion_model->detailandtipo();
                $i = array();
                foreach ($categoria as $c) {
                    $i[$c->rieCla_id][$c->rieCla_categoria][] = array(
                        $c->rieClaTip_id,
                        $c->rieClaTip_tipo
                    );
                }

                $this->output->set_content_type('application/json')->set_output(json_encode($i));
            } else {
                echo 1;
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardartipocategoria() {

        try {
            $this->load->model(array("Riesgoclasificacion_model", "Riesgoclasificaciontipo_model"));
            if (empty($this->Riesgoclasificaciontipo_model->exist($this->input->post("categoria"), $this->input->post("tipo")))) {
                if ($this->input->post("accion") == 1) {
                    $this->Riesgoclasificaciontipo_model->create(
                            $this->input->post("categoria"), $this->input->post("tipo")
                    );
                } else {
                    $this->Riesgoclasificaciontipo_model->modificarClasificacionTipo(
                            $this->input->post("categoria"), $this->input->post("tip_id"), $this->input->post("tipo"));
                }
                $categoria = $this->Riesgoclasificacion_model->detailandtipo();
                $i = array();
                foreach ($categoria as $c) {
                    $i[$c->rieCla_id][$c->rieCla_categoria][] = array(
                        $c->rieClaTip_id,
                        $c->rieClaTip_tipo
                    );
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($i));
            } else {
                echo 1;
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultatiporiesgoxclasificacion() {
        try {
            $this->load->model("Riesgoclasificaciontipo_model");
            $data['Json'] = $this->Riesgoclasificaciontipo_model->tipoxcategoria($this->input->post("categoria"));
            if (count($data['Json']) == 0)
                $data['message'] = "No hay tipos asociados a la clasificación";
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function busquedariesgo() {
        try {
            $this->load->model("Riesgo_model");
            $planes = $this->Riesgo_model->filtrobusqueda(
                    $this->input->post("cargo"), $this->input->post("categoria"), $this->input->post("dimensionuno"), $this->input->post("dimensiondos"), $this->input->post("tipo")
            );
            $i = array();
            if (count($planes) > 0) {
                foreach ($planes as $t) {
                    $i["Json"][$t->rieCla_id][$t->rieCla_categoria][] = array(
                        "rie_id" => $t->rie_id,
                        "des2" => $t->des2,
                        "des1" => $t->des1,
                        "estado" => $t->estado,
                        "rie_zona" => $t->rie_zona,
                        "rie_descripcion" => $t->rie_descripcion,
                        "rie_fecha" => $t->rie_fecha,
                        "rieClaTip_tipo" => $t->rieClaTip_tipo,
//                        "rieCol_colorhtml" => $t->rieCol_colorhtml,
                        "rie_actividad" => $t->rie_actividad,
                        "cantidadTareas" => $t->cantidadTareas
                    );
                }
                $this->output->set_content_type('application/json')->set_output(json_encode($i));
            } else {
                $data["message"] = "No se encontraron datos en el sistema";
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminar_riesgos() {
        try {
            $this->load->model("Riesgo_model");
            $data['Json'] = $this->Riesgo_model->eliminar_riesgos($this->input->post());
            if ($data['Json'] != true)
                $data["message"] = "No se pudo eliminar por favor comunicarse con el administrador";
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminar() {
        try {
            $this->load->model("Riesgoclasificacion_model");
            $this->Riesgoclasificacion_model->eliminar(
                    $this->input->post('id')
            );
            $categoria = $this->Riesgoclasificacion_model->detailandtipo();
            $i = array();
            foreach ($categoria as $c) {
                $i[$c->rieCla_id][$c->rieCla_categoria][] = array(
                    $c->rieClaTip_id,
                    $c->rieClaTip_tipo
                );
            }

            $this->output->set_content_type('application/json')->set_output(json_encode($i));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminarCategoria() {
        try {
            $this->load->model("Riesgoclasificacion_model");
            $this->Riesgoclasificacion_model->eliminarCategoria(
                    $this->input->post('rieCla_id')
            );
            $categoria = $this->Riesgoclasificacion_model->detailandtipo();
            $i = array();
            foreach ($categoria as $c) {
                $i[$c->rieCla_id][$c->rieCla_categoria][] = array(
                    $c->rieClaTip_id,
                    $c->rieClaTip_tipo
                );
            }

            $this->output->set_content_type('application/json')->set_output(json_encode($i));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function matrizRiesgo() {
        $this->load->model("Riesgo_model");
        $matriz = $this->Riesgo_model->matrizRiesgo();
        $i = array();
        foreach ($matriz as $m) :
            $i[$m->pla_nombre][$m->actPad_nombre][$m->actHij_nombre][$m->tar_descripcion][$m->rie_descripcion][$m->rieCla_categoria][] = $m->rieClaTip_tipo;
        endforeach;
        var_dump($i);die;
        $this->data['matriz'] = $i;
        $this->layout->view("riesgo/matrizriesgo", $this->data);
    }

    function solicitudriesgo() {
        try {
            $this->load->model(array("Empleado_model"
                , "Empresa_model"
                , 'Dimension2_model'
                , 'Dimension_model'));

            $this->data["empleados"] = $this->Empleado_model->detail_order();
            $this->data['dimension'] = $this->Dimension_model->detail();
            $this->data['dimension2'] = $this->Dimension2_model->detail();
            $this->data['empresa'] = $this->Empresa_model->detail()[0];
            $this->layout->view("riesgo/solicitudriesgo", $this->data);
        } catch (Exception $e) {
            
        } finally {
            
        }
    }

    function filtroSolicitud() {
        try {
            $this->load->model(array("Solicitudriesgo_model"));

            $solicitud = $this->input->post('numSolicitud');
            $empleado = $this->input->post('solicitante');
            $dim1 = $this->input->post('dimension1');
            $dim2 = $this->input->post('dimension2');
            $fInicial = $this->input->post('fInicial');
            $fFinal = $this->input->post('fFinal');
            $data['Json'] = $this->Solicitudriesgo_model->filtroempleados($solicitud, $empleado, $dim1, $dim2, $fInicial, $fFinal);
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function consultaSolicitud() {
        try {
            $this->load->model(array("Solicitudriesgo_model"));
            $solicitud = $this->input->post('solicitud');
            $data['Json'] = $this->Solicitudriesgo_model->detailxid($solicitud)[0];
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function prevencionRiesgo() {
        $this->load->model(array("Empresa_model", "Riesgoclasificacion_model", "Cargo_model", 'Dimension2_model', 'Dimension_model'));
        $this->data['empresa'] = $this->Empresa_model->detail();
        $this->data['categoria'] = $this->Riesgoclasificacion_model->detail();
//        $this->data['tipoClasificacion'] = $this->Riesgoclasificaciontipo_model->tipoxcategoria($this->data['tarea']->rieCla_id);
//        $this->data['riesgos'] = $this->Tarea_model->lista_riesgos();
        $this->data['dimension'] = $this->Dimension_model->detail();
        $this->data['dimension2'] = $this->Dimension2_model->detail();
        $this->data['clasificacion'] = $this->Riesgoclasificacion_model->detail();
        $this->data['cargo'] = $this->Cargo_model->detail();
        $this->layout->view("riesgo/prevencionRiesgo", $this->data);
    }

    function guardarPrevencion() {
        try {
            $this->load->model(array("Prevencionriesgoclasificacion_model","Prevencion_model"));
            $variable = array(
                "cargo" => $this->input->post("car_id"),
                "dimDos_id" => $this->input->post("dimDos"),
                "dimUno_id" => $this->input->post("dimUno"),
                "emp_id" => $this->input->post("empleado"),
                "pre_fechaFin" => $this->input->post("fechaFin"),
                "pre_fechaInicio" => $this->input->post("fechaInicio"),
                "pre_lugar" => $this->input->post("lugar"),
                "pre_medidasAdoptadas" => $this->input->post("medidasAdoptadas"),
                "pre_medidasAAdoptar" => $this->input->post("medidasAdoptar"),
                "pre_medPreApropiadas" => $this->input->post("medidasPreventivas"),
                "pre_observacion" => $this->input->post("observacion"),
                "pre_nombre" => $this->input->post("planPrevencion"),
                "pre_presupuesto" => $this->input->post("presupuesto")
            );
            $pre_id = $this->Prevencion_model->guardarPrevencion($variable);

            
            if (!empty($this->input->post('clasificacion'))):
                $clasificacion = $this->input->post('clasificacion');
                for ($i = 0; $i < count($clasificacion); $i++):
                    $prevencionClasificacion = array(
                        "pre_id" => $pre_id,
                        "RieCla_id" => $clasificacion[$i],
                    );
                    $preRieCla_id = $this->Prevencionriesgoclasificacion_model->guardarPrevencionClasificacion($prevencionClasificacion);
                endfor;
            endif;
            $data['Json'] = $pre_id;
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarAsignacion() {
        try {
            if (empty($this->input->post("pre_id")))
                throw new Exception("Primero debe guardar la prevención");
            $this->load->model("Prevencioncontrol_model");
            $control = array(
                "preCon_porcentaje" => $this->input->post("porcentaje"),
                "preCon_costo" => $this->input->post("costoAvance"),
                "preCon_descripcion" => $this->input->post("descripcionControl"),
                "pre_id" => $this->input->post("pre_id"),
                "preCon_fecha" => $this->input->post("fechaControl"),
                "creatorUser" => $this->data["usu_id"],
                "creationDate" => date("Y-m-d H:i:s")
            );
            $this->Prevencioncontrol_model->guardarControl($control);
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function listadoPrevencion() {

        $this->layout->view("riesgo/listadoPrevencion", $this->data);
    }

    function consultaListadoPrevencion() {
        try {
            $this->load->model("Prevencioncontrol_model");
            $data['Json'] = $this->Prevencioncontrol_model->filtroMatrizPrevencion($this->input->post("fechaDesde"), $this->input->post("fechaHasta"));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */