<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehiculo extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Vehiculo_model");
    }

    function index() {
        $this->load->model(array(
            "Tipoidentificacion_model"
            , "Tipovehiculo_model"
            , "Clasevehiculo_model"
            , "Pais_model"
            , "Departamento_model"
            , "Ciudad_model"
            , "Empresa_model"
            , "Dimension_model"
            , "Dimension2_model"
            , "Vehiculo_model"
            , "Tiposervicio_model"
            , "Tipocarroceria_model"
            , "Estados_model"
            , "Vehiculoobservacion_model"
            , "Vehiculopropietario_model"
            , "Sexo_model"
        ));
        $this->data['veh_id'] = "";
        if (!empty($this->input->post('veh_id'))) {
            $this->data['veh_id'] = $this->input->post('veh_id');
            $this->data['vehiculo'] = $this->Vehiculo_model->consultaVehiculoXId($this->input->post('veh_id'));
            $this->data['propietario'] = $this->Vehiculopropietario_model->consultaPropietarioVehiculo($this->input->post('veh_id'));
            $this->data['observacionVehiculo'] = $this->Vehiculoobservacion_model->detail($this->input->post('veh_id'));
        }
        $this->data['estados'] = $this->Estados_model->estadoVehiculos();
        $this->data['empresa'] = $this->Empresa_model->detail();
        $this->data['sexo'] = $this->Sexo_model->detail();
        $this->data["pais"] = $this->Pais_model->detail();
        $this->data["departamento"] = $this->Departamento_model->detail();
        $this->data["ciudad"] = $this->Ciudad_model->detail();
        $this->data['dimension'] = $this->Dimension_model->detail();
        $this->data['dimension2'] = $this->Dimension2_model->detail();
        $this->data["tipoIdentificacion"] = $this->Tipoidentificacion_model->detail();
        $this->data["tipoVehiculo"] = $this->Tipovehiculo_model->detail();
        $this->data["tipoServicio"] = $this->Tiposervicio_model->detail();
        $this->data["tipoCarroceria"] = $this->Tipocarroceria_model->detail();
        $this->data["claseVehiculo"] = $this->Clasevehiculo_model->detail();
        $this->layout->view("vehiculo/index", $this->data);
    }

    function guardarVehiculo() {
        try {
            if (empty($this->input->post())):
                $info['color'] = "amarillo";
                throw new Exception("No existen datos para almacenar");
            endif;

            $info['veh_id'] = $this->Vehiculo_model->save($this->input->post());
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function eliminarObservacion() {
        try {
            if (empty($this->input->post())):
                $info['color'] = "amarillo";
                throw new Exception("No existen datos para eliminar");
            endif;

            $this->load->model("Vehiculoobservacion_model");
            $this->Vehiculoobservacion_model->delete($this->input->post('observacionId'));
            $info = true;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function actualizarVehiculo() {
        try {
            if (empty($this->input->post())):
                $info['color'] = "amarillo";
                throw new Exception("No existen datos para almacenar");
            endif;
            $this->Vehiculo_model->saveEdit($this->input->post());
            $info['veh_id'] = $this->input->post("idVehiculo");
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function guardarPropietario() {
        try {
            if (empty($this->input->post("veh_id"))):
                $info['color'] = "amarillo";
                throw new Exception("No existen vehículo para registro de datos");
            endif;
            $this->load->model("Vehiculopropietario_model");
            $existenciaPropietario = $this->Vehiculopropietario_model->consultaPropietarioVehiculo($this->input->post('veh_id'));
            if (empty($existenciaPropietario)) {
                $this->Vehiculopropietario_model->save($this->input->post());
            } else {
                $this->Vehiculopropietario_model->saveEdit($this->input->post());
            }
            $info = true;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function guardarRtm() {
        try {
            if (empty($this->input->post("veh_id"))):
                $info['color'] = "amarillo";
                throw new Exception("No existen vehículo para registro de datos");
            endif;

            $this->load->model("Vehiculortm_model");
            $this->Vehiculortm_model->save($this->input->post());
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function guardarSoat() {
        try {
            if (empty($this->input->post("veh_id"))):
                $info['color'] = "amarillo";
                throw new Exception("No existen vehículo para registro de datos");
            endif;
            $this->load->model("Vehiculosoat_model");
            $this->Vehiculosoat_model->save($this->input->post());
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function listadoVehiculo() {
        $this->load->model(array(
            "Tipoidentificacion_model"
            , "Tipovehiculo_model"
            , 'Dimension2_model'
            , 'Dimension_model'
            , 'Empresa_model'
            , 'Clasevehiculo_model'
        ));
        $this->data["claseVehiculo"] = $this->Clasevehiculo_model->detail();
        $this->data["tipoIdentificacion"] = $this->Tipoidentificacion_model->detail();
        $this->data["tipoVehiculo"] = $this->Tipovehiculo_model->detail();
        $this->data['dimension'] = $this->Dimension_model->detail();
        $this->data['dimension2'] = $this->Dimension2_model->detail();
        $this->data['empresa'] = $this->Empresa_model->detail();
        $this->layout->view("vehiculo/listadoVehiculo", $this->data);
    }

    function consultaVehiculo() {
        try {
            $vehiculos = $this->Vehiculo_model->consultaDetalle($this->input->post());
            if (!empty($vehiculos)):
                $info['Json'] = $vehiculos;
            else:
                throw new Exception("No existe vehiculos");
            endif;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function consultaTipoVehiculo() {
        try {
            if (empty($this->input->post("clase"))):
                $info['color'] = "rojo";
                throw new Exception("No existe clase para consultar el tipo de vehiculo");
            endif;
            $this->load->model("Tipovehiculo_model");
            $tipoVehiculo = $this->Tipovehiculo_model->detail($this->input->post("clase"));
            if (!empty($tipoVehiculo)):
                $info['Json'] = $tipoVehiculo;
            else:
                $info['color'] = "amarillo";
                throw new Exception("No existen tipos de vehiculos para la clase asociada");
            endif;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function consultaKilometrosVehiculo() {
        try {
            if (empty($this->input->post("veh_id"))):
                $info['color'] = "rojo";
                throw new Exception("No existe vehiculo a consultar");
            endif;
            $this->load->model("Vehiculokilometro_model");
            $kilometro = $this->Vehiculokilometro_model->detail($this->input->post("veh_id"));
            if (!empty($kilometro)):
                $info['Json'] = $kilometro;
            else:
                $info['color'] = "amarillo";
                throw new Exception("No existen kilometros");
            endif;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function guardarKilometro() {
        try {
            if (empty($this->input->post("kilometro")) || empty($this->input->post("veh_id"))):
                $info['color'] = "rojo";
                throw new Exception("No existe kilometros para guardar");
            endif;
            $this->load->model("Vehiculokilometro_model");
            $this->Vehiculokilometro_model->save($this->input->post("kilometro"), $this->input->post("veh_id"));

            $kilometro = $this->Vehiculokilometro_model->detail($this->input->post("veh_id"));
            if (!empty($kilometro)):
                $info['ultimoKilometro'] = $this->Vehiculokilometro_model->ultimoKilometro($this->input->post("veh_id"));
                $info['Json'] = $kilometro;
            else:
                $info['color'] = "amarillo";
                throw new Exception("No existen kilometros");
            endif;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function eliminarKilometraje() {
        try {
            $this->load->model("Vehiculokilometro_model");
            $this->Vehiculokilometro_model->delete($this->input->post("vehKil_id"));

            $kilometro = $this->Vehiculokilometro_model->detail($this->input->post("veh_id"));
            if (!empty($kilometro)):
                $info['Json'] = $kilometro;
            else:
                $info['color'] = "amarillo";
                throw new Exception("No existen kilometros");
            endif;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function consultaDepartamentoXPais() {
        try {
            if (empty($this->input->post("pais"))):
                $info['color'] = "rojo";
                throw new Exception("No existe pais para consultar");
            endif;
            $this->load->model("Departamento_model");
            $pais = $this->Departamento_model->detail($this->input->post("pais"));
            if (!empty($pais)):
                $info['Json'] = $pais;
            else:
                $info['color'] = "amarillo";
                throw new Exception("No existen departamentos asociados al pais");
            endif;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function consultaCiudadXDepartamento() {
        try {
            if (empty($this->input->post("dpto"))):
                $info['color'] = "rojo";
                throw new Exception("No existe pais para consultar");
            endif;
            $this->load->model("Ciudad_model");
            $pais = $this->Ciudad_model->detail($this->input->post("dpto"));
            if (!empty($pais)):
                $info['Json'] = $pais;
            else:
                $info['color'] = "amarillo";
                throw new Exception("No existen ciudades asociadas al departamento");
            endif;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function guardarObservacionesVehiculo() {
        try {
            if (empty($this->input->post())):
                $info['color'] = "rojo";
                throw new Exception("No existe datos para almacenar");
            endif;
            $this->load->model("Vehiculoobservacion_model");
            $this->Vehiculoobservacion_model->save($this->input->post());
            $vehiculo = $this->Vehiculoobservacion_model->detail($this->input->post('vehiculo'));

            if (!empty($vehiculo)):
                $info['Json'] = $vehiculo;
            else:
                $info['color'] = "amarillo";
                throw new Exception("No existen observaciones asociadas al vehículo");
            endif;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

    function eliminarVehiculo() {
        try {
            if (empty($this->input->post())):
                $info['color'] = "rojo";
                throw new Exception("No existe datos para eliminar");
            endif;
            $this->Vehiculo_model->eliminarVehiculo($this->input->post("veh_id"));
            $info = true;
        } catch (exception $e) {
            $info['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($info));
        }
    }

}
