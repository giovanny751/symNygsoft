<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user-plus"></i> Listado Usuario
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
                            <form method="post" id="f4" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="<?php echo base_url() . "index.php/administrativo/creacionusuarios" ?>"><div class="circuloIcon" title="Nuevo Usuario" ><i class="fa fa-folder-open fa-3x"></i></div></a>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cedula" class="col-md-1">Cédula</label>
                                            <div class="col-md-3">
                                                <input type="text" name="cedula" id="cedula" class="form-control">
                                            </div>
                                            <label for="nombre" class="col-md-1">Nombre</label>
                                            <div class="col-md-3">
                                                <input type="text" name="nombre" id="nombre" class="form-control">
                                            </div>
                                            <label for="apellido" class="col-md-1">Apellido</label>
                                            <div class="col-md-3">
                                                <input type="text" name="apellido" id="apellido" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="estado" class="col-md-1">Estado</label>
                                            <div class="col-md-3">
                                                <select name="estado" id="estado" class="form-control">
                                                    <option value="">::Seleccionar::</option>
                                                    <?php foreach ($estado as $e) { ?>
                                                        <option value="<?php echo $e->est_id ?>"><?php echo $e->est_nombre ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <label for="estado" class="col-md-1">Tipo de usuario</label>
                                            <div class="col-md-3">
                                                <select name="tipoUsuario" id="estado" class="form-control">
                                                    <option value="">::Seleccionar::</option>
                                                    <?php foreach ($tipoUsuario as $tu): ?>
                                                        <option value="<?php echo $tu->tipUsuEva_id ?>"><?php echo $tu->tipUsuEva_tipo ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4" style="text-align: center">
                                                <button type="button" class="btn btn-danger limpiar">Limpiar</button>
                                                <button type="button" class="btn btn-success consultar">Consultar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <table id="tablesst" class="table table-striped table-bordered table-hover ">
                                        <thead>
                                        <th>Cédula</th>
                                        <th>Usuario</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Estado</th>
                                        <th>Fecha actualización</th>
                                        <th>Fecha creación</th>
                                        <th>Último Ingreso</th>
                                        <th>Roles</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                        </thead>
                                        <tbody id="bodyuser">
                                        </tbody>
                                    </table>
                                </div>    
                            </div>    

                        </div>
                    </div>
                    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                        <div class="modal-dialog modal-lg" >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Permisos</h4>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                    <div class=" marginV20">
                                        <div class="widgetTitle">
                                            <h5><i class="glyphicon glyphicon-pencil"></i> Asignacion de Rol</h5>
                                        </div>
                                        <div class="well">
                                            <div class="row">
                                                <div class="form-group has-success has-feedback">
                                                    <form method="post" id="f15">
                                                        <input type="hidden" value="" id="idusuario" name="idusuario" />
                                                        <table class="tablesst"> 
                                                            <thead>
                                                            <th>Rol</th><th>Asignación</th>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($roles as $rol) { ?>
                                                                    <tr>
                                                                        <td><?php echo $rol['rol_nombre']; ?></td>
                                                                        <td style="text-align:center">
                                                                            <input type="checkbox" rol="<?php echo $rol['rol_id']; ?>" value="<?php echo $rol['rol_id']; ?>" id="idrol" name="idrol[]">
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>    

                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <form method="post" id="formulariopermisos">
                                                    <input type="hidden" name="usuarioid" id="usuarioid">
                                                    <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12 permisomenu">

                                                    </div>
                                                </form>    
                                            </div>
                                        </div>
                                    </div>
                                </div>		
                                <div class="modal-footer">
                                    <div class="row marginV10">
                                        <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 col-md-offset-8 col-lg-offset-8 col-sm-offset-8 col-sx-offset-8 margenlogo' align='center' >
                                            <button type="button" class="btn btn-success insertarrol">Asignar</button>
                                        </div>
                                        <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                                            <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
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
<form id="f10" method="post" action="<?php echo base_url("index.php/administrativo/creacionusuarios") ?>">
    <input type="hidden" value="" name="usu_id" id="usu_id">
</form>
<script>

    $('#ingresousuario').hide();
    $('.insertarrol').click(function () {
        $("#idusuario").val($(this).attr('usuarioid'));
        $.post(
                url + 'index.php/presentacion/guardarpermisos',
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

    $('body').delegate(".modificar", "click", function () {
        $("#usu_id").val($(this).attr("usu_id"));
        $("#f10").submit();
    });

    $('body').delegate('.permiso', 'click', function () {
        var id = $(this).attr('usuarioid');
        $('#usuarioid').val(id);
        $('.insertarrol').attr('usuarioid', id);
        $('input[type="checkbox"]').parent("span").removeClass('checked');
        $('input[type="checkbox"]').attr('checked', false);
        $.post(
                url + 'index.php/presentacion/consultarolxrolidusuario',
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

    $(function () {
        table = $('#tablesst').DataTable();
        $('.consultar').click(function () {
            $.post(
                    url + "index.php/administrativo/consultarusuario",
                    $("#f4").serialize()
                    ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("rojo", msg['message'])
                else {

                    table.clear().draw();
                    $.each(msg['Json'], function (key, val) {
                        var activo = "";
                        if (val.est_id == 1)
                            activo = "Activo";
                        if (val.est_id != 1)
                            activo = "Inactivo";
                        table.row.add([
                            val.usu_cedula,
                            val.usu_usuario,
                            val.usu_nombre,
                            val.usu_apellido,
                            activo,
                            val.usu_fechaActualizacion,
                            val.usu_fechaCreacion,
                            val.ing_fechaIngreso,
                            '<button type="button"  class="btn btn-block permiso" usuarioid="' + val.usu_id + '">Roles</button>',
                            '<center><button type="button" class="btn btn-info"><i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar" usu_id="' + val.usu_id + '"  data-toggle="modal" data-target="#myModal"></i></button></center>',
                            '<center><button type="button" class="btn btn-danger"><i class="fa fa-remove fa-2x eliminar" title="Eliminar" usu_id="' + val.usu_id + '"></i></button></center>',
                        ]).draw();
                    });

                }
            }
            ).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
            });
        });
    })
    $('body').delegate('.eliminar', 'click', function () {
        var asignacion = $(this);
        var usu_id = $(this).attr('usu_id');
        if (confirm("Esta seguro que desea eliminar el usuario?")) {
            $.post(
                    url + "index.php/administrativo/eliminarusuario", {usu_id: usu_id})
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