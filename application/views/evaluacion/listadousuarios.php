<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> LISTADO ASIGNACIÓN EVALUACIONES
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" id="f4">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="cedula">Cédula</label><input type="text" name="cedula" id="cedula" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label><input type="text" name="nombre" id="nombre" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="apellido">Apellido</label><input type="text" name="apellido" id="apellido" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="">::Seleccionar::</option>
                                        <?php foreach ($estado as $e) { ?>
                                            <option value="<?php echo $e->est_id ?>"><?php echo $e->est_nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center">
                                <div class="form-group">
                                    <label>&nbsp;</label><button type="button" class="btn-sst limpiar">Limpiar</button>
                                    <label>&nbsp;</label><button type="button" class="btn-sst consultar">Consultar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <hr>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tablesst" class="table table-striped table-bordered table-hover tabla-sst">
                                <thead>
                                <th>Cédula</th>
                                <th>Usuario</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Estado</th>
                                <th>Fecha actualización</th>
                                <th>Fecha creación</th>
                                <th>Último Ingreso</th>
                                <th>Evaluacione</th>
                                <th>Asignar Evaluación</th>
                                <th>Evaluaciones Realizadas</th>
                                </thead>
                                <tbody id="bodyuser">
                                </tbody>
                            </table>
                        </div>    
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Evaluaciones</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" table-responsive">
                    <input type="hidden" value="" id="usuarioid">
                    <table class="table table-responsive">
                        <thead>
                        <th></th>
                        <th>Nombre Evaluación</th>
                        </thead>
                        <tbody id="resultados">

                        </tbody>
                    </table>
                </div>
            </div>		
            <div class="modal-footer">
                <div class="row marginV10">
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                    </div>
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" class="btn btn-default asignar">Asignar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $('#ingresousuario').hide();
    $('.insertarrol').click(function () {
        $("#idusuario").val($(this).attr('usuarioid'));
        $.post(
                url + 'index.php/Evaluacion/guardarpermisos',
                $('#f15').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message'])
            else {
                $('#myModal3').modal('hide');
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
        });
    });

    $('body').delegate(".asignar", "click", function () {
        var info = '';
        $('input[type="checkbox"]:checked').each(function () {
            info += $(this).val() + '||';
        })

        $.post(
                url + 'index.php/Evaluacion/arignar_evaluacion',
                {info: info, usuarioid: $('#usuarioid').val()})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message)) {
                        alerta("rojo", msg['message'])
                        $('#myModal3').modal('hide');
                    } else {
                        $('#myModal3').modal('hide');
                        $('.consultar').trigger('click')
                    }
                })
                .fail(function () {
                    alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
                    $('#myModal3').modal('hide');
                })
    })
    $('body').delegate(".evaluaciones", "click", function () {
        $('.asignar').show();
        var usuarioid = $(this).attr('usuarioid')
        $('#usuarioid').val(usuarioid);
        $.post(
                url + 'index.php/Evaluacion/ver_evaluaciones',
                {usuarioid: usuarioid})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message)) {
                        alerta("rojo", msg['message'])
                        $('#myModal3').modal('hide');
                    } else {
                        $('#resultados').html('');
                        $.each(msg.Json, function (key, val) {
                            $('#resultados').append('<tr><td><center><input type="checkbox" value="' + val.eva_id + '" ' + ((val.use_id) ? 'checked' : '') + ' ></center></td><td>' + val.eva_nombre + '</td></tr>')
                        })
                    }
                })
                .fail(function (msg) {
                    alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
                    $('#myModal3').modal('hide');
                })
    })
    $('body').delegate(".evaluaciones_resueltas", "click", function () {
        $('.asignar').hide();
        var usuarioid = $(this).attr('usuarioid')
        $('#usuarioid').val(usuarioid);
        $.post(
                url + "index.php/Evaluacion/ver_evaluaciones_resueltas",
                {usuarioid: usuarioid})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message)) {
                        alerta("rojo", msg['message'])
                        $('#myModal3').modal('hide');
                    } else {
                        evaluaciones(msg);
                    }
                })
                .fail(function (msg) {
                    alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
                    $('#myModal3').modal('hide');
                })
    })
    function evaluaciones(msg) {
        $('#resultados').html('');
        $.each(msg.Json, function (key, val) {
            var x = Math.floor((Math.random() * 1000) + 2000);
            var y = Math.floor((Math.random() * 1000) + 2000);
            $('#resultados').append('<tr><td><input type="radio" class="evaluaciones_reset" eva="' + val.eva_id  + '" user="' +  val.use_id + '"></td><td colspan="2"><a href="<?php echo base_url('index.php/Evaluacion/evaluando') ?>/' + x + val.eva_id + y + '/' + x + val.use_id + y + '" target="_black">' + val.eva_nombre + '</a></td></tr>')
        })
    }
    $('body').delegate(".modificar", "click", function () {
        $("#usu_id").val($(this).attr("usu_id"));
        $("#f10").submit();
    });
    $('body').delegate(".evaluaciones_reset", "click", function () {
        var r = confirm('¿Desea Eliminar Esta Prueba?');
        if (r == false)
            return false;
        var usuario = $(this).attr("user");
        var evaluacion = $(this).attr("eva");
        $.post(url + 'index.php/Evaluacion/evaluaciones_reset', {usuarioid: usuario, evaluacion: evaluacion})
                .done(function (msg) {
                    evaluaciones(msg);
                })
                .fail(function () {

                })
    });

    $('body').delegate('.permiso', 'click', function () {
        var id = $(this).attr('usuarioid');
        $('#usuarioid').val(id);
        $('.insertarrol').attr('usuarioid', id);
        $('input[type="checkbox"]').parent("span").removeClass('checked');
        $('input[type="checkbox"]').attr('checked', false);
        $.post(
                url + 'index.php/Evaluacion/consultarolxrolidusuario',
                {id: id})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        $.each(msg.Json, function (key, val) {
                            $('input[rol="' + val.rol_id + '"]').parent("span").addClass('checked');
                            $('input[rol="' + val.rol_id + '"]').prop('checked', true);
                            $('input[rol="' + val.rol_id + '"]').is(":checked");
                        });
                        $("#myModal3").modal("show");
                    }
                }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
        });
    });
    $('#insertarusuario').click(function () {
        $('.obligatorio').val('');
    });
