<div class="row">
    <div class="circuloIcon guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">
                <a href="<?php echo base_url("index.php/administrativo/listadoempleados") ?>">EMPLEADO</a>/
                <a href="#">HORAS EXTRAS</a>
            </span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <div class="row">
        <form method="post" id="FrmHorasExtras">
            <label for="empleado" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <span style="color:red">*</span>Empleado
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <select name="emp_id" id="empleado" class="form-control obligatorio">
                    <option value="0">::Seleccionar::</option>
                    <?php foreach ($empleados as $e): ?>
                        <option value="<?php echo $e->Emp_Id ?>"><?php echo $e->Emp_Nombre . " " . $e->Emp_Apellidos ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label for="fecha" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <span style="color:red">*</span>Fecha
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="text" name="fecha" id="fecha" class="form-control fecha  obligatorio"/>
            </div>
            <label for="horas" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <span style="color:red">*</span>Cantidad Horas
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="number" name="horas" id="horas" class="form-control obligatorio"/>
            </div>
            <label for="tipo" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <span style="color:red">*</span>Tipo
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <select name="tipo" id="tipo" class="form-control obligatorio">
                    <option value="">::Seleccionar::</option>
                    <?php foreach ($tipo as $t): ?>
                        <option value="<?php echo $t->horExtTip_id ?>"><?php echo $t->horExtTip_tipo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>
    <div class="row">
        <table class="tabla-sst" id="horasEmpleados">
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
            $.each(msg.Json, function (key, val) {
                table.row.add([
                    val.Emp_Nombre + " " + val.Emp_Apellidos,
                    val.empHorExt_fecha,
                    val.empHorExt_horas,
                    val.horExtTip_tipo,
                    "<button type='button' class='btn btn-danger' title='Eliminar'>-</button>"
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
    });
</script>    