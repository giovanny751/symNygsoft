<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url() . "index.php/administrativo/creacionusuarios" ?>"><div class="circuloIcon" title="Nuevo Usuario" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">
                <a href="<?php echo base_url("index.php/presentacion/principal") ?>">HOME</a>/
                <a href="<?php echo base_url("index.php/administrativo/empresa") ?>">EMPRESA</a>/
                LISTADO USUARIOS
            </span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form method="post" id="f4">
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
    </form>
    <hr>
    <div class="row">
        <table class="tablesst">
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
                <tr>
                    <td colspan="10">
            <center><b>Ingresar Filtros para realizar la consulta</b></center>
            </td>
            </tr>
            <?php // } ?>
            </tbody>
        </table>
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
<form id="f10" method="post" action="<?php echo base_url("index.php/administrativo/creacionusuarios") ?>">
    <input type="hidden" value="" name="usu_id" id="usu_id">
</form>
<script>

    $('#ingresousuario').hide();
    $('.insertarrol').click(function () {
        $("#idusuario").val($(this).attr('usuarioid'));
        $.post("<?php echo base_url('index.php/presentacion/guardarpermisos') ?>",
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
        $.post("<?= base_url('index.php/presentacion/consultarolxrolidusuario') ?>",
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
        source: "<?php echo base_url("index.php/administrativo/autocompletaruacedula") ?>",
        minLength: 1
    });
    $('#nombre').autocomplete({
        source: "<?php echo base_url("index.php/administrativo/autocompletar") ?>",
        minLength: 1
    });
    $('#apellido').autocomplete({
        source: "<?php echo base_url("index.php/administrativo/autocompletaruapellido") ?>",
        minLength: 1
    });

    $('.limpiar').click(function () {
        $('select,input').val('');
    });
    $('.consultar').click(function () {
        $.post(
                "<?php echo base_url("index.php/administrativo/consultarusuario") ?>",
                $("#f4").serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message'])
            else {
                $('#bodyuser *').remove();
                var body = "";
                $.each(msg.Json, function (key, val) {
                    if (val.est_id == 1)
                        var activo = "Activo";
                    if (val.est_id != 1)
                        var activo = "Inactivo";
                    body += "<tr>";
                    body += "<td>" + val.usu_cedula + "</td>";
                    body += "<td>" + val.usu_usuario + "</td>";
                    body += "<td>" + val.usu_nombre + "</td>";
                    body += "<td>" + val.usu_apellido + "</td>";
                    body += "<td>" + activo + "</td>";
                    body += "<td>" + val.usu_fechaActualizacion + "</td>";
                    body += "<td>" + val.usu_fechaCreacion + "</td>";
                    body += "<td>" + val.ing_fechaIngreso + "</td>";
                    body += '<td><button type="button"  class="btn btn-info permiso" usuarioid="' + val.usu_id + '">Roles</button></td>';
                    body += '<td class="transparent">\n\
                            <i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar" usu_id="' + val.usu_id + '"  data-toggle="modal" data-target="#myModal"></i>\n\
                        </td>';
                    body += '<td class="transparent">\n\
                            <i class="fa fa-trash-o fa-2x eliminar" title="Eliminar" usu_id="' + val.usu_id + '"></i>\n\
                        </td>';
                    body += "</tr>";
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
            $.post("<?php echo base_url("index.php/administrativo/eliminarusuario") ?>", {usu_id: usu_id})
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