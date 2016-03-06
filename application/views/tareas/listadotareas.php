
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> Listado Tareas
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" id="f9">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?php echo base_url() . "/index.php/tareas/nuevatarea" ?>"><div class="circuloIcon" title="Nueva Tarea" ><i class="fa fa-folder-open fa-3x"></i></div></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label for="Plan">Plan</label>
                                <select name="Plan" id="Plan" class="form-control">
                                    <option value="">::Seleccionar::</option>
                                    <?php foreach ($planes as $p) { ?>
                                        <option value="<?php echo $p->pla_id ?>"><?php echo strtoupper($p->pla_nombre) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label for="filtrotarea">Filtro Tareas</label>
                                <select name="filtrotarea" id="filtrotarea" class="form-control">
                                    <option value="">::Seleccionar::</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label for="responsable">Responsable</label>
                                <select name="responsable" id="responsable" class="form-control">
                                    <option value="">::Seleccionar::</option>
                                    <?php foreach ($responsables as $r) { ?>
                                        <option value="<?php echo $r->emp_id ?>"><?php echo strtoupper($r->Emp_Nombre . " " . $r->Emp_Apellidos) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label for="responsable">Tipo Riesgo</label>
                                <select name="responsable" id="responsable" class="form-control">
                                    <option value="">::Seleccionar::</option>
                                </select>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <button type="button" class="btn btn-block" id="consultar">Consultar</button>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body   ">
                                <div class="row" id='filtroconsulta'>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<form method="post" id="f13" action="<?php echo base_url("index.php/tareas/nuevatarea") ?>">
    <input type="hidden" name="tar_id" id="tar_id">
</form>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Riesgos</h4>
            </div>
            <div class="modal-body">
                <div class="resultado"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $('#Plan').change(function () {
        $.post(
                url + "index.php/tareas/consultaractividadpadre",
                {plan: $(this).val()}
        ).done(function (msg) {
            $('#filtrotarea *').remove();
            var optionTarea = "<option value=''>::Seleccionar::</option>";
            $.each(msg.tareaPadre, function (key, val) {
                optionTarea += "<option value='" + val.tar_id + "'>" + val.tar_nombre.toUpperCase()  + "</option>";
            });
            $('#filtrotarea').append(optionTarea);
        }).fail(function () {
            alerta("rojo", "Error por favor comunicarse con el administrador");
        });
    });

    $('body').delegate('.modificar', "click", function () {
        $('#tar_id').val($(this).attr('tar_id'));
        $('#f13').submit();
    });

    $('body').delegate(".nuevoavance", "click", function () {
        var form = "<form method='post' id='frmFormAvance' action='" + url + "index.php/tareas/nuevatarea" + "'>";
        form += "<input type='hidden' name='tar_id' value='" + $(this).attr("tar_id") + "'>"
        form += "<input type='hidden' name='nuevoavance' value='" + $(this).attr("tar_id") + "'>"
        form += "</form>";
        $("body").append(form);
        $('#frmFormAvance').submit();
    });

    $('#consultar').click(function () {
        $.post(
                url + "index.php/tareas/consultatareas",
                $('#f9').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                $('#filtroconsulta *').remove();
                var table = "";
                var encabezado = "<tr>";
                encabezado += "<th width='5%'>AGREGAR AVANCE</th>"
                encabezado += "<th width='5%'>AVANCE</th>"
                encabezado += "<th width='5%'>TIPO</th>"
                encabezado += "<th width='20%'>NOMBRE DE LA TAREA</th>"
                encabezado += "<th width='8%'>FECHA INICIO</th>"
                encabezado += "<th width='8%'>FECHA FIN</th>"
                encabezado += "<th width='14%'>DURACIÓN PRESUPUESTADA</th>"
                encabezado += "<th width='10%'>RESPONSABLES</th>"
                encabezado += "<th># RIESGOS</th>"
                encabezado += "<th>RIESGOS</th>"
                encabezado += "<th>EDITAR</th>"
                encabezado += "<th>ELIMINAR</th>"
                encabezado += "</tr>";
                $.each(msg.Json, function (idplan, nombreplan) {
                    table += " <div class='table-responsive'><table class='table table-striped table-bordered table-hover'>";
                    $.each(nombreplan, function (nombre, tareaid) {
                        table += "<thead><tr><th colspan='12'>" + nombre + "</th></tr>";
                        table += encabezado;
                        table += "</thead>";
                        table += "<tbody>";
                        $.each(tareaid, function (idtar, detalle) {
                            if (idtar != "") {
                                $.each(detalle, function (nombre, numeracion) {
                                    if (typeof numeracion != "string") {
                                        table += "<tr>";
                                        table += '<td style="text-align:center"><i class="fa fa-bookmark-o btn btn-default nuevoavance" title="Nuevo avance" tar_id="' + idtar + '" ></i></td>';
                                        table += "<td>" + numeracion.progreso + "</td>";
                                        table += "<td>" + numeracion.tipo + "</td>";
                                        table += "<td>" + numeracion.nombretarea + "</td>";
                                        table += "<td>" + numeracion.fechainicio + "</td>";
                                        table += "<td>" + numeracion.fechafinalizacion + "</td>";
                                        table += "<td style='text-align:center;'>" + numeracion.diferencia + "</td>";
                                        table += "<td>" + numeracion.nombre + "</td>";
                                        table += "<td>" + numeracion.cantidadriesgo + "</td>";
                                        table += '<td class="transparent">';
                                        if (numeracion.cantidadRiesgo > 0) {
                                            table += '<center><i class="fa fa-file-text-o fa-2x  riesgos" title="Riesgos" tar_id="' + idtar + '"  ></i>';
                                        }
                                        table += "</td>";
                                        table += '<td class="transparent">';
                                        table += '<i class="fa fa-pencil-square-o fa-2x  modificar" title="Modificar" tar_id="' + idtar + '" ></i>';
                                        table += "</td>";
                                        table += '<td class="transparent">';
                                        table += '<i class="fa fa-trash-o fa-2x eliminar" title="Eliminar" tar_id="' + idtar + '" ></i>';
                                        table += "</td>";
                                        table += "</tr>";
                                    }
                                });
                            } else {
                                table += "<tr>";
                                table += "<td colspan='12'><center><b>No hay tareas asociadas al plan</b></center></td>";
                                table += "</tr>";
                            }
                        });
                    });
                    table += "</tbody>";
                    table += "</table></div>";
                });
            }
            $('#filtroconsulta').append(table);
        }
        ).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
        });
    });

    $('body').delegate(".riesgos", "click", function () {
        var seleccion = $(this)
        $.post(
                url + "index.php/tareas/obtener_riesgos",
                {tar_id: $(this).attr("tar_id")}
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                var html = "<ul>";
                $.each(msg.Json, function (key, val) {
                    html += "<li>" + val.rie_descripcion + "</li>";
                })
                html += "</ul>";
                $('.resultado').html(html);
                $('#myModal').modal('show');
            }

        }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sistema")
        });

    });
    $('body').delegate(".eliminar", "click", function () {
        var seleccion = $(this)
        $.post(
                url + "index.php/tareas/eliminartarea",
                {tarea: $(this).attr("tar_id")}
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                seleccion.parents("tr").remove();
                alerta("verde", "Tarea eliminada correctamente");
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sistema")
        });

    });
</script>