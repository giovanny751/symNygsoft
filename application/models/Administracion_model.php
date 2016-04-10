<?php

class administracion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    

    function guardaradministracion($campos, $tabla) {
        try{
            $this->db->insert_batch($tabla, $campos);
        }catch(exception $e){
            
        }
    }


    function usuarios() {
try{
        $this->db->where('est_id !=', 3);
        $dato = $this->db->get('user');
        return $dato->result_array();
        }catch(exception $e){
            
        }
    }

    function eliminarusuario($id) {
try{
        $this->db->where('usu_id', $id);
        $this->db->set('est_id ', 3);
        $this->db->update('user');
        }catch(exception $e){
            
        }
    }



    function cambioestado($id, $estado) {
try{
        $this->db->where('usu_id', $id);
        $this->db->set('est_id', $estado);
        $this->db->update('user');
        }catch(exception $e){
            
        }
    }

    function categoria() {
try{
        $genero = $this->db->get('categoria');
        return $genero->result_array();
        }catch(exception $e){
            
        }
    }


    function datosusuario($id) {
try{
        $this->db->where('usu_id', $id);
        $user = $this->db->get('user');
        return $user->result_array();
        }catch(exception $e){
            
        }
    }
    
    function rol() {
try{
        $rol = $this->db->get('rol');
        return $rol->result_array();
        }catch(exception $e){
            
        }
    }


    function guardar_admin_inicio($post) {
        try{
        $this->db->where('ini_id', 1);
        $this->db->update('inicio', $post);
        }catch(exception $e){
            
        }
    }

    function guardar_admin_inicio_emp($post, $id) {
        try{
        $this->db->where('emp_id', $id);
        $this->db->update('empresa', $post);
        }catch(exception $e){
            
        }
    }

    function info_empresa($id) {
        try{
        $this->db->where('emp_id', $id);
        $dato = $this->db->get('empresa');
        return $dato->result();
        }catch(exception $e){
            
        }
    }

    function admin_inicio() {
        try{
        $this->db->where('ini_id', 1);
        $dato = $this->db->get('inicio');
        return $dato->result();
        }catch(exception $e){
            
        }
    }

    function admin_inicio_emp($id) {
        try{
        $this->db->set('emp_inicio,emp_id');
        $this->db->where('emp_id', $id);
        $dato = $this->db->get('empresa');
        return $dato->result();
        }catch(exception $e){
            
        }
    }


    function guardapolitica($politica, $id) {
        try{
        $data = array(
            'pol_politica' => $politica,
            'emp_id' => $id
        );

        $this->db->insert('politicas', $data);
        }catch(exception $e){
            
        }
    }

    function actualizarpolitica($politica, $id) {
        try{
        $this->db->where('emp_id', $id);
        $this->db->set('pol_politica', $politica);
        $this->db->update('politicas');
        }catch(exception $e){
            
        }
    }

    function verificapolitica($id) {
        try{
        $this->db->where('emp_id', $id);
        $politica = $this->db->get('politicas');
        return $politica->result_array();
        }catch(exception $e){
            
        }
    }

    

    function eliminabjetivos($id, $tabla, $campo) {
        try{
        $this->db->where('emp_id', $id);
        $this->db->delete($tabla);
        }catch(exception $e){
            
        }
    }

    function empleado_el($id) {
        try{
        $id = deencrypt_id($id);
        $this->db->set('usu_status', '3');
        $this->db->where('usu_id', $id);
        $this->db->update('user');
        }catch(exception $e){
            
        }
    }

    function empresa_el($id) {
        try{
        $id = deencrypt_id($id);
        $this->db->set('emp_status', '3');
        $this->db->where('emp_id', $id);
        $this->db->update('empresa');
        }catch(exception $e){
            
        }
    }
    function empresa($id) {
        try{
        $this->db->where('emp_id', $id);
        $datos=$this->db->get('empresa');
        return $datos->result();
        }catch(exception $e){
            
        }
    }
    function guardar_emp($userfile,$id) {
        try{
        $this->db->where('emp_id', $id);
        $this->db->set('userfile', $userfile);
        $this->db->update('empresa');
        }catch(exception $e){
            
        }
    }
}
