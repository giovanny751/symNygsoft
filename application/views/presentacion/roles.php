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
                <form method="post" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <button type="button" class="btn green opciones" data-toggle="modal" data-target="#myModal">Nuevo Rol</button>
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
                    <i class="fa fa-table"></i> Tabla
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
                                <th>Nombre</th>
                                <th>Fecha de creación</th>
                                <th>Fecha de modificación</th>
                                <th>Opciones</th>
                                <th>Notificación</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="cuerporol">
                            <?php foreach ($roles as $datos) { ?>
                                <tr>
                                    <td><?php echo $datos['rol_nombre']; ?></td>
                                    <td><?php echo $datos['rol_fechaCreacion']; ?></td>
                                    <td><?php echo $datos['rol_fechaModificacion']; ?></td>
                                    <td align="center"><button type="button" rol="<?php echo $datos['rol_id']; ?>"    class="btn btn-info modificar">Opciones</button></td>
                                    <td align="center"><button type="button" rol="<?php echo $datos['rol_id']; ?>" class="btn btn-warning notificacion">Notificación</button></td>
                                    <td align="center"><button type="button" rol="<?php echo $datos['rol_id']; ?>" class="btn btn-danger eliminar">Eliminar</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Notificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Modificación</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" marginV20">
                    <div class="widgetTitle">
                        <h5><i class="glyphicon glyphicon-pencil"></i> Nuevo</h5>
                    </div>
                    <div class="well" >
                        <form method="post" id="frmNotificacion">
                            <input type="hidden" id="rolNotificacion" name="rol">
                            <table class="table table-hover table-bordered ">
                                <thead>
                                <th>Notificación</th>
                                <th>Selección</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($notificacion as $not): ?>
                                        <tr>
                                            <td><?php echo $not->not_notificacion ?></td>
                                            <td><input type="checkbox" name="notificacion[]" value="<?php echo $not->not_id ?>" ></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>		
            <div class="modal-footer">
                <div class="row marginV10">
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 col-md-offset-8 col-lg-offset-8 col-sm-offset-8 col-sx-offset-8 margenlogo' align='center' >
                        <button type="button" class="btn btn-primary guardarRolNotificacion">Guardar</button>
                    </div>
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Modificación</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" marginV20">
                    <div class="widgetTitle">
                        <h5><i class="glyphicon glyphicon-pencil"></i> Nuevo</h5>
                    </div>
                    <div class="well" >
                        <form id="nuevorol" method="post">
                            <input type="hidden" id="rolesuser" name="rol">
                            <div class="form-group agregarrol">

                            </div>
                            <div class="form-group datas"  style="overflow: scroll;height: 250px;">
                                <b>Permisos <span style="float:right">1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4&nbsp;&nbsp;</span></b>
                                <?php
                                echo $content;
                                ?>
                            </div>
                        </form>    
                    </div>
                    <b>Permisos</b><br>
                    <b>1</b> Incluir al menu<br>
                    <b>2</b> Crear <br>
                    <b>3</b> Modificar <br>
                    <b>4</b> Eliminar <br>
                </div>
            </div>		
            <div class="modal-footer">
                <div class="row marginV10">
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 col-md-offset-8 col-lg-offset-8 col-sm-offset-8 col-sx-offset-8 margenlogo' align='center' >
                        <button type="button" class="btn btn-primary guardar">Guardar</button>
                    </div>
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
<script>
    $('.guardarRolNotificacion').click(function () {
        $.post(url + "index.php/Presentacion/guardarNotificacionRol", $('#frmNotificacion').serialize())
                .done(function (msg) {

                })
                .fail(function (msg) {

                });
    });

    $('body').delegate(".notificacion", "click", function () {
        $('#rolNotificacion').val($(this).attr('rol'));
        $("#Notificacion").modal("show");
    });

    $('.seleccionados').click(function () {
        var atr = $(this).attr('atr')
        var marcado = $(this).is(":checked");
        if (marcado == true)
            var r = true;
        else
            var r = false;
        $("." + atr).each(function () {
            $(this).prop('checked', r);
        });
    })
    $('.crear2').click(function () {
        var atr = $(this).attr('atr')
        var marcado = $(this).is(":checked");
        if (marcado == true)
            var r = true;
        else
            var r = false;
        $("." + atr + '_c').each(function () {
            $(this).prop('checked', r);
        });
    })
    $('.modificar2').click(function () {
        var atr = $(this).attr('atr')
        var marcado = $(this).is(":checked");
        if (marcado == true)
            var r = true;
        else
            var r = false;
        $("." + atr + '_m').each(function () {
            $(this).prop('checked', r);
        });
    })
    $('.eliminar2').click(function () {
        var atr = $(this).attr('atr')
        var marcado = $(this).is(":checked");
        if (marcado == true)
            var r = true;
        else
            var r = false;
        $("." + atr + '_e').each(function () {
            $(this).prop('checked', r);
        });
    })
//    
//------------------------------------------------------------------------------
//                      ELIMINAR ROL    
//------------------------------------------------------------------------------ 
    $('body').delegate('.eliminar', 'click', function () {
        var r = confirm('Desea eliminar este Rol');
        if (r == false) {
            return false;
        }
        var posicion = $(this);
        $.post(
                url + 'index.php/presentacion/eliminarrol', {id: $(this).attr('rol')})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta(msg.color, msg['message'])
                    else {
                        posicion.parents('tr').remove();
                        alerta("verde", "Eliminado con exito");
                    }
                }).fail(function (msg) {
            alerta("rojo", "Error por favor comunicarse con el administrador del sistema");
        });
    });
//------------------------------------------------------------------------------
//                      NUEVO ROL    
//------------------------------------------------------------------------------    
    $('body').delegate('.guardar', 'click', function () {
        if (obligatorio("obligatorio")) {
            $.post(
                    url + 'index.php/presentacion/guardarroles',
                    $('#nuevorol').serialize(), function (data) {
                $('#myModal').modal('hide');
                var filas = "";
                data = jQuery.parseJSON(data);
                $.each(data, function (key, val) {
                    filas += "<tr>";
                    filas += "<td>" + val.rol_nombre + "</td>";
                    filas += "<td>" + val.rol_fechaCreacion + "</td>";
                    filas += "<td>" + val.rol_fechaModificacion + "</td>";
                    filas += "<td><button type='button' rol='" + val.rol_id + "' class='btn btn-info modificar' data-toggle='modal' data-target='#myModal'>Opciones</button></td>";
                    filas += "<td><button type='button' rol='" + val.rol_id + "' class='btn btn-danger notificacion'>Notificación</button></td>";
                    filas += "<td><button type='button' rol='" + val.rol_id + "' class='btn btn-danger eliminar'>Eliminar</button></td>";
                    filas += "</tr>";
                });
                $('#cuerporol *').remove();
                $('#cuerporol').append(filas);
                $('#nombre').val('');
            });
        }
    });

    $('.opciones').click(function () {
        $(".nombres").remove()
        $('input[type="checkbox"]').prop('checked', false);
        $('.agregarrol').append('<label class="nombres">Nombre</label><input type="text" id="nombre" name="nombre" class="form-control nombres obligatorio">');
        $('#nombre').val('');
        $('.seleccionados').prop('checked', false);
    });

    $("body").delegate(".modificar", "click", function () {

//        alert("444");
        $('#rolesuser').val($(this).attr('rol'));
        $('input[type="checkbox"]').parent("span").removeClass("checked");
        $('input[type="checkbox"]').prop('checked', false);
        $('.agregarrol *').remove();
        $.post(
                url + 'index.php/presentacion/rolesasignados',
                {id: $(this).attr('rol')}, function (data) {
            
            if (!jQuery.isEmptyObject(data.message))
                alerta("rojo", data.message);
            else {
                data = jQuery.parseJSON(data);
                $.each(data, function (key, val) {
                    $('.seleccionados[value="' + val.menu_id + '"]').parent("span").addClass("checked");
                    $('.seleccionados[value="' + val.menu_id + '"]').prop('checked', true);
                    if (val.perRol_crear != 0) {
                        $('.crear2[value="' + val.menu_id + '"]').parent("span").addClass("checked");
                        $('.crear2[value="' + val.menu_id + '"]').prop('checked', true);
                    }
                    if (val.perRol_modificar != 0) {
                        $('.modificar2[value="' + val.menu_id + '"]').parent("span").addClass("checked");
                        $('.modificar2[value="' + val.menu_id + '"]').prop('checked', true);
                    }
                    if (val.perRol_eliminar != 0) {
                        $('.eliminar2[value="' + val.menu_id + '"]').parent("span").addClass("checked");
                        $('.eliminar2[value="' + val.menu_id + '"]').prop('checked', true);
                    }
                });
                $('#myModal').modal("show");
            }
        });
    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function () {
        $('body').tooltip();
    });
</script>