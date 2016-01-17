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
class Indicador extends My_Controller {

    function __construct() {
        parent::__construct();
    }

    function nuevoindicador() {
        $this->load->model(array('Estados_model'
            ,'Cargo_model'
            ,'Empleado_model'
            ,'Dimension2_model'
            ,'Dimension_model'
            ,'Tipo_model'
            ,'Empresa_model'
            ,'Indicador_model'
            ,"Indicadortipo_model"
            ,"Planes_model"
            ));
        $this->data['indicadortipo'] = $this->Indicadortipo_model->detail();
        $this->data['empresa'] = $this->Empresa_model->detail();
        if (!empty($this->data['empresa'][0]->Dim_id) && !empty($this->data['empresa'][0]->Dimdos_id)) {
            $this->data['tipo'] = $this->Tipo_model->detail();
            $this->data['estados'] = $this->Estados_model->detail();
            $this->data['cargo'] = $this->Cargo_model->allcargos();
            $this->data['dimension'] = $this->Dimension_model->detail();
            $this->data['dimension2'] = $this->Dimension2_model->detail();
            if (!empty($this->input->post("ind_id"))) {
                $this->data['todo_izq'] = $this->Indicador_model->min_id();
                $this->db->where('ind_id <', $this->input->post('ind_id'));
                $this->data['izq'] = $this->Indicador_model->max_id();
                if (empty($this->data['izq'])) {
                    $this->data['izq'] = $this->data['todo_izq'];
                }
                $this->db->where('ind_id >', $this->input->post('ind_id'));
                $this->data['derecha'] = $this->Indicador_model->select_id();
                $this->data['max_der'] = $this->Indicador_model->max_id();

                if (empty($this->data['derecha'])) {
                    $this->data['derecha'] = $this->data['max_der'];
                }
                $this->load->model("Indicadorvalores_model");
                $this->load->model("Indicadorcarpeta_model");
                $this->load->model("Registrocarpeta_model");
                $this->data['registrocarpeta'] = $this->Registrocarpeta_model->detailxindicador($this->input->post("ind_id"));
                
                $carpeta = $this->Registrocarpeta_model->consultaIndicadoryRegistroxInd($this->input->post("ind_id"));
//                var_dump($carpeta);die;
                $i = array();
                foreach ($carpeta as $c) {
                    $i[$c->regCar_id][$c->regCar_nombre . " - " . $c->regCar_descripcion][] = array(
                                $c->reg_tamano
                                , $c->reg_version
                                , $c->reg_descripcion
                                , $c->reg_ruta.'/'.$c->reg_id.'/'.$c->reg_archivo
                                , $c->reg_archivo
                                , $c->reg_fechaCreacion
                                , $c->usu_nombre . " " . $c->usu_apellido
                                , $c->reg_id
                    );
                }
                $this->data['carpeta'] = $i;
                $this->data['valores'] = $this->Indicadorvalores_model->consultaIndicadorxId($this->input->post("ind_id"));
                $this->data["ind_id"] = $this->input->post("ind_id");
                $this->data["indicador"] = $this->Indicador_model->detailxid($this->input->post("ind_id"))[0];
                $this->data["empleado"] = $this->Empleado_model->empleadoxcargo($this->data["indicador"]->car_id);
            }
            $this->layout->view("indicador/nuevoindicador", $this->data);
        } else {
            redirect('index.php/administrativo/empresa', 'location');
        }
    }
//    function graficaindicador(){
//         $this->load->model("Indicadorvalores_model");
//         $this->data['valores'] = $this->Indicadorvalores_model->consultaIndicadorxId(9);
//         $this->output->set_content_type('application/json')->set_output(json_encode($campos));
//        
//    }
    function verindicadores() {
        $this->load->model(array('Indicadortipo_model','Dimension2_model','Dimension_model','Empresa_model'));
        $this->data['empresa'] = $this->Empresa_model->detail();
        if (!empty($this->data['empresa'][0]->Dim_id) && !empty($this->data['empresa'][0]->Dimdos_id)) {
            $this->data['dimension'] = $this->Dimension_model->detail();
            $this->data['dimension2'] = $this->Dimension2_model->detail();
            $this->data['tipo'] = $this->Indicadortipo_model->detail();
            $this->layout->view("indicador/verindicadores", $this->data);
        } else {
            redirect('index.php/administrativo/empresa', 'location');
        }
    }

