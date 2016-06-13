<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>LISTADO CONTROLES
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="portlet box blue">
                        <div class="portlet-body">
                            <form method="post" class="form-horizontal" id="frmListado">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Tipo control</label>
                                            <div class="col-md-4">
                                                <?php echo lista("tipAcc_id", "tipAcc_id", "form-control obligatorio", "tipoAccion", "tipAcc_id", "tipAcc_nombre", null, array("est_id" => "1"), /* readOnly? */ false); ?>
                                            </div>
                                            <label class="control-label col-md-2">Responsable</label>
                                            <div class="col-md-4">
                                                <input type="text" name="responsable" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Lugar</label>
                                            <div class="col-md-4">
                                                <input type="text" name="lugar" class="form-control ">
                                            </div>
                                            <label class="control-label col-md-2">Cargo</label>
                                            <div class="col-md-4">
                                                <input type="text" name="cargo" class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="text-align: center">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success" id="consultar">Consultar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="tablesst" class="table table-striped table-bordered table-hover tabla-sst">
                                <thead>
                                <th>Tipo control</th>
                                <th>Compañia</th>
                                <th>Lugar</th>
                                <th>Responsable</th>
                                <th>Cargo</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="row" id="matrizLegal">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    $('#consultar').click(function () {
        $.post(url + "index.php/riesgo/consultaListadoPrevencion",
                $('#frmListado').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message']);
            else {
                var table = $('#tablesst').DataTable();
                table.clear().draw();
                $.each(msg['Json'], function (key, val) {
                    table.row.add([
                        val.tipAcc_nombre,
                        val.pertenece,
                        val.pre_lugar,
                        (val.Emp_nombre != null) ? val.Emp_nombre + " " + val.Emp_Apellidos : val.pre_empleado_externo,
                        (val.car_nombre != null) ? val.car_nombre : val.pre_cargo_externo,
                        '<a href="javascript:"><i class="fa fa-pencil-square-o fa-2x  modificar" aria-hidden="true" title="Modificar"  pre_id="' + val.pre_id + '" ></i></a>',
                        '<a href="javascript:"><i class="fa fa-trash-o fa-2x   eliminar" aria-hidden="true" title="Eliminar" pre_id="' + val.pre_id + '"></i></a>'
                    ]).draw();
                });
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, comunicarse con el administrador del sistema");
        });
    });

    $('body').delegate('.modificar', 'click', function () {
        var form = "<form method='post' id='frmModificarPrevencion' action='<?php echo base_url('index.php/Riesgo/prevencionRiesgo') ?>'>";
        form += "<input type='hidden' value='" + $(this).attr("pre_id") + "' name='pre_id'>"
        form += "</form>";
        $('body').append(form);
        $('#frmModificarPrevencion').submit();
    });
    $('body').delegate('.eliminar', 'click', function () {
        var r = confirm('¿Desea eliminarla?')
        if (r == false)
            return r;

        $.post(url + "index.php/Riesgo/prevencionRiesgo_inactivar", {pre_id: $(this).attr("pre_id")})
                .done(function () {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message']);
                    else {
                        alerta('verde','Eliminado con exito.')
                        $('#consultar').trigger('click');
                    }
                })
                .fail(function () {
                    alerta('rojo', 'Error en la accion por favor intentar mas tarde.')
                })
    });
</script>    