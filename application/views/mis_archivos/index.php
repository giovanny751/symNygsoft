<br>
<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon guardar" title="Guardar dimension" metodo="guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="glyphicon glyphicon-ok"></i> Mis archivos
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-info" title="Subir Documento"><i class="fa fa-arrow-up"></i></button>
                            <button class="btn btn-info" title="Nueva Carpeta"  id="crearCarpeta"><i class="fa fa-folder-open-o"></i></button>

                        </div>
                        <div class="col-md-4"></div>
                        <div style="display: " class="col-md-4">
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="id_carpeta" id="id_carpeta" class="form-control placeholder-no-fix" value="<?php echo $carpeta[0]->carDoc_id_padre ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row genera_carpeta">
                        <div class="form-horizontal">
                            <div class="col-md-12">
                                    <?php
                                    $i = 0;
                                    $d = 1;
                                    foreach ($carpeta as $value) :
                                        if($d == 1): ?>
                                            <div class="form-group">
                                        <?php endif;
                                        if (!empty($value->carDoc_id_padre) && $i == 0) :
                                            $i++;
                                            ?>
                                            <div class="col-md-1 carpeta_atras">  
                                                <i class="fa fa-folder-o fa-4x"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-md-1 carpeta_seccion" toma="<?php echo $value->carDoc_id; ?>">  
                                            <br>
                                            <i class="fa fa-folder-o fa-4x"></i>
                                            <span class="nombreDocumento"><?php echo $value->carDoc_nombre ?></span>
                                        </div>
                                    <?php 
                                    $d++;
                                     if($d == 13): ?>
                                                </div>
                                     <?php  
                                     $d = 1;
                                     endif;
                                    endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nueva Carpeta</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3" for="nueva_carpeta">Nombre Carpeta</label>
                            <div class="col-md-9"><input type="text" class="form-control" id="nueva_carpeta"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success guardar_carpeta" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<style>
    .carpeta_seccion{
        cursor: pointer;
    }
    .carpeta_seccion:hover{
        border-style: dotted;
        border-width: 1px;
        background-color: #EFF4FA;
    }
</style>
<script>

    $('#crearCarpeta').click(function () {
        $('#nueva_carpeta').val('');
        $('#myModal').modal('show');
    });
    $('body').delegate('.carpeta_seccion, .carpeta_atras', 'click', function () {
        $('.carpeta_seccion span').each(function () {
            $(this).css('background-color', '');
        })
        $('.carpeta_atras span').each(function () {
            $(this).css('background-color', '');
        })
        $(this).children('span').css('background-color', '#2d5f8b');
    })
    $('body').delegate('.carpeta_seccion', 'dblclick', function () {
        var url = "<?php echo base_url('index.php/Mis_archivos/traer_folder'); ?>"
        var toma = $(this).attr('toma');
        $.post(url, {id_carpeta: $(this).attr('toma')})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        llenar_carpetas(msg, toma);
                    }
                })
                .fail(function () {
                    alerta('Error al guardar');
                })
    });
    $('body').delegate('.carpeta_atras', 'dblclick', function () {
        var url = "<?php echo base_url('index.php/Mis_archivos/traer_atras'); ?>"
        var toma = $(this).attr('toma');
        $.post(url, {id_carpeta: $(this).attr('toma')})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        llenar_carpetas(msg, toma);
                    }
                })
                .fail(function () {
                    alerta('Error al guardar');
                })
    });
    $('.guardar_carpeta').click(function () {
        var url = "<?php echo base_url('index.php/Mis_archivos/new_folder'); ?>";
        var toma = $('#id_carpeta').val();
        $.post(url, {id_carpeta: $('#id_carpeta').val(), nueva_carpeta: $('#nueva_carpeta').val()})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        llenar_carpetas(msg, toma)
                    }
                })
                .fail(function () {
                    alerta('Error al guardar');
                })
    })

    function llenar_carpetas(msg, toma) {
        var html = "";
        var i = 0;
        html += '<div class="col-md-1 carpeta_atras" toma=""><br><i class="fa fa-folder-o fa-4x"></i><br><span>...</span></div>';
        padre = null;
        $.each(msg.Json, function (key, val) {
            i++;
            console.log(val.carDoc_id_padre)
            padre = val.carDoc_id_padre;
            html += '<div class="col-md-1 carpeta_seccion" toma="' + val.carDoc_id + '">  '
            html += '<br>'
            html += '<i class="fa fa-folder-o fa-4x"></i>'
            html += '<br><span>' + val.carDoc_nombre + '</span>'
            html += '</div>'
        });
        $('.genera_carpeta').html(html);
        if (padre == null && i == 0) {
            $('#id_carpeta').val(toma)
            $('.carpeta_atras').attr('toma', toma)
        } else if (padre == null) {
            $('.carpeta_atras').hide();
            $('#id_carpeta').val('')
        } else {
            $('.carpeta_atras').attr('toma', padre)
            $('#id_carpeta').val(padre)
        }

    }
</script>