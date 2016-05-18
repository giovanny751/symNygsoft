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
                            <button class="btn btn-info subir_documento" title="Subir Documento"  data-toggle="modal" data-target="#myModal_cargue"><i class="fa fa-arrow-up"></i></button>
                            <button class="btn btn-info" title="Nueva Carpeta"  id="crearCarpeta"><i class="fa fa-folder-open-o"></i></button>
                        </div>
                        <div class="col-md-4">
                            <div form-group>
                                <label for="ordenar" class="col-md-4">Ordenar</label>
                                <div class='col-md-8'>
                                    <select id="ordenar" class='form-control'>
                                        <option value=''>::Seleccionar::</option>
                                        <option value="1">Ascendente</option>
                                        <option value="2">Descendente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="display: " class="col-md-4">
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="carpetas" id="carpetas" class="form-control placeholder-no-fix" value="">
                                    <input type="hidden" name="id_carpeta" id="id_carpeta" class="form-control placeholder-no-fix" value="<?php echo (!empty($carpeta[0]->carDoc_id_padre)) ? $carpeta[0]->carDoc_id_padre : ""; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-horizontal">
                            <div class="col-md-4">
                                <div class="carpetas" style="padding-left: 10px">
                                    <li>
                                        <div toma="" tipo="2" name_folder="actas" activo="0" class="recurso_sele2" recarga="1">
                                            <img width="20px" src="<?php echo base_url(); ?>uploads/icon/carpeta.png"> &nbsp;&nbsp;&nbsp;
                                            Mis Archivos
                                        </div>
                                        <ul at='1'>
                                            <?php foreach ($carpetas as $value) { ?>
                                                <li>
                                                    <div class="recurso_sele2" activo="0" name_folder="<?php echo $value->nombre ?>" tipo="2" toma="<?php echo $value->idCarpeta ?>" style="" color="#000">
                                                        <img width="20px" src="<?php echo base_url(); ?>uploads/icon/carpeta.png"> &nbsp;&nbsp;&nbsp;
                                                        <?php echo $value->nombre; ?>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>

                                </div>
                                <input type="hidden" id="carpeta_selec" name="carpeta_selec">
                                <br><p>
                            </div>
                            <div class="col-md-8">
                                <div class="row genera_carpeta">
                                    <div class="col-md-12">
                                        <?php
                                        $i = 0;
                                        $d = 1;
                                        foreach ($documentos as $value) :
                                            if ($d == 1):
                                                ?>
                                                <div class="form-group">
                                                    <?php
                                                endif;
                                                if (!empty($value['idpadre']) && $i == 0) :
                                                    $i++;
                                                    ?>
                                                    <div class="col-md-1 carpeta_atras">  
                                                        <i class="fa fa-folder fa-4x"></i>
                                                    </div>
                                                    <?php
                                                endif;
                                                $tipo = 3;
                                                if ($value['extension'] == "carpeta") {
                                                    $tipo = 2;
                                                }
                                                ?>
                                                <div class="col-md-1 carpeta_seccion" title="<?php echo $value['nombre'] ?>  <?php echo!empty($value['carDoc_descripcion']) ? ":" . $value['carDoc_descripcion'] : '' ?>" tipo="<?php echo $tipo; ?>" toma="<?php echo $value['carDoc_id']; ?>" archivoId="<?php echo $value['archivoId']; ?>">  
                                                    <br>
                                                    <?php if ($value['extension'] == "carpeta") { ?>
                                                        <img  src='<?php echo base_url('uploads/icon') . "/carpeta.png" ?>'   width='40px'>
                                                    <?php } else { ?>
                                                        <img src='<?php echo base_url('uploads/icon') . "/" . $value['extension'] . ".png" ?>'  onerror="this.src='<?php echo base_url() ?>uploads/icon/nn.png'" width='40px'>
                                                    <?php } ?>
                                                    <br>
                                                    <span class="nombreDocumento" style="font-size: 11px">
                                                        <?php
                                                        if (strlen($value['nombre']) > 13) {
                                                            $re = substr($value['nombre'], 0, 13);
                                                            echo $re . '...';
                                                        } else {
                                                            echo $value['nombre'];
                                                        }
                                                        ?>
                                                    </span>
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
                            <div class="col-md-9"><input type="text" class="form-control" id="nueva_carpeta"><br></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3" for="nueva_carpeta">Descripción</label>
                            <div class="col-md-9"><textarea class="form-control" name="descripcion" id="descripcion"></textarea></div>
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
<div id="myModal_cargue" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nuevo Documento.</h4>
            </div>
            <div class="modal-body">
                <p><input type="file" id="documento3" name="files[]" required="required" class="obligatorioArchivo"  ></p>
                <input type="hidden" id="nueva_version">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="procesar">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>
<div id="myModal_cargue2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Otras Versiones.</h4>
            </div>
            <div class="modal-body">
                <div id="otras_versiones"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>
<div id="myMenu1" class="contextMenu" style="display: none"></div>
<style>
    .carpetaSeleccionada{
        border-style: dotted;
        border-width: 1px;
        background-color: #EFF4FA;
    }
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

    $('body').delegate('.subir_documento', 'click', function () {
        $('#nueva_version').val('');
    })
    $('body').delegate('.recurso_sele2', 'click', function () {
        var toma = $(this).attr('toma');
        if ($('#carpeta_selec').val() != toma)
            obtener_doc(toma);
    });
    $('body').on('click', '.recurso_sele2', function () {
        if ($(this).next().attr('style') == 'display:none') {
            $(this).next().attr('style', 'display')
        } else {
            $(this).next().attr('style', 'display:none')
        }
        colorear()
        $(this).css('color', '#FFF')
        $(this).css('background', '#008Ac9');
        $(this).attr('activo', '1');
        var id = $(this).attr('toma');
        $('#carpeta_selec').val(id);
        if ($(this).attr('recarga') == 1)
            return false;
        var apuntador = $(this)
        $.post(url + "index.php/Mis_archivos/carpetas_2", {id: id})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        var html = "<ul at='1'>";
                        $.each(msg, function (key, val) {
                            html += "<li>";
                            html += '<div class="recurso_sele2" tipo="2" activo="0" name_folder="' + val.nombre + '" toma="' + val.idCarpeta + '" >';

                            html += '<img width="20px" src="<?php echo base_url(); ?>uploads/icon/carpeta.png"  > &nbsp;&nbsp;&nbsp;';
                            html += val.nombre;
                            html += '';
                            html += "</div>";
                            html += "</li>";
                        })
                        html += "</ul>";
                        apuntador.attr('recarga', '1')
                        apuntador.parent().append(html);
                    }
                })
                .fail(function () {
                    alerta('rojo', ' Error en la consulta');
                })

    })
    $('#ordenar').change(function () {
        if ($(this).val() != "") {
            $.post(
                    url + "index.php/Mis_archivos/ordenamiento",
                    {
                        padre: $('#id_carpeta').val(),
                        orden: $(this).val()
                    }
            ).done(function (msg) {
//                var id_carpeta=$('#id_carpeta').val();
                llenar_carpetas(msg, msg.carpetaPadre);
//                $('#id_carpeta').val(id_carpeta);
            })
                    .fail(function (msg) {
                        alerta("rojo", "Error comunicarse con el administrador");
                    });
        }
    });
    $('#procesar').click(function () {
        if (obligatorio('obligatorioArchivo')) {
            var file_data = $('#documento3').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('nueva_version', $('#nueva_version').val());
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
                success: function (msg) {
                    //                    $('#resultados').html(data);
                    $('#documento3').val('')
                    $('#myModal_cargue').modal('hide');
                    console.log(msg.carpetaPadre);
                    llenar_carpetas(msg, msg.carpetaPadre);
                }
            });
        }
    });


    $('html').click(function () {
        $('.carpetaSeleccionada').removeClass('carpetaSeleccionada');
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
            $('.carpetaSeleccionada').removeClass('carpetaSeleccionada');
            if ($(this).hasClass('carpeta_seccion')) {
                $(this).addClass('carpetaSeleccionada');
            }
            $('#divMenu *').remove();
            var opciones = '<ul>';
            if ($(this).attr('tipo') == 3) {
                opciones += '<li class="opciones" at="descargar">Descargar</li><li at="eliminar" class="opciones">Eliminar</li><li at="new_version" class="opciones" data-toggle="modal" data-target="#myModal_cargue">Nueva Versión</li><li at="oter_version" class="opciones" data-toggle="modal" data-target="#myModal_cargue2">Otras Versiones</li>';
                $('#nueva_version').val($(this).attr('archivoid'));
            }
            if ($(this).attr('tipo') == 2)
                opciones += '<li class="opciones" at="editar">Editar</li><li at="eliminar" class="opciones">Eliminar</li>';
            if ($(this).attr('tipo') == 1)
                opciones += '<li class="opciones" at="crearCarpeta">Crear Carpeta</li><li at="subirArchivo" class="opciones" data-toggle="modal" data-target="#myModal_cargue">Subir Archivo</li>';
            opciones += "</ul>";

            $('#divMenu').append(opciones);
            if ($(this).attr('tipo') == 2)
                $('#divMenu ul li').attr("archivo", $(this).attr('toma'))
            if ($(this).attr('tipo') == 3)
                $('#divMenu ul li').attr("archivo", $(this).attr('archivoid'))

            $('#divMenu ul li').attr("tipo", $(this).attr('tipo'))

            e.preventDefault();
            //volvemos a obtener las coordenadas del raton en el documento
            var iX = e.pageX, iY = e.pageY;
            //mostramos nuestro menu contextual en la ubicacion X e Y del puntero del raton
            $('#divMenu').css({
                display: 'block',
                left: iX,
                top: iY - 47});
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
                        $('#descripcion').val(msg.Json.carDoc_descripcion);
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
                            {
                                archivo: archivo,
                                tipo: $(this).attr('tipo'),
                                IdCarpetaPadre: $('#id_carpeta').val()
                            }
                    ).done(function (msg) {
                        mensaje = jQuery.parseJSON(msg);
                        alerta(mensaje.color, mensaje.message)
                        $('.carpeta_seccion[toma="' + archivo + '"]').remove();
                        llenar_carpetas(msg, msg.carpetaPadre);
                    }).fail(function (msg) {
                        alerta("rojo", "Error comunicarse con el administrador");
                    });
                }
            } else if (opcion == "oter_version") {
                oter_version();
            } else if (opcion == "new_version") {

            } else if (opcion == "subirArchivo") {
                $("#nueva_version").val('')
            } else if (opcion == "crearCarpeta") {
                nuevaCarpeta();
            } else if (opcion == 'descargar') {
                if ($(this).attr('tipo') == '3') {
                    $('#carpeta_descarga').val($(this).attr('archivo'));
                    $('#form_descarga').submit();
                }
            }
        });

    });
    $('body').delegate('.descarga_doc', 'click', function () {
        $('#carpeta_descarga').val($(this).attr('id_doc'));
        $('#form_descarga').submit();
    })
    function oter_version() {

        $.post(url + "index.php/Mis_archivos/oter_version", {id: $("#nueva_version").val()})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message)) {
                        alerta("rojo", msg['message'])
                        $('#myModal_cargue2').modal('hide');
                    } else {
                        var html = '';
                        $.each(msg['Json'], function (key, val) {

                            img = "'<?php echo base_url() ?>uploads/icon/nn.png'";
                            img = 'onerror="this.src=' + img + '"';
                            var r = val.nombre;
                            var tipo = 3;
                            icons = "<a href='javascript:'><img src='" + url + 'uploads/icon/' + val.repDoc_extension + ".png' class='descarga_doc' id_doc='" + val.repDoc_id + "' width='40px' " + img + "  ></a>";
                            html += "<div class='row'>";
                            html += "<div class='col-md-12'>";
                            html += "<div class='col-md-3'>";
                            html += icons;
                            html += "</div>";
                            html += "<div class='col-md-9'>";
                            html += "Nombre: " + val.repDoc_nombre;
                            html += "<br>Extencion: " + val.repDoc_extension;
                            html += "<br>Tamaño: " + val.repDoc_tamano;
                            html += "<br>Usuario Modificador: " + (val.usu_nombre == null ? val.uno + " " + val.dos : val.usu_nombre + " " + val.usu_apellido);
                            html += "<br>Fecha Modificación: " + (val.modificationDate == null ? val.creatorDate : val.modificationDate);
                            html += "</div>";
                            html += "</div>";
                            html += "</div>";
                            html += "<div class='row'><hr>";
                            html += "</div>";
                        })
                        $('#otras_versiones').html(html)
                    }
                })
                .fail(function () {

                })
    }

    $('body').delegate("#actualizar", "click", function () {
        carpeta = $(this).attr('idCarpeta');
        nombreCarpeta = $('#nueva_carpeta').val();
        descripcion = $('#descripcion').val();
        $.post(
                url + "index.php/Mis_archivos/actualizarArchivo",
                {
                    idArchivo: carpeta,
                    descripcion: descripcion,
                    nombreArchivo: nombreCarpeta}
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
            $(this).css('color', '#000');
        });
        $('.carpeta_atras span').each(function () {
            $(this).css('background-color', '');
            $(this).css('color', '#000');
        });
        $(this).children('span').css('background-color', '#2d5f8b');
        $(this).children('span').css('color', '#FFF');
        $(this).children('span').css('color', '#FFF');
    })

    $('body').delegate('.carpeta_seccion', 'dblclick', function () {
        var toma = $(this).attr('toma');
        obtener_doc(toma);
    });
    function obtener_doc(toma) {
        if (toma)
            $.post(url + 'index.php/Mis_archivos/traer_folder', {IdCarpetaPadre: toma})
                    .done(function (msg) {
                        message = jQuery.parseJSON(msg);
                        if (!jQuery.isEmptyObject(message.message))
                            alerta("rojo", msg['message'])
                        else {
                            console.log(toma)
                            llenar_carpetas(msg, toma);
                        }
                    })
                    .fail(function () {
                        alerta('Error al guardar');
                    })
    }
    $('body').delegate('.carpeta_atras', 'dblclick', function () {
        colorear();
        $('#carpeta_selec').val('-');
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
        $.post(url, {IdCarpetaPadre: $('#id_carpeta').val(), descripcion: $('#descripcion').val(), nueva_carpeta: $('#nueva_carpeta').val()})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        llenar_carpetas(msg, toma)
                    }
                }).fail(function () {
            alerta("rojo", 'Error comunicarse con el administrador');
        })
    })

    function llenar_carpetas(msg, toma) {
        var i = 0;
        var d = 1;
        msg = jQuery.parseJSON(msg);
        toma = msg.carpetaPadre;
        html = "<div class='form-horizontal'>";
        html += "<div class='col-md-12'>";
        if (toma && toma != 0 && toma != "0" && toma != "") {
            d = 2;
            html += "<div class='form-group'>";
            html += '<div class="col-md-1 carpeta_atras" toma="">\n\
                                <br>\n\
                                    <img src="' + url + "uploads/icon/carpetaVerde.png" + '" width="40px">\n\
                                        <br><span style="font-size: 11px">Atrás</span> \n\
               </div>';
        }
        $.each(msg.Json, function (key, val) {
            var icons = "";
            img = "'<?php echo base_url() ?>uploads/icon/nn.png'";
            img = 'onerror="this.src=' + img + '"';
            var r = val.nombre;
            var tipo = 3;
            if (val.extension != "carpeta") {
                icons = "<img src='" + url + 'uploads/icon/' + val.extension + ".png' width='40px' " + img + "  >";
            } else {
                tipo = 2;
                icons = "<img src='" + url + "uploads/icon/carpeta.png' width='40px' " + img + " >";
            }

            if (d == 1) {
                html += "<div class='form-group'>";
            }
            i++;
            padre = val.idpadre;
            //            html += '<div class="col-md-1 carpeta_seccion" toma="' + val.idCarpeta + '">  ';
            html += '<div class="col-md-1 carpeta_seccion" title="' + r + ' ' + (val.carDoc_descripcion != null ? (val.carDoc_descripcion != 0 ? ": " + val.carDoc_descripcion : '') : '') + '" tipo="' + tipo + '" toma="' + val.carDoc_id + '" archivoId="' + val.archivoId + '">';
            html += '<br>';
            html += icons;
            if (r.length > 13)
                var res = r.substring(0, 13);
            else
                var res = r + "...";
            html += '<br><span style="font-size: 11px">' + res + '</span>';
            html += '</div>';
            d++;
            if (d == 13) {
                html += "</div>";
                d = 1;
            }
        });
        html += "</div>";
        html += "</div>";
        $('.genera_carpeta').html(html);
        if (toma != null) {
            $('#id_carpeta').val(toma)
            $('.carpeta_atras').attr('toma', toma)
        } else if (toma == null) {
            $('.carpeta_atras').hide();
            $('#id_carpeta').val('')
        } else {
            $('.carpeta_atras').attr('toma', padre)
            $('#id_carpeta').val(padre)
        }

    }


    function colorear() {
        $('.recurso_sele2').each(function () {
            $(this).css('background', '#FFF')
            $(this).css('color', '#000')
            $(this).attr('color', '#000')
            $(this).attr('activo', '0');
        })
    }
    $(function () {
        $(document).tooltip();
    });
</script>
<form action="<?php echo base_url('index.php/Mis_archivos/descarga') ?>" method="post" target="_black" id="form_descarga">
    <input id="carpeta_descarga" name="carpeta_descarga" type="hidden">
</form>
<style>

    .recurso_sele2 {
        /*border: 1px solid #72b8f2;*/
        border-radius: 7px;
        margin: 4px;
        padding: 4px;
        /*background: #89c4f4;*/
        width: 50%;
        /*color:#FFF;*/
    }

    .recurso_sele2 i{
        float: right
    }
    .carpetas span{
        color: yellow;
    }
    .recurso_sele2:hover{
        border: 1px solid #72b8f2;
        background: #89c4f4;
    }
    #formulario_documento2 {
        background-color: white !important;
        border: 2px solid #337ab7 !important;
        color: gray;
    }
    .nombreDocumento{
        padding: 5px;
    }
</style>