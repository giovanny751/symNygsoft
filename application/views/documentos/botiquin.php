<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="guardarInspeccionBotiquin" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">INSPECCIÓN BOTIQUIN</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form method="post" id='FrmBotiquin'>
        <div class="row">
            <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Fecha Inspección</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" name="fecha" id="fecha" class="form-control fecha" value='<?php echo date("Y-m-d") ?>'>
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
        <div class="row">
            <table class="tablesst">
                <thead>
                <th>GRUPO</th>
                <th>ELEMENTO</th>
                <th>OPCIÓN</th>
                <th>FECHA DE VENCIMIENTO</th>
                <th>CANTIDAD</th>
                </thead>
                <thead>
                <tbody>
                    <?php foreach ($seguridad as $grupo => $num): ?>
                        <?php
                        $rowspan = count($num);
                        $i = 0;
                        $d = 0;
                        foreach ($num as $elemento):
                            ?>
                            <tr>
                                <?php if ($rowspan > $i && $d == 0): ?>
                                    <td rowspan="<?php echo $rowspan ?>"><?php echo $grupo; ?></td>
                                    <?php
                                    $d = 1;
                                endif;
                                $i++;
                                ?>
                                <td><?php echo $elemento[1]; ?></td>
                                <td class="transparent">
                                    <select name="opcion[]" class="form-control" style="text-align:center">
                                        <option>::Seleccionar::</option>
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </td>
                                <td class="transparent"><input type="text" class="form-control fecha" name="fechaVencimiento[]"></td>
                                <td class="transparent"><input type="number" class="form-control cantidad" name="cantidad[]" value="0"></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <label for="observaciones">Observaciones</label>
            <textarea id="observaciones" name="observaciones" class="form-control"></textarea>
        </div>
    </form>
</div>
<script>
    $('.cantidad').change(function () {
        if ($(this).val() == "")
            $(this).val(0)
    });

    $('#guardarInspeccionBotiquin').click(function () {
        $.post("<?php echo base_url("index.php/documento/guardarBotiquin") ?>",
                $('#FrmBotiquin').serialize()
                )
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        $('input[type="text"],select,textarea').val();
                        $('input').prop('checked', false);
                        alerta("verde", "Datos guardados correctamente");
                    }
                })
                .fail(function (msg) {

                });
    });
</script>