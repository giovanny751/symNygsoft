<?php

class Indicador_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        try {
            $this->db->insert("indicador", $data);
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function actualizar($id, $data) {
        try {
            $this->db->where("ind_id", $id);
            $this->db->update("indicador", $data);
        } catch (exception $e) {
            
        }
    }

    function search($tipo, $dimension, $dimensiondos) {
        try {
            if (!empty($tipo))
                $this->db->where("indicador.indTip_id", $tipo);
            if (!empty($dimension))
                $this->db->where("indicador.dim_id", $dimension);
            if (!empty($dimensiondos))
                $this->db->where("indicador.dimdos_id", $dimensiondos);

            $this->db->select("indicador.ind_id");
            $this->db->select("indicador_tipo.indTip_tipo");
            $this->db->select("indicador_tipo.indTip_id");
            $this->db->select("indicador.ind_indicador");
            $this->db->select("dimension.dim_descripcion as dimuno");
            $this->db->select("dimension2.dim_descripcion as dimdos");
            $this->db->select("indicador.ind_mide");
            $this->db->select("indicador.ind_frecuencia");
            $this->db->select("indicador.ind_minimo");
            $this->db->select("indicador.ind_maximo");
            $this->db->select("CONCAT(`empleado`.`Emp_Nombre`,' ',`empleado`.`Emp_Apellidos`) as nombre", false);

            $this->db->join("dimension", "dimension.dim_id = indicador.dim_id", "LEFT");
            $this->db->join("dimension2", "dimension2.dim_id = indicador.dimdos_id", "LEFT");
            $this->db->join("indicador_tipo", "indicador_tipo.indTip_id = indicador.indTip_id",'left');
            $this->db->join("cargo", "cargo.car_id = indicador.car_id", "LEFT");
            $this->db->join("empleado", "empleado.emp_id = indicador.emp_id", "LEFT");
            $indicadores = $this->db->get("indicador");
            return $indicadores->result();
        } catch (exception $e) {
            
        }
    }
    function eliminar_Indicador($post) {
        $this->db->where("ind_id", $post['ind_id']);
        $this->db->delete('indicador');
    }

    function detailxid($id) {
        try {
            $this->db->where("ind_id", $id);
            $indicadores = $this->db->get("indicador");
            return $indicadores->result();
        } catch (exception $e) {
            
        }
    }

    function consultaIndicadorFlechas($idIndicador, $metodo) {
        try {
            switch ($metodo) {
                case "flechaIzquierdaDoble":
                    $this->db->where("ind_id = (select min(ind_id) from indicador)");
                    break;
                case "flechaIzquierda":
                    $this->db->where("ind_id < '" . $idIndicador . "' ");
                    $this->db->order_by("ind_id desc");
                    break;
                case "flechaDerecha":
                    $this->db->where("ind_id > '" . $idIndicador . "' ");
                    $this->db->order_by("ind_id asc");
                    break;
                case "flechaDerechaDoble":
                    $this->db->where("ind_id = (select max(ind_id) from indicador)");
                    break;
                default :
                    die;
                    break;
            }
            $usuario = $this->db->get("indicador"
                    . ""
                    . "", 1);
            return $usuario->result();
        } catch (exception $e) {
            
        }
    }
    function max_id() {
        try {
            $this->db->select_max('ind_id');
            $datos = $this->db->get('indicador');
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->ind_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    function min_id() {
        try {
            $this->db->select_min('ind_id');
            $datos = $this->db->get('indicador');
            $datos = $datos->result();
//        echo $this->db->last_query();
            if (count($datos) > 0)
                return $datos[0]->ind_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

    

    function max_id_next($id) {
        try {
            $this->db->select('ind_id');
            $datos = $this->db->get('indicador', 1, 1);
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->ind_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }
    
    function select_id() {
        try {
            $this->db->select('ind_id');
            $datos = $this->db->get('indicador', 1, 1);
            $datos = $datos->result();
            if (count($datos) > 0)
                return $datos[0]->ind_id;
            else
                return '';
        } catch (exception $e) {
            
        }
    }

}

?>
