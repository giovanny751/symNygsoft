<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>INSPECCIÓN BOTIQUIN
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="circuloIcon" id="guardarInspeccionBotiquin" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
                        </div>
                    </div>
                    <form method="post" id='FrmBotiquin' class="form-horizontal">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha" class="col-md-4 control-label" >Fecha Inspección</label>
                                    <div class="col-md-8">
                                        <input type="text" name="fecha" id="fecha" class="form-control fecha obligatorio" value='<?php echo date("Y-m-d") ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="empleado" class="col-md-6 control-label">Nombre de quien realiza la inspección:</label>
                                    <div class="col-md-6">
                                        <select name="empleado" id="empleado" class="form-control obligatorio">
                                            <option value="">::Seleccionar::</option>
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
                                <table class='table table-bordered table-hover'>
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
                                                            <option value=''>::Seleccionar::</option>
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
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observaciones" class="col-md-2">Observaciones</label>
                                    <div class="col-md-10">
                                        <textarea id="observaciones" name="observaciones" class="form-control"></textarea>
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
    $('.cantidad').change(function () {
        if ($(this).val() == "")
            $(this).val(0)
    });

    $('#guardarInspeccionBotiquin').click(function () {
        if(obligatorio('obligatorio')){
        $.post(
                url + "index.php/documento/guardarBotiquin",
                $('#FrmBotiquin').serialize()
                )
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        $('input[type="text"],select,textarea').val('');
                        $('input').prop('checked', false);
                        alerta("verde", "Datos guardados correctamente");
                    }
                })
                .fail(function (msg) {
                    alerta("rojo", "Error por favor comunicarse con el administrador")
                });
                }
    });
    
</script>