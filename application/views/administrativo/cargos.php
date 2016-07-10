<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Nuevo Cargo</h4>
            </div>
            <div class="modal-body form-horizontal">
                <div class="row">
                    <form method="post" id="formcargos" class="form-horizontal">
                        <input type="hidden" value="" name="car_id" id="idcargo">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cargo" class="control-label col-md-2">* Cargo</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control obligatorio texto mayuscula" name="cargo" id="cargo" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cargojefe" class="control-label col-md-2">Cargo jefe directo</label>
                                    <div class="col-md-4">
                                        <select name="cargojefe" id="cargojefe" class="form-control select2me" >
                                            <option value=""></option>
                                            <?php foreach ($cargo as $d) { ?>
                                                <option value="<?php echo $d->car_id ?>"><?php echo strtoupper($d->car_nombre) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label for="porcentaje" class="control-label col-md-2">* Cotizacion ARL</label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="text" name="porcentaje" id="porcentaje" class="form-control obligatorio number2 texto" />
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="alert alert-info"><center><b>Manual de Funciones</b></center></div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="objetivoPrincipal" class="control-label col-md-2">Perfil del cargo</label>
                                    <div class="col-md-10">
                                        <textarea id="perfilCargo" name="perfilCargo" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="objetivoPrincipal" class="control-label col-md-2">Objetivo principal</label>
                                    <div class="col-md-10">
                                        <textarea id="objetivoPrincipal" name="objetivoPrincipal" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 principalFuncion">
                                <div class="form-group">
                                    <label for="funcionesEsenciales" class="control-label col-md-2">Funciones esencial</label>
                                    <div class="col-md-9">
                                        <textarea id="funcionesEsenciales" name="funcionesEsenciales[]" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="agregar btn btn-success"><i class="fa fa-plus fa-2x"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="funciones">

                            </div>
                            <div class="col-md-offset-10 col-md-2" id="buttonSeleccion">

                            </div>
                        </div>
                    </form>
                </div>
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
                    <i class="fa fa-table"></i>CARGOS
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="Abrir/Cerrar"></a>
                    <a href="javascript:;" class="reload" data-original-title="Recargar"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="nuevoCargo" class="btn btn-success">Nuevo</button>
                            <a href="<?php echo base_url("index.php/administrativo/organigrama") ?>">
                                <button type="button" id="organigrama" title="Organigrama" class="btn btn-info"><i class="fa fa-sitemap"></i></button>
                            </a>
                            <a href="<?php echo base_url("index.php/Administrativo/empresa") ?>">
                                <button type="button" class="btn btn-info" title="Organización"><i class="fa fa-building-o"></i></button>
                            </a>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover tabla-sst">
                                <thead >
                                    <tr>
                                        <th style="text-align: center">Cargo</th>
                                        <th style="text-align: center">Cargo Jefe Directo</th>
                                        <th style="text-align: center">% Cotización ARL</th>
                                        <th style="text-align: center">Manual de funciones</th>
                                        <th style="text-align: center">Riesgos</th>
                                        <th style="text-align: center">Editar</th>
                                        <th style="text-align: center">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="bodycargo">
                                    <?php foreach ($cargo as $c) { ?>
                                        <tr>
                                            <td><?php echo $c->car_nombre ?></td> 
                                            <td><?php echo $c->jefe ?></td> 
                                            <td style="text-align:center;"><?php echo $c->car_porcentajearl ?></td> 
                                            <td style="text-align: center">
                                                <a href="javascript:;" class="btn btn-xs default manual" car_id="<?php echo $c->car_id ?>">
                                                    <i class="fa fa-file-pdf-o" title="Manual" ></i>
                                                    Manual
                                                </a>
                                            </td>
                                            <td style="text-align: center">
                                                <?php if ($c->cantidadRiesgos > 0): ?>
                                                    <i class="fa fa-child fa-2x riesgo " title="Eliminar" car_id="<?php echo $c->car_id ?>" ></i>
                                                <?php endif; ?>
                                            </td>
                                            <td style="text-align: center">
                                                <a href="javascript:;" class="btn btn-xs default modificar" car_id="<?php echo $c->car_id ?>">
                                                    <i class="fa fa-pencil-square-o" title="Modificar" ></i>
                                                    Modificar
                                                </a>
                                            </td> 
                                            <td style="text-align: center">
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
    </div>
</div>
<form id="manual_form" target="_black" action="<?php echo base_url('index.php/Administrativo/funcionesCargo') ?>" method="post">
    <input type="hidden" id="id_cargo_form" name="car_id">
</form>

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
<script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js'); ?>"></script>
<script>

    $('body').delegate(".manual", "click", function () {
        $('#id_cargo_form').val($(this).attr('car_id'));
        $('#manual_form').submit();
    })
    $('body').delegate(".agregar", "click", function () {

        var funciones = '<div class="col-md-12 newFunction">\n\
                                <div class="form-group">\n\
                                    <label for="funcionesEsenciales" class="control-label col-md-2">Funciones esencial</label>\n\
                                    <div class="col-md-9 texto" >\n\
                                        <textarea id="funcionesEsenciales" name="funcionesEsenciales[]" class="form-control funcionesEsenciales"></textarea>\n\
                                    </div>\n\
                                    <div class="col-md-1">\n\
                                        <button type="button" class="eliminarFuncion btn btn-danger"><i class="fa fa-remove fa-2x"></i></button>\n\
                                    </div>\n\
                                </div>\n\
                            </div>';
        $('.funciones').append(funciones);
    });

    $('body').delegate('.eliminarFuncion', 'click', function () {
        if ($(this).parent().siblings('.texto').children('.funcionesEsenciales').val() != "") {
            if ($(this).parent().siblings('.texto').children('.funcionesEsenciales').val() != "") {
                if (confirm("Esta seguro de eliminar la funcion")) {
                    $(this).parents('.newFunction').remove();
                }
            } else {
                $(this).parents('.newFunction').remove();
            }
        } else {
            $(this).parents('.newFunction').remove();
        }
    });

    $('#nuevoCargo').click(function () {
        $('#buttonSeleccion *').remove();
        $('#buttonSeleccion').append('<input type="button" value="Guardar" class="btn btn-success  guardarcargo" />');

        $('#cargo').val("");
        $('#porcentaje').val("");
        $('#objetivoPrincipal').val("");
        $('.funcionesEsenciales').val("");
        $('.newFunction').remove();
        $("#nuevo").modal("show");
    });
    $('body').delegate(".riesgo", "click", function () {
        var car_id = $(this).attr("car_id");
        $.post(
                url + "index.php/administrativo/cargoriesgo",
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
    $('body').delegate(".guardarmodificacion", "click", function () {
        $.post(
                url + "index.php/administrativo/modificacioncargo",
                $('#formcargos').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message']);
            else {
                listadoCargos(msg);
                $('#nuevo').modal("hide");
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, Por favor comunicarse con el administrador del sistema");
        });
    });
    $('body').delegate(".modificar", "click", function () {
        $('.newFunction').remove();
        $('#buttonSeleccion *').remove();
        $('#buttonSeleccion').append('<input type="button" value="Actualizar" class="btn btn-info  guardarmodificacion" />');
        $.post(
                url + "index.php/administrativo/consultacargoxid",
                {
                    car_id: $(this).attr('car_id')
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message']);
            else {
                $('#idcargo').val(msg.Json[0].car_id);
                $('#cargo').val(msg.Json[0].car_nombre);
                $('#cargojefedir').val(msg.Json[0].idjefe);
                $('#porcentaje').val(msg.Json[0].car_porcentajearl);
                $('#objetivoPrincipal').val(msg.Json[0].car_objetivoPrincipal);
                $('#perfilCargo').val(msg.Json[0].car_perfilCargo);

                var funciones = "";
                i = 0;
                $.each(msg.funciones, function (key, val) {
                    if (i == 0) {
                        $('.principalFuncion').remove();
                        cambio = "plus";
                        claseaEliminar = "principalFuncion";
                        clase = "agregar";
                        color = "success";
                    } else {
                        cambio = "remove";
                        claseaEliminar = "newFunction";
                        clase = "eliminarFuncion";
                        color = "danger";
                    }
                    i++;

                    funciones += '<div class="col-md-12 ' + claseaEliminar + '">\n\
                                <div class="form-group">\n\
                                    <label for="funcionesEsenciales" class="control-label col-md-2">Funciones esencial</label>\n\
                                    <div class="col-md-9 texto" >\n\
                                        <textarea id="funcionesEsenciales" name="funcionesEsenciales[]" class="form-control funcionesEsenciales">' + val.carFun_funcion + '</textarea>\n\
                                    </div>\n\
                                    <div class="col-md-1">\n\
                                        <button type="button" class="' + clase + ' btn btn-' + color + '"><i class="fa fa-' + cambio + ' fa-2x"></i></button>\n\
                                    </div>\n\
                                </div>\n\
                            </div>';

                });
                $('.funciones').append(funciones);

                $('#nuevo').modal("show");
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, Por favor comunicarse con el administrador del sistema");
        });
    });
    $('body').delegate(".eliminar", "click", function () {
        var fila = $(this);
        if (confirm("Esta seguro de eliminar el cargo") == true) {
            $.post(url + 'index.php/administrativo/eliminarcargo', {id: $(this).attr('car_id')})
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
    $('body').delegate(".guardarcargo", "click", function () {
        if (obligatorio('obligatorio') == true) {
            $.post(url + 'index.php/administrativo/guardarcargo',
                    $("#formcargos").serialize())
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message)) {
                            alerta(msg['color'], msg['message']);
                        } else {
                            listadoCargos(msg);
//-----------------------------------------------------------------------------
                            if (jQuery.isEmptyObject(msg.message)) {
                                $("#notif").html('prueba');
                                var socket = io.connect('http://' + window.location.hostname + ':3000');
                                socket.emit('new_count_message', {
                                    new_count_message: msg.new_count_message
                                });
                                socket.emit('new_message', {
                                    name: 'hola gerson'
                                });
                            } else if (data.success == false) {
                                $("#name").val(msg.name);
                                $("#email").val(msg.email);
                                $("#subject").val(msg.subject);
                                $("#message").val(msg.message);
                                $("#notif").html(msg.notif);
                            }
//-----------------------------------------------------------------------------                        
                            $('#objetivoPrincipal').val("");
                            $('#funcionesEsenciales').val("");
                            $('.newFunction').remove();
                            $('#nuevo').modal("hide");
                        }
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
            body += '<td class="transparent" style="text-align: center">\n\
            <a class="btn btn-xs default manual" car_id="' + val.car_id + '" href="javascript:;">\n\
                    <i class="fa fa-file-pdf-o" title="Manual"></i> Manual </a>\n\
                                        </td>';
            body += '<td class="transparent" style="text-align: center">';
            if (val.cantidadRiesgos > 0) {
                body += '<i class="fa fa-child fa-2x riesgo" title="Eliminar" car_id="' + val.car_id + '" ></i>';
            }
            body += '</td>';
            body += '<td class="transparent" style="text-align: center">\n\
                                            <i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar" car_id="' + val.car_id + '" ></i>\n\
                                        </td>';
            body += '<td class="transparent" style="text-align: center">\n\
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