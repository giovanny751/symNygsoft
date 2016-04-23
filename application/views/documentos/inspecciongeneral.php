<br>
<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="guardarInspeccion" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>INSPECCIÓN GENERAL
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form id="FrmInspeccion" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="fecha">Fecha de Inspección</label>
                                    <div class="col-md-8">
                                        <input type="text" name="fecha" id="fecha" class="form-control fecha obliContrato" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-6 control-label" for="empleado">Nombre de quien realiza la inspección:</label>
                                    <div class="col-md-6">
                                        <select name="empleado" id="empleado" class="form-control obliContrato">
                                            <option value=''>::Seleccionar::</option>
                                            <?php foreach ($empleado as $emp): ?>
                                                <option value="<?php echo $emp->Emp_id ?>"><?php echo strtoupper($emp->Emp_Nombre . " " . $emp->Emp_Apellidos) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info" role="alert" style='margin-top:10px;font-weight: bold;text-align: center;'>
                                    Verificación del cumplimiento de aspectos en Seguridad Industrial
                                    <br>
                                    Marque con una X la casilla correspondiente de acuerdo con lo observado en la inspección. Realice las observaciones correspondientes.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class='table table-bordered table-hover'>
                                    <?php foreach ($factores as $factor => $t): ?>
                                        <thead>
                                            <tr>
                                                <th colspan="5"><?php echo explode("/", $factor)[1] ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align:center">ITEM</td>
                                                <td style="text-align:center">SI</td>
                                                <td style="text-align:center">NO</td>
                                                <td style="text-align:center">NA</td>
                                            </tr>
                                            <?php foreach ($t as $tipo => $num): ?>
                                                <tr>
                                                    <td colspan="5"><b><?php echo explode("/", $tipo)[1] ?></b></td>
                                                </tr>
                                                <?php foreach ($num as $elemento): ?>
                                                    <tr>
                                                        <td style="padding-left: 50px"><?php echo $elemento[1] ?></td>
                                                        <td><input type="radio" name="<?php echo $elemento[0] . "/elemento" ?>" class="form-control" value="1" at="si"></td>
                                                        <td><input type="radio" name="<?php echo $elemento[0] . "/elemento" ?>" class="form-control" value="2" at="no"></td>
                                                        <td><input type="radio" name="<?php echo $elemento[0] . "/elemento" ?>" class="form-control" value="3" at="na"></td>
                                                    </tr>
                                                    <?php
                                                endforeach;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observaciones" class="col-md-2">Observaciones</label>
                                    <div class="col-md-10">
                                        <textarea id="observaciones" name="observacionGeneral" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('#guardarInspeccion').click(function () {
        if (obligatorio('obliContrato')) {
            $.post(
                    url + "index.php/documento/guardarInspeccion",
                    $('#FrmInspeccion').serialize()
                    )
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta("amarillo", msg['message'])
                        else {
                            $('input[type="text"],select,textarea').val('');
                            $('input').prop('checked', false);
                            alerta("verde", "Datos guardados correctamente");
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error por favor comunicarse con el administrador");
                    });
        }
    });
</script>