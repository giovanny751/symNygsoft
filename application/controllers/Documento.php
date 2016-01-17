<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documento extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    function documento() {

        $this->layout->view("documento/documento");
    }

    function botiquin() {
        try{
        $this->load->model("Seguridadbotiquin_model");
        $this->load->model("Botiquin_model");
//        $botiquin = $this->Botiquin_model->detail();
        $seguridad = $this->Seguridadbotiquin_model->grupos();
        $i = array();
        foreach ($seguridad as $s):
            $i[$s->segGru_grupo][] = array($s->segGruEle_id, $s->segGru_Elemento);
        endforeach;
        $this->data['seguridad'] = $i;
        $this->load->model(array("Empleado_model"));
        $this->data['empleado'] = $this->Empleado_model->detail();
        $this->layout->view("documentos/botiquin", $this->data);
        }catch(exception $e){
            
        }finally{
            
        }
    }
    
    function guardarBotiquin(){
        
        $this->load->model("Botiquin_model");
        $data = array(
            "creatorUser"=>$this->data["usu_id"],
            "creationDate"=>date("Y-m-d H:i:s"),
            "bot_fechaInspeccion"=>$this->input->post("fecha"),
            "emp_id"=>$this->input->post("empleado"),
            "bot_observacion"=>$this->input->post("observaciones")
        );
        $id = $this->Botiquin_model->save($data);
    }

    function extintores() {
        $this->load->model(array("Empleado_model"));
        $this->data['empleado'] = $this->Empleado_model->detail();
        $this->layout->view("documentos/extintores", $this->data);
    }

    function inspeccionGeneral() {
        $this->load->model(array("Empleado_model", "Riesgoclasificacion_model"));
        $this->data['empleado'] = $this->Empleado_model->detail();
//        var_dump( $this->data['empleado']);die;
        $factores = $this->Riesgoclasificacion_model->elementosXFactores();
        $i = array();
        foreach ($factores as $f) {
            $i[$f->rieCla_id . "/" . $f->rieCla_categoria][$f->rieClaTip_id . "/" . $f->rieClaTip_tipo][] = array($f->rieClaEle_id, $f->rieClaEle_elemento);
        }
        $this->data["factores"] = $i;
        $this->layout->view("documentos/inspecciongeneral", $this->data);
    }

    function guardarInspeccion() {
        try {
            $this->load->model(array("Inspeccionopcion_model", "Inspeccion_model"));
            $inspeccion = array(
                "ins_fecha" => $this->input->post("fecha"),
                "emp_id" => $this->input->post("empleado"),
                "ins_observacion" => $this->input->post("observacionGeneral")
            );
            $id = $this->Inspeccion_model->save($inspeccion);

            $this->load->model("Inspeccionopcion_model");
            $post = $this->input->post();
            $inspeccion = array();

            foreach ($post as $name => $val) {
                if (($name != "observacionGeneral" && $name != "empleado" && $name != "fecha") && explode("/", $name)[1] == "elemento") {
                    $inspeccion[] = array(
                        "rieClaEle_id" => explode("/", $name)[0],
                        "insOpc_opcion" => $val,
                        "ins_id" => $id
                    );
                }
            }
            $batchInscripcion = $this->Inspeccionopcion_model->save($inspeccion);
            if ($batchInscripcion == false)
                throw new Exception("Error al insertar datos");
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            
        }
    }

    function guardarExtintor() {
        try {
            $this->load->model("Extintor_model");
            $informacion = array(
                "ext_numero" => $this->input->post("noextintor"),
                "ext_capacidad" => $this->input->post("capacidad"),
                "ext_clase" => $this->input->post("clase"),
                "ext_agente" => $this->input->post("agente"),
                "ext_fechaPruHidrostatica" => $this->input->post("pruebaHidrostatica"),
                "ext_pintura" => $this->input->post("pintura"),
                "ext_manometro" => $this->input->post("mamometro"),
                "ext_pasador" => $this->input->post("pasador"),
                "ext_manguera" => $this->input->post("manguera"),
                "ext_boquilla" => $this->input->post("boquilla"),
                "ext_envase" => $this->input->post("envase"),
                "ext_soporteColgar" => $this->input->post("soporteColgar"),
                "ext_manija" => $this->input->post("Manija"),
                "ext_satisfactorioFunc" => $this->input->post("estadoSatisfactorio"),
                "ext_corrosion" => $this->input->post("corrosion"),
                "ext_terjetaRegistroOpe" => $this->input->post("tarjetaRegistro"),
                "ext_InstruccionesVisibles" => $this->input->post("ManejoVisible"),
                "ext_senalizado" => $this->input->post("encuentraSenalizado"),
                "ext_acceso" => $this->input->post("acceso"),
                "ext_altura" => $this->input->post("Altura"),
                "ext_visibilidadIdentificacion" => $this->input->post("Visibilidad"),
                "ext_limpieza" => $this->input->post("limpieza"),
                "ext_observaciones" => $this->input->post("observaciones"),
                "emp_id" => $this->input->post("empleado"),
                "creationDate" => date("Y-m-d H:i:s"),
                "creationUser" => $this->data["usu_id"],
                "ext_fechaInspeccion" => $this->input->post("fecha")
            );
            $this->Extintor_model->guardarExtintor($informacion);
        } catch (exception $e) {
            
        } finally {
            
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */