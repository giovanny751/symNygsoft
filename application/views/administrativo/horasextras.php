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
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
            <form method="post" id="FrmHorasExtras">
                <label for="empleado" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Empleado</label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <select name="emp_id" id="empleado" class="form-control">
                        <option>::Seleccionar::</option>
                        <?php foreach ($empleados as $e): ?>
                            <option value="<?php echo $e->Emp_Id ?>"><?php echo $e->Emp_Nombre . " " . $e->Emp_Apellidos ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <label for="fecha" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    Fecha
                </label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="fecha" id="fecha" class="form-control fecha"/>
                </div>
                <label for="horas" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    Cantidad Horas
                </label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="number" name="horas" id="horas" class="form-control"/>
                </div>
                <label for="tipo" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    Tipo
                </label>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="">::Seleccionar::</option>
                        <?php foreach ($tipo as $t): ?>
                            <option value="<?php echo $t->horExtTip_id ?>"><?php echo $t->horExtTip_tipo ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.guardar').click(function () {
        $.post("<?php echo base_url("index.php/administrativo/guardarHorasExtras") ?>",
                $('#FrmHorasExtras').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message'])
            else {

            }
        })
                .fail(function (msg) {

                });
    });
</script>    