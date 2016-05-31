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
class Presupuesto extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    function presupuestoExamenesMedicos() {

        $this->load->model(array("Parametrosnomina_model", "Presupuestoexamen_model"));
        $this->data['parametros'] = $this->Parametrosnomina_model->detalle();
        $this->data['examenes'] = $this->Presupuestoexamen_model->detalle();


        $this->layout->view("presupuesto/presupuestoExamenesMedicos", $this->data);
    }
    
    function eliminarExamen(){
        try{
            if(empty($this->input->post('preExa_id'))){
                throw new Exception("No hay datos para inactivar");
            }
            
        $this->load->model(array("Presupuestoexamen_model"));   
        
        $this->Presupuestoexamen_model->inactivarExamen($this->input->post('preExa_id'));
            
        }catch(exception $e){
            
        }finally{
            
        }
    }
    
    function guardarExamen(){
        try{
            if(empty($this->input->post())){
                throw new Exception("No existen parametros para guardar en el sistema");
            }
            
            $this->load->model(array("Presupuestoexamenvalor_model", "Presupuestoexamen_model"));
            $idInsertado = $this->Presupuestoexamen_model->guardarExamen($this->input->post());
            $this->Presupuestoexamenvalor_model->guardarValor($idInsertado, $this->input->post('valor'), $this->data['usu_id'], date("Y-m-d H:i:s"));
            
        }catch(exception $e){
            
            
        }finally{
            
        }
    }

    function guardarExamenes() {
        try {
            $this->load->model(array("Presupuestoexamenvalor_model", "Presupuestoexamen_model"));
            if (empty($this->input->post())) {
                throw new Exception('No existen datos para almacenar');
            }

            foreach ($this->input->post() as $key => $val) {
                $this->Presupuestoexamenvalor_model->guardarValor($key, $val, $this->data['usu_id'], date("Y-m-d H:i:s"));
            }
        } catch (exception $e) {
            
        } finally {
            
        }
    }

    function examenesPersonal() {
        $this->load->model(array("","Sexo_model", "Tipoidentificacion_model", "Presupuestoexamen_model", "Tipoexamen_model"));

        $this->data['sexo'] = $this->Sexo_model->detail();
        $this->data['tipoExamen'] = $this->Tipoexamen_model->detail();
        $this->data['tipoIdentificacion'] = $this->Tipoidentificacion_model->detail();
        $this->data['examenes'] = $this->Presupuestoexamen_model->detalle();


        $this->layout->view("presupuesto/examenesPersonal", $this->data);
    }

    function guardarExamenMedico() {
        try {
            if (empty($this->input->post())) {
                $data['color'] = "rojo";
                throw new Exception("No existen datos para guardar");
            }
            $this->load->model(array("Empleadopresupuestoexamen_model", "Empleadopresupuestoexamenvalor_model"));

            $data = array(
                "empPreExa_pertenece" => $this->input->post("pertenece"),
                "tipExa_id" => $this->input->post("examen"),
                "tipIde_id" => $this->input->post("tipoIdentificacion"),
                "empPreExa_nombre" => $this->input->post("nombre"),
                "empPreExa_apellido" => $this->input->post("apellidos"),
                "empPreExa_documento" => $this->input->post("noDocumento"),
                "empPreExa_fechaNacimiento" => $this->input->post("fechaNacimiento"),
                "sex_id" => $this->input->post("sexo"),
                "empPreExa_telefono" => $this->input->post("telefono"),
                "empPreExa_direccion" => $this->input->post("direccion"),
                "empPreExa_correo" => $this->input->post("correo"),
                "pro_id" => $this->input->post('proveedor'),
                "creatorUser" => $this->data['usu_id'],
                "creatorDate" => date("Y-m-d H:i:s")
            );

            $idPresupuesto = $this->Empleadopresupuestoexamen_model->save($data);

            if (!empty($this->input->post('tipoExamen'))) {
                $info = array();
                for ($i = 0; $i < count($this->input->post('tipoExamen')); $i++) {
                    $info[] = array(
                        "empPreExa_id"=>$idPresupuesto,
                        "preExaVal_id"=>$this->input->post('tipoExamen')[$i]
                    );
                }
                $this->Empleadopresupuestoexamenvalor_model->save($info);
            }

        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function examenesRealizados() {
        $this->load->model(array("Sexo_model","Presupuestoexamen_model"));
        $this->data['sexo'] = $this->Sexo_model->detail();
        $this->data['examenes'] = $this->Presupuestoexamen_model->detalle();
        $this->layout->view("presupuesto/examenesAsignados", $this->data);
    }

    function consultaEmpleadoXId() {
        try {
            if (empty($this->input->post())) {
                throw new Exception("No existe empleado a consultar");
            }
            $this->load->model("Empleado_model");

            $respuesta = $this->Empleado_model->datosPrincipalesEmpleado($this->input->post());

            if (empty($respuesta)) {
                throw new Exception("No existe empleado asociado al numero de cedula");
            } else {
                $data['Json'] = $respuesta;
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function consultarExamenesMedicos() {
        try {
            $this->load->model("Empleadopresupuestoexamen_model");

            $resultado = $this->Empleadopresupuestoexamen_model->consultaExamenesEmpleados($this->input->post());

            if (!empty($resultado)) {
                $data['Json'] = $resultado;
            } else {
                throw new Exception("No existe información");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function examenMedico() {
        try {
            if (empty($this->input->post("examenId"))) {
                $data["color"] = "rojo";
                throw new Exception("No existe cargo para consultar");
            }

            $this->load->model(array("Empleadopresupuestoexamen_model"));

            $this->data['examenes'] = $this->Cargo_model->consultacargoxid($this->input->post("car_id"));

            $html = $this->load->view("formatos/examenMedico", $this->data, true);
            pdf($html);
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            
        }
    }

}
