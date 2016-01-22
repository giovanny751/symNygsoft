<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i><?= $empresa[0]->Dimdos_id ?> (<?= $title ?>)
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="descripcion" class="control-label col-md-3">*Descripción</label>
                                    <div class="col-md-9">
                                        <input type="text" name="descripcion" id="descripcion" class="form-control obligatorio"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-offset-8 col-md-4">
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
                                <th>Descripción</th>
                                <th>Riesgos</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="bodydimension">
                        <?php foreach ($dimension as $d) { ?>
                            <tr>
                                <td><?php echo $d->dim_descripcion ?></td>
                                <td>
                                    <?php if($d->cantidadRiesgo > 0): ?>
                                    <i class="fa fa-child fa-2x riesgo" title="Riesgos" dim_id="<?php echo $d->dim_id ?>" ></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="javascript:;" class="btn btn-xs default modificar" dim_id="<?php echo $d->dim_id ?>">
                                        <i class="fa fa-pencil-square-o" title="Modificar" ></i>
                                        Modificar
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:;" class="btn btn-xs default eliminar" dim_id="<?php echo $d->dim_id ?>">
                                        <i class="fa fa-trash-o" title="Eliminar" ></i>
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
                <h4 class="modal-title" id="myModalLabel">Dimensión</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-offset-2 col-sm-8">
                        <center>
                            <input type="hidden" name="dimid" id="dimid">
                            <label for="descripcion2">Descripción</label>
                            <input type="text" name="descripcion2" id="descripcion2" class="form-control" />
                            <br>
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary guardarmodificacion">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="riesgo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">RIESGOS ASOCIADOS</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-offset-2 col-sx-offset-2 col-md-8 col-sx-8">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th>RIESGOS</th>
                            </thead>
                            <tbody id="riesgodimension">

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
<script>
    $('body').delegate('.seleccionRiesgo', "click", function () {
        var form = "<form method='post' id='frmRiesgo' action='<?php echo base_url("index.php/riesgo/nuevoriesgo") ?>'>";
        form += "<input type='hidden' value='" + $(this).attr('rie_id') + "' name='rie_id'>";
        form += "</form>";
        $('body').append(form);
        $('#frmRiesgo').submit();
    });
    
    $('body').delegate(".riesgo", "click", function () {
        var dim_id = $(this).attr("dim_id");
        $.post(
                "<?php echo base_url("index.php/administrativo/dimensiondosriesgo") ?>",
                {
                    dim_id: dim_id
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                $("#riesgodimension *").remove();
                var body = "";
                $.each(msg.Json, function (key, val) {
                    body += "<tr>";
                    body += "<td class='seleccionRiesgo' style='text-align:center;cursor:pointer;' rie_id='"+val.rie_id+"'>" + val.rie_descripcion + "</td>";
                    body += "</tr>";
                });
                $("#riesgodimension").append(body);
                $('#riesgo').modal('show');
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador");
        });
    });
    $('.guardarmodificacion').click(function () {
        $.post(
                "<?php echo base_url("index.php/administrativo/guardarmodificaciondimension2") ?>",
                {
                    dimid: $('#dimid').val(),
                    descripcion: $('#descripcion2').val()
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else 
                construccionTabla(msg);
        }).fail(function () {
            alerta("rojo", "Error, por favor comunicarse con el administrador");
        })

    });

    $('body').delegate(".modificar", "click", function () {

        $.post(
                "<?php echo base_url("index.php/administrativo/consultadimensionxid2") ?>",
                {dim_id: $(this).attr('dim_id')}
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message'])
            else {
                $('#dimid').val(msg.Json[0].dim_id);
                $('#descripcion2').val(msg.Json[0].dim_descripcion);
                $('#myModal').modal('show');
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador");
        });

    });

    $('body').delegate(".eliminar", "click", function () {
        var eliminar = $(this);
        if (confirm("Esta seguro de eliminar la dimension") == true) {
            $.post("<?php echo base_url('index.php/administrativo/eliminardimension2') ?>",
                    {id: $(this).attr('dim_id')}
            ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("rojo", msg['message'])
                else {
                    eliminar.parents('tr').remove();
                    alerta("verde", "Eliminado Correctamente");
                }
            }).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador");
            });
        }
    });
    $('.guardar').click(function () {
        if (obligatorio('obligatorio') == true) {
            $.post("<?php echo base_url("index.php/administrativo/guardardimension2") ?>"
                    , {
                        descripcion: $('#descripcion').val()
                    })
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta("amarillo", msg['message'])
                        else 
                            construccionTabla(msg);
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error, por favor comunicarse con el administrador");
                    })
        }
    });

    function construccionTabla(msg) {
        $('#bodydimension *').remove();
        var bodydimension = "";
        $.each(msg.Json, function (key, val) {
            bodydimension += "<tr>";
            bodydimension += "<td>" + val.dim_descripcion + "</td>";
            bodydimension += "<td >";
            if(val.cantidadRiesgo > 0){
                bodydimension += "<i class='fa fa-child fa-2x riesgo' title='Riesgos' dim_id='" + val.dim_id + "' ></i>";
            }
            bodydimension += "</td>";
            bodydimension += '<td>';
            bodydimension += '<a href="javascript:;" class="btn btn-xs default modificar" dim_id="' + val.dim_id + '">';
            bodydimension += '<i class="fa fa-pencil-square-o" title="Modificar" ></i> Modificar';
            bodydimension += '</a >';
            bodydimension += '</td>';
            bodydimension += '<td>';
            bodydimension += '<a href="javascript:;" class="btn btn-xs default eliminar" dim_id="' + val.dim_id + '">';
            bodydimension += '<i class="fa fa-trash-o" title="Eliminar"></i> Eliminar';
            bodydimension += '</a >';
            bodydimension += '</td>';
                                
            bodydimension += "</tr>";
        });
        $('#bodydimension').append(bodydimension);
        $('#myModal').modal('hide');
        alerta("verde", "Guardado Correctamente");

    }
</script>