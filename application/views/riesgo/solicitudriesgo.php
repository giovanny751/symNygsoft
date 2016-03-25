<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url() . "/index.php/riesgo/nuevoriesgo" ?>"><div class="circuloIcon" title="Nuevo Riesgo" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>SOLICITUD RIESGO
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form method="post" id="consultaSolicitud" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="numSolicitud" class="col-md-4 control-label">Numero de Solicitud:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="numSolicitud" id="numSolicitud" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="solicitante" class="col-md-4 control-label">Empleado:</label>
                                    <div class="col-md-8">
                                        <select name="solicitante" id="solicitante" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($empleados as $empleado): ?>
                                                <option value="<?php echo $empleado->Emp_Id ?>"><?php echo $empleado->Emp_Nombre . " " . $empleado->Emp_Apellidos ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dimension1" class="col-md-4 control-label"><?php echo $empresa->Dim_id ?></label>
                                    <div class="col-md-8">
                                        <select name="dimension1" id="dimension1" class="form-control obligatorio dimencion_uno_se">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension as $d): ?>
                                                <option value="<?php echo $d->dim_id; ?>"><?php echo $d->dim_descripcion ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dimension2" class="col-md-4 control-label"><?php echo $empresa->Dimdos_id ?></label>
                                    <div class="col-md-8">
                                        <select name="dimension2" id="dimension2" class="form-control dimencion_dos_se">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension2 as $d2): ?>
                                                <option value="<?php echo $d2->dim_id; ?>"><?php echo $d2->dim_descripcion ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fInicial" class="col-md-4 control-label">Fecha inicial de solicitud</label>
                                    <div class="col-md-8">
                                        <input type="text" name="fInicial" id="fInicial" class="fecha form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fFinal" class="col-md-4 control-label">Fecha final de solicitud</label>
                                    <div class="col-md-8">
                                        <input type="text" name="fFinal" id="fFinal" class="fecha form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
                                    <button type="button" id="consultar" class="btn btn-sst">Consultar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tabla_general" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Solicitud</th>
                                        <th>Nombre Solicitante</th>
                                        <th>Correo Solicitante</th>
                                        <th><?php echo $empresa->Dim_id ?></th>
                                        <th><?php echo $empresa->Dimdos_id ?></th>
                                        <th>Fecha Solicitud</th>
                                        <th>Verificar</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaSolicitud">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="solicitud" tabindex="-1" role="dialog" aria-labelledby="solicitud">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">INFORMACIÓN</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><b>Nombre Solicitante:</b></label>
                            <label class="col-sm-4 control-label" id="modalSolicitante"></label>
                            <label class="col-sm-2 control-label"><b>Correo Electronico:</b></label>
                            <label class="col-sm-4 control-label" id="modalCorreo"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><b><?php echo $empresa->Dim_id ?></b></label>
                            <label class="col-sm-4 control-label" id="modalDimension1"></label>
                            <label class="col-sm-2 control-label"><b><?php echo $empresa->Dimdos_id ?></b></label>
                            <label class="col-sm-4 control-label" id="modalDimension2"></label>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label><b>Descripción</b></label>
                                <textarea id="modalDescripcion" class="form-control" disabled="disabled"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            var tabla = $('#tabla_general').DataTable();
        })

        $("#consultar").click(function () {
            $.post(
                    url + "index.php/riesgo/filtroSolicitud",
                    $("#consultaSolicitud").serialize())
                    .done(function (msg) {
                        var html = ""
                        $("#tablaSolicitud").empty();
                        if (typeof (msg.message) != "undefined") {
                            alerta("rojo", "Error al momento de ingresar datos");
                        } else {
                            var tabla = $('#tabla_general').DataTable();
                            tabla.row().clear().draw();
                            $.each(msg.Json, function (indice, valor) {
                                tabla.row.add([
                                    valor.solicitud,
                                    valor.empleado,
                                    valor.correo,
                                    valor.dimension1,
                                    ((valor.dimension2 == null) ? "" : valor.dimension2),
                                    valor.fechaCreacion,
                                    "<button type='button' class='btn btn-circle' data-toggle='modal' data-target='#solicitud' data-whatever='" + valor.solicitud + "'><i class='fa fa-street-view'></i></button>"
                                ]).draw();
                            });
//                            $("#tablaSolicitud").append(html);
//                            alerta("verde", "Exito")
                        }
                    })
                    .fail(function () {
                        alerta("rojo", "Falla")
                    });

        });

        $('#solicitud').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var recipient = button.data('whatever');
            var modal = $(this)
            $.post(url + "index.php/riesgo/consultaSolicitud", {solicitud: recipient})
                    .done(function (msg) {
                        if (typeof (msg.message) != "undefined") {
                            alerta("rojo", "Error al momento de ingresar datos");
                        } else {
                            modal.find("#modalSolicitante").text(msg.Json.empleado);
                            modal.find("#modalCorreo").text(msg.Json.correo);
                            modal.find("#modalDimension1").text(msg.Json.dimension1);
                            modal.find("#modalDimension2").text(msg.Json.dimension2);
                            modal.find("#modalDescripcion").val(msg.Json.descripcion);
                        }
                    })
                    .fail(function () {
                        alerta("rojo", "Error")
                    })
        })
    </script>