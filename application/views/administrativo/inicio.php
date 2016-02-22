<link rel="stylesheet" href="<?php echo base_url('dist/css/font-awesome.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('dist/js/summernote.js?v=' . date("d-h")); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('dist/js/script_summernote.js?v=' . date("d-h")); ?>"></script>
<link href="<?php echo base_url('dist/css/summernote.css?v=' . date("d-h")); ?>" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<script>
    $(function () {
        $("#accordion").accordion({
            active: 2
        });
    });
</script>

<div class="widgetTitle">
    <center><h5>
            <i class="glyphicon glyphicon-ok"></i>
            Administrador de inicio 
        </h5></center>
</div>
<p><br>
<div id="accordion">
    <h3>Politicas</h3>
    <div >
        <p>
            <?php
            echo form_textarea('ini_politicas', $inicio[0]->ini_politicas, 'id="ini_politicas" class="textareasumer"  ');
            ?>
        </p>
        <center>
            <button id="g_politicas" class="btn green">Guardar</button>
        </center>
    </div>
    <h3>Pagina de Inicio</h3>
    <div>
        <p>
            <?php
            echo form_textarea('ini_p_inicio', $inicio[0]->ini_p_inicio, 'id="ini_p_inicio" class="textareasumer" ');
            ?>
        </p>
        <center>
            <button id="g_p_inicio" class="btn green">Guardar</button>
        </center>
    </div>
</div>
<script>
    $('#g_politicas').click(function () {
        var ini_politicas = $('#ini_politicas').code();
        var url = base_url_js + "/index.php/Administrativo/guardar_admin_inicio";
        $.post(url, {ini_politicas: ini_politicas})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        alerta('verde', 'Los Datos Fueron Guardados con Exito');
                    }
                }).fail(function (msg) {
            alerta('rojo', 'Error al Guardar');
        })
    })
    $('#g_p_inicio').click(function () {
        var ini_p_inicio = $('#ini_p_inicio').code();
        var url = base_url_js + "/index.php/Administrativo/guardar_admin_inicio";
        $.post(url, {ini_p_inicio: ini_p_inicio})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        alerta('verde', 'Los Datos Fueron Guardados con Exito');
                    }
                }).fail(function (msg) {
            alerta('rojo', 'Error al Guardar');
        })
    })
</script>






