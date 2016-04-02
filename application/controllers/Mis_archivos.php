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
        $this->load->model(array('Mis_archivos_model', "Repositoriodocumento_model"));
    }

    function index() {
        $carpetas = $this->Mis_archivos_model->carpetas2();
//        $carpetas = $this->carpeta($carpetas);
        $this->data['carpetas'] = $carpetas;
        $this->data['documentos'] = $this->Repositoriodocumento_model->documentos();
        $this->layout->view("mis_archivos/index", $this->data);
    }
    public function carpetas_2() {
        $id=$this->input->post('id');
        $carpetas = $this->Mis_archivos_model->carpetas2($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($carpetas));
    }

    function printTree($tree, $num = 0) {
        if (!is_null($tree) && count($tree) > 0) {
            echo '<ul ' . (($num == 0) ? 'class="sTree2 listsClass" ' : 'style="display:none"') . '>';
            foreach ($tree as $node) {
                $nombre_=Mis_archivos::nombre_arbol($node['name']);
                echo '<li class="uno">'
                . '<div class="recurso_sele2" recarga="0" id_elemento="' . $node['name'] . '" name_folder="' . $nombre_ . '"  activo="0"><span class="fa fa-folder-o"></span> ' . $nombre_. "</div>";
                $num++;
                Mis_archivos::printTree($node['children'], $num);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    function nombre_arbol($id) {
        $carpetas = $this->Mis_archivos_model->nombre_arbol($id);
        return $carpetas;
    }

    function new_folder() {
        try {
            if (empty($this->input->post('nueva_carpeta')))
                throw new Exception("No ha ingresado el nombre de la carpeta");
            $idCarpeta = $this->Mis_archivos_model->new_folder($this->input->post('nueva_carpeta'), $this->input->post('IdCarpetaPadre'),$this->input->post('descripcion'));
            if ($idCarpeta == false)
                throw new Exception("Error al crear la carpeta en base de datos");
            $data['carpetaPadre'] = $this->input->post('IdCarpetaPadre');
            $data['Json'] = $this->Repositoriodocumento_model->documentos($this->input->post('IdCarpetaPadre'));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            echo json_encode($data);
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
            if (empty($this->input->post("archivo")) || empty($this->input->post("tipo")))
                throw new Exception("No existe archivo para Eliminar");
            if (empty($this->input->post("tipo") == 2)) {
                $this->load->model("Mis_archivos_model");
                $respuesta = $this->Mis_archivos_model->eliminarCarpeta($this->input->post("archivo"));
            }
            if ($this->input->post("tipo") == 3) {
                $this->load->model("Repositoriodocumento_model");
                $respuesta = $this->Repositoriodocumento_model->eliminarArchivo($this->input->post("archivo"));
            }
            if ($respuesta == 1) {
                $data['carpetaPadre'] = $this->input->post('IdCarpetaPadre');
                $data['Json'] = $this->Repositoriodocumento_model->documentos($this->input->post('IdCarpetaPadre'));
                $data['color'] = 'verde';
                throw new Exception("Carpeta eliminada correctamente");
            } else if ($respuesta == 0) {
                $data['color'] = 'rojo';
                throw new Exception("No se pudo eliminar la carpeta");
            }
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            echo json_encode($data);
        }
    }

    function actualizarArchivo() {
        try {
            if (empty($this->input->post('idArchivo')) || empty($this->input->post('nombreArchivo')))
                throw new Exception("No cumple los parametros para actualizar carpeta");

            $respuesta = $this->Mis_archivos_model->actualizarCarpeta($this->input->post('idArchivo'), $this->input->post('nombreArchivo'),$this->input->post('descripcion'));
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
            $data['carpetaPadre'] = $this->input->post('IdCarpetaPadre');
            $data['Json'] = $this->Repositoriodocumento_model->documentos($this->input->post('IdCarpetaPadre'));
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            echo json_encode($data);
        }
    }

    function traer_atras() {
        try {
            $idCarpetaAnterior = $this->Mis_archivos_model->traer_atras();
            $data['carpetaPadre'] = $idCarpetaAnterior[0]->carDoc_id_padre;
            $data['Json'] = $this->Repositoriodocumento_model->documentos($data['carpetaPadre']);
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            echo json_encode($data);
        }
    }

    function ordenamiento() {
        try {
            if (empty($this->input->post('orden')))
                throw new Exception("No existe dato para poder ordenar");
            $data['carpetaPadre'] = $this->input->post("padre");
//            echo $this->input->post('orden');die;
            $data['Json'] = $this->Repositoriodocumento_model->documentos($data['carpetaPadre'], $this->input->post('orden'));
            echo json_encode($data);
            die;
        } catch (exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            echo json_encode($data);
        }
    }

    public function subir_archivo() {
        try {
            ini_set('MAX_EXECUTION_TIME', -1);
            ini_set('memory_limit', -1);
            $uploaddir = './uploads/cargueArchivos';
            $carpeta = "";
            if (!empty($this->input->post("carpeta")))
                $carpeta = $this->input->post("carpeta");

            $this->load->model("Repositoriodocumento_model");
            if (isset($_FILES['file'])) {
                $uploadfile = $uploaddir . '/' . basename($_FILES['file']['name']);
                $tipo = $_FILES['file']['type'];
                $nombre = $_FILES['file']['name'];
                $tamano = filesize($_FILES['file']['tmp_name']);
                $fh = fopen($_FILES['file']['tmp_name'], 'rb');
                $documento = fread($fh, $_FILES['file']['size']);
                $documento = addslashes($documento);
                fclose($fh);
                $archivo = array(
                    "carDoc_id" => $carpeta,
                    "repDoc_tamano" => $tamano,
                    "repDoc_extension" => explode(".", $nombre)[1],
                    "repDoc_nombre" => $nombre,
                    "repDoc_documento" => $documento,
                    "repDoc_tipo" => $tipo
                );
                $this->Repositoriodocumento_model->saveFile($archivo);


                $data['carpetaPadre'] = $carpeta;
                $data['Json'] = $this->Repositoriodocumento_model->documentos($data['carpetaPadre']);
                echo json_encode($data);
                die;
            }
        } catch (exception $e) {
            $this->data["message"] = $e->getMessage();
        } finally {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    function descarga() {
        $post = $this->input->post();
        $datos = $this->Mis_archivos_model->descarga($post['carpeta_descarga']);
        $tipo = $datos[0]->repDoc_tipo;
        $nombre = $datos[0]->repDoc_nombre;
        $documento = $datos[0]->repDoc_documento;
        header("Content-type:" . $tipo);
//        header("Content-Disposition: attachment; filename=$nombre");
        header("Content-Disposition: attachment; filename=" . $nombre);
        echo $documento;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */