<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i><?= $title ?>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cargo" class="control-label col-md-3">* Cargo</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control obligatorio texto" name="cargo" id="cargo" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cargojefe" class="control-label col-md-3">Cargo jefe directo</label>
                                    <div class="col-md-9">
                                        <select name="cargojefe" id="cargojefe" class="form-control select2me" >
                                            <option value=""></option>
                                            <?php foreach ($cargo as $d) { ?>
                                                <option value="<?php echo $d->car_id ?>"><?php echo $d->car_nombre ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="porcentaje" class="control-label col-md-3">* %Cotizacion ARL</label>
                                    <div class="col-md-9">
                                        <input type="text" name="porcentaje" id="porcentaje" class="form-control obligatorio number2 texto" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-10 col-md-2">
                                <input type="button" value="Agregar" class="btn btn-block green guardarcargo" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Datatable -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-table"></i>Tabla
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="Abrir/Cerrar"></a>
                    <a href="javascript:;" class="reload" data-original-title="Recargar"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <table class="table table-striped table-bordered table-hover tabla-sst">
                        <thead>
                            <tr>
                                <th>Cargo</th>
                                <th>Cargo Jefe Directo</th>
                                <th>% Cotización ARL</th>
                                <th>Riesgos</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="bodycargo">
                            <?php foreach ($cargo as $c) { ?>
                                <tr>
                                    <td><?php echo $c->car_nombre ?></td> 
                                    <td><?php echo $c->jefe ?></td> 
                                    <td style="text-align:center;"><?php echo $c->car_porcentajearl ?></td> 
                                    <td style="text-align: center">
                                        <?php if ($c->cantidadRiesgos > 0): ?>
                                            <i class="fa fa-child fa-2x riesgo " title="Eliminar" car_id="<?php echo $c->car_id ?>" ></i>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs default modificar" car_id="<?php echo $c->car_id ?>">
                                            <i class="fa fa-pencil-square-o" title="Modificar" ></i>
                                            Modificar
                                        </a>
                                    </td> 
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs default eliminar" car_id="<?php echo $c->car_id ?>">
                                            <i class="fa fa-trash-o" title="Eliminar" car_id="<?php echo $c->car_id ?>"></i>
                                            Eliminar
                                        </a>
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
                <h4 class="modal-title" id="myModalLabel" style="text-align: center;"> <div class="circuloIcon guardarmodificacion" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div> Editar Cargo</h4>
            </div>
            <div class="modal-body form-horizontal">
                <div class="row">
                    <input type="hidden" value="" name="car_id" id="idcargo">

                    <div class="form-group">
                        <label for="cargo2" class="col-sm-offset-1 col-sm-3 control-label">Cargo</label>
                        <div class="col-sm-7">
                            <input type="text"  class="form-control" id="cargo2" name="cargo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cargojefedir" class="col-sm-offset-1 col-sm-3 control-label">Cargo Jefe Directo</label>
                        <div class="col-sm-7">
                            <select name="cargojefedir" id="cargojefedir" class="form-control" >
                                <option value="">Sin Jefe</option>
                                <?php foreach ($cargo as $d) { ?>
                                    <option value="<?php echo $d->car_id ?>"><?php echo $d->car_nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cotizacion" class="col-sm-offset-1 col-sm-3 control-label">Cargo</label>
                        <div class="col-sm-7">
                            <input type="text"  class="form-control" id="cotizacion" name="cotizacion">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="riesgo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">RIESGOS ASOCIADOS AL CARGO</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-offset-2 col-sx-offset-2 col-md-8 col-sx-8">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th>RIESGOS</th>
                            </thead>
                            <tbody id="riesgocargo">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $('body').delegate(".riesgo", "click", function () {
        var car_id = $(this).attr("car_id");
        $.post(
                "<?php echo base_url("index.php/administrativo/cargoriesgo") ?>",
                {
                    car_id: car_id
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message']);
            else {
                $("#riesgocargo *").remove();
                var body = "";
                $.each(msg.Json, function (key, val) {
                    body += "<tr>";
                    body += "<td>" + val.rie_descripcion + "</td>";
                    body += "</tr>";
                });
                $("#riesgocargo").append(body);
                $('#riesgo').modal('show');
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, Por favor comunicarse con el administrador del sistema");
        });
    });
    $('.guardarmodificacion').click(function () {
        $.post(
                "<?php echo base_url("index.php/administrativo/modificacioncargo") ?>",
                {
                    cargo: $('#cargo2').val(),
                    jefe: $('#cargojefedir').val(),
                    cotizacion: $('#cotizacion').val(),
                    car_id: $('#idcargo').val()
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message']);
            else {
                listadoCargos(msg);
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, Por favor comunicarse con el administrador del sistema");
        });
    });

    $('body').delegate(".modificar", "click", function () {
        $.post(
                "<?php echo base_url("index.php/administrativo/consultacargoxid") ?>",
                {
                    car_id: $(this).attr('car_id')
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message']);
            else {
                $('#idcargo').val(msg.Json[0].car_id);
                $('#cargo2').val(msg.Json[0].car_nombre);
                $('#cargojefedir').val(msg.Json[0].idjefe);
                $('#cotizacion').val(msg.Json[0].car_porcentajearl);
                $('#myModal').modal("show");
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, Por favor comunicarse con el administrador del sistema");
        });
    });

    $('body').delegate(".eliminar", "click", function () {
        var fila = $(this);
        if (confirm("Esta seguro de eliminar el cargo") == true) {
            $.post("<?php echo base_url('index.php/administrativo/eliminarcargo') ?>", {id: $(this).attr('car_id')})
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta("rojo", msg['message']);
                        else {
                            $('select *').remove();
                            var select = "";
                            $.each(msg.Json, function (key, val) {
                                select += "<option value='" + val.car_id + "'>" + val.car_nombre + "</option>";
                            });
                            $('select').append(select);
                            fila.parents('tr').remove();
                            alerta("verde", "Eliminado Correctamente");
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error, Por favor comunicarse con el administrador del sistema");
                    });
        }
    });

    $('.guardarcargo').click(function () {
        if (obligatorio('obligatorio') == true) {
            $.post("<?php echo base_url('index.php/administrativo/guardarcargo') ?>",
                    $("#formcargos").serialize())
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta("rojo", msg['message']);
                        else 
                            listadoCargos(msg);
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error, Por favor comunicarse con el administrador del sistema");
                    })

        }
    });
    function listadoCargos(msg) {
        $('#bodycargo *,#cargojefe *').remove();
        var body = "";
        var option = "";
        $.each(msg.Json, function (key, val) {
            body += "<tr>";
            body += "<td>" + val.car_nombre + "</td>";
            body += "<td>" + val.jefe + "</td>";
            body += "<td style='text-align: center'>" + val.car_porcentajearl + "</td>";
            body += '<td class="transparent">';
            if (val.cantidadRiesgos > 0) {
                body += '<i class="fa fa-child fa-2x riesgo" title="Eliminar" car_id="' + val.car_id + '" ></i>';
            }
            body += '</td>';
            body += '<td class="transparent">\n\
                                            <i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar" car_id="' + val.car_id + '" ></i>\n\
                                        </td>';
            body += '<td class="transparent">\n\
                                            <i class="fa fa-trash-o fa-2x eliminar" title="Eliminar" car_id="' + val.car_id + '"></i>\n\
                                        </td>';
            body += "</tr>";
            option += "<option value='" + val.car_id + "'>" + val.car_nombre + "</option>";
        });
        $('#bodycargo').append(body);
        $('#cargojefe').append(option);
        $('.texto').val("");
        alerta("verde", "Guardado Correctamente");
        $('#myModal').modal('hide');
    }

</script>    