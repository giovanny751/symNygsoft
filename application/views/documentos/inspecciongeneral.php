<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="guardarInspeccion" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
        <!--<div class="circuloIcon" ><i class="fa fa-pencil-square-o fa-3x"></i></div>-->
        <!--<div class="circuloIcon" ><i class="fa fa-trash-o fa-3x"></i></div>-->
        <!--<div class="circuloIcon" ><i class="fa fa-folder-open fa-3x"></i></div>-->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">INSPECCIÓN GENERAL</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form id="FrmInspeccion" method="post">
        <div class="row">
            <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Fecha Inspección</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" name="fecha" id="fecha" class="form-control fecha" >
            </div>
            <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Nombre de quien realiza la inspección:</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <select name="empleado" class="form-control">
                    <option>::Seleccionar::</option>
                    <?php foreach ($empleado as $emp): ?>
                        <option value="<?php echo $emp->Emp_Id ?>"><?php echo $emp->Emp_Nombre . " " . $emp->Emp_Apellidos ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="alert alert-info" role="alert" style='margin-top:10px;font-weight: bold;text-align: center;'>
            Verificación del cumplimiento de aspectos en Seguridad Industrial
        </div>
        <div class="alert alert-info" role="alert" style='margin-top:10px;font-weight: bold;text-align: center;'>
            Marque con una X la casilla correspondiente de acuerdo con lo observado en la inspección. Realice las observaciones correspondientes.
        </div>

        <div class="row">
            <table class='tablesst'>
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
        <div class="row">
            <label>Observación general</label>
            <textarea name="observacionGeneral" class="form-control"></textarea>
        </div>
    </form>
</div>
<script>

    $('#guardarInspeccion').click(function () {
        $.post("<?php echo base_url("index.php/documento/guardarInspeccion") ?>",
                $('#FrmInspeccion').serialize()
                )
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        $('input[type="text"],select,textarea').val();
                        $('input').prop('checked', false);
                        alerta("verde","Datos guardados correctamente");
                    }
                })
                .fail(function (msg) {

                });
    });
</script>