    function guardarindicador() {
        try {
            $this->load->model("Indicador_model");
            $data = array(
                "ind_indicador" => $this->input->post("indicador"),
                "indTip_id" => $this->input->post("tipo"),
                "ind_mide" => $this->input->post("mide"),
                "dim_id" => $this->input->post("dimensionuno"),
                "dimdos_id" => $this->input->post("dimensiondos"),
                "ind_frecuencia" => $this->input->post("frecuencia"),
                "car_id" => $this->input->post("cargo"),
                "emp_id" => $this->input->post("nombreempleado"),
                "ind_minimo" => $this->input->post("minimo"),
                "ind_maximo" => $this->input->post("maximo"),
                "est_id" => $this->input->post("estado"),
                "ind_objetivo" => $this->input->post("objetivo"),
                "ind_fecha" => $this->input->post("fecha"),
                "ind_observaciones" => $this->input->post("observaciones"),
                "ind_fechaCreacion" => date('Y-m-d H:i:s'),
                "userCreator" => $this->data["usu_id"]
            );
            $id = $this->Indicador_model->create($data);
            echo $id;
        } catch (exception $e) {
            
        }
    }

    function actualizarindicador() {
        $this->load->model("Indicador_model");
        $data = array(
            "ind_indicador" => $this->input->post("indicador"),
            "indTip_id" => $this->input->post("tipo"),
            "ind_mide" => $this->input->post("mide"),
            "dim_id" => $this->input->post("dimensionuno"),
            "dimdos_id" => $this->input->post("dimensiondos"),
            "ind_frecuencia" => $this->input->post("frecuencia"),
            "car_id" => $this->input->post("cargo"),
            "emp_id" => $this->input->post("nombreempleado"),
            "ind_minimo" => $this->input->post("minimo"),
            "ind_maximo" => $this->input->post("maximo"),
            "est_id" => $this->input->post("estado"),
            "ind_objetivo" => $this->input->post("objetivo"),
            "ind_observaciones" => $this->input->post("observaciones"),
            "ind_meta" => $this->input->post("meta"),
            "ind_fechaModificacion" => date('Y-m-d H:i:s')
        );
        $this->Indicador_model->actualizar($this->input->post("ind_id"), $data);
    }

    function consultaIndicadorFlechas() {
        try {
            $this->load->model(array("Indicador_model",'Empleado_model'));
            $idIndicador = $this->input->post("idIndicador");
            $metodo = $this->input->post("metodo");
            $campos["campos"] = $this->Indicador_model->consultaIndicadorFlechas($idIndicador, $metodo)[0];
            if (!empty($campos)) {
                $data["empleado"] = $this->Empleado_model->empleadoxcargo($campos["campos"]->car_id);
                $campos = array_merge($campos, $data);
                $this->output->set_content_type('application/json')->set_output(json_encode($campos));
            } else {
                $this->output->set_content_type('application/json')->set_output("vacio");
            }
        } catch (Exception $e) {
            echo $e;
            die;
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
            $post["ind_id"] = $this->input->post("ind_id");
            //Creamos carpeta con el ID del registro
//            if (isset($_FILES['archivo']['name']))
//                if (!empty($_FILES['archivo']['name']))
//                    $post['tarReg_archivo'] = basename($_FILES['archivo']['name']);
//            $tar_id = $post['tar_id'];
            $targetPath = "./uploads/tareas_registro/";
            //De la carpeta idRegistro, creamos carpeta con el id del empleado
            if (!file_exists($targetPath))
                mkdir($targetPath, 0777, true);
            $targetPath = "./uploads/tareas_registro/" . $post["tar_id"];
            if (!file_exists($targetPath))
                mkdir($targetPath, 0777, true);
            $post['reg_ruta'] = $target_path = $targetPath . '/' . basename($_FILES['archivo']['name']);
            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $target_path)) {
                
            }
            $this->Registro_model->guardar_registro($post);
            $data = $this->Registro_model->registroxcarpeta($this->input->post('regCar_id'));
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } catch (exception $e) {
            
        }
    }
    function eliminar_Indicador() {
        $this->load->model("Indicador_model");
        $this->Indicador_model->eliminar_Indicador($this->input->post());
    }

    function consultarindicador() {
        $this->load->model("Indicador_model");
        $tabla = $this->Indicador_model->search($this->input->post("tipo"), $this->input->post("dimensionUno"), $this->input->post("dimesionDos"));
        $i = array();
        foreach ($tabla as $t) {
            $i["Json"][$t->indTip_id][$t->indTip_tipo][] = array(
                "ind_id" => $t->ind_id,
                "ind_indicador" => $t->ind_indicador,
                "dimuno" => $t->dimuno,
                "dimdos" => $t->dimdos,
                "ind_mide" => $t->ind_mide,
                "ind_frecuencia" => $t->ind_frecuencia,
                "ind_minimo" => $t->ind_minimo,
                "ind_maximo" => $t->ind_maximo,
                "nombre" => $t->nombre
            );
        }
        if (empty($i))
            $i['message'] = "No se encontro Información en el sistema";
        $this->output->set_content_type('application/json')->set_output(json_encode($i));
    }

    function guardarvalores() {
        $this->load->model("Indicadorvalores_model");
        $data = array(
            "indVal_comentario" => $this->input->post("comentarios"),
            "usu_id" => $this->data["usu_id"],
            "indVal_valor" => $this->input->post("valor"),
            "ind_id" => $this->input->post("ind_id"),
            "indVal_fecha" => $this->input->post("fecha"),
            "usu_idcreacion" => $this->data["usu_id"],
            "indVal_unidad" => $this->input->post("unidad"),
            "indVal_fechaCreacion" => date("Y-m-d H:i:s")
        );
        $this->Indicadorvalores_model->guardarvalores($data,$this->input->post("indVal_id"));
        $this->traer_listado();
    }
    function traer_listado(){
        $this->load->model("Indicadorvalores_model");
        $data = $this->Indicadorvalores_model->consultaIndicadorxId($this->input->post("ind_id"));

        $a = array();
        foreach ($data as $key => $value) {
            if (isset($a['fecha']))
                $a['fecha'].= "'" . $value->indVal_fecha . "',";
            else
                $a['fecha'] = "'" . $value->indVal_fecha . "',";
            if (isset($a['valores']))
                $a['valores'].= $value->indVal_valor . ",";
            else
                $a['valores'] = $value->indVal_valor . ",";
        }
        $labels = array('29 April 2015', '30 April 2015', '1 May 2015', '2 May 2015', '3 May 2015', '4 May 2015', '5 May 2015');
        $points = array('100', '250', '10', '35', '73', '0', '25');
//        echo json_encode(array('labels' => $labels, 'points' => $points));

        $this->output->set_content_type('application/json')->set_output(json_encode(array($data, array('labels' => $labels, 'points' => $points))));
    }

    function guardarcarpetatarea() {

        $this->load->model("Registrocarpeta_model");
        $data = array(
            "regCar_nombre" => $this->input->post("nombrecarpeta"),
            "regCar_descripcion" => $this->input->post("descripcioncarpeta"),
            "ind_id" => $this->input->post("ind_id")
        );
        $id = $this->Registrocarpeta_model->guardarCarpeta($data);
        $data = $this->Registrocarpeta_model->consultaCarpetaxIdIndicador($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
    }

    function tipoindicador() {
        $this->load->model("Indicadortipo_model");
        $this->data["tipoindicadores"] = $this->Indicadortipo_model->detail();
        $this->layout->view("indicador/tipoindicador", $this->data);
    }

    function guardarmodificaciontipoindicador() {
        try {
            $this->load->model('Indicadortipo_model');
            $this->Indicadortipo_model->guardarmodificaciondimension(
                    $this->input->post('tipIndTipo'), $this->input->post('tipIndid')
            );
            $data = $this->Indicadortipo_model->tipoIndicadorxId($this->input->post('tipIndid'));
            $this->output->set_content_type('application/json')->set_output(json_encode($data[0]));
        } catch (exception $e) {
            
        }
    }

    function consultaIndicadorxid() {

        $this->load->model('Indicadortipo_model');
        $this->data['tipoIndicador'] = $this->Indicadortipo_model->consultadimensionxid($this->input->post('tipoIndicador'));
        $this->output->set_content_type('application/json')->set_output(json_encode($this->data['tipoIndicador'][0]));
    }

    function eliminarindicador() {
        $this->load->model('Indicadortipo_model');
        $this->Indicadortipo_model->delete($this->input->post('id'));
    }

    function guardarTipoIndicador() {
        $this->load->model('Indicadortipo_model');
        $data[0] = array(
            "indTip_tipo" => $this->input->post('tipoindicador')
        );
        if (empty($this->Indicadortipo_model->consultxname($this->input->post('tipoindicador')))) {
            $this->Indicadortipo_model->create($data);
            $dimension = $this->Indicadortipo_model->detail();
            $this->output->set_content_type('application/json')->set_output(json_encode($dimension));
        } else
            echo 1;
    }
    function eliminar_indicador_valores(){
        $this->load->model('Indicadortipo_model');
        $this->Indicadortipo_model->delete_indicador_valores($this->input->post('indVal_valor'));
        $this->traer_listado();
    }
    function modificar_indicador_valores(){
        $this->load->model('Indicadortipo_model');
        $datos=$this->Indicadortipo_model->modificar_indicador_valores($this->input->post('indVal_valor'));
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */