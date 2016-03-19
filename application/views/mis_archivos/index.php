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
                        <div class="col-md-12">
                            <button class="btn btn-info" title="Subir Documento"><i class="fa fa-arrow-up"></i></button>
                            <button class="btn btn-info" title="Nueva Carpeta" data-toggle="modal" data-target="#myModal"><i class="fa fa-folder-open-o"></i></button>
                            <div style="display:none ">
                                <input type="text" name="id_carpeta" id="id_carpeta" value="<?php echo $carpeta[0]->carDoc_id_padre ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row genera_carpeta">
                        <?php
                        $i = 0;
                        foreach ($carpeta as $value) {
                            if (!empty($value->carDoc_id_padre) && $i == 0) {
                                $i++;
                                ?>
                                <div class="col-md-1 carpeta_atras">  
                                    <br>
                                    <i class="fa fa-folder-o fa-5x"></i>
                                    <br>...
                                </div>
                            <?php } ?>
                            <div class="col-md-1 carpeta_seccion" toma="<?php echo $value->carDoc_id; ?>">  
                                <br>
                                <i class="fa fa-folder-o fa-5x"></i>
                                <br><span><?php echo $value->carDoc_nombre ?></span>
                            </div>
                        <?php } ?>
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
                    <div class="col-md-3">Nombre Carpeta</div>
                    <div class="col-md-5"><input type="text" class="form-control" id="nueva_carpeta"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default guardar_carpeta" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

<script>
    $('.carpeta_seccion').click(function(){
        $('.carpeta_seccion span').each(function(){
            $(this).css('background-color','');
        })
        $(this ' span').css('background-color','#2d5f8b');
    })
    $('.guardar_carpeta').click(function () {
        var url = "<?php echo base_url('index.php/Mis_archivos/new_folder'); ?>"
        $.post(url, {id_carpeta: $('#id_carpeta').val(), nueva_carpeta: $('#nueva_carpeta').val()})
                .done(function (msg) {
                    llenar_carpetas(msg)
                })
                .fail(function () {
                    alerta('Error al guardar');
                })
    })

    function llenar_carpetas(msg) {
        var html = "";
        var i=0;
        console.log(msg);
        $.each(msg.Json, function (key, val) {
            console.log(val);
            if(val.carDoc_id_padre!=null && i == 0){
                i++;
                html += '<div class="col-md-1 carpeta_atras"><br><i class="fa fa-folder-o fa-5x"></i><br><span>...</span></div>';
            }
            html += '<div class="col-md-1 carpeta_seccion" toma="' + val.carDoc_id + '">  '
            html += '<br>'
            html += '<i class="fa fa-folder-o fa-5x"></i>'
            html += '<br><span>' + val.carDoc_nombre+'</span>'
            html += '</div>'
        })
        alert(html)
        $('.genera_carpeta').html(html);
    }
</script>