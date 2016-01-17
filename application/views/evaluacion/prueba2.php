<!DOCTYPE html>
<html>
    <head>
        <title>SG-SST</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <!--<meta http-equiv="Content-type" content="text/html; charset=utf-8">-->
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <link href="<?= base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/> 
        <!--<link href="<?= base_url('assets/global/plugins/fullcalendar/fullcalendar.min.css') ?>" rel="stylesheet" type="text/css"/>-->
        <link href="<?= base_url('assets/global/plugins/jqvmap/jqvmap/jqvmap.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL PLUGIN STYLES -->
        <!-- BEGIN PAGE STYLES -->
        <link href="<?= base_url('assets/admin/pages/css/tasks.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- BEGIN PAGE LEVEL STYLES -->
        <!--<link rel="stylesheet" type="text/css" href="<?= base_url('assets/global/plugins/clockface/css/clockface.css') ?>"/>-->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') ?>"/>
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/global/plugins/jquery-notific8/jquery.notific8.min.css') ?>"/>
        <!--<script type="text/javascript" src="<?= base_url('assets/global/plugins/clockface/js/clockface.js') ?>"></script>-->
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>
        <!-- Flechas para cambio de usuario, empleados y mÃ¡s cosas -->
        <link rel="stylesheet" href="<?= base_url('css/flechas.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/estilos.css'); ?>"/>
        <!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
        <script type="text/javascript" src="<?php echo base_url() ?>/js/jquery_1.11.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/js/jquery_ui_1.11.4.min.js"></script>
        <!--<script src="<?= base_url('assets/global/plugins/fullcalendar/fullcalendar.min.js') ?>" type="text/javascript"></script>-->
        <script src="<?= base_url('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/global/plugins/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>/css/jquery_ui_1.11.4.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>/css/bootstrap_theme_3.3.5.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>/css/sst.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>/css/sstmenu.css">
        <script src="<?= base_url('js/jquery.blockUI.js') ?>" type="text/javascript"></script>

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script type="text/javascript" src="<?= base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') ?>"></script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= base_url('assets/global/plugins/jquery-notific8/jquery.notific8.min.js') ?>"></script>
        <script src="<?= base_url('assets/admin/pages/scripts/ui-notific8.js') ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url() ?>/css/bootstrap_3.3.5.min.css" />
        <script type="text/javascript" src="<?php echo base_url() ?>/js/bootstrap_3.3.5.min.js"></script>
    </head>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="tituloCuerpo">
                <span class="txtTitulo"><?php echo $nombre_evaluacion[0]->eva_nombre ?></span>
            </div>
        </div>
    </div>
    
    <div class="cuerpoContenido">
        <form action="<?php echo base_url('index.php/Evaluacion/calificar') ?>" method="post" id="" onsubmit="return enviar();">
            <!--<div class="container">-->
            <table width="100%">
                <?php
                $area = '';
                $tema = '';
                $tipo = '';
                $i = 1;
                $corecctas=0;
                foreach ($respondio as $key => $value) {
                    $respuesta[$value->pre_id] = $value->res_id;
                }

                foreach ($preguntas_evaluacion as $key => $value) {
                    echo '<tr><td><span><b>Pregunta # ' . $i . '</b></span><span style="float:right">Tipo pregunta: ' .utf8_encode($value->tipPre_nombre) . '</span></td></tr><tr><td>';
                    $i++;
//                    if ($value->are_nombre != $area) {
//                        echo '<b>Area: ' . $value->are_nombre . '</b><p>';
//                        $area = $value->are_nombre;
//                    }
//                    if ($value->tem_nombre != $tema) {
//                        echo '<b>Tema: ' . $value->tem_nombre . '</b><p>';
//                        $tema = $value->tem_nombre;
//                    }
                    if (!empty($value->pre_contexto))
                        echo '<b>Contexto:</b> <br>' . utf8_encode($value->pre_contexto) . '<p>';
                    echo '<b>Pregunta:</b> <br>' . utf8_encode($value->pre_nombre) . '<p>';
                    $pregu[] = $value->pre_id;
                    @$datos = Evaluacion::obtener_respuestas($value->pre_id);
                    
                    foreach ($datos as $value2) {
                        if ($respuesta[$value->pre_id] == $value2->res_id) {
                            $s = 'checked';
                            $st = 'style="background-color:#ed6b75;opacity: 0.65;"';
                        } else {
                            $s = '';
                            $st = '';
                        }
                        if ($value2->res_id == $value->res_id) {
                            $st = 'style="background-color:#32c5d2;opacity: 0.65;"';
                        }
                        if(($respuesta[$value->pre_id] == $value2->res_id) && ($value2->res_id == $value->res_id) ){
                            $corecctas++;
                        }
                        ?>
                        <div class="col-md-12" <?php echo $st; ?>>
                            <div class="col-md-1">
                                <?php
                                if ($respuesta[$value->pre_id] == $value2->res_id) {
                                    $s = 'checked';
                                } else {
                                    $s = '';
                                }
                                ?>
                                <input type="radio" <?php echo $s; ?> name="<?php echo $value2->pre_id ?>" class="obligado" value="<?php echo $value2->res_id ?>" >
                            </div>
                            <div class="col-md-10">
                                <?php echo $value2->res_nombre ?>
                            </div>
                        </div>
                        <?php
                    }
                    echo "</td></tr>";
                }
                ?>
            </table>
            <!--</div>-->
        </form>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h2>Calificación:  <?php echo  $corecctas.'/'.count($preguntas_evaluacion);echo '<br>'.number_format(($corecctas*5)/count($preguntas_evaluacion),2) ?></h2><p><br></p>
                </center>
            </div>
        </div>
    </div>
    </div>

    <style>
        table tr{

            border-bottom: 3px solid #fff;
        }
    </style>