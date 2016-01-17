<?php

class Reportes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function visualizacionreporte($padre = null) {
        try {
            if ($padre != "prueba")
                $this->db->where('rep_idpadre', $padre);
            else
                $this->db->where('rep_idpadre', 0);
            $reporte = $this->db->get('reporte');
            return $reporte->result_array();
        } catch (exception $e) {
            
        }
    }

    function validarquery($id, $query) {
        try {
            $query = $this->db->query("desc $query");
            return $query->result_array();
        } catch (exception $e) {
            
        }
    }

    function guardarreporte($reporte) {
        try {
            $this->db->set('rep_nombre', $reporte);
            $this->db->insert('reportes');
        } catch (exception $e) {
            
        }
    }

    function totalreportes() {
        try {
            $reportes = $this->db->get('reportes');
            return $reportes->result_array();
        } catch (exception $e) {
            
        }
    }

    function inforeport($id) {
        try {
            $this->db->where('rep_id', $id);
            $reportes = $this->db->get('reporte');
            return $reportes->result_array();
        } catch (exception $e) {
            
        }
    }

    function editreport($id, $nombre, $estado) {
        try {
            $this->db->where('rep_id', $id);
            $this->db->set('rep_nombre', $nombre);
            $this->db->set('rep_estado', $estado);
            $this->db->update('reportes');
        } catch (exception $e) {
            
        }
    }

    function guardartodoreporte($data, $id) {
        try {
            $this->db->where('rep_id', $id);
            $this->db->update('reporte', $data);
        } catch (exception $e) {
            
        }
    }

    function consultahijos($idgeneral = 0) {
        try {
            if (!empty($idgeneral))
                $this->db->where('rep_idpadre', $idgeneral);
            else
                $this->db->where('rep_idpadre', '0');
            $dato = $this->db->get('reporte');
            return $dato->result_array();
        } catch (exception $e) {
            
        }
    }

    function hijos($hijo) {
        try {
            $this->db->where('rep_idpadre', $hijo);
            $dato = $this->db->get('reporte');
            $envio = $dato->result_array();
            return $envio;
        } catch (exception $e) {
            
        }
    }

    function guardarmodulo($modulo, $padre = null, $general) {
        try {
            $data = array('rep_nombrepadre' => $modulo,
                'rep_idpadre' => $general
            );
            $this->db->insert('reporte', $data);
            return $this->db->insert_id();
        } catch (exception $e) {
            
        }
    }

    function cargamenu($padre) {
        try {
            if (empty($padre)) {
                $this->db->where('rep_idpadre', '0');
            } else {
                $this->db->where('rep_idpadre', $padre);
            }
            $dato = $this->db->get('reporte');
            $envio = $dato->result_array();
            return $envio;
        } catch (exception $e) {
            
        }
    }

    function consultamenu($idgeneral) {
        try {
            $this->db->where('rep_id', $idgeneral);
            $datos = $this->db->get('reporte');
            return $datos->result_array();
        } catch (exception $e) {
            
        }
    }

    function actualizahijos($padre) {
        try {
            $data = array('rep_idhijo' => $padre);
            $this->db->where('rep_id', $padre);
            $this->db->update('reporte', $data);
        } catch (exception $e) {
            
        }
    }

    function consultareporte($idreporte) {
        try {
            $this->db->where('rep_id', $idreporte);
            $reporte = $this->db->get('reporte');
            return $reporte->result_array();
        } catch (exception $e) {
            
        }
    }

    function ejecucionquery($query) {
        try {
            $query = $this->db->query($query);
            return $query->result_array();
        } catch (exception $e) {
            
        }
    }

    function totales($query, $campos) {
        try {
            $query = $this->db->query($query);
            return $query->result_array();
        } catch (exception $e) {
            
        }
    }

}
