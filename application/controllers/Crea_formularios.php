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
class Crea_formularios extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Crea_formularios_model');
    }

    public function index() {
//        if ($this->consultaacceso($this->data["usu_id"])) :
            $this->data["tablas"] = $this->Crea_formularios_model->tablas();
            $this->layout->view('Crea_formularios/index', $this->data);
//            else:
//            $this->layout->view("permisos");
//        endif;
    }

    public function info_table() {
        $post = $this->input->post();
        $datos = $this->Crea_formularios_model->info_table($post);
        $info_input = $this->Crea_formularios_model->info_input();
        $data = array($datos, $info_input);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function new_file() {
        $this->data["post"] = $this->input->post();
        $view = $this->load->view('Crea_formularios/view', $this->data, true);
        $controller = $this->load->view('Crea_formularios/controller', $this->data, true);
        $model = $this->load->view('Crea_formularios/model', $this->data, true);
        $view_consulta = $this->load->view('Crea_formularios/view_consulta', $this->data, true);

        $view_consulta = str_replace('<=?php', '<?php', $view_consulta);
        $view_consulta = str_replace('?=>', '?>', $view_consulta);
        $model = str_replace('<=?php', '<?php', $model);
        $model = str_replace('?=>', '?>', $model);
        $controller = str_replace('<=?php', '<?php', $controller);
        $controller = str_replace('?=>', '?>', $controller);
        $view = str_replace('<=?php', '<?php', $view);
        $view = str_replace('?=>', '?>', $view);

        $controllers = "./application/controllers/";
        $models = "./application/models/";
        $estructura = "./application/views/" . $this->data["post"]['tabla'] . "/";
        mkdir($estructura, 0777, true);

        $file = fopen($controllers . "/" . ucfirst($this->data["post"]['tabla']) . ".php", "w");
        fwrite($file, $controller . PHP_EOL);
        fclose($file);
        $file = fopen($models . "/" . ucfirst($this->data["post"]['tabla']) . "__model.php", "w");
        fwrite($file, $model . PHP_EOL);
        fclose($file);
        $file = fopen($estructura . "/index.php", "w");
        fwrite($file, $view . PHP_EOL);
        fclose($file);
        $file = fopen($estructura . "/" . "consult_" . $this->data["post"]['tabla'] . ".php", "w");
        fwrite($file, $view_consulta . PHP_EOL);
        fclose($file);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */