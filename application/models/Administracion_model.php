<?php

class administracion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //datos de vehiculo
    function vehiculo($id) {
        try{
        $this->db->where('veh_id', $id);
        $dato = $this->db->get('vehiculo');
        return $dato->result();
        }catch(exception $e){
            
        }
    }

    function formulario_general() {
        try{
        $datos = $this->db->get('adminFormularios');
        return $datos->result_array();
        }catch(exception $e){
            
        }
    }

    function guardar_formulario($post) {
        try{
        $this->db->insert('adminformularios', $post);
        }catch(exception $e){
            
        }
    }

    function maxForm() {
        try{
        $this->db->select('MAX(form_formulario) form_formulario', false);
        $dato = $this->db->get('adminformularios');
        $dato = $dato->result_array();
        return $dato[0]['form_formulario'];
        }catch(exception $e){
            
        }
    }

    function guardaradministracion($campos, $tabla) {
        try{
            $this->db->insert_batch($tabla, $campos);
        }catch(exception $e){
            
        }
    }

    function guardarvehiculo($vehiculo) {
        try{
        if (empty($vehiculo['veh_id'])) {
            $this->db->insert('vehiculo', $vehiculo);
        } else {
            $this->db->where('emp_id', $vehiculo['emp_id']);
            $this->db->where('veh_id', $vehiculo['veh_id']);
            $this->db->update('vehiculo', $vehiculo);
        }
        }catch(exception $e){
            
        }
    }

    function confirmacion() {
try{
        $dato = $this->db->get('confirmacion');
        return $dato->result_array();
        }catch(exception $e){
            
        }
    }

    function tipovinculacion() {
try{
        $dato = $this->db->get('tipo_vinculacion');
        return $dato->result_array();
        }catch(exception $e){
            
        }
    }

    function tipocarroceria() {
try{
        $dato = $this->db->get('tipo_carroceria');
        return $dato->result_array();
        }catch(exception $e){
            
        }
    }

    function entidades() {
try{
        $dato = $this->db->get('entidad_soat');
        return $dato->result_array();
        }catch(exception $e){
            
        }
    }

    function tipovehiculo() {
try{
        $dato = $this->db->get('tipo_vehiculo');
        return $dato->result_array();
        }catch(exception $e){
            
        }
    }

    function tiposervicio() {
try{
        $dato = $this->db->get('tipo_servicio');
        return $dato->result_array();
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
        $this->db->delete('user');
        }catch(exception $e){
            
        }
    }

    function eliminarvehiculo($id) {
try{
        $this->db->where('veh_id', $id);
        $this->db->delete('vehiculo');
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

    function cambioestadovehiculo($id, $estado) {
try{
        $this->db->where('veh_id', $id);
        $this->db->set('est_id', $estado);
        $this->db->update('vehiculo');
        }catch(exception $e){
            
        }
    }

    function reportevehiculos() {
try{
        $this->db->where('est_id !=', 3);
        $this->db->join('tipo_vehiculo', 'vehiculo.tipVeh_id = tipo_vehiculo.tipVeh_id');
        $dato = $this->db->get('vehiculo');
        return $dato->result_array();
        }catch(exception $e){
            
        }
    }
    function desicion() {
try{
        $genero = $this->db->get('confirmacion');
        return $genero->result_array();
        }catch(exception $e){
            
        }
    }

    function causas($id) {
try{
        $this->db->select('causas.cau_nombre,causas.cau_id,causas_usuario.usu_id,causas_usuario.cauUsu_id');
        $this->db->join('causas_usuario', 'causas_usuario.cau_id = causas.cau_id and usu_id=' . $id, 'left');
        $causas = $this->db->get('causas');
//        echo $this->db->last_query();
        return $causas->result_array();
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

    function guardarfactores($factores) {
try{
        $this->db->insert_batch('factor_usuario', $factores);
        }catch(exception $e){
            
        }
    }

    function guardarcausas($causas) {
try{
        $this->db->insert_batch('causas_usuario', $causas);
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
    function factoresriesgo($id) {
try{
        $this->db->select('factores_riesgo.facRis_id,factores_riesgo.facRis_nombre,factor_usuario.facUsu_id');
        $this->db->join('factor_usuario', 'factor_usuario.facRis_id = factores_riesgo.facRis_id and usu_id=' . $id, 'left');
        $ciudad = $this->db->get('factores_riesgo');
        return $ciudad->result_array();
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

    function tipodesplazamiento() {
try{
        $rol = $this->db->get('tipo_desplazamiento');
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

   function consultacronograma($id, $semestre,$eje){
        try{
        $this->db->where('emp_id',$id);
        $this->db->where('cro_semestre',$semestre);
        $this->db->where('cro_eje',$eje);
        $cronograma = $this->db->get('cronograma');
        return $cronograma->result_array();
        }catch(exception $e){
            
        }
    }
    function actualizacronograma($id, $semestre,$eje,$cronograma){
        try{
        $this->db->where('emp_id',$id);
        $this->db->where('cro_semestre',$semestre);
        $this->db->where('cro_eje',$eje);
        $this->db->set('cro_cronograma',$cronograma);
        $this->db->update('cronograma');
        }catch(exception $e){
            
        }
    }
    function insertacronograma($id, $semestre,$eje,$cronograma){
        try{
        $data = array(
            'cro_semestre'=>$semestre,
            'cro_eje'=>$eje,
            'cro_cronograma'=>$cronograma,
            'emp_id'=>$id
        );
        $this->db->insert('cronograma',$data);
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

    function miembros($data) {
        try{
        $this->db->insert_batch('miembros', $data);
        }catch(exception $e){
            
        }
    }
    
    function textomiembro($id){
        try{
        $this->db->where('emp_id',$id);
        $dato = $this->db->get('comite_texto');
        return $dato->result_array();
        }catch(exception $e){
            
        }
    }
    function riesgo(){
        try{
        $dato = $this->db->get('tipo_riesgo');
        return $dato->result_array();
        }catch(exception $e){
            
        }
    }

    function guardarresponsables($data) {
try{
        $this->db->insert_batch('responsables', $data);
        }catch(exception $e){
    
        }
    }

    function eliminarresponsables($id) {
try{
        $this->db->where('emp_id', $id);
        $this->db->delete('responsables');
        }catch(exception $e){
            
        }
    }

    function eliminarcomite($id) {
try{
        $this->db->where('emp_id', $id);
        $this->db->delete('comite');
        }catch(exception $e){
            
        }
    }

    function guardarcomite($data) {
try{
        $this->db->insert_batch('comite', $data);
        }catch(exception $e){
            
        }
    }

    function eliminafactores($id) {
        try{
        $this->db->where('usu_id', $id);
        $this->db->delete('factor_usuario');
        }catch(exception $e){
            
        }
    }

    function eliminacausas($id) {
        try{
        $this->db->where('usu_id', $id);
        $this->db->delete('causas_usuario');
        }catch(exception $e){
            
        }
    }

    function tipoobjetivo() {
        try{
        $datos = $this->db->get('tipo_objetivo');
        return $datos->result_array();
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

    function vehiculo_el($id) {
        try{
        $id = deencrypt_id($id);
        $this->db->set('veh_status', '3');
        $this->db->where('veh_id', $id);
        $this->db->update('vehiculo');
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
