<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon categoria" title="Agregar" ><i class="fa fa-floppy-o fa-3x"></i></div>
        <a href="<?php echo base_url() . "/index.php/riesgo/nuevoriesgo" ?>"><div class="circuloIcon" title="Nuevo Riesgo" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">CLASIFICACIÓN DE RIESGO</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <div class="row">
        <div class="form-group">
            <label>Categoria</label>
            <input type="text" name="categoria" id="cat">
        </div>
    </div>
    <div class="row informacion">
        <table class="tablesst">
            <?php
            foreach ($categoria as $id => $cat):
                foreach ($cat as $categoria => $num):
                    ?>
                    <thead>
                        <tr>
                            <th style="text-align:center"><b><?= $categoria ?></b></th>  
                            <th></th>
                            <th><i class="fa fa-pencil-square-o fa-2x modificar2" nombre='<?= $categoria ?>' rieCla_id="<?php echo $id ?>" title="Modificar" data-target="#myModal2" data-toggle="modal"></i></th>
                            <th><i class="fa fa-trash-o fa-2x eliminarcategoria"  title="Eliminar" rieCla_id="<?php echo $id ?>"></i></th>
                        </tr>
                        <tr>
                            <th style='width:70%'>Tipo</th>
                            <th style='width:15%'>Inspección</th>
                            <th style='width:15%'>Editar</th>
                            <th style='width:15%'>Eliminar</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($num as $numero => $tipo):
                        if (!empty($tipo[1])):
                            ?>
                            <tr>
                                <td><?php echo $tipo[1] ?></td>
                                <td class="transparent"><i class="fa fa-building  fa-2x inspeccion" rieClaTip_id="<?php echo $tipo[0] ?>" rieCla_id="<?= $id ?>" rieClaTip_id="<?php echo $tipo[1] ?>" title="Inspección"></i></td>
                                <td class="transparent"><i class="fa fa-pencil-square-o fa-2x modificar" rieCla_id="<?= $id ?>" rieClaTip_tipo="<?php echo $tipo[1] ?>" rieCla_categoria="<?= $id ?>" rieClaTip_id="<?php echo $tipo[0] ?>" title="Modificar" data-target="#myModal" data-toggle="modal"></i></td>
                                <td class="transparent"><i class="fa fa-trash-o fa-2x eliminar" rieClaTip_id="<?php echo $tipo[0] ?>" rieCla_id="<?= $id ?>" rieClaTip_id="<?php echo $tipo[1] ?>" title="Eliminar"></i></td>
                            </tr>
                            <?php
                        endif;
                    endforeach;
                endforeach;
            endforeach;
            ?>
        </table>
    </div>
    <div class="row">
        <button type="button" class="btn-sst modal_nuevo" data-toggle="modal" data-target="#myModal" >Nuevo</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center;"> <div class="circuloIcon" id="guardartipo" ><i class="fa fa-floppy-o fa-3x"></i></div> NUEVO TIPO DE RIESGO</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form method="post" id="frmtipocategoria">
                            <input type="hidden" name="accion" id="accion" value="1">
                            <input type="hidden" name="tip_id" id="tip_id">
                            <input type="hidden" name="rieCla_id" id="rieCla_id">
                            <div class="col-sm-offset-2 col-sm-8">
                                <div class="form-group">
                                    <label for="ct">Categoría</label>
                                    <select name="categoria" id="ct" class="form-control">
                                        <option value="">::Seleccionar::</option>
                                        <?php foreach ($categoria2 as $cc): ?>
                                            <option value="<?php echo $cc->rieCla_id ?>"><?php echo $cc->rieCla_categoria ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <input type="text" name="tipo" id="tipo" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <div id="guardartipo2" class="circuloIcon">
                        <i class="fa fa-floppy-o fa-3x"></i>
                    </div>
                    CLASIFICACIÓN DE RIESGO
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="categoria_m">Categoria</label>
                    </div>
                    <div class="col-md-8">
                        <input type="hidden" class="form-control" id="categoria_id" name="categoria_id">
                        <input type="text" class="form-control" id="categoria_m" name="categoria_m">
                        <p><br></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="inspeccion" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="row">
                    <center>
                        <h4 class="modal-title">
                            ELEMENTOS A INSPECCIONAR
                        </h4>
                    </center>
                    <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Elemento</label>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <input type="text" name="elemento" id="elemento" class="form-control"/>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <button type="button" id="guardarElemento" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row filaElementos">

                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('#guardarElemento').click(function () {
        
        $.post("<?php echo base_url("index.php/Riesgo/elementos") ?>",
                {
                    elemento: $('#elemento').val(),
                    tipo: $(this).attr("tipo")
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                $('.filaElementos *').remove();
                var listado = "<ul>"
                $.each(msg.Json, function (key, val) {
                    listado += "<li>" + val.rieClaEle_elemento + "</li>";
                });
                listado += "</ul>"
                $('.filaElementos').append(listado);
                $('#elemento').val('');
            }
        })
                .fail(function (msg) {
                    alerta("rojo", "Error por favor comunicarse con el administrador");
                });
    });

    $('body').delegate(".inspeccion", "click", function () {
        $('.filaElementos *').remove();
        $('#guardarElemento').attr("tipo", $(this).attr("rieclatip_id"));
        $.post("<?php echo base_url("index.php/Riesgo/elementosXIdTipo") ?>",
                {
                    tipo: $(this).attr("rieclatip_id")
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message'])
            else {
                $('.filaElementos *').remove();
                var listado = "<ul>"
                $.each(msg.Json, function (key, val) {
                    listado += "<li>" + val.rieClaEle_elemento + "</li>";
                });
                listado += "</ul>"
                $('.filaElementos').append(listado);
            }
        })
                .fail(function (msg) {
                    alerta("rojo", "Error por favor comunicarse con el administrador");
                });
        $('#inspeccion').modal('show');
    });

    $('.modal_nuevo').click(function () {
        $('#ct').val('');
        $('#tipo').val('');
        $("#accion").val('1')
    });
    $('body').delegate('.modificar', 'click', function () {
        $("#accion").val('2');
        $('#tip_id').val($(this).attr('rieclatip_id'))
        $('#rieCla_id').val($(this).attr("riecla_id"));
        $('#ct').val($(this).attr('rieCla_categoria'));
        $('#tipo').val($(this).attr('rieClaTip_tipo'));
    })
    $('body').delegate('.modificar2', 'click', function () {
        $("#accion").val('2')
        $('#tip_id').val($(this).attr('rieclatip_id'))
        $('#categoria_m').val($(this).attr('nombre'))
        $('#rieCla_id').val($(this).attr("riecla_id"));
        $('#categoria_id').val($(this).attr('rieCla_id'));
        $('#tipo').val($(this).attr('rieClaTip_tipo'));
    })
    $('body').delegate('.eliminar', 'click', function () {
        var r = confirm('¿Desea Eliminarla?');
        if (r == false)
            return false;
        var url = "<?php echo base_url("index.php/Riesgo/eliminar") ?>";
        $.post(url, {
            id: $(this).attr('rieClaTip_id')
        })
                .done(function (msg) {
                    agregarTabla(msg);
                })
                .fail(function () {

                })
    });

    $('body').delegate(".eliminarcategoria", "click", function (key, val) {
        var url = "<?php echo base_url("index.php/Riesgo/eliminarCategoria") ?>";
        $.post(url, {
            rieCla_id: $(this).attr('rieCla_id')
        })
                .done(function (msg) {
                    agregarTabla(msg);
                    alerta("verde", "Eliminado correctamente");
                })
                .fail(function (msg) {
                    alerta("rojo", "Error por favor comunicarse con el administrador del sistema")
                })
    })

    function agregarTabla(msg) {
        $('.informacion *').remove();
        var cuerpo = "";
        var option = "";
        $('#ct *').remove();
        $.each(msg, function (key, val) {
            $.each(val, function (indice, campo) {
                option += "<option value='" + key + "'>" + indice + "</option>";
                cuerpo += "<table class='tablesst'>";
                cuerpo += "<thead>";
                cuerpo += "<tr>";
                cuerpo += "<th   style='text-align:center'><b>" + indice + "</b></th>";
                cuerpo += "<th></th>";
                cuerpo += "<th  style='text-align:center'> <i class='fa fa-pencil-square-o fa-2x modificar2' data-toggle='modal' nombre='" + indice + "' data-target='#myModal2' riecla_id='" + key + "'  title='Modificar'></i></th>";
                cuerpo += "<th><i class='fa fa-trash-o fa-2x eliminarcategoria' rieCla_id='" + key + "'  title='Eliminar'></i></th>";
                cuerpo += "</tr>";
                cuerpo += "<tr>";
                cuerpo += "<th style='width:70%'>Tipo</th>";
                cuerpo += "<th style='width:15%'>Inspección</th>";
                cuerpo += "<th style='width:15%'>Editar</th>";
                cuerpo += "<th style='width:15%'>Eliminar</th>";
                cuerpo += "</tr>";
                cuerpo += "</thead>";
                cuerpo += "<tbody>";
                $.each(campo, function (numero, campo) {
                    if (campo[0] != null) {
                        cuerpo += "<tr>";
                        cuerpo += "<td><b>" + campo[1] + "</b   ></td>";
                        cuerpo += "<td class='transparent'><i class='fa fa-building fa-2x inspeccion' rieCla_id='" + key + "' rieClaTip_id='" + campo[0] + "' title='Eliminar'></i></td>";
                        cuerpo += "<td class='transparent'><i class='fa fa-pencil-square-o fa-2x modificar' data-toggle='modal' data-target='#myModal' title='Modificar' rieclatip_id='" + campo[0] + "' rieclatip_tipo='" + campo[1] + "' riecla_id='" + key + "' rieCla_categoria='" + key + "' title='Modificar'></i></td>";
                        cuerpo += "<td class='transparent'><i class='fa fa-trash-o fa-2x eliminar' rieCla_id='" + key + "' rieClaTip_id='" + campo[0] + "' title='Eliminar'></i></td>";
                        cuerpo += "</tr>";
                    }
                });
                cuerpo += "</tbody>";
                cuerpo += "</table>";
            })
        });
        $('.informacion').append(cuerpo);
        $('#ct').append(option);
    }

    $('#guardartipo').click(function () {
        if ($('#ct').val() == "") {
            alerta('rojo', 'Campo Categoria Obligatorio')
            return false;
        }
        $.post(
                "<?php echo base_url("index.php/Riesgo/guardartipocategoria") ?>",
                $("#frmtipocategoria").serialize()
                )
                .done(function (msg) {
                    if (msg != 1)
                        agregarTabla(msg);
                    else
                        alerta("amarillo", "Datos ya existentes en el sistema");
                    $('#myModal').modal("hide");
                })
                .fail(function (msg) {
                    alerta("rojo", "Error al guardar el tipo por favor comunicarse con el administrador");
                });

    });
    $('#guardartipo2').click(function () {
        if ($('#categoria_m').val() == "") {
            alerta('rojo', 'Campo Categoria Obligatorio')
            return false;
        }
        $.post(
                "<?php echo base_url("index.php/Riesgo/update") ?>",
                {categoria: $('#categoria_m').val(), id_categoria: $('#categoria_id').val()}
        )
                .done(function (msg) {
                    if (msg != 1) {
                        agregarTabla(msg);
                        alerta("verde", "Categoria guardada con exito");
                    } else
                        alerta("amarillo", "Datos ya existentes en el sistema");
                    $('#myModal2').modal("hide");
                })
                .fail(function (msg) {
                    alerta("rojo", "Error al guardar el tipo por favor comunicarse con el administrador");
                });

    });

    $('.categoria').click(function () {
        var categoria = $('#cat').val();
        $.post("<?php echo base_url("index.php/riesgo/guardarclasificacionriesgo") ?>",
                {categoria: categoria}
        ).done(function (msg) {
            if (msg != 1) {
                $('#cat').val('');
                agregarTabla(msg);
                alerta("verde", "Categoria guardada con exito");
            } else {
                alerta("amarillo", "Datos ya existentes en el sistema");
            }
        })
                .fail(function (msg) {

                })
                ;
    });



</script>    