//    -----------------------------------------------------------------------------
    $('#cedula').autocomplete({
        source: url + "index.php/administrativo/autocompletaruacedula",
        minLength: 1
    });
    $('#nombre').autocomplete({
        source: url + "index.php/administrativo/autocompletar",
        minLength: 1
    });
    $('#apellido').autocomplete({
        source: url + "index.php/administrativo/autocompletaruapellido",
        minLength: 1
    });

    $('.limpiar').click(function () {
        $('select,input').val('');
    });
    $('.consultar').click(function () {
        $.post(
                url + "index.php/Evaluacion/consultarusuario",
                $("#f4").serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message'])
            else {
                $('#bodyuser *').remove();
                var body = "";
                var table = $('#tablesst').DataTable();
                table.clear().draw();
                $.each(msg.Json, function (key, val) {
                    if (val.est_id == 1)
                        var activo = "Activo";
                    if (val.est_id != 1)
                        var activo = "Inactivo";

                    table.row.add([
                        val.usu_cedula,
                        val.usu_usuario,
                        val.usu_nombre,
                        val.usu_apellido,
                        activo,
                        (val.usu_fechaActualizacion ? val.usu_fechaActualizacion : ''),
                        (val.usu_fechaCreacion ? val.usu_fechaCreacion : ''),
                        (val.ing_fechaIngreso ? val.ing_fechaIngreso : ''),
                        (val.conca ? val.conca : ''),
                        '<button type="button" data-toggle="modal" data-target="#myModal3"  class="btn btn-info evaluaciones" usuarioid="' + val.usu_id + '">Asignar</button>',
                        '<button type="button" data-toggle="modal" data-target="#myModal3"  class="btn btn-info evaluaciones_resueltas" usuarioid="' + val.usu_id + '">Ver</button>',
                    ]).draw()




                });
                $('#bodyuser').append(body);
            }
        }
        ).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
        });
    });

    $('body').delegate('.eliminar', 'click', function () {
        var asignacion = $(this);
        var usu_id = $(this).attr('usu_id');
        if (confirm("Esta seguro que desea eliminar el usuario?")) {
            $.post(
                    url + "index.php/administrativo/eliminarusuario",
                    {usu_id: usu_id})
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta("rojo", msg['message'])
                        else {
                            asignacion.parents('tr').remove();
                            alerta("verde", "Usuario eliminado con exito");
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error, por favor comunicase con el administrador del sistema")
                    });
        }

    });
</script>