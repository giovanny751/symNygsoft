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
class Administrativo extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    function creacionempleados() {
        try {
            $this->data['empleado'] = "";
            $this->load->model(array(
                'Tipocontrato_model',
                'Sexo_model', 'Estadocivil_model',
                'Tipoaseguradora_model',
                'Dimension2_model',
                'Dimension_model',
                'Cargo_model',
                'Tipo_aseguradora__model',
                'Empleadotipoaseguradora_model',
                'Empresa_model',
                'Empleadoregistro_model',
                'Empleadoresponsable_model',
                "Horario_model",
                'Empleadocarpeta_model',
                'Empleado_model',
                'Vacaciones_model',
                'Empleadoausentismo_model',
                'Horaextratipo_model',
                'Empleadohoraextra_model',
                'Empleadocontrato_model',
                'Empleadoincapacidad_model',
                'Capacitaciones_model'
            ));
            $this->data['tipoHora'] = $this->Horaextratipo_model->tipos();
            $empleadoId = (!empty($this->input->post('emp_id'))) ? $this->input->post('emp_id') : "";
            if (isset($empleadoId)) {
                $this->data['horasExtras'] = $this->Empleadohoraextra_model->detalleHoraXEmpleado($empleadoId);
                $this->data['capacitaciones'] = $this->Capacitaciones_model->capacitacionesXidEmpleado($empleadoId);
                $this->data['tiposContrato'] = $this->Empleadocontrato_model->contratosxEmpleado($empleadoId);
                $this->data['vacaciones'] = $this->Vacaciones_model->detailxEmpleado($empleadoId);
                $this->data['incapacidades'] = $this->Empleadoincapacidad_model->detailxid($empleadoId);
                $this->data['ausentismo'] = $this->Empleadoausentismo_model->detailxEmpleado($empleadoId);
                $this->data['empleado'] = $this->Empleado_model->consultaempleadoxid($empleadoId);
                $this->data["aserguradorasxempleado"] = $this->Empleadotipoaseguradora_model->consult_empleado($empleadoId);
                $this->data["carpeta"] = $this->Empleadocarpeta_model->detail($empleadoId);
                $registro = $this->Empleadoregistro_model->detailxIdEmpleado($empleadoId);
                $this->data['registro'] = array();
                foreach ($registro as $campo)
                    $this->data['registro'][$campo->empCar_id][$campo->empCar_nombre . " - " . $campo->empCar_descripcion][] = array($campo->nombreempleado, $campo->empReg_archivo, $campo->empReg_descripcion, $campo->empReg_version, $campo->empReg_id, $campo->empReg_tamano, $campo->empgReg_fecha);

                $this->data['empleadoresponsable'] = $this->Empleadoresponsable_model->detail();
            }
            $this->data['empresa'] = $this->Empresa_model->detail();
            if ((!empty($this->data['empresa'][0]->Dim_id)) && (!empty($this->data['empresa'][0]->Dimdos_id))) {
                $this->data['cargo'] = $this->Cargo_model->detail();
                $this->data['horario'] = $this->Horario_model->tipos();
                $this->data['tipocontrato'] = $this->Tipocontrato_model->detail();
                $this->data['sexo'] = $this->Sexo_model->detail();
                $this->data['estadocivil'] = $this->Estadocivil_model->detail();
                $this->data['aseguradoras'] = $this->Tipo_aseguradora__model->aseguradoras();
                $this->data['tipoaseguradora'] = $this->Tipoaseguradora_model->detail();
                $this->data['dimension'] = $this->Dimension_model->detail();
                $this->data['dimension2'] = $this->Dimension2_model->detail();
                $this->layout->view("administrativo/creacionempleados", $this->data);
            } else {
                redirect('index.php/administrativo/empresa', 'location');
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function horasExtrasGuardadasHoy() {
        try {
            $data = array();
            $this->load->model(array("Empleadohoraextra_model"));
            $data['Json'] = $this->Empleadohoraextra_model->horasGuardadasHoy();
            if (empty($data['Json']))
                throw new Exception("No ha registrado horas extra");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarHorasExtras() {
        try {
            if (empty($this->input->post("emp_id")))
                throw new Exception("Primero debe registrar el empleado");
            $this->load->model(array("Empleadohoraextra_model"));
            $dataGuardar = array(
                "emp_id" => $this->input->post("emp_id"),
                "empHorExt_fecha" => $this->input->post("fecha"),
                "horExtTip_id" => $this->input->post("tipo"),
                "empHorExt_horas" => $this->input->post("horas"),
                "creatorUser" => $this->data['usu_id'],
                "creatorDate" => date("Y-m-d H:i:s")
            );
            $this->Empleadohoraextra_model->save($dataGuardar);

            $data['Json'] = $this->Empleadohoraextra_model->detalleHoraXEmpleado($this->input->post("emp_id"));
        } catch (exception $e) {
            $data["message"] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function eliminarHorasExtrasEmpleado() {
        try {
            $this->load->model(array("Empleadohoraextra_model"));
            $this->Empleadohoraextra_model->eliminarHoraExtra($this->input->post("HorExtId"));
            $data['Json'] = $this->Empleadohoraextra_model->horasGuardadasHoy();
            if (empty($data['Json'])) {
                throw new Exception("No hay registros de horas extras");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarHorasExtrasEmpleado() {
        try {
            $this->load->model(array("Empleadohoraextra_model"));
            $dataSave = array(
                "emp_id" => $this->input->post("emp_id"),
                "empHorExt_fecha" => $this->input->post("fecha"),
                "horExtTip_id" => $this->input->post("tipo"),
                "empHorExt_horas" => $this->input->post("horas"),
                "creatorUser" => $this->data['usu_id'],
                "creatorDate" => date("Y-m-d H:i:s")
            );
            $this->Empleadohoraextra_model->save($dataSave);
            $data['Json'] = $this->Empleadohoraextra_model->horasGuardadasHoy();
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarVacaciones() {
        try {
            if (empty($this->input->post("emp_id")))
                throw new Exception("Primero debe registrar el empleado");
            $this->load->model('Vacaciones_model');
            $data = array(
                "vac_fechaInicio" => $this->input->post("iniciovacaciones"),
                "vac_fechaFin" => $this->input->post("finvacaciones"),
                "vac_observaciones" => $this->input->post("observacionvacaciones"),
                "emp_id" => $this->input->post("emp_id")
            );
            if ($this->Vacaciones_model->saveVacation($data) == true)
                $data['Json'] = $this->Vacaciones_model->detailxEmpleado($this->input->post("emp_id"));
            else
                throw new Exception("Error por favor comunicarse con el administrador");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function traer_dimencion() {
        try {
            $this->load->model('Dimension2_model');
            $data['Json'] = $this->Dimension2_model->traer_dimencion();
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarAusentismo() {
        try {
            if (empty($this->input->post("emp_id")))
                throw new Exception("Primero debe registrar el empleado");
            $this->load->model('Empleadoausentismo_model');
            $data = array(
                "empAus_fechaInicial" => $this->input->post("iniciovacaciones"),
                "empAus_fechaFinal" => $this->input->post("finvacaciones"),
                "empAus_observaciones" => $this->input->post("observacionvacaciones"),
                "emp_id" => $this->input->post("emp_id")
            );
            if ($this->Empleadoausentismo_model->saveVacation($data) == true)
                $data['Json'] = $this->Empleadoausentismo_model->detailxEmpleado($this->input->post("emp_id"));
            else
                throw new Exception("Error por favor comunicarse con el administrador");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function obtener_lugar() {
        try {
            $this->load->model(array("Accidentes_model"));
            $data['Json'] = $this->Accidentes_model->obtener_lugar($this->input->post());
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function removeHolidays() {
        try {
            $this->load->model('Vacaciones_model');
            $data['Json'] = $this->Vacaciones_model->removeHolidays($this->input->post("vac_id"));
            if ($data['Json'] == false)
                throw new Exception("Error en la base de datos");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function updateHolidays() {
        try {
            $this->load->model('Vacaciones_model');
            $data = array(
                "vac_fechaInicio" => $this->input->post("iniciovacaciones"),
                "vac_fechaFin" => $this->input->post("finvacaciones"),
                "vac_observaciones" => $this->input->post("observacionvacaciones"),
                "emp_id" => $this->input->post("emp_id")
            );
            if ($this->Vacaciones_model->updateHolidays($data, $this->input->post("vac_id")) == true)
                $data['Json'] = $this->Vacaciones_model->detailxEmpleado($this->input->post("emp_id"));
            else
                throw new Exception("Error por favor comunicarse con el administrador");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function actualizarAusentismo() {
        try {
            $this->load->model('Vacaciones_model');
            $data = array(
                "vac_fechaInicio" => $this->input->post("iniciovacaciones"),
                "vac_fechaFin" => $this->input->post("finvacaciones"),
                "vac_observaciones" => $this->input->post("observacionvacaciones"),
                "emp_id" => $this->input->post("emp_id")
            );
            if ($this->Vacaciones_model->updateHolidays($data, $this->input->post("vac_id")) == true)
                $data['Json'] = $this->Vacaciones_model->detailxEmpleado($this->input->post("emp_id"));
            else
                throw new Exception("Error por favor comunicarse con el administrador");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function dataHolidaysxId() {
        try {
            $this->load->model('Vacaciones_model');
            $data['Json'] = $this->Vacaciones_model->dataHolidaysxId($this->input->post("vac_id"));
            if (count($data['Json']) == 0)
                throw new Exception("No se encontro información para el Id");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function cargarempleadocarpeta() {
        try {
            $this->load->model('Empleadocarpeta_model');
            $carpeta = $this->Empleadocarpeta_model->cargarcarpeta($this->input->post("carpeta"));
            $this->output->set_content_type('application/json')->set_output(json_encode($carpeta[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminarregistro() {
        try {
            $this->load->model('Empleadoregistro_model');
            $this->Empleadoregistro_model->eliminarregistroempleado($this->input->post("empReg_id"));
        } catch (exception $e) {
            
        }
    }

    function modificarcarpeta() {
        try {
            $this->load->model('Empleadocarpeta_model');
            $carpeta = $this->Empleadocarpeta_model->actualizacarpeta(
                    $this->input->post("nombrecarpeta"), $this->input->post("descripcioncarpeta"), $this->input->post("empCar_id")
            );
            $carpeta = $this->Empleadocarpeta_model->cargarcarpeta($this->input->post("empCar_id"));
            $this->output->set_content_type('application/json')->set_output(json_encode($carpeta[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminarcarpeta() {
        try {
            $this->load->model('Empleadocarpeta_model');
            $carpeta = $this->Empleadocarpeta_model->eliminarcarpeta(
                    $this->input->post("empCar_id")
            );
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function cargartablaincapacidad() {
        try {
            $this->load->model('Empleadoincapacidad_model');
            $this->data["tablaincapacidad"] = $this->Empleadoincapacidad_model->detailxid($this->input->post("empleado"));
            $this->output->set_content_type('application/json')->set_output(json_encode($this->data["tablaincapacidad"]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarincapacidad() {
        try {
            if (empty($this->input->post('empleadoInc')))
                throw new Exception("Primero debe registrar el empleado");
            $this->load->model('Empleadoincapacidad_model');
            $data = array(
                'empRes_id' => $this->input->post('responsable'),
                'empInc_fechaInicio' => $this->input->post('fechaInicioInc'),
                'empInc_fechaFinal' => $this->input->post('fechaFinalInc'),
                'empInc_motivo' => $this->input->post('motivoInc'),
                'empInc_observacion' => $this->input->post('observacionInc'),
                'usu_id' => $this->session->userdata('usu_id'),
                'emp_id' => $this->input->post('empleadoInc'),
                'empInc_fechaIngreso' => date("Y-m-d H:i:s"),
                'creatorUser' => $this->data["usu_id"],
                'creationDate' => date("Y-m-d H:i:s")
            );
            $this->Empleadoincapacidad_model->create($data);

            $data = $this->Empleadoincapacidad_model->detailxid($this->input->post('empleadoInc'));
        } catch (exception $e) {
            $data["message"] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function searchxid() {
        try {
            $this->load->model('Empleadoregistro_model');
            $data = $this->Empleadoregistro_model->searchxid($this->input->post("empReg_id"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarcarpeta() {
        try {
            if (empty($this->input->post("emp_id")))
                throw new Exception("Primero debe registrar el empleado");

            $this->load->model('Empleadocarpeta_model');
            $this->Empleadocarpeta_model->create(
                    $this->input->post("nombrecarpeta"), $this->input->post("descripcioncarpeta"), $this->input->post("emp_id")
            );
            $carpetas = $this->Empleadocarpeta_model->search(
                    $this->input->post("nombrecarpeta"), $this->input->post("descripcioncarpeta"), $this->input->post("emp_id")
            );
            $data = $carpetas[0];
        } catch (exception $e) {
            $data["message"] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarregistroempleado() {
        try {
            $post = $this->input->post();
            $this->load->model(array('Empleado_model', 'Empleadoregistro_model'));
            $tamano = round($_FILES["archivo"]["size"] / 1024, 1) . " KB";
            $post["empReg_tamano"] = $tamano;
            $fecha = new DateTime();
            $post["empgReg_fecha"] = $fecha->format('Y-m-d H:i:s');
//Creamos carpeta con el ID del registro
            if (isset($_FILES['archivo']['name']))
                if (!empty($_FILES['archivo']['name']))
                    $post['empReg_archivo'] = basename($_FILES['archivo']['name']);

            if (empty($emp_id))
                $emp_id = $post['Emp_Id'];
            $targetPath = "./uploads/empleado/" . $post['Emp_Id'];

            if (empty($this->input->post('empReg_id')))
                $emp_id = $this->Empleadoregistro_model->empleado_registro($post);
            else {
                $this->Empleadoregistro_model->empleado_registroactualizar($post, $this->input->post('empReg_id'));
                $emp_id = $this->input->post('regEmp_id');
            }

//De la carpeta idRegistro, creamos carpeta con el id del empleado
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            $targetPath = "./uploads/empleado/" . $post['Emp_Id'] . '/' . $emp_id;
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            $target_path = $targetPath . '/' . basename($_FILES['archivo']['name']);
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) {
                
            }
            $detallecarpeta = $this->Empleadoregistro_model->detallexcarpeta($post['empReg_carpeta']);
            $this->output->set_content_type('application/json')->set_output(json_encode($detallecarpeta));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarempleado() {
        try {
            $this->load->model(array('Empleado_model', 'Empleadotipoaseguradora_model'));

            $id = $this->Empleado_model->create();

            if (empty($id))
                throw new Exception("Error al momento de insertar un empleado");

            $tipoaseguradora = $this->input->post("tipoaseguradora");
            $dataAseguradora = array();
            if (!empty($tipoaseguradora[0])):
                $nombreaseguradora = $this->input->post("nombreaseguradora");
                for ($i = 0; $i < count($tipoaseguradora); $i++) {
                    if ($nombreaseguradora[$i] != ""):
                        $dataAseguradora[$i] = array(
                            "emp_id" => $id,
                            "ase_id" => $nombreaseguradora[$i],
                            "tipAse_id" => $tipoaseguradora[$i]
                        );

                    endif;
                }
                $this->Empleadotipoaseguradora_model->create($dataAseguradora);
            endif;
            $data['Json'] = $id;
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function validarcedula() {
        try {
            $this->load->model('Empleado_model');
            $cedula = $this->Empleado_model->validacedula($this->input->post("cedula"));
            if (!empty($cedula)) {
                echo 1;
            } else {
                echo 2;
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardaractualizacion() {
        try {
            $this->load->model('Empleado_model');
            $data = array(
                'Emp_codigo' => $this->input->post('codigo'),
                'Emp_Cedula' => $this->input->post('cedula'),
                'TipDoc_id' => $this->input->post('tipodocumento'),
                'Emp_Nombre' => $this->input->post('nombre'),
                'Emp_Apellidos' => $this->input->post('apellidos'),
                'sex_Id' => $this->input->post('sexo'),
                'Emp_FechaNacimiento' => $this->input->post('fechadenacimiento'),
                'Emp_Estatura' => $this->input->post('estatura'),
                'Emp_Peso' => $this->input->post('peso'),
                'Emp_Telefono' => $this->input->post('telefono'),
                'Emp_Direccion' => $this->input->post('direccion'),
                'Emp_Contacto' => $this->input->post('contacto'),
                'Emp_TelefonoContacto' => $this->input->post('telefonocontacto'),
                'Emp_Email' => $this->input->post('email'),
                'EstCiv_id' => $this->input->post('estadocivil'),
                'Emp_FechaInicioContrato' => $this->input->post('fechainiciocontrato'),
                'Emp_FechaFinContrato' => $this->input->post('fechafincontrato'),
                'Emp_PlanObligatorioSalud' => $this->input->post('planobligatoriodesalud'),
                'Emp_FechaAfiliacionArl' => $this->input->post('fechaafiliacionarl'),
                'Dim_id' => $this->input->post('dimension1'),
                'Dim_IdDos' => $this->input->post('dimension2'),
                'Car_id' => $this->input->post('cargo'),
                'emp_salario' => $this->input->post('salario'),
                'emp_fondo' => $this->input->post('fondo')
            );
            $this->Empleado_model->update($data, $this->input->post('emp_id'));

//--------------------- Actualiza tipo aseguradoras ----------------------------
            $id = $this->input->post('emp_id');
            $this->load->model('Empleadotipoaseguradora_model');
            $tipoaseguradora = $this->input->post("tipoaseguradora");
            $data = array();

//        if (isset($tipoaseguradora)) 
            if ((!empty($this->input->post("tipoaseguradora")[0])) && (!empty($this->input->post("nombreaseguradora")[0]))) {
                $nombreaseguradora = $this->input->post("nombreaseguradora");
                for ($i = 0; $i < count($tipoaseguradora); $i++) {
                    if ($nombreaseguradora[$i] != ""):
                        $data[$i] = array(
                            "emp_id" => $id,
                            "ase_id" => $nombreaseguradora[$i],
                            "tipAse_id" => $tipoaseguradora[$i]
                        );
                    endif;
                }
                $this->Empleadotipoaseguradora_model->actualizatipo($id, $data);
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaaseguradoras() {
        try {
            $this->load->model('Aseguradora_model');
            $data = $this->Aseguradora_model->consulta_aseguradora($this->input->post("id"));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadoempleados() {
        try {
            $this->data['title'] = "Listado Empleados";
            $this->load->model('Empresa_model');
            $this->data['empresa'] = $this->Empresa_model->detail();
            if ((!empty($this->data['empresa'][0]->Dim_id)) && (!empty($this->data['empresa'][0]->Dimdos_id))) {
                $this->load->model('Tipo_documento_model');
                $this->load->model('Tipocontrato_model');
                $this->load->model("Estados_model");
                $this->load->model('Cargo_model');
                $this->load->model('Dimension2_model');
                $this->load->model('Dimension_model');
                $this->data['dimension'] = $this->Dimension_model->detail();
                $this->data['dimension2'] = $this->Dimension2_model->detail();
                $this->data['cargo'] = $this->Cargo_model->detail();
                $this->data['estado'] = $this->Estados_model->detail();
                $this->data['tipocontrato'] = $this->Tipocontrato_model->detail();
//        var_dump($this->data['tipocontrato']);die;
                $this->data["tipodocumento"] = $this->Tipo_documento_model->detail();
                $this->layout->view("administrativo/listadoempleados", $this->data);
            } else {
                redirect('index.php/administrativo/empresa', 'location');
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaempleados() {
        try {
            $this->load->model('Empleado_model');
            $cedula = $this->input->post('cedula');
            $nombre = $this->input->post('nombre');
            $apellido = $this->input->post('apellido');
            $codigo = $this->input->post('codigo');
            $cargo = $this->input->post('cargo');
            $estado = $this->input->post('estado');
            $dim1 = $this->input->post('dimension1');
            $dim2 = $this->input->post('dimension2');
            $estado = $this->input->post('estado');
            $tipocontrato = $this->input->post('tipocontrato');
            $contratosvencidos = $this->input->post('contratosvencidos');
            $data['Json'] = $this->Empleado_model->filtroempleados($cedula, $nombre, $apellido, $codigo, $cargo, $estado, $contratosvencidos, $tipocontrato, $dim1, $dim2);
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarContrato() {
        try {
            $this->load->model('Empleadocontrato_model');
            if (empty($this->input->post("emp_id")))
                throw new Exception("primero debe registrar el empleado");
            $data = array(
                "empCon_fechaDesde" => $this->input->post("fInicioContrato"),
                "empCon_fechaHasta" => $this->input->post("fFinalContrato"),
                "tipCon_id" => $this->input->post("tipContrato"),
                "empCon_observacion" => $this->input->post("obsContrato"),
                "emp_id" => $this->input->post("emp_id"),
                "creatorUser" => $this->data['usu_id'],
                "creatorDate" => date('Y-m-d H:i:s')
            );
            $contrato = $this->Empleadocontrato_model->CreacionContrato($data);

            $data['Json'] = $this->Empleadocontrato_model->contratosxEmpleado($this->input->post("emp_id"));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function consultacontratosvencidos() {
        try {
            $this->load->model('Empleado_model');
            $this->data['listado'] = $this->Empleado_model->contratosvencidos();
            $this->output->set_content_type('application/json')->set_output(json_encode($this->data['listado']));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function eliminarempleado() {
        try {
            $this->load->model('Empleado_model');
            $respuesta = $this->Empleado_model->eliminarempleado($this->input->post('id'));
            if ($respuesta == true)
                $data['Json'] = $respuesta;
            else
                throw new Exception("Error en la base de datos");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function creacionusuarios() {
        try {
            $this->load->model(array('Sexo_model', 'Cargo_model', 'Empleado_model', 'Estados_model', 'User_model', 'Roles_model'));
            $this->data['roles'] = $this->Roles_model->roles();
            $this->data['empleado'] = $this->Empleado_model->detail();
            $this->data['estado'] = $this->Estados_model->detail();
            $this->data['sexo'] = $this->Sexo_model->detail();
            $this->data['cargo'] = $this->Cargo_model->detail();
            $this->data['usuario'] = "";
            $user = $this->input->post('usu_id');
            if (!empty($user)) {
                $this->data['usuario'] = $this->User_model->consultausuarioxid($this->input->post('usu_id'));
                $this->data['empleado'] = $this->Empleado_model->empleadoxcargo($this->data['usuario'][0]->car_id);
            }
            $this->layout->view("administrativo/creacionusuarios", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function listadousuarios() {
        try {
            $this->load->model(array('Tipo_documento_model', 'Estados_model', 'User_model', 'Roles_model'));
            $this->data['roles'] = $this->Roles_model->roles();
            $this->data['estado'] = $this->Estados_model->detail();
            $this->data["tipodocumento"] = $this->Tipo_documento_model->detail();
            $this->data["usuarios"] = $this->User_model->consultageneral();
            $this->layout->view("administrativo/listadousuarios", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultarusuario() {
        try {
            $this->load->model('User_model');
            $data['Json'] = $this->User_model->filteruser(
                    $this->input->post('apellido')
                    , $this->input->post('cedula')
                    , $this->input->post('estado')
                    , $this->input->post('nombre')
            );
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarusuario() {
        try {
            $this->load->model(array('User_model', 'Roles_model', 'Empresa_model'));
            $consultaexistencia = $this->User_model->consultausuarioxcedula($this->input->post('cedula'));
            if (empty($consultaexistencia)) {
                $data = array(
                    'usu_contrasena' => sha1($this->input->post('contrasena')),
                    'est_id' => $this->input->post('estado'),
                    'usu_politicas' => '0',
                    'usu_cedula' => $this->input->post('cedula'),
                    'usu_nombre' => $this->input->post('nombres'),
                    'usu_apellido' => $this->input->post('apellidos'),
                    'usu_usuario' => $this->input->post('usuario'),
                    'usu_email' => $this->input->post('email'),
                    'sex_id' => $this->input->post('genero'),
                    'usu_cambiocontrasena' => $this->input->post('cambiocontrasena'),
                    'usu_fechaCreacion' => date('Y-m-d H:i:s'),
                    'car_id' => (!empty($this->input->post('cargo')) ? $this->input->post('cargo') : NULL),
                    'emp_id' => (!empty($this->input->post('empleado')) ? $this->input->post('empleado') : NULL),
                    'rol_id' => (!empty($this->input->post('rol')) ? $this->input->post('rol') : NULL)
                );
                $this->data['empresa'] = $this->Empresa_model->detail();
                $this->data['nombre'] = $this->input->post('nombres') . " " . $this->input->post('apellidos');
                $this->data['usuario'] = $this->input->post('usuario');
                $this->data['contrasena'] = $this->input->post('contrasena');

                $cartaBienvenida = $this->load->view("cartas/ingresousuario", $this->data, true);
                $cabeceras = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                mail($this->input->post('email'), "Bienvenido al sistema SG-SST", $cartaBienvenida, $cabeceras);
//                echo $data;die;
//                var_dump($data);die;

                $id = $this->User_model->create($data);
                if (!empty($id))
                    $this->Roles_model->permisosusuario($id, $this->input->post('rol'));
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function actualizarusuario() {
        try {
            $this->load->model('User_model');
            $data = array(
                'usu_contrasena' => $this->input->post('contrasena'),
                'est_id' => $this->input->post('estado'),
                'usu_cedula' => $this->input->post('cedula'),
                'usu_nombre' => $this->input->post('nombres'),
                'usu_apellido' => $this->input->post('apellidos'),
                'usu_usuario' => $this->input->post('usuario'),
                'usu_email' => $this->input->post('email'),
                'sex_id' => $this->input->post('genero'),
                'car_id' => $this->input->post('cargo'),
                'emp_id' => $this->input->post('empleado'),
                'usu_cambiocontrasena' => $this->input->post('cambiocontrasena'),
                'usu_fechaCreacion' => date('Y-m-d H:i:s')
            );
            $this->User_model->update($data, $this->input->post('usuid'));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaorganigrama($datosmodulos = null, $html = null) {
        try {
            $tipo = 2;
            $this->load->model('Cargo_model');
            $menu = $this->Cargo_model->consultaorganigrama($datosmodulos);
            $i = array();

            foreach ($menu as $modulo)
                $i[$modulo['car_id']][$modulo['car_nombre']][] = array($modulo['idjefe']);
            if ($datosmodulos == 'prueba')
                $html .='<ul id="org" style="display:none">';
            else
                $html .='<ul id="org" style="display:none">';
            foreach ($i as $padre => $nombrepapa)
                foreach ($nombrepapa as $nombrepapa => $menuidpadre)
                    foreach ($menuidpadre as $modulos => $menu):
                        $html .= "<li class='liorganigrama'><p style='margin-top:20px'>" . strtoupper($nombrepapa) . "</p>";
                        $html .=$this->consultaorganigrama($padre, null);
                        $html .= "</li>";
                    endforeach;
            $html.="</ul>";
            return $html;
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function organigrama() {
        try {
            $this->layout->view("administrativo/organigrama");
        } catch (exception $e) {
            
        }
    }

    function loadorganigrama() {
        try {
            $this->data["organigrama"] = $this->consultaorganigrama();
            $this->load->view("administrativo/organigrama_load", $this->data);
        } catch (exception $e) {
            
        }
    }

    function cargos() {
        try {
            $this->data['title'] = "Cargos";
            $this->load->model(array("Empresa_model", 'Cargo_model'));
            $this->data["cargo"] = $this->Cargo_model->detail();
            $this->data['informacion'] = $this->Empresa_model->detail();
            $this->layout->view("administrativo/cargos", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function cargoriesgo() {
        try {
            $this->load->model('Cargo_model');
            $data['Json'] = $this->Cargo_model->cargoriesgo($this->input->post('car_id'));
        } catch (exception $e) {
            
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function dimensionunoriesgo() {
        try {
            $this->load->model('Dimension_model');
            $data['Json'] = $this->Dimension_model->dimensionunoriesgo($this->input->post('dim_id'));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function dimensiondosriesgo() {
        try {
            $this->load->model('Dimension2_model');
            $data['Json'] = $this->Dimension2_model->dimensionunoriesgo($this->input->post('dim_id'));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function consultausuarioscargo() {
        try {
            $this->load->model('Empleado_model');
            $this->data["cargo"] = $this->Empleado_model->empleadoxcargo($this->input->post('cargo'));
            $this->output->set_content_type('application/json')->set_output(json_encode($this->data["cargo"]));
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultausuariosflechas() {
        try {
            $this->load->model("User_model");
            $idUsuarioCreado = $this->input->post("idUsuarioCreado");
            $metodo = $this->input->post("metodo");
            $campos = $this->User_model->consultausuariosflechas($idUsuarioCreado, $metodo);

            if (!empty($campos)) {
                $this->output->set_content_type('application/json')->set_output(json_encode($campos[0]));
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaempleadoflechas() {
        try {
            $this->load->model("Empleado_model");
            $idEmpleadoCreado = $this->input->post("idEmpleadoCreado");
            $metodo = $this->input->post("metodo");
            $campos = $this->Empleado_model->consultaempleadoflechas($idEmpleadoCreado, $metodo);
            if (!empty($campos)) {
                $this->output->set_content_type('application/json')->set_output(json_encode($campos[0]));
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultaempleadoflechasaseguradora() {
        try {
            $this->load->model("Empleadotipoaseguradora_model");
            $idEmpleadoCreado = $this->input->post("idEmpleadoCreado");
            $campos = $this->Empleadotipoaseguradora_model->consult_empleado($idEmpleadoCreado);
            if (!empty($campos)) {
                $this->output->set_content_type('application/json')->set_output(json_encode($campos));
            } else {
                die("null");
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function consultacargoxid() {
        try {
            $this->load->model('Cargo_model');
            $data['Json'] = $this->Cargo_model->consultacargoxid($this->input->post('car_id'));
        } catch (exception $e) {
            
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarcargo() {
        try {
            $this->load->model('Cargo_model');
            $cargo = $this->input->post("cargo");
            $cargojefe = $this->input->post("cargojefe");
            if (empty($this->Cargo_model->existe($cargo, $cargojefe))) {
                $almacenamiento = array(
                    "car_nombre" => $cargo,
                    "car_jefe" => $cargojefe,
                    "car_porcentajearl" => $this->input->post("porcentaje"),
                );
                $creacion = $this->Cargo_model->create($almacenamiento);
                if ($creacion == true)
                    $data['Json'] = $this->Cargo_model->detail();
                else
                    throw new Exception("Ocurrio un error en la base de datos");
            } else {
                throw new Exception("Cargo ya existente");
            }
        } catch (exception $e) {
            $data['message'] = "Cargo ya existente";
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function eliminarcargo() {
        try {
            $this->load->model(array('Cargo_model', 'Empleado_model'));
            if (empty($this->Empleado_model->validarExistencia($this->input->post('id')))) {
                $consulta = $this->Cargo_model->consultahijos($this->input->post('id'));
                if ($consulta > 0)
                    throw new Exception("Tiene personas a cargo");
                else {
                    if ($this->Cargo_model->delete($this->input->post('id')) == TRUE)
                        $data['Json'] = $this->Cargo_model->detail();
                    else
                        throw new Exception("Ocurrio un error en la base de datos");
                }
            } else {
                throw new Exception("Tiene empleados asociados al cargo");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function eliminarusuario() {
        try {
            $this->load->model("User_model");
            $data['Json'] = $this->User_model->eliminarusuario($this->input->post("usu_id"));
            if ($data['Json'] == false)
                throw new Exception("Error en la base de datos");
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function modificacioncargo() {
        try {
            $this->load->model('Cargo_model');
            $respuesta = $this->Cargo_model->update(
                    $this->input->post('cargo')
                    , $this->input->post('jefe')
                    , $this->input->post('cotizacion')
                    , $this->input->post('car_id')
            );
            if ($respuesta == true) {
                $data['Json'] = $this->Cargo_model->detail();
            } else
                throw new Exception("Error en la base de datos");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function dimension2() {
        $this->data['title'] = "Dimensión 2";
        $this->load->model(array('Dimension2_model', 'Empresa_model'));
        $this->data['empresa'] = $this->Empresa_model->detail();
        if (!empty($this->data['empresa'][0]->Dimdos_id)) {
            $this->data['dimension'] = $this->Dimension2_model->detail();
            $this->layout->view("administrativo/dimension2", $this->data);
        } else {
            redirect('index.php/administrativo/empresa', 'location');
        }
    }

    function consultadimensionxid2() {
        try {
            $this->load->model('Dimension2_model');
            $data['Json'] = $this->Dimension2_model->consultadimensionxid($this->input->post('dim_id'));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardarmodificaciondimension2() {
        try {
            $this->load->model('Dimension2_model');
            $respuesta = $this->Dimension2_model->guardarmodificaciondimension(
                    $this->input->post('descripcion'), $this->input->post('dimid'), $this->input->post('dimid1')
            );
            if ($respuesta == true)
                $data['Json'] = $this->Dimension2_model->detail();
            else
                throw new Exception("Error en la base de datos");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardardimension2() {
        try {
            $this->load->model('Dimension2_model');
            $guardar = array(
                "dim_descripcion" => $this->input->post('descripcion'),
                "dim_id1" => $this->input->post('dim_id')
            );
            if (empty($this->Dimension2_model->consultxname($this->input->post('descripcion'), $this->input->post('dim_id')))) {
                $respuesta = $this->Dimension2_model->create($guardar);
                if ($respuesta == true)
                    $data['Json'] = $this->Dimension2_model->detail();
                else
                    throw new Exception("Error al guardar en la base de datos");
            } else
                throw new Exception("Datos existente en el sistema");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function eliminardimension2() {
        try {
            $this->load->model('Dimension2_model');
            $respuesta = $this->Dimension2_model->delete($this->input->post('id'));
            if ($respuesta == false)
                throw new Exception("Error en la base de datos");
            else
                $data['Json'] = $respuesta;
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function actualizardimension2() {
        $this->load->model('Dimension_model');
    }

    function dimension() {
        $this->data['title'] = "Dimensión 1";
        $this->load->model(array('Dimension_model', 'Empresa_model'));
        $this->data['empresa'] = $this->Empresa_model->detail();
        if (!empty($this->data['empresa'][0]->Dim_id)) {
            $this->data['dimension'] = $this->Dimension_model->detail();
            $this->layout->view("administrativo/dimension", $this->data);
        }
    }

    function consultadimensionxid() {

        $this->load->model('Dimension_model');
        $this->data['dimension'] = $this->Dimension_model->consultadimensionxid($this->input->post('dim_id'));
        $this->output->set_content_type('application/json')->set_output(json_encode($this->data['dimension'][0]));
    }

    function guardarmodificaciondimension() {
        try {
            $this->load->model('Dimension_model');
            $respuesta = $this->Dimension_model->guardarmodificaciondimension(
                    $this->input->post('descripcion'), $this->input->post('dimid')
            );
            if ($respuesta === FALSE)
                throw new Exception("Ocurrio un error en la base de datos");
            else
                $data['Json'] = $this->Dimension_model->detail();
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function guardardimension() {
        try {
            $this->load->model('Dimension_model');
            $data = array(
                "dim_descripcion" => $this->input->post('descripcion')
            );
            if (!empty($this->Dimension_model->consultxname($this->input->post('descripcion'))))
                throw new Exception("Datos existente en el sistema");
            else {
                if ($this->Dimension_model->create($data) == TRUE)
                    $data['Json'] = $this->Dimension_model->detail();
                else
                    throw new Exception("Ocurrio un error en la base de datos");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function eliminardimension() {
        try {
            $this->load->model('Dimension_model');
            $respuesta = $this->Dimension_model->delete($this->input->post('id'));
            if ($respuesta == FALSE)
                throw new Exception("Ocurrio un problema en la base de datos");
            $data['Json'] = $respuesta;
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function actualizardimension() {
        $this->load->model('Dimension_model');
    }

    function empresa() {
        $this->data['title'] = "Empresa";
        $this->data['subtitle'] = "Datos";
        $this->load->model(array("Empresa_model", 'Tamano_empresa_model', 'Ingreso_model', 'Actividadeconomica_model'));
        $this->data['mensaje'] = "";
        if ($this->session->guardadoexito == "guardado con exito") {
            $this->data['mensaje'] = "guardado con exito";
            $this->session->guardadoexito = "xyz";
        }
        $this->data['ciudad'] = $this->Ingreso_model->ciudades();
        $this->data['sector'] = $this->Ingreso_model->sectorEconomico();
        $this->data['tamano'] = $this->Tamano_empresa_model->detail();
        $this->data['informacion'] = $this->Empresa_model->detail();
        $this->data['actividadeconomica'] = $this->Actividadeconomica_model->detail();
        $this->layout->view("administrativo/empresa", $this->data);
    }

    function guardarempresa() {


        try {
            $this->load->model("Empresa_model");
            if (isset($_FILES['userfile']['name']))
                if (!empty($_FILES['userfile']['name']))
                    $this->db->set("emp_logo", basename($_FILES['userfile']['name']));
            $data[] = array(
                "emp_razonSocial" => $this->input->post("razonsocial"),
                "emp_nit" => $this->input->post("nit"),
                "emp_direccion" => $this->input->post("direccion"),
                "ciu_id" => $this->input->post("ciudad"),
                "tam_id" => $this->input->post("tamano"),
                "numEmp_id" => $this->input->post("empleados"),
                "actEco_id" => $this->input->post("actividadeconomica"),
                "Dim_id" => $this->input->post("dimension1"),
                "Dimdos_id" => $this->input->post("dimension2"),
                "emp_representante" => $this->input->post("representante"),
                "emp_arl" => $this->input->post("arl"),
                "secEco_id" => $this->input->post("sector")
//            "emp_logo"=>$this->input->post("")
            );
            $datos = $this->Empresa_model->detail();
            if (count($datos) == 0)
                $dd = $this->Empresa_model->create($data);
            else
                $dd = $this->Empresa_model->update($data[0]);

            $targetPath = "./uploads/empresa";
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }
            $targetPath = "./uploads/empresa/" . $dd[0]->emp_id;
            if (!file_exists($targetPath)) {
                mkdir($targetPath, 0777, true);
            }

            $target_path = $targetPath . '/' . basename($_FILES['userfile']['name']);
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) {
                
            }

            $this->session->guardadoexito = "guardado con exito";

            redirect('index.php/administrativo/empresa', 'location');
        } catch (exception $e) {
            redirect('index.php/administrativo/empresa', 'location');
        }
    }

    function autocompletar() {
        $info = auto("user", "usu_id", "usu_nombre", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompletarIncapacidadReferencia() {
        $info = auto("incapacidad_referencia", "incRef_cod", "incRef_nombre", $this->input->get('term'), 10);
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompletaruapellido() {
        $info = auto("user", "usu_id", "usu_apellido", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompletaruacedula() {
        $info = auto("user", "usu_id", "usu_cedula", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompletarcedula() {
        $info = auto("empleado", "Emp_Id", "Emp_Cedula", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompletarnombre() {
        $info = auto("empleado", "Emp_Id", "Emp_Nombre", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function autocompletarapellido() {
        $info = auto("empleado", "Emp_Id", "Emp_Apellido", $this->input->get('term'));
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    function riesgo() {
        if ($this->consultaacceso($this->data["usu_id"])) {
            $this->layout->view("administrativo/riesgo");
        }
    }

    function clasificacionriesgo() {
        if ($this->consultaacceso($this->data["usu_id"])) {
            $this->layout->view("administrativo/clasificacionriesgo");
        }
    }

    function importar_empleados() {
        $this->layout->view("administrativo/importar_empleados");
    }

    public function subir_archivo() {
        ini_set('MAX_EXECUTION_TIME', -1);
        ini_set('memory_limit', -1);
        $this->load->model("Empleado_model");
        $uploaddir = './uploads';
        if (isset($_FILES['file'])) {
            $uploadfile = $uploaddir . '/' . basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $datos['archivo'] = "El archivo es válido y fue cargado exitosamente.\n";
            } else {
                echo "<br>-¡Error en el cargue del archivo!\n";
                die();
            }
        } else {
            echo "<br>-¡Error en el cargue del archivo !\n";
            die();
        }


        $excel = PHPExcel_IOFactory::load($uploadfile)->setActiveSheetIndex(0);
        $lastRow = $excel->getHighestRow();
        $creados = 0;
        $actulizados = 0;
        $registros = 0;
        $incosistencias = "";
        for ($row = 10; $row <= $lastRow; $row++) {
            $registros++;
            $info = array();
            $info['Emp_Cedula'] = $excel->getCell('A' . $row)->getValue();
            $info['Emp_Nombre'] = $excel->getCell('B' . $row)->getValue();
            $info['Emp_Apellidos'] = $excel->getCell('C' . $row)->getValue();
            $info['sex_Id'] = $excel->getCell('D' . $row)->getValue();
            $info['Emp_FechaNacimiento'] = $excel->getCell('E' . $row)->getValue();
            if (!empty($info['Emp_FechaNacimiento'])) {
                $info['Emp_FechaNacimiento'] = date('Y-m-d H:i:s', ($excel->getCell('E' . $row)->getValue() - 25569 - 0.08333) * 86400);
            }
            $info['Emp_Estatura'] = $excel->getCell('F' . $row)->getValue();
            $info['Emp_Peso'] = $excel->getCell('G' . $row)->getValue();
            $info['Emp_Telefono'] = $excel->getCell('H' . $row)->getValue();
            $info['Emp_Direccion'] = $excel->getCell('I' . $row)->getValue();
            $info['Emp_TelefonoContacto'] = $excel->getCell('J' . $row)->getValue();
            $info['Emp_Email'] = $excel->getCell('K' . $row)->getValue();
            $info['EstCiv_id'] = $excel->getCell('L' . $row)->getValue();
            if (($excel->getCell('M' . $row)->getValue()) != '')
                $info['TipCon_Id'] = $this->Empleado_model->buscar_tipo_contrato($excel->getCell('M' . $row)->getValue());
            $info['Emp_FechaInicioContrato'] = $excel->getCell('N' . $row)->getValue();
            if (!empty($info['Emp_FechaInicioContrato'])) {
                $info['Emp_FechaInicioContrato'] = date('Y-m-d H:i:s', ($excel->getCell('N' . $row)->getValue() - 25569 - 0.08333) * 86400);
            }
            $info['Emp_FechaFinContrato'] = $excel->getCell('O' . $row)->getValue();
            if (!empty($info['Emp_FechaFinContrato'])) {
                $info['Emp_FechaFinContrato'] = date('Y-m-d H:i:s', ($excel->getCell('O' . $row)->getValue() - 25569 - 0.08333) * 86400);
            }
            $info['Emp_PlanObligatorioSalud'] = $excel->getCell('P' . $row)->getValue();
            $info['Emp_FechaAfiliacionArl'] = $excel->getCell('Q' . $row)->getValue();
            if (!empty($info['Emp_FechaAfiliacionArl'])) {
                $info['Emp_FechaAfiliacionArl'] = date('Y-m-d H:i:s', ($excel->getCell('Q' . $row)->getValue() - 25569 - 0.08333) * 86400);
            }
            if (($excel->getCell('R' . $row)->getValue()) != '')
                $info['TipAse_Id'] = $this->Empleado_model->buscar_tipo_aseguradora($excel->getCell('R' . $row)->getValue());
            if (($excel->getCell('S' . $row)->getValue()) != '')
                $info['Ase_Id'] = $this->Empleado_model->buscar_aseguradora($excel->getCell('S' . $row)->getValue(), $info['TipAse_Id']);
            if (($excel->getCell('T' . $row)->getValue()) != '')
                $info['Dim_id'] = $this->Empleado_model->buscar_dimencion1($excel->getCell('T' . $row)->getValue());
            if (($excel->getCell('U' . $row)->getValue()) != '')
                $info['Dim_IdDos'] = $this->Empleado_model->buscar_dimencion2($excel->getCell('U' . $row)->getValue());
            if (($excel->getCell('V' . $row)->getValue()) != '')
                $info['Car_id'] = $this->Empleado_model->cargo($excel->getCell('V' . $row)->getValue());
            if (!empty($info['Car_id'])) {
                if (($excel->getCell('W' . $row)->getValue()) != '')
                    $info['TipDoc_id'] = $this->Empleado_model->tipo_documento($excel->getCell('W' . $row)->getValue());
                $info['Est_id'] = $excel->getCell('X' . $row)->getValue();
                $info['emp_fondo'] = $excel->getCell('Y' . $row)->getValue();
                $info['Emp_contacto'] = $excel->getCell('Z' . $row)->getValue();

                $this->db->select('Emp_Id');
                $this->db->where('Emp_Cedula', $info['Emp_Cedula']);
                $datos = $this->db->get('empleado');
                $datos = $datos->result();
                if (count($datos)) {
                    $this->db->where('Emp_Cedula', $info['Emp_Cedula']);
                    $this->db->update('empleado', $info);
                    $actulizados++;
                } else {
                    $this->db->insert('empleado', $info);
                    $creados++;
                }
            } else {
                $incosistencias.='<br> Cargo no encontrado para la cedula: ' . $info['Emp_Cedula'];
            }
        }
        echo "<p><br>Numero de registros: " . $registros;
        echo "<br>Registros actualizados : " . $actulizados;
        echo "<br>Registros Creados : " . $creados;
        if (!empty($incosistencias)) {
            echo "<br>Datos con errores : " . $incosistencias;
        }
    }

    function accidente() {

        $idAccidente = $this->input->post("accidente");

        $this->load->model(array('Tipoevento_model'
            , 'Claseevento_model'
            , 'Partescuerpo_model'
            , 'Riesgoclasificacion_model'
            , 'Empleado_model'
            , 'Dimension2_model'
            , 'Dimension_model'
            , "Empresa_model"
            , "Empleadoresponsable_model"
            , 'Riesgoclasificacion_model'
            , "Accidentes_model"));

        $this->data["tipo_eventos"] = $this->Tipoevento_model->detail();
        $this->data["clases_eventos"] = $this->Claseevento_model->detail();
        $this->data["partes_del_cuerpo"] = $this->Partescuerpo_model->detail();
        $this->data["tipo_riesgos"] = $this->Riesgoclasificacion_model->detail();
        $this->data["empleados"] = $this->Empleado_model->detail_order();
        $this->data['dimension'] = $this->Dimension_model->detail();
        $this->data['dimension2'] = $this->Dimension2_model->detail();
        $this->data['empresa'] = $this->Empresa_model->detail()[0];
        $this->data['responsables'] = $this->Empleadoresponsable_model->detail();

        if (!empty($idAccidente)) {
            $rieClaTip = array();
            $resultadoAccidentes = $this->Accidentes_model->detailAccidente($idAccidente);
//            print_y($resultadoAccidentes);
            foreach ($resultadoAccidentes as $resultadoAccidente) {
                $this->data["accidente"]["datos"]["id"] = $resultadoAccidente->id;
                $this->data["accidente"]["datos"]["empleado"] = $resultadoAccidente->empleado;
                $this->data["accidente"]["datos"]["acc_lugar_incidente"] = $resultadoAccidente->acc_lugar_incidente;
                $this->data["accidente"]["datos"]["lugar"] = $resultadoAccidente->lugar;
                $this->data["accidente"]["datos"]["dimension1"] = $resultadoAccidente->dimension1;
                $this->data["accidente"]["datos"]["dimension2"] = $resultadoAccidente->dimension2;
                $this->data["accidente"]["datos"]["zona"] = $resultadoAccidente->zona;
                $this->data["accidente"]["datos"]["jefeInmediato"] = $resultadoAccidente->jefeInmediato;
                $this->data["accidente"]["datos"]["tipoEvento"] = $resultadoAccidente->tipoEvento;
                $this->data["accidente"]["datos"]["lugarAccidente"] = $resultadoAccidente->lugarAccidente;
                $this->data["accidente"]["datos"]["fechaAccidente"] = explode(" ", $resultadoAccidente->fechaAccidente);
                $this->data["accidente"]["datos"]["descripcion"] = $resultadoAccidente->descripcion;
                $this->data["accidente"]["datos"]["reportado"] = $resultadoAccidente->reportado;
                $this->data["accidente"]["incapacidad"]["fInicial"] = $resultadoAccidente->fechaInicio;
                $this->data["accidente"]["incapacidad"]["fFinal"] = $resultadoAccidente->fechaFinal;
                $this->data["accidente"]["incapacidad"]["responsable"] = $resultadoAccidente->responsable;
                $this->data["accidente"]["tipEve"][$resultadoAccidente->accidenteEvento] = $resultadoAccidente->claseEvento;
                $this->data["accidente"]["parCUe"][$resultadoAccidente->accidenteParte] = $resultadoAccidente->parteCuerpo;
                $this->data["accidente"]["correo"][$resultadoAccidente->accidenteCorreo] = $resultadoAccidente->correo;
                $this->data["accidente"]["rieClasificacion"][$resultadoAccidente->accidenteRiesgoCla] = $resultadoAccidente->riesgoCla;
                $this->data["accidente"]["rieClasificacionTipo"][$resultadoAccidente->accidenteRiesgoClaTip] = $resultadoAccidente->RiesgoClaTip;
                array_push($rieClaTip, $resultadoAccidente->riesgoCla);
            }
            $rieClaTip = array_unique($rieClaTip);
            $rieClasificaciones = $this->Riesgoclasificacion_model->detailandtipo_categoria_batch($rieClaTip);
            foreach ($rieClasificaciones as $rieClasificacion) {
                $this->data["rieClasificaciones"][$rieClasificacion->clasificacion]["tipo"][$rieClasificacion->clasificacion_id] = $rieClasificacion->tipo;
                $this->data["rieClasificaciones"][$rieClasificacion->clasificacion]["categoria"] = $rieClasificacion->categoria;
            }
        }
        $this->layout->view("administrativo/accidente", $this->data);
    }

    function guardarAccidente() {
        try {

            $this->load->model(array("Accidentes_model"
                , "Accidentesclaseevento_model"
                , "Accidentespartescuerpo_model"
                , "Accidentesriesgoclasificacion_model"
                , "Accidentesriesgoclasificaciontipo_model"
                , "Empleadoincapacidad_model"
                , "Accidentescorreo_model"));

            $empleado = $this->input->post("empleado");

            $accdente = array(
                "emp_id" => $empleado
                , "acc_lugar" => $this->input->post("lugar")
                , "dim1_id" => $this->input->post("dimension1")
                , "dim2_id" => $this->input->post("dimension2")
                , "acc_zona" => $this->input->post("zona")
                , "acc_jefeInmediato" => $this->input->post("jefe")
                , "tipEve_id" => $this->input->post("tipo")
                , "acc_lugar_incidente" => $this->input->post("lugar_asociado")
                , "acc_lugarAccidente" => $this->input->post("sitio")
                , "acc_fechaAccidente" => $this->input->post("accidenteFecha") . " " . $this->input->post("accidenteHora")
                , "acc_descripcion" => $this->input->post("descripcion")
                , "acc_reportado" => $this->input->post("accidenteReportado")
                , "creatorUser" => $this->data["usu_id"]
                , "creationDate" => date("Y-m-d H:i:s")
            );
            $id = $this->Accidentes_model->insert($accdente);
            if ($id != FALSE) {
                $agregarEvento = array();
                $agregarParte = array();
                $agregarTipo = array();
                $agregarCorreo = array();
                $verificacion = array();
                $data['message'] = array();

                $claseEventos = $this->input->post("claseEventos");
                if (isset($claseEventos)) {
                    foreach ($claseEventos as $claseEvento)
                        array_push($agregarEvento, array("acc_id" => $id, "claEve_id" => $claseEvento));
                    $verificacion[] = $this->Accidentesclaseevento_model->insert($agregarEvento);
                }

                $correo = $this->input->post("correo");
                if (isset($correo)) {
                    foreach ($correo as $c)
                        array_push($agregarCorreo, array("acc_id" => $id, "accCor_correo" => $c));
                    $verificacion[] = $this->Accidentescorreo_model->insert($agregarCorreo);
                }

                $parteCuerpo = $this->input->post("parteCuerpo");
                if (isset($parteCuerpo)) {
                    foreach ($parteCuerpo as $pc)
                        array_push($agregarParte, array("acc_id" => $id, "parCue_id" => $pc));
                    $verificacion[] = $this->Accidentespartescuerpo_model->insert($agregarParte);
                }

                $tipoRiesgo = $this->input->post("tipoRiesgo");
                if (isset($tipoRiesgo)) {
                    foreach ($tipoRiesgo as $tr) {
                        $idriesgo = $this->Accidentesriesgoclasificacion_model->insert(array("acc_id" => $id, "rieCla_id" => $tr));

                        if ($idriesgo != FALSE) {
                            $dato = $this->input->post();
                            foreach ($dato as $name => $val) {
                                $valores = array();
                                $variable = explode("/", $name);
                                if ($variable[0] == "dato") {
                                    if ($variable[1] == $tr) {
                                        foreach ($val as $index => $tipo_id)
                                            $valores[] = array("accRieCla_id" => $idriesgo, "rieClaTip_id" => $tipo_id);
                                        $resultadoTipo = $this->Accidentesriesgoclasificaciontipo_model->insert($valores);
                                        if ($resultadoTipo == False) {
                                            $data["Error"] = "Error Insertando tipo Riesgo";
                                        }
                                    }
                                }
                            }
                        } else {
                            $verificacion[] = FALSE;
                        }
                    }
                }

                $responsable = $this->input->post("responsable");
                $fInicio = $this->input->post("fechaInicioIncapacidad");
                $fFin = $this->input->post("fechaFinIncapacidad");

                if (isset($responsable) && isset($fInicio) && isset($fFin)) {
                    $incapacidad = array(
                        "empRes_id" => $responsable
                        , "empInc_fechaInicio" => $fInicio
                        , "empInc_fechaFinal" => $fFin
                        , "empInc_motivo" => "Accidente"
                        , "usu_id" => $this->data["usu_id"]
                        , "emp_id" => $empleado
                        , "empInc_fechaIngreso" => date("Y-m-d H:i:s")
                    );
                    $this->Empleadoincapacidad_model->create($incapacidad);
                }

                $i = 0;
                $indiceError = ["Eventos", "Cuerpo", "Riesgo", "Correo"];
                print_r($verificacion);
                die;
                foreach ($verificacion as $veri) {
                    if ($veri === false) {
                        array_push($data['message'], "Error en -> " . $indiceError[$i] . "");
                    }
                    $i++;
                }
                if (count($data['message']) == 0) {
                    array_push($data['message'], "SUCCESS");
                }
            } else {
                throw new Exception("Error por favor comunicarse con el administrador");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function editarAccidente() {
        try {

            $this->load->model(array("Accidentes_model"
                , "Accidentesclaseevento_model"
                , "Accidentespartescuerpo_model"
                , "Accidentesriesgoclasificacion_model"
                , "Accidentesriesgoclasificaciontipo_model"
                , "Empleadoincapacidad_model"
                , "Accidentescorreo_model"));

            $empleado = $this->input->post("empleado");

            $idAccidente = $this->db->post("registro");

            $accdente = array(
                "emp_id" => $empleado
                , "acc_lugar" => $this->input->post("lugar")
                , "dim1_id" => $this->input->post("dimension1")
                , "dim2_id" => $this->input->post("dimension2")
                , "acc_zona" => $this->input->post("zona")
                , "acc_jefeInmediato" => $this->input->post("jefe")
                , "tipEve_id" => $this->input->post("tipo")
                , "acc_lugar_incidente" => $this->input->post("lugar_asociado")
                , "acc_lugarAccidente" => $this->input->post("sitio")
                , "acc_fechaAccidente" => $this->input->post("accidenteFecha") . " " . $this->input->post("accidenteHora")
                , "acc_descripcion" => $this->input->post("descripcion")
                , "acc_reportado" => $this->input->post("accidenteReportado")
                , "modificationUser" => $this->data["usu_id"]
                , "modificationDate" => date("Y-m-d H:i:s")
            );
            $id = $this->Accidentes_model->update($accdente, $idAccidente);

            if ($id != FALSE) {
                $agregarEvento = array();
                $agregarParte = array();
                $agregarTipo = array();
                $agregarCorreo = array();
                $verificacion = array();
                $data['message'] = array();

                $claseEventos = $this->input->post("claseEventos");
                if (isset($claseEventos)) {
                    foreach ($claseEventos as $claseEvento)
                        array_push($agregarEvento, array("acc_id" => $id, "claEve_id" => $claseEvento));
                    $verificacion[] = $this->Accidentesclaseevento_model->updateAccidente($agregarEvento, $id);
                }

                $correo = $this->input->post("correo");
                if (isset($correo)) {
                    foreach ($correo as $c)
                        array_push($agregarCorreo, array("acc_id" => $id, "accCor_correo" => $c));
                    $verificacion[] = $this->Accidentescorreo_model->insert($agregarCorreo);
                }

                $parteCuerpo = $this->input->post("parteCuerpo");
                if (isset($parteCuerpo)) {
                    foreach ($parteCuerpo as $pc)
                        array_push($agregarParte, array("acc_id" => $id, "parCue_id" => $pc));
                    $verificacion[] = $this->Accidentespartescuerpo_model->insert($agregarParte);
                }

                $tipoRiesgo = $this->input->post("tipoRiesgo");
                if (isset($tipoRiesgo)) {
                    foreach ($tipoRiesgo as $tr) {
                        $idriesgo = $this->Accidentesriesgoclasificacion_model->insert(array("acc_id" => $id, "rieCla_id" => $tr));

                        if ($idriesgo != FALSE) {
                            $dato = $this->input->post();
                            foreach ($dato as $name => $val) {
                                $valores = array();
                                $variable = explode("/", $name);
                                if ($variable[0] == "dato") {
                                    if ($variable[1] == $tr) {
                                        foreach ($val as $index => $tipo_id)
                                            $valores[] = array("accRieCla_id" => $idriesgo, "rieClaTip_id" => $tipo_id);
                                        $resultadoTipo = $this->Accidentesriesgoclasificaciontipo_model->insert($valores);
                                        if ($resultadoTipo == False) {
                                            $data["Error"] = "Error Insertando tipo Riesgo";
                                        }
                                    }
                                }
                            }
                        } else {
                            $verificacion[] = FALSE;
                        }
                    }
                }

                $responsable = $this->input->post("responsable");
                $fInicio = $this->input->post("fechaInicioIncapacidad");
                $fFin = $this->input->post("fechaFinIncapacidad");

                if (isset($responsable) && isset($fInicio) && isset($fFin)) {
                    $incapacidad = array(
                        "empRes_id" => $responsable
                        , "empInc_fechaInicio" => $fInicio
                        , "empInc_fechaFinal" => $fFin
                        , "empInc_motivo" => "Accidente"
                        , "usu_id" => $this->data["usu_id"]
                        , "emp_id" => $empleado
                        , "empInc_fechaIngreso" => date("Y-m-d H:i:s")
                    );
                    $this->Empleadoincapacidad_model->create($incapacidad);
                }

                $i = 0;
                $indiceError = ["Eventos", "Cuerpo", "Riesgo", "Correo"];
                print_r($verificacion);
                die;
                foreach ($verificacion as $veri) {
                    if ($veri === false) {
                        array_push($data['message'], "Error en -> " . $indiceError[$i] . "");
                    }
                    $i++;
                }
                if (count($data['message']) == 0) {
                    array_push($data['message'], "SUCCESS");
                }
            } else {
                throw new Exception("Error por favor comunicarse con el administrador");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function horasextras() {
        $this->load->model(array('Empleado_model', 'Horaextratipo_model'));
        $this->data['empleados'] = $this->Empleado_model->empleados();
//        var_dump($this->data['empleados']);die;
        $this->data['tipo'] = $this->Horaextratipo_model->tipos();
        $this->layout->view("administrativo/horasextras", $this->data);
    }

    function elementos_proteccion() {
        $this->load->model(array('Empleado_model', 'Horaextratipo_model'));
        $this->data['empleados'] = $this->Empleado_model->detail();
        $this->layout->view("administrativo/elementos_proteccion", $this->data);
    }

    function consultaClasificacion() {
        try {
            $this->load->model(array("Riesgoclasificacion_model"));
            $data = $this->Riesgoclasificacion_model->detailandtipo_categoria($this->input->post("riesgo"));
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function listadoaccidente() {
        try {
            $this->load->model(array('Empleado_model'
                , 'Dimension2_model'
                , 'Dimension_model'
                , "Empresa_model"));

            $this->data["empleados"] = $this->Empleado_model->detail_order();
            $this->data['dimension1'] = $this->Dimension_model->detail();
            $this->data['dimension2'] = $this->Dimension2_model->detail();
            $this->data['empresa'] = $this->Empresa_model->detail()[0];

            $this->layout->view("administrativo/listadoaccidente", $this->data);
        } catch (Exeption $e) {
            
        } finally {
            
        }
    }

    function filtroaccidente() {
        try {
            $this->load->model(array("Accidentes_model"));

            $reporte = $this->input->post('reporte');
            $empleado = $this->input->post('empleado');
            $dim1 = $this->input->post('dimension1');
            $dim2 = $this->input->post('dimension2');
            $zona = $this->input->post('zona');
            $lugar = $this->input->post('lugar');
            $fInicial = $this->input->post('fInicial');
            $fFinal = $this->input->post('fFinal');
            $Creacion = $this->input->post('fCreacion');
            $incapacidad = $this->input->post('incapacidad');

            $data['Json'] = $this->Accidentes_model->filtroaccidente($reporte, $empleado, $dim1, $dim2, $zona, $lugar, $fInicial, $fFinal, $Creacion, $incapacidad);
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function capacitacion() {
        try {
            $this->load->model(array("Empleado_model"));
            $this->data["empleados"] = $this->Empleado_model->empleados();
            $this->layout->view("administrativo/capacitacion", $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function guardarCapacitaciones() {
        $this->load->model(array("Capacitaciones_model", "Empleadocapacitacion_model"));
        $responsable = array(
            "emp_id_responsable" => $this->input->post("responsable"),
            "cap_fechaCapacitacion" => $this->input->post("fechaCapacitacion"),
            "cap_observacion" => $this->input->post("observacion"),
            "cap_nombreCapacitacion" => $this->input->post("nombre")
        );
        $id = $this->Capacitaciones_model->guardarCapacitacion($responsable);
        $guardarEmpleados = array();
        $empleados = $this->input->post("empleado");
        for ($i = 0; $i < count($empleados); $i++) {
            $guardarEmpleados[] = array(
                "emp_id" => $empleados[$i],
                "cap_id" => $id
            );
        }
        $this->Empleadocapacitacion_model->guardar($guardarEmpleados);
    }

    function guardar_admin_inicio() {
        try {
            $this->load->model(array("administracion_model", "Empleadocapacitacion_model"));
            $post = $this->input->post();
            $this->administracion_model->guardar_admin_inicio($post);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function administracion() {
        try {
            $this->load->model(array("administracion_model", "Empleadocapacitacion_model"));
            $this->data['inicio'] = $this->administracion_model->admin_inicio();
            $this->layout->view('administrativo/inicio', $this->data);
        } catch (exception $e) {
            
        } finally {
            
        }
    }
    function eliminarAccidente() {
        try {
            $this->load->model(array("Accidentes_model"));
            $this->Accidentes_model->eliminarAccidente();
        } catch (exception $e) {
            
        } finally {
            
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */