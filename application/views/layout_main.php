<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <title>SG-SST</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
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
    </head>
    <body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
        <?php
        function modulos($datosmodulos, $idusuario, $dato = null) {
            $ci = &get_instance();
            $ci->load->model("ingreso_model");
            $user = null;
            $menu = $ci->ingreso_model->menu($datosmodulos, $idusuario, 2);
            $i = array();
            foreach ($menu as $modulo)
                $i[$modulo['menu_nombrepadre']][$modulo['menu_idpadre']] [] = array($modulo['menu_idhijo'], $modulo['menu_controlador'], $modulo['menu_accion'], $modulo['mod_icons']);
            echo"<ul class=''>";
                foreach ($i as $nombrepapa => $menuidpadre)
                    foreach ($menuidpadre as $modulos => $menu)
                        foreach ($menu as $submenus):
                            if ($submenus[1] == "" && $submenus[2] == "")
                                echo "<li class='has-sub'><a href='#'>" . strtoupper($nombrepapa) . "</span></a>";
                            else
                                echo "<li class=''><a href='" . base_url("index.php/" . $submenus[1] . "/" . $submenus[2]) . "'>" . strtoupper($nombrepapa) . "</a>";
                            if (!empty($submenus[0]))
                                modulos($submenus[0], $idusuario);
                            echo "</li>";
                        endforeach;
            if ($datosmodulos == 'prueba')
                echo "<li><a href='" . base_url('index.php/login/logout') . "'>CERRAR SESION</a></li>";
            echo "</ul>";
        }
        ?>
        <div class="page-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <div style="text-align: center;">
                            <a href="<?php echo base_url("/index.php/presentacion/principal") ?>"><img src="<?php echo base_url() ?>/img/sst.png" class="logo_imagen" alt="Logo"></a>
                            <h6>Seguridad y Salud en el Trabajo</h6>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="header_position">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-headerImg" ><i class="fa fa-sitemap fa-2x" style="color:#FFF"></i></button>
                                    </div>
                                    <div class="col-md-8 headerTxt">
                                        <a href="<?php echo base_url("index.php/planes/listadoplanes") ?>" class="btn btn-headerTxt">
                                            PLANES 
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-headerImg"><i class="fa fa-pencil-square-o  fa-2x" style="color:#FFF"></i></button>
                                    </div>
                                    <div class="col-md-8 headerTxt">
                                        <a href="<?php echo base_url("index.php/tareas/listadotareas") ?>" class="btn btn-headerTxt">
                                            TAREAS 
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-headerImg"><i class="fa fa-bar-chart fa-2x" style="color:#FFF"></i></button>
                                    </div>
                                    <div class="col-md-8 headerTxt">
                                        <a href="<?php echo base_url("index.php/indicador/verindicadores") ?>" class="btn btn-headerTxt">
                                            INDICADORES 
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-headerImg"><i class="fa fa-exclamation-triangle fa-2x" style="color:#FFF"></i></button>
                                    </div>
                                    <div class="col-md-8 headerTxt">
                                        <a href="<?php echo base_url("index.php/riesgo/listadoriesgo") ?>" class="btn btn-headerTxt">
                                            RIESGOS <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                <div id="cssmenu">
<?php echo modulos('prueba', $id, null); ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row cuerpoDescripcion">
<?php echo $content_for_layout ?>
                </div>
            </div>
        </div>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script type="text/javascript" src="<?= base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') ?>"></script>
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?= base_url('assets/global/plugins/jquery-notific8/jquery.notific8.min.js') ?>"></script>
        <script src="<?= base_url('assets/admin/pages/scripts/ui-notific8.js') ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url() ?>/css/bootstrap_3.3.5.min.css" />
        <script type="text/javascript" src="<?php echo base_url() ?>/js/bootstrap_3.3.5.min.js"></script>
        <style>
            .tab-pane{
                color: black;
            }

            tbody{
                color: black;
            }
            .obligado{
                background-color: rgb(250, 255, 189);
            }
            .caption {
                display: inline-block;
                float: left;
                font-size: 18px;
                font-weight: 400;
                line-height: 18px;
                padding: 10px 0;
            }
            .portlet.box, .portlet-title {
                border-bottom: 1px solid #eee;
                color: #fff;
                margin-bottom: 0;
                padding: 0 10px;
            }
            .row{
                margin-top: 1%;
            }
            .container{
                padding-top: 83px;

            }
            * { 
                font-family: "calibri", Garamond, 'Comic Sans'; 
                font: 12px/2em sans-serif;
            }
            .campoobligatorio{
                color:red;
                font-size:16px;
            }
            i{
                cursor:pointer;
            }
            .table tbody tr td {
                border: 1px solid #CCC !important;
            }

            .table tr th {
                border: 1px solid #CCC !important;
                background-color: #008ac9;
                color: #FFF
            }

            .table thead tr td {
                border: 1px solid #CCC !important;
                background-color: #008ac9;
                color: #FFF
            }
            .header_position a {
                margin-left: -7%;
            }
            .blockOverlay{
                z-index:10000 !important;
            }
        </style>
        <script>
            jQuery(document).ready(function () {
//                Metronic.init(); // init metronic core componets
//                Layout.init(); // init layout
//                QuickSidebar.init(); // init quick sidebar
//                Demo.init(); // init demo features
//                Index.init();
//                Index.initDashboardDaterange();
//                Index.initJQVMAP(); // init index page's custom scripts
//                Index.initCalendar(); // init index page's custom scripts
//                Index.initCharts(); // init index page's custom scripts
//                Index.initChat();
//                Index.initMiniCharts();
//                Tasks.initDashboardWidget();
                UINotific8.init();

            });


            $('.limpiar').click(function () {
                $('select,input').val('');
            });
            //    --------------------------------------------------------------------------
            //COLORES DE ALERTAS DE METRONIC
            //    --------------------------------------------------------------------------
            function alerta(color, texto)
            {
                switch (color) {
                    case "rojo":
                        var alerta = 'ruby sticky';
                        break;
                    case "morado":
                        var alerta = 'amethyst sticky';
                        break;
                    case "azul":
                        var alerta = 'teal sticky';
                        break;
                    case "amarillo":
                        var alerta = 'lemon sticky';
                        break;
                    case "verde":
                        var alerta = 'lime sticky';
                        break;
                    case "naranja":
                        var alerta = 'tangerine sticky';
                        break;
                    default:
                        break;
                }
                $.notific8('', {
                    horizontalEdge: 'bottom',
                    life: 5000,
                    theme: alerta,
                    heading: texto
                });
            }


            $('body').delegate('.number', 'keypress', function (tecla) {
                if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
                    return false;
            });
            //numero que permite comas        
            $('body').delegate('.number2', 'keypress', function (tecla) {
                console.log(tecla.charCode);
                if (tecla.charCode > 0 && (tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode < 45 || tecla.charCode > 47))
                    return false;
            });
            $('body').delegate('.miles', 'keyup', function (tecla) {
                $(this).val(num_miles($(this).val()))
            });
            $('body').delegate('.float', 'keypress', function (tecla) {
                if (tecla.charCode == 46)
                    return true;
                if ((tecla.charCode > 0 && tecla.charCode < 48) || (tecla.charCode > 57))
                    return false;
            });
            function obligatorio(clase) {
                var i = 0;
                $('.' + clase).each(function (key, val) {
                    if ($(this).val() != "")
                        $(this).removeClass('obligado');
                    else {
                        $(this).addClass('obligado');
                        i++;
                    }
                });
                if (i == 0)
                    return true;
                else {
                    alerta('naranja', "FALTAN CAMPOS POR LLENAR");
                    return false;
                }
            }

            function email(classemail) {
                var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                //Se utiliza la funcion test() nativa de JavaScript
                if (regex.test($('.' + classemail).val().trim())) {
                    $("." + classemail).removeClass('obligado');
                    return true;
                } else {
                    $("." + classemail).addClass('obligado');
                    alerta("amarillo", "Correo no valido")
                    return false;
                }
            }

            ;
            (function ($) {
                $.fn.datepicker.dates['es'] = {
                    days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
                    daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
                    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
                    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"]
                };
            }(jQuery));

            $(".email").change(function () {
                email("email");
            });
            $('.fecha').datepicker({
                language: "es",
                format: "yyyy-mm-dd",
                autoclose: true
            });


            function difFecha(idFecha1, idFecha2) {
                var valFecha1 = $(idFecha1).val();
                var valFecha2 = $(idFecha2).val();
                var arrayFecha1 = valFecha1.split("-");
                var arrayFecha2 = valFecha2.split("-");
                var fecha1 = new Date(arrayFecha1[0], arrayFecha1[1] - 1, arrayFecha1[2]);
                var fecha2 = new Date(arrayFecha2[0], arrayFecha2[1] - 1, arrayFecha2[2]);
                var resta = (fecha2 - fecha1) / 1000 / 3600 / 24;
                if (resta >= 0) {
                    $(idFecha1,idFecha2).removeClass("obligado");
                    return resta;
                } else {
                    $(idFecha1,idFecha2).addClass("obligado");
                    alerta("amarillo", "Fecha no es valida");
                    return false;
                }
            }
            function difFechaIncapacidad(idFecha1, idFecha2) {
                var valFecha1 = $(idFecha1).val();
                var valFecha2 = $(idFecha2).val();
                var arrayFecha1 = valFecha1.split("-");
                var arrayFecha2 = valFecha2.split("-");
                var fecha1 = new Date(arrayFecha1[0], arrayFecha1[1] - 1, arrayFecha1[2]);
                var fecha2 = new Date(arrayFecha2[0], arrayFecha2[1] - 1, arrayFecha2[2]);
                var resta = (fecha2 - fecha1) / 1000 / 3600 / 24;
                if (resta >= 0) {
                    $(idFecha1).removeClass("obligado");
                    $(idFecha2).removeClass("obligado");
                    return resta+1;
                } else {
                    $(idFecha1).addClass("obligado");
                    $(idFecha2).addClass("obligado");
                    alerta("amarillo", "Fecha no es valida");
                    return false;
                }
            }
            function num_miles(num) {
                num = num.toString().replace(/\$|\,/g, '');
                if (isNaN(num))
                    num = "0";
                sign = (num == (num = Math.abs(num)));
                num = Math.floor(num * 100 + 0.50000000001);
                cents = num % 100;
                num = Math.floor(num / 100).toString();
                if (cents < 10)
                    cents = "0" + cents;
                for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
                    num = num.substring(0, num.length - (4 * i + 3)) + ',' +
                            num.substring(num.length - (4 * i + 3));
                return (((sign) ? '' : '-') + num);
            }

            $('#cssmenu li.active').addClass('open').children('ul').show();
            $('#cssmenu li.has-sub>a').on('click', function () {
                $(this).removeAttr('href');
                var element = $(this).parent('li');
                if (element.hasClass('open')) {
                    element.removeClass('open');
                    element.find('li').removeClass('open');
                    element.find('ul').slideUp(200);
                } else {
                    element.addClass('open');
                    element.children('ul').slideDown(200);
                    element.siblings('li').children('ul').slideUp(200);
                    element.siblings('li').removeClass('open');
                    element.siblings('li').find('li').removeClass('open');
                    element.siblings('li').find('ul').slideUp(200);
                }
            });
            $(function () {
                //Se pone para que en todos los llamados ajax se bloquee la pantalla mostrando el mensaje Procesando...
                $.blockUI.defaults.message = 'Procesando...';
                $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
            });
        </script>