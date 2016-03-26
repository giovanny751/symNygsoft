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
class Mis_archivos extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('Mis_archivos_model',"Repositoriodocumento_model"));
    }

    function index() {

        $this->data['carpeta'] = $this->Mis_archivos_model->carpetas2();
        $this->data['documentos'] =  $this->Repositoriodocumento_model->documentos();
        $this->layout->view("mis_archivos/index", $this->data);
    }

    function new_folder() {
        try {
            if (empty($this->input->post('nueva_carpeta')))
                throw new Exception("No ha ingresado el nombre de la carpeta");
            $idCarpeta = $this->Mis_archivos_model->new_folder($this->input->post('nueva_carpeta'), $this->input->post('IdCarpetaPadre'));
            if ($idCarpeta == false)
                throw new Exception("Error al crear la carpeta en base de datos");

            $data['Json'] = $this->Mis_archivos_model->carpetaDocumento($this->input->post('IdCarpetaPadre'));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function consultaCarpetaId() {
        try {
            if (empty($this->input->post("archivo")))
                throw new Exception("No existe archivo para editar");
            $data['Json'] = $this->Mis_archivos_model->consultaCarpetaXId($this->input->post("archivo"))[0];
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function eliminarCarpeta() {
        try {
            if (empty($this->input->post("archivo")))
                throw new Exception("No existe archivo para editar");
            $respuesta = $this->Mis_archivos_model->eliminarCarpeta($this->input->post("archivo"));
            if ($respuesta == 1) {
                $data['color'] = 'verde';
                throw new Exception("Carpeta eliminada correctamente");
            } else if ($respuesta == 0) {
                $data['color'] = 'rojo';
                throw new Exception("No se pudo eliminar la carpeta");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function actualizarArchivo() {
        try {
            if (empty($this->input->post('idArchivo')) || empty($this->input->post('nombreArchivo')))
                throw new Exception("No cumple los parametros para actualizar carpeta");

            $respuesta = $this->Mis_archivos_model->actualizarCarpeta($this->input->post('idArchivo'), $this->input->post('nombreArchivo'));
            if ($respuesta == true) {
                $data['Json'] = true;
            } elseif ($respuesta == false) {
                $data['color'] = 'rojo';
                $data['Json'] = false;
                throw new Exception("Error al actualizar comunicarse con el administrador");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function traer_folder() {
        try {
            $data['Json'] = $this->Mis_archivos_model->traer_folder();
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function traer_atras() {
        try {
            $data['Json'] = $this->Mis_archivos_model->traer_atras();
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function subir_archivo() {
        ini_set('MAX_EXECUTION_TIME', -1);
        ini_set('memory_limit', -1);
        $uploaddir = './uploads/cargueArchivos';
        $carpeta = "";
        if(!empty($this->input->post("carpeta")))
            $carpeta = $this->input->post("carpeta");
        
        $this->load->model("Repositoriodocumento_model");
        if (isset($_FILES['file'])) {
            $uploadfile = $uploaddir . '/' . basename($_FILES['file']['name']);
            $nombre = $_FILES['file']['name'];
            $tamano = filesize($_FILES['file']['tmp_name']);
            $fh = fopen($_FILES['file']['tmp_name'], 'r');
            $documento = fread($fh, filesize($_FILES['file']['tmp_name']));
            $documento = addslashes($documento);
            $archivo = array(
                "carDoc_id"=>$carpeta,
                "repDoc_tamano"=>$tamano, 
                "repDoc_extension"=>explode(".", $nombre)[1], 
                "repDoc_nombre"=>$nombre, 
                "repDoc_documento"=>$documento 
            );
            $this->Repositoriodocumento_model->saveFile($archivo);
        } else {
            echo "<br>-¡Error en el cargue del archivo !\n";
            die();
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */