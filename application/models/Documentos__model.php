<?php

class Documentos__model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function consultarDocumentosPadre() {
        $this->db->select("id,nombre,estado");
		$this->db->where("estado < 3  AND tipo_documento=1  AND id_padre=0");
		$this->db->order_by("id");
		$datos=$this->db->get('documentos');
		return $datos=$datos->result();	
    }   
	
	function consultarDocumentosHijo($id_padre) {
        $this->db->select("id,tipo_documento,id_padre,nombre,descripcion,contenido,url,encabezado,pie,tipo_contenido,estado,url,
		                   (select count(id) from documentos where id_padre=$id_padre) as cant");
		$this->db->where("id_padre=$id_padre");
		$this->db->where("estado < 3 " );
		$datos=$this->db->get('documentos');
		//print "<br>".$this->db->last_query();	
		return $datos=$datos->result();	
    }

}


?>