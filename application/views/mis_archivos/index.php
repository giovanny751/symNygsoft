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
                    <div class="row" id="panel" tipo="1">
                        <div class="col-md-4">
                            <input type="file" id="documento3" name="files[]" required="required" class="obligatorioArchivo"  >
                            <button class="btn btn-info" title="Subir Documento" id="procesar"><i class="fa fa-arrow-up"></i></button>
                            <button class="btn btn-info" title="Nueva Carpeta"  id="crearCarpeta"><i class="fa fa-folder-open-o"></i></button>
                        </div>
                        <div class="col-md-4"></div>
                        <div style="display: " class="col-md-4">
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="carpetas" id="carpetas" class="form-control placeholder-no-fix" value="">
                                    <input type="hidden" name="id_carpeta" id="id_carpeta" class="form-control placeholder-no-fix" value="<?php echo (!empty($carpeta[0]->carDoc_id_padre))?$carpeta[0]->carDoc_id_padre:""; ?>">
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
                                    if ($d == 1):
                                        ?>
                                        <div class="form-group">
                                            <?php
                                        endif;
                                        if (!empty($value->idpadre) && $i == 0) :
                                            $i++;
                                            ?>
                                            <div class="col-md-1 carpeta_atras">  
                                                <i class="fa fa-folder-o fa-4x"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-md-1 carpeta_seccion" tipo="2" toma="<?php echo $value->nombre; ?>">  
                                            <br>
                                            <i class="fa fa-folder-o fa-4x"></i>
                                            <br><span class="nombreDocumento"><?php echo $value->carDoc_nombre ?></span>
                                        </div>
                                        <?php
                                        $d++;
                                        if ($d == 13):
                                            ?>
                                        </div>
                                        <?php
                                        $d = 1;
                                    endif;
                                endforeach;
                                ?>
                                <?php
                                $i = 0;
                                $d = 1;
                                foreach ($documentos as $value) :
                                    if ($d == 1):
                                        ?>
                                        <div class="form-group">
                                            <?php
                                        endif;
                                        ?>
                                        <div class="col-md-1 carpeta_seccion" tipo="2" toma="<?php echo $value->carDoc_id; ?>">  
                                            <br>
                                            <i class="fa fa-cube fa-4x"></i>
                                            <br><span class="nombreDocumento"><?php echo $value->repDoc_nombre ?></span>
                                        </div>
                                        <?php
                                        $d++;
                                        if ($d == 13):
                                            ?>
                                        </div>
                                        <?php
                                        $d = 1;
                                    endif;
                                endforeach;
                                ?>
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
<div id="myMenu1" class="contextMenu" style="display: none">

    <ul>

        <li id="open"><img src="folder.png" /> Open</li>

        <li id="email"><img src="email.png" /> Email</li>

        <li id="save"><img src="disk.png" /> Save</li>

        <li id="close"><img src="cross.png" /> Close</li>

    </ul>

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
    body{
        font: normal 13px Tahoma, Verdana, Arial, sans-serif;
        padding: 0;
        margin: 0;
    }

    h1{
        text-align: center;
        padding: 20px 0;
    }
    p{
        text-align: justify;
        padding: 5px;
    }

    #divContenedor{
        position: absolute;
        width: 700px;
        left: 50%;
        margin-left: -350px;
        top: 40px;
        z-index: 1;
        background: #fff;
    }
    #divCoordenadas{
        border: solid 1px #ccc;
        padding: 10px;
        width: 200px;
        text-align: center;
        border-radius: 5px;
        box-shadow: 1px 1px 10px #c0c0c0;
        float: left;
    }
    #divScroll{
        border: solid 1px #ccc;
        border-radius: 5px;
        height: 400px;
        padding: 10px;
        overflow-y: scroll;
        margin: 20px 0;
        box-shadow: 1px 1px 10px #c0c0c0;
    }
    #divEstado{
        width: 200px;
        padding: 10px;
        border: solid 1px #ccc;
        border-radius: 5px;
        box-shadow: 1px 1px 10px #c0c0c0;
        float: right;
        text-align: center;
    }

    #divMenu{
        position: absolute;
        width: 200px;
        border: solid 1px #ccc;
        border-radius: 5px;
        box-shadow: 1px 1px 10px #c0c0c0;
        display: none;
        padding: 10px;
        background: #fff;
        z-index: 100;
    }
    #divMenu ul{
        padding: 0;
        margin: 0;
        list-style-type: none;
    }
    #divMenu ul li{
        padding: 7px;
        cursor: pointer;
    }
    #divMenu ul li:hover{
        background: #ccc;
        border-radius: 3px;
    }
    .clsSalto{
        clear: both;
    }
</style>
<div id="divMenu"></div>
<script>
    $('#procesar').click(function () {
        if (obligatorio('obligatorioArchivo')) {
            var file_data = $('#documento3').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('carpeta', $('#id_carpeta').val());

            var fullPath = document.getElementById('documento3').value;
            if (fullPath) {
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
            }
            $.ajax({
                url: url + 'index.php/Mis_archivos/subir_archivo',
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (data) {
                    $('#resultados').html(data)
                }
            });
        }
    });


    $('html').click(function () {
        $('#divMenu').css({
            display: 'none'
        });
    });
//manejador de evento para el clic derecho (contextmenu)
    $(document).on('contextmenu', function (e) {
        //evitamos que aparezca el menu predeterminado del navegador (si, asi se "bloquea")
        e.preventDefault();
    });

    $(document).ready(function () {
        //manejador de evento para el clic derecho (contextmenu)
        $(document).on('contextmenu', '.carpeta_seccion,#panel', function (e) {
            $('#divMenu *').remove();
            var opciones = '<ul>';
            if ($(this).attr('tipo') == 2)
                opciones += '<li class="opciones" at="editar">Editar</li><li at="eliminar" class="opciones">Eliminar</li>';
            if ($(this).attr('tipo') == 1)
                opciones += '<li class="opciones" at="crearCarpeta">Crear Carpeta</li><li at="subirArchivo" class="opciones">Subir Archivo</li>';
            opciones += "</ul>";

            $('#divMenu').append(opciones);
            $('#divMenu ul li').attr("archivo", $(this).attr('toma'))
            e.preventDefault();
            //volvemos a obtener las coordenadas del raton en el documento
            var iX = e.pageX, iY = e.pageY;
            //mostramos nuestro menu contextual en la ubicacion X e Y del puntero del raton
            $('#divMenu').css({
                display: 'block',
                left: iX,
                top: iY - 47
            });
        });

        //evento cuando hacemos clic en un elemento (li) de la lista (ul)
        $('body').delegate(".opciones", "click", function () {
            var opcion = $(this).attr('at');
            var archivo = $(this).attr('archivo');
            if (opcion == 'editar') {
                $.post(
                        url + "index.php/Mis_archivos/consultaCarpetaId",
                        {archivo: archivo}
                ).done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        $('#nueva_carpeta').val(msg.Json.carDoc_nombre);
                        $('.guardar_carpeta').replaceWith('<button type="button" class="btn btn-info" id="actualizar" idCarpeta="' + msg.Json.carDoc_id + '" data-dismiss="modal">Actualizar</button>');
                        $('#myModal').modal('show');
                    }
                }).fail(function (msg) {
                    alerta("rojo", "Error comunicarse con el administrador");
                });

            } else if (opcion == "eliminar") {
                if (confirm("¿Esta seguro de eliminar la carpeta?"))
                {
                    $.post(
                            url + "index.php/Mis_archivos/eliminarCarpeta",
                            {archivo: archivo}
                    ).done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message)) {
                            alerta(msg.color, msg['message'])
                            if (msg.color == 'verde')
                                $('.carpeta_seccion[toma="' + archivo + '"]').remove();
                        }
                    }).fail(function (msg) {
                        alerta("rojo", "Error comunicarse con el administrador");
                    });
                }
            } else if (opcion == "crearCarpeta") {
                nuevaCarpeta();
            }
        });

    });

    $('body').delegate("#actualizar", "click", function () {
        carpeta = $(this).attr('idCarpeta');
        nombreCarpeta = $('#nueva_carpeta').val();
        $.post(
                url + "index.php/Mis_archivos/actualizarArchivo",
                {
                    idArchivo: carpeta,
                    nombreArchivo: nombreCarpeta
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta(msg.color, msg['message'])
            else {
                $('.carpeta_seccion[toma="' + carpeta + '"] span').text(nombreCarpeta);
            }
        }).fail(function (msg) {

        });
        $('#nueva_carpeta').modal('hide');
    });

    $('#crearCarpeta').click(function () {
        nuevaCarpeta();
    });
    function nuevaCarpeta() {
        $('#nueva_carpeta').val('');
        $('#actualizar').replaceWith('<button type="button" class="btn btn-success guardar_carpeta" data-dismiss="modal">Guardar</button>');
        $('#myModal').modal('show');
    }
    $('body').delegate('.carpeta_seccion, .carpeta_atras', 'click', function () {
        $('.carpeta_seccion span').each(function () {
            $(this).css('background-color', '');
        });
        $('.carpeta_atras span').each(function () {
            $(this).css('background-color', '');
        });
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
    $('body').delegate(".guardar_carpeta", "click", function () {
        var url = "<?php echo base_url('index.php/Mis_archivos/new_folder'); ?>";
        var toma = $('#id_carpeta').val();
        $.post(url, {IdCarpetaPadre: $('#id_carpeta').val(), nueva_carpeta: $('#nueva_carpeta').val()})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        llenar_carpetas(msg, toma)
                    }
                })
                .fail(function () {
                    alerta("rojo", 'Error comunicarse con el administrador');
                })
    })

    function llenar_carpetas(msg, toma) {
        var i = 0;
        var d = 1;
        html = "<div class='form-horizontal'>";
        html += "<div class='col-md-12'>";
        html += '<div class="col-md-1 carpeta_atras" toma=""><br><i class="fa fa-folder-o fa-4x"></i><br><span>...</span></div>';
        padre = null;
        $.each(msg.Json, function (key, val) {
            if (d == 1) {
                html += "<div class='form-group'>";
            }
            i++;
            padre = val.carDoc_id_padre;
            html += '<div class="col-md-1 carpeta_seccion" toma="' + val.carDoc_id + '">  ';
            html += '<br>';
            html += '<i class="fa fa-folder-o fa-4x"></i>';
            html += '<br><span>' + val.carDoc_nombre + '</span>';
            html += '</div>';
            d++;
            if (d == 13) {
                html += "</div>";
                d = 1;
            }
        });
        html += "</div>"
        html += "</div>"
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