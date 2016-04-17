<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>SG-SST</title>

        <link rel="stylesheet" href="<?php echo base_url() ?>/css/jquery_ui_1.11.4.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>/css/bootstrap_3.3.5.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>/css/bootstrap_theme_3.3.5.min.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/global/css/components.css" />
        <link rel="stylesheet" href="<?= base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css') ?>" type="text/css"/> 
        <style type="text/css">

            @font-face {
                font-family: "open_sans_regular";
                src: url(<?php echo base_url("fonts/OpenSans-Regular.ttf") ?>) format("truetype");
            }
            @font-face {
                font-family: "anton";
                src: url(<?php echo base_url("fonts/Anton.ttf") ?>) format("truetype");
            }

            html, body{
                background-color: #eee;
                font-family: "open_sans_regular";
            }
            .portlet.box > .portlet-body {
                background-color: #ffffff;
                padding: 15px 30px;
            }
            .row{
                margin-top: 15px;
            }
            .logo{
                font-family: "anton";
                color: #0C7093;
                font-size: 120px;
                margin-left: 15px;
                padding:0px;
            }
            header{
                border-bottom: 1px solid white;
            }
            #nota{
                display:none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header>
                <div class="logo">PQR</div>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="glyphicon glyphicon-ok"></i> FORMULARIO DE ATENCIÓN
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <div class="form-body">
                                <?php if ($this->session->flashdata('message')) { ?>
                                    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                                        <?php echo $this->session->flashdata('message'); ?>
                                    </div>            
                                <?php } ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        Pensando en la satisfacción de sus grupos de interés DRIFT S.A. pone a su servicio la aplicación PQRS, en la cual usted puede evaluar nuestro servicio y la atención recibida.<br><br>

                                        Por tal motivo solicitamos de su parte que las inquietudes o comentarios sean descritos en forma clara, breve, precisa y respetuosa.<br><br>

                                        De nuestra parte daremos respuesta a sus inquietudes en el menor tiempo posible.
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="formBody">


                                            <!--<div class="col-md-12">-->
                                            <div class="col-md-3">
                                                Consulte el estado de la solicitud
                                            </div>
                                            <div class="col-md-1">
                                                <input type="text" class="form-control number" id="solicitud">
                                            </div>
                                            <div class="col-md-1">
                                                <button class="btn btn-success" id="buscar">Buscar</button>
                                                <i class="fa fa-circle-o-notch fa-lg fa-spin radio_pin" style="color:#008AC9;display: none"></i>
                                            </div>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                                <form action="<?php echo base_url('index.php/') . "/reportarriesgo/save_pqr"; ?>" method="post" onsubmit="return campos()"  enctype="multipart/form-data">
                                    <div class="row">
                                        <?php $id = (isset($datos[0]->pqr_id) ? $datos[0]->pqr_id : '' ) ?>
                                        <input type="hidden" value="<?php echo (isset($datos[0]->pqr_id) ? $datos[0]->pqr_id : '' ) ?>" class=" form-control   " id="pqr_id" name="pqr_id">


                                        <div class="col-md-3">
                                            <label for="tipSol_id">
                                                *                             Tipo De Solicitud:                        </label>
                                        </div>
                                        <div class="col-md-3">
                                            <?php echo lista("tipSol_id", "tipSol_id", "form-control obligatorio", "tipo_solicitud", "tipSol_id", "tipSol_nombre", (isset($datos[0]->tipSol_id) ? $datos[0]->tipSol_id : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                        <br>
                                        </div>



                                        <div class="col-md-3">
                                            <label for="temSol_id">
                                                *                             Tema:                        </label>
                                        </div>
                                        <div class="col-md-3">
                                            <?php echo lista("temSol_id", "temSol_id", "form-control obligatorio", "temaSolicitud", "temSol_id", "temSol_nombre", (isset($datos[0]->temSol_id) ? $datos[0]->temSol_id : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                        <br>
                                        </div>



                                        <div class="col-md-3">
                                            <label for="pqr_detalle">
                                                *                             Detalles:                        </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class=" form-control obligatorio  " id="pqr_detalle" name="pqr_detalle"></textarea>
                                            <br>
                                        </div>



                                        <div class="col-md-3">
                                            <label for="sol_id">
                                                *                             Solicitante:                        </label>
                                        </div>
                                        <div class="col-md-3">
                                            <?php echo lista("sol_id", "sol_id", "form-control obligatorio", "solicitante", "sol_id", "sol_nombre", (isset($datos[0]->sol_id) ? $datos[0]->sol_id : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                        <br>
                                        </div>



                                        <div class="col-md-3">
                                            <label for="pqr_nombre">
                                                *                             Nombre:                        </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" value="<?php echo (isset($datos[0]->pqr_nombre) ? $datos[0]->pqr_nombre : '' ) ?>" class=" form-control obligatorio  " id="pqr_nombre" name="pqr_nombre">


                                            <br>
                                        </div>



                                        <div class="col-md-3">
                                            <label for="email">
                                                *                             E-mail:                        </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="email" value="<?php echo (isset($datos[0]->email) ? $datos[0]->email : '' ) ?>" class=" form-control obligatorio  " id="email" name="email">


                                            <br>
                                        </div>



                                        <div class="col-md-3">
                                            <label for="telefono">
                                                *                             Teléfono:                        </label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" value="<?php echo (isset($datos[0]->telefono) ? $datos[0]->telefono : '' ) ?>" class=" form-control obligatorio  number" id="telefono" name="telefono">


                                            <br>
                                        </div>



                                        <div class="col-md-3">
                                            <label for="dep_id">
                                                *                             Departamento:                        </label>
                                        </div>
                                        <div class="col-md-3">
                                            <?php echo lista("dep_id", "dep_id", "form-control obligatorio", "departamento", "dep_id", "dep_nombre", (isset($datos[0]->dep_id) ? $datos[0]->dep_id : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                        <br>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <center>
                                                <span id="boton_guardar">
                                                    <button class="btn btn-dcs" >Guardar</button> 
                                                    <input class="btn btn-dcs" type="reset" value="Limpiar">
                                                </span>
                                                <span id="boton_cargar" style="display: none">
                                                    <h2>Cargando ...</h2>
                                                </span>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="float: right"><b>Los campos en * son obligatorios</b></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url() ?>/js/jquery_1.11.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/js/jquery_ui_1.11.4.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/js/bootstrap_3.3.5.min.js"></script>
        <script>
                                    $('#buscar').click(function () {
                                        
                                        
                                        if ($('#solicitud').val() == "") {
                                            alert('Numero de solicitud obligatorio');
                                            return false;
                                        }
                                        $('#buscar').hide('slow');
                                        $('.radio_pin').show('slow');
                                        var url = "<?php echo base_url('index.php/') . "/reportarriesgo/buscar_sol"; ?>";
                                        $.post(url, {solicitud: $('#solicitud').val()})
                                                .done(function (msg) {
                                                    alert(msg);
                                                    $('.radio_pin').hide('slow');
                                                    $('#buscar').show('slow');
                                                })
                                                .fail(function () {
                                                    $('.radio_pin').hide('slow');
                                                    $('#buscar').show('slow');
                                                    alert('Error por favor intentar mas tarde.')
                                                })

                                    })
                                    function campos() {
                                        $('input[type="file"]').each(function (key, val) {
                                            var img = $(this).val();
                                            if (img != "") {
                                                var r = (img.indexOf('jpg') != -1) ? '' : ((img.indexOf('png') != -1) ? '' : ((img.indexOf('gif') != -1) ? '' : false))
                                                if (r === false) {
                                                    alert('Tipo de archivo no valido');
                                                    return false;
                                                }
                                            }
                                        });
                                        if (obligatorio('obligatorio') == false) {
                                            return false
                                        } else {
                                            $('#boton_guardar').hide();
                                            $('#boton_cargar').show();
                                            return true;
                                        }
                                    }
                                    $('body').delegate('.number', 'keypress', function (tecla) {
                                        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
                                            return false;
                                    });
                                    $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});

                                    function obligatorio(clase) {
                                        var i = 0;
                                        $('.' + clase).each(function (key, val) {
                                            if ($(this).val() == "" || $(this).val() == null) {
                                                $(this).addClass('obligado');
                                                i++;
                                            } else {
                                                $(this).removeClass('obligado');
                                            }
                                        });
                                        if (i == 0)
                                            return true;
                                        else {
                                            alerta('naranja', "FALTAN CAMPOS POR LLENAR");
                                            return false;
                                        }
                                    }

        </script>
    </body>
</html>
