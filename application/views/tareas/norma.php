<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Normas
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" id="formcargos" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="norma" class="control-label col-md-1">*Norma</label>
                                    <div class="col-md-4">
                                        <input type="text" name="norma" id="norma" class="form-control obligatorio"/>
                                    </div>
                                    <label for="norma" class="control-label col-md-2">Descripción</label>
                                    <div class="col-md-5">
                                        <input type="text" name="descripcion" id="descripcion" class="form-control obligatorio"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-8">
                                        <input type="button" value="Agregar" class="btn btn-block green guardar" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-table"></i>Tabla
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <table class="table table-striped table-bordered table-hover tabla-sst">
                        <thead>
                            <tr>
                                <th>Norma</th>
                                <th>Descripción</th>
                                <th>Numero de Articulos</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_norma">
                            <?php foreach ($norma as $d) { ?>
                                <tr>
                                    <td><?php echo $d->nor_norma ?></td>
                                    <td><?php echo $d->nor_descripcion ?></td>
                                    <td>
                                        <a href="javascript:" class="num_articulos" nor_id="<?php echo $d->nor_id ?>" data-toggle="modal" data-target="#myModal2"><?php echo $d->cantidad_articulos ?></a>
                                    </td>
                                    <td>
                                        <a href="javascript:" class="btn btn-xs default modificar" norma="<?php echo $d->nor_norma ?>" descri="<?php echo $d->nor_descripcion ?>" nor_id="<?php echo $d->nor_id ?>" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-pencil-square-o" title="Modificar"></i>
                                            Modificar
                                        </a>
                                    </td>
                                    <td>
                                        <?php //if ($d->cantidad_articulos == 0): ?>
                                        <a href="javascript:;" class="btn btn-xs default eliminar" nor_id="<?php echo $d->nor_id ?>">
                                            <i class="fa fa-trash-o " title="Eliminar"></i>
                                            Eliminar
                                        </a>
                                        <?php //endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Norma</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-8">
                        <center>
                            <input type="hidden" name="nor_id" id="nor_id">
                            <label for="norma_edi">Norma</label>
                            <input type="text" name="norma_edi" id="norma_edi" class="form-control" />
                            <label for="descripcion_edi">Descripción</label>
                            <input type="text" name="descripcion_edi" id="descripcion_edi" class="form-control" />
                            <br>
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary guardarmodificacion">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Articulos</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-10 data1">
                        <table class="table table-striped table-bordered table-hover tabla-sst">
                            <thead>
                            <th>Articulo</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                            </thead>
                            <tbody id="tabla_articulo"></tbody>
                        </table>
                    </div>
                    <div class="col-sm-offset-2 col-sm-8 data2" style="display: none">
                        <div class="row">
                            <label>Articulo</label>
                        </div><div class="row">
                            <input type="text" class="form-control" id="articulo_mod" name="articulo_mod">
                            <input type="hidden" class="form-control" id="norArt_id" name="norArt_id">
                            <input type="hidden" class="form-control" id="nor_id_articulo" name="nor_id_articulo">
                            <br>
                        </div><div class="row">
                            <button type="button" class="btn btn-primary atras_articulo">Atras</button>
                            <button type="button" class="btn btn-primary guardar_articulo">Guardar</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary nuevo_articulo ">Nuevo</button>
                    <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('body').delegate('.num_articulos', 'click', function () {
        var id = $(this).attr('nor_id');
        $('#nor_id_articulo').val(id);
        $.post(
                url + 'index.php/Tareas/lista_articulos',
                {nor_id: id})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        construccionTabla2(msg);
                    }
                })
                .fail(function () {

                })
    })
    $('body').delegate('.guardar_articulo', 'click', function () {
        var nor_id_articulo = $('#nor_id_articulo').val();
        var norArt_id = $('#norArt_id').val();
        var articulo_mod = $('#articulo_mod').val();
        $.post(
                url + 'index.php/Tareas/actualizar_articulo',
                {nor_id: nor_id_articulo, norArt_id: norArt_id, articulo_mod: articulo_mod})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        construccionTabla2(msg);
                    }
                })
                .fail(function () {

                })
    })
    $('body').delegate('.eliminar_articulo', 'click', function () {
        var norArt_id = $(this).attr('norArt_id');
        var nor_id_articulo = $('#nor_id_articulo').val();
        $.post(url + 'index.php/Tareas/eliminar_articulo',
                {norArt_id: norArt_id, nor_id: nor_id_articulo})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        construccionTabla2(msg);
                    }
                })
                .fail(function () {

                })
    })
    $('body').delegate('.modificar_articulo', 'click', function () {
        $('#articulo_mod').val($(this).attr('norArt_articulo'));
        $('#norArt_id').val($(this).attr('norArt_id'));
        $('.data2').show();
        $('.data1').hide();
    });
    $('body').delegate('.nuevo_articulo', 'click', function () {
        $('#articulo_mod').val('');
        $('#norArt_id').val('');
        $('.data2').show();
        $('.data1').hide();
    });
    $('body').delegate('.atras_articulo', 'click', function () {
        $('.data1').show();
        $('.data2').hide();
    });
    $('body').delegate('.guardar', 'click', function () {
        var norma = $('#norma').val();
        var descripcion = $('#descripcion').val();
        $.post(url + 'index.php/Tareas/crear_norma', 
                {norma: norma, descripcion: descripcion})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        $('#myModal').modal('hide');
                        $('#norma').val('');
                        $('#descripcion').val('');
                        construccionTabla(msg);
                    }
                })
                .fail(function (msg) {
                    alerta("rojo","Error,comunicarse con el administrador");
                })
    })
    $('body').delegate('.modificar', 'click', function () {
        $('#nor_id').val($(this).attr('nor_id'));
        $('#descripcion_edi').val($(this).attr('descri'));
        $('#norma_edi').val($(this).attr('norma'))
    })
    $('body').delegate('.guardarmodificacion', 'click', function () {
        var nor_id = $('#nor_id').val();
        var norma = $('#norma_edi').val();
        var descripcion = $('#descripcion_edi').val();
        $.post(url+'index.php/Tareas/actualizar_norma', 
                {nor_id: nor_id, norma: norma, descripcion: descripcion})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        $('.cerrar').trigger('click')
                        construccionTabla(msg);
                    }
                })
                .fail(function () {

                })
    })
    $('body').delegate('.eliminar', 'click', function () {
        var nor_id = $(this).attr('nor_id');
        $.post(url+'index.php/Tareas/eliminar_norma', 
                {nor_id: nor_id,est_id:3})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        $('.cerrar').trigger('click')
                        construccionTabla(msg);
                    }
                })
                .fail(function () {

                })
    })
    function construccionTabla(msg) {
        $('#tabla_norma *').remove();
        var tabla_norma = "";
        $.each(msg.Json, function (key, val) {
            tabla_norma += "<tr>";
            tabla_norma += "<td>" + val.nor_norma + "</td>";
            tabla_norma += "<td>" + val.nor_descripcion + "</td>";
            tabla_norma += '<td><a href="javascript:" class="num_articulos" nor_id="'+val.nor_norma +'" data-toggle="modal" data-target="#myModal2">' + val.cantidad_articulos + "</a></td>";

            tabla_norma += '<td >';
            tabla_norma += '<a href="javascript:;" class="btn btn-xs default modificar" norma="' + val.nor_norma + '" descri="' + val.nor_descripcion + '" data-toggle="modal" data-target="#myModal" nor_id="' + val.nor_id + '">';
            tabla_norma += '<i class="fa fa-pencil-square-o " title="Modificar" ></i> Modificar';
            tabla_norma += '</a >';
            tabla_norma += '</td>';
            tabla_norma += '<td>';
//            if (val.cantidad_articulos == 0) {
            tabla_norma += '<a href="javascript:;" class="btn btn-xs default eliminar" nor_id="' + val.nor_id + '">';
            tabla_norma += '<i class="fa fa-trash-o" title="Eliminar"></i> Eliminar';
//            }
            tabla_norma += '</a >';
            tabla_norma += '</td>';
            tabla_norma += "</tr>";
        });
        $('#tabla_norma').append(tabla_norma);
        alerta("verde", "Guardado Correctamente");
    }
    function construccionTabla2(msg) {
        $('#tabla_articulo *').remove();
        var tabla_norma = "";
        $.each(msg.Json, function (key, val) {
            tabla_norma += "<tr>";
            tabla_norma += "<td>" + val.norArt_articulo + "</td>";
            tabla_norma += '<td >';
            tabla_norma += '<a href="javascript:;" class="btn btn-xs default modificar_articulo" norArt_articulo="' + val.norArt_articulo + '"  norArt_id="' + val.norArt_id + '">';
            tabla_norma += '<i class="fa fa-pencil-square-o " title="Modificar" ></i> Modificar';
            tabla_norma += '</a >';
            tabla_norma += '</td>';
            tabla_norma += '<td>';
//            if (val.cantidad_articulos == 0) {
            tabla_norma += '<a href="javascript:;" class="btn btn-xs default eliminar_articulo" norArt_id="' + val.norArt_id + '">';
            tabla_norma += '<i class="fa fa-trash-o" title="Eliminar"></i> Eliminar';
//            }
            tabla_norma += '</a >';
            tabla_norma += '</td>';
            tabla_norma += "</tr>";
        });
        $('#tabla_articulo').append(tabla_norma);
        alerta("verde", "Información Correctamente");
        $('.data1').show();
        $('.data2').hide();
    }
</script>