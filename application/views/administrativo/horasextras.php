<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-clock-o"></i>HORAS EXTRAS
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
                            <div class="circuloIcon guardar">
                                <i class="fa fa-floppy-o fa-3x"></i>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <form method="post" id="FrmHorasExtras" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="empleado" class="col-md-1">
                                        <span style="color:red">*</span>Empleado
                                    </label>
                                    <div class="col-md-2">
                                        <select name="emp_id" id="empleado" class="form-control obligatorio">
                                            <option value="0">::Seleccionar::</option>
                                            <?php foreach ($empleados as $e): ?>
                                                <option value="<?php echo $e->Emp_id ?>"><?php echo $e->Emp_Nombre . " " . $e->Emp_Apellidos ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label for="fecha" class="col-md-1">
                                        <span style="color:red">*</span>Fecha
                                    </label>
                                    <div class="col-md-2">
                                        <input type="text" name="fecha" id="fecha" class="form-control fecha  obligatorio"/>
                                    </div>
                                    <label for="horas" class="col-md-1">
                                        <span style="color:red">*</span>Cantidad Horas
                                    </label>
                                    <div class="col-md-2">
                                        <input type="number" name="horas" id="horas" class="form-control obligatorio"/>
                                    </div>
                                    <label for="tipo" class="col-md-1">
                                        <span style="color:red">*</span>Tipo
                                    </label>
                                    <div class="col-md-2">
                                        <select name="tipo" id="tipo" class="form-control obligatorio">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($tipo as $t): ?>
                                                <option value="<?php echo $t->horExtTip_id ?>"><?php echo $t->horExtTip_tipo ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-info">
                        <center><b>Horas registradas el día de Hoy</b></center>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table table-striped table-bordered table-hover tabla-sst" id="horasEmpleados">
                                <thead>
                                <th>Empleado</th>
                                <th>Fecha</th>
                                <th>Cantidad Horas</th>
                                <th>Tipo</th>
                                <th>Eliminar</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>

            $('document').ready(function () {

                $.post(
                        url + "index.php/administrativo/horasExtrasGuardadasHoy"
                        ).done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        $('#FrmHorasExtras input,select').val("");
                        horasExtras(msg);
                    }
                })
                        .fail(function (msg) {
                            alerta("rojo", "Error, comunicarse con el administrador");
                        });

                function horasExtras(msg) {
                    var table = $('#horasEmpleados').DataTable();
                    table
                            .clear()
                            .draw();

                    $.each(msg.Json, function (key, val) {
                        table.row.add([val.Emp_Nombre + " " + val.Emp_Apellidos,
                            val.empHorExt_fecha,
                            val.empHorExt_horas, val.horExtTip_tipo,
                            "<button type='button' class='btn btn-danger eliminar' HorExtId='" + val.empHorExt_id + "' title='Eliminar'>-</button>"
                        ]).draw();
                    })
                }

                $('.guardar').click(function () {
                    if (obligatorio('obligatorio')) {
                        $.post(
                                url + "index.php/administrativo/guardarHorasExtrasEmpleado",
                                $('#FrmHorasExtras').serialize()
                                ).done(function (msg) {
                            if (!jQuery.isEmptyObject(msg.message))
                                alerta("rojo", msg['message'])
                            else {
                                $('#FrmHorasExtras input,select').val("");
                                horasExtras(msg);
                                alerta('verde', 'Guardado con exito');
                            }
                        })
                                .fail(function (msg) {
                                    alerta("rojo", "Error, comunicarse con el administrador");
                                });
                    }
                });

                $('body').delegate(".eliminar", "click", function () {
                    if (confirm("Esta seguro de eliminar la hora extra")) {
                        $.post(
                                url + "index.php/administrativo/eliminarHorasExtrasEmpleado",
                                {HorExtId: $(this).attr('HorExtId')}
                        ).done(function (msg) {
                            horasExtras(msg);
                        }).fail(function (msg) {
                            alerta("rojo", "Ocurrio un error por favor comunicarse con el administrador");
                        });
                    }
                });
            });
        </script>    