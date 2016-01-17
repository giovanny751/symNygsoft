<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon guardar" title="Agregar"><i class="fa fa-floppy-o fa-3x"></i></div> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">TIPOS DE INDICADORES</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <div class="row">
        <div class="form-inline">
            <div class="form-group">
                <label for="descripcion"><span class="campoobligatorio">*</span>Tipo Indicador</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control obligatorio"/>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <table class="tablesst">
            <thead>
            <th style="width: 80%">Tipo</th>
            <th style="width: 10%">Editar</th>
            <th style="width: 10%">Eliminar</th>
            </thead>
            <tbody id="bodytipoindicador">
                <?php foreach ($tipoindicadores as $d) { ?>
                    <tr id="<?php echo $d->indTip_id ?>">
                        <td class='tipo'><?php echo $d->indTip_tipo ?></td>
                        <td class="transparent">
                            <i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar" dim_id="<?php echo $d->indTip_id ?>" data-toggle="modal" data-target="#myModal"></i>
                        </td>
                        <td class="transparent">
                            <i class="fa fa-trash-o fa-2x eliminar" title="Eliminar" dim_id="<?php echo $d->indTip_id ?>" ></i>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"> <div class="circuloIcon guardarmodificacion" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>  Tipo indicador</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-horizontal">
                        <div class="form-group">
                            <input type="hidden" name="dimid" id="dimid">
                            <label class="col-sm-offset-1 col-sm-3" for="descripcion2">Tipo Indicador</label>
                            <div class="col-sm-6">
                                <input type="text" name="descripcion2" id="descripcion2" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.guardarmodificacion').click(function () {
        $.post(
                "<?php echo base_url("index.php/indicador/guardarmodificaciontipoindicador") ?>",
                {
                    tipIndid: $('#dimid').val(),
                    tipIndTipo: $('#descripcion2').val()
                }
        ).done(function (msg) {
            $('#' + $('#dimid').val()).find('.tipo').text(msg.indTip_tipo);
            $('#myModal').modal("hide");
            alerta("verde", "Modificado correctamente");
        }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
        })

    });

    $('body').delegate(".modificar", "click", function () {
        $.post(
                "<?php echo base_url("index.php/indicador/consultaIndicadorxid") ?>",
                {tipoIndicador: $(this).attr('dim_id')}
        ).done(function (msg) {
            $('#dimid').val(msg.indTip_id);
            $('#descripcion2').val(msg.indTip_tipo);
        }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
        });

    });

    $('body').delegate(".eliminar", "click", function () {
        var eliminar = $(this);
        if (confirm("Esta seguro de eliminar el tipo de indicador") == true) {
            $.post("<?php echo base_url('index.php/indicador/eliminarindicador') ?>",
                    {id: $(this).attr('dim_id')}
            ).done(function (msg) {
                eliminar.parents('tr').remove();
                alerta("verde", "Eliminado Correctamente");
            }).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
            });
        }
    });
    $('.guardar').click(function () {
        if (obligatorio('obligatorio') == true) {
            $.post("<?php echo base_url("index.php/indicador/guardarTipoIndicador") ?>"
                    , {
                        tipoindicador: $('#descripcion').val()
                    })
                    .done(function (msg) {
                        if (msg != 1) {
                            $('#descripcion').val('');
                            $('#bodytipoindicador *').remove();
                            var bodytipoIndicador = "";
                            $.each(msg, function (key, val) {
                                bodytipoIndicador += "<tr id='" + val.indTip_id + "'>";
                                bodytipoIndicador += "<td class='tipo'>" + val.indTip_tipo + "</td>";
                                bodytipoIndicador += '<td class="transparent"><i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar"  dim_id="' + val.indTip_id + '" data-toggle="modal" data-target="#myModal"></i></td>';
                                bodytipoIndicador += '<td class="transparent"><i class="fa fa-trash-o fa-2x eliminar" title="Eliminar" dim_id="' + val.indTip_id + '" ></i></td>'
                                bodytipoIndicador += "</tr>";
                            });
                            $('#bodytipoindicador').append(bodytipoIndicador);
                            alerta("verde", "Guardado Correctamente");
                        } else {
                            alerta("amarillo", "datos ya existentes en el sistema");
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
                    })
        }
    });
</script>