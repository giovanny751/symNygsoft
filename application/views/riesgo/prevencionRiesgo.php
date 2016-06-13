<br>
<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="guardar" pre_id="" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
        <a href="<?php echo base_url("index.php/riesgo/listadoPrevencion"); ?>">
            <div class="circuloIcon" title="Listado Prevención de riesgos"><i class="fa fa-sticky-note fa-2x"></i></div>
        </a>
        <br>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>CONTROL
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="portlet box blue">
                        <div class="portlet-body">
                            <div class="tabbable tabbable-tabdrop">
                                <ul class="nav nav-tabs">
                                    <li class='active'>
                                        <a data-toggle="tab" href="#tab1">Tipo de acción</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab2">Asignación de control</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab1" class="tab-pane active">
                                        <form id="frmPrevencion" class="form-horizontal">
                                            <input type="hidden" value="<?php echo (!empty($Prevencion[0]->pre_id)) ? $Prevencion[0]->pre_id : ""; ?>" name="pre_id" id="pre_id">
                                            <div class="alert alert-info" style="text-align: center">
                                                Responsable
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dimUno" class="col-md-3 control-label"><span>*</span>Acción</label>
                                                        <div class="col-md-9">
                                                            <?php echo lista("tipAcc_id", "tipAcc_id", "form-control obligatorio", "tipoAccion", "tipAcc_id", "tipAcc_nombre", (isset($Prevencion[0]->tipAcc_id) ? $Prevencion[0]->tipAcc_id : null), array("est_id" => "1"), /* readOnly? */ false); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dimUno" class="col-md-3 control-label"><span>*</span>Pertenece a la compañia </label>
                                                        <div class="col-md-9">
                                                            <select id="pertenece" class="form-control obligatorio" name="pertenece">
                                                                <option value="">::Seleccionar::</option>
                                                                <option value="1" <?php echo (isset($Prevencion[0]->pertenece) ? ($Prevencion[0]->pertenece == '1' ? 'selected' : '') : '') ?>>SI</option>
                                                                <option value="0" <?php echo (isset($Prevencion[0]->pertenece) ? ($Prevencion[0]->pertenece == '0' ? 'selected' : '') : '') ?>>NO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dimUno" class="col-md-3 control-label"><span>*</span><?php echo $empresa[0]->Dim_id ?></label>
                                                        <div class="col-md-9">
                                                            <select name="dimUno" id="dimUno" class="form-control dimencion_uno_se obligatorio">
                                                                <option value="">::Seleccionar::</option>
                                                                <?php foreach ($dimension as $d1) { ?>
                                                                    <option <?php echo (!empty($Prevencion[0]->dimUno_id) && $Prevencion[0]->dimUno_id == $d1->dim_id ) ? "selected" : ""; ?> value="<?php echo $d1->dim_id; ?>"><?php echo strtoupper($d1->dim_descripcion); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dimDos" class="col-md-3 control-label"><span>*</span> <?php echo $empresa[0]->Dimdos_id ?></label>
                                                        <div class="col-md-9">
                                                            <select name="dimDos" id="dimDos" class="form-control dimencion_dos_se obligatorio">
                                                                <option value="">::Seleccionar::</option>
                                                                <?php foreach ($dimension2 as $d1) { ?>
                                                                    <option <?php echo (!empty($Prevencion[0]->dimDos_id) && $Prevencion[0]->dimDos_id == $d1->dim_id ) ? "selected" : ""; ?> value="<?php echo $d1->dim_id; ?>"><?php echo strtoupper($d1->dim_descripcion); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lugar" class="col-md-3 control-label">Lugar</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="lugar" id="lugar" class="form-control" value="<?php echo (!empty($Prevencion[0]->pre_lugar)) ? $Prevencion[0]->pre_lugar : ""; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="cargo" class="col-md-3 control-label"><span>*</span>Cargo</label>
                                                        <div class="col-md-9">
                                                            <select name="cargo" id="cargo" class="form-control obligatorio interno">
                                                                <option value="">::Seleccionar::</option>
                                                                <?php foreach ($cargo as $c): ?> 
                                                                    <option <?php echo (!empty($Prevencion[0]->car_id) && $Prevencion[0]->car_id == $c->car_id ) ? "selected" : ""; ?> value="<?php echo $c->car_id ?>"><?php echo strtoupper($c->car_nombre) ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <input type="text" class="form-control externo" name="cargo_externo" id="cargo_externo" value="<?php echo (isset($Prevencion[0]->pre_cargo_externo) ? $Prevencion[0]->pre_cargo_externo : '') ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="empleado" class="col-md-3 control-label"><span>*</span>Empleado</label>
                                                        <div class="col-md-9">
                                                            <select name="empleado" id="empleado" class="form-control obligatorio interno">
                                                                <option value="">::Seleccionar::</option>
                                                            </select>
                                                            <input type="text" class="form-control externo" name="empleado_externo" id="empleado_externo" value="<?php echo (isset($Prevencion[0]->pre_empleado_externo) ? $Prevencion[0]->pre_empleado_externo : '') ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-info" style="text-align: center">
                                                Fuente que origina la acción correctiva y preventiva
                                            </div>



                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dimUno" class="col-md-3 control-label"><span>*</span>Fuente de origen</label>
                                                        <div class="col-md-9">
                                                            <?php
                                                            $d = array();
                                                            if (isset($fuenteOrigen))
                                                                foreach ($fuenteOrigen as $value) {
                                                                    $d[] = $value->fueOri_id;
                                                                }
                                                            ?>
                                                            <?php echo listaMultiple2("fueOri_id[]", "", "form-control obligatorio", "fuenteOrigen", "fueOri_id", "fueOri_nombre", $d, array("est_id" => "1"), /* readOnly? */ false); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 otra_fuente" style="display: none">
                                                    <div class="form-group">
                                                        <label for="dimUno" class="col-md-3 control-label"><span>*</span>Otro</label>
                                                        <div class="col-md-9">
                                                            <div class="col-md-12">
                                                                <div class='input-group'>
                                                                    <input type="text" class="form-control" id="otro_"> 
                                                                    <div class='input-group-addon'><a href='javascript:' class="agregar_otro"><i class="fa fa-plus " aria-hidden="true"></i></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observacion" class="col-md-12">Descripción de la no conformidad real o potencial.</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="observacion" id="observacion"><?php echo (!empty($Prevencion->pre_observacion)) ? $Prevencion->pre_observacion : ""; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="alert alert-info" style="text-align: center">
                                                Analisis de la causa (causa o causas por la que se presento la no conformidad real, o se detecta una no conformidad potencial).
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="cree table table-hover">
                                                            <thead>
                                                            <th>Causa</th>
                                                            <th>Sub causa ¿porque?</th>
                                                            <th>Ultra causa ¿porque?</th>
                                                            <th>Cada causa</th>
                                                            <th></th>
                                                            </thead>
                                                            <tbody class="body_table_causas">

                                                                <?php
                                                                if (isset($causas)) {
                                                                    foreach ($causas as $value) {
                                                                        ?>

                                                                        <tr>
                                                                            <td><textarea class='form-control obligatorio causa_' name='causa[]'><?php echo $value->preCau_causa ?></textarea></td>
                                                                            <td><textarea class='form-control  subcausa_' name='subcausa[]'><?php echo $value->preCau_sub_causa ?></textarea></td>
                                                                            <td><textarea class='form-control  ultracausa_' name='ultracausa[]'><?php echo $value->preCau_ultra_causa ?></textarea></td>
                                                                            <td>
                                                                                <?php
                                                                                @$datos = Riesgo::detalle_causa($value->preCau_id);
                                                                                foreach ($datos as $value2) {
                                                                                    ?>
                                                                                    <div class='input-group'>
                                                                                        <?php echo lista('detCau_id[]', '', 'form-control obligatorio', 'detalleCausa', 'detCau_id', 'detCau_nombre', $value2->detCau_id, array('est_id' => '1'), /* readOnly? */ false); ?>
                                                                                        <div class='input-group-addon'>
                                                                                            <a class='otra_causa' href='javascript:'>
                                                                                                <i class='fa fa-plus ' aria-hidden='true'></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <td>
                                                                                <a class='new_campo_causas' href='javascript:'>
                                                                                    <i class='fa fa-plus ' aria-hidden='true'></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>

                                                                        <?php
                                                                    }
                                                                } else {
                                                                    ?>

                                                                    <tr>
                                                                        <td><textarea class='form-control obligatorio causa_' name='causa[]'></textarea></td>
                                                                        <td><textarea class='form-control  subcausa_' name='subcausa[]'></textarea></td>
                                                                        <td><textarea class='form-control  ultracausa_' name='ultracausa[]'></textarea></td>
                                                                        <td>
                                                                            <div class='input-group'>
                                                                                <?php echo lista('detCau_id[]', '', 'form-control obligatorio', 'detalleCausa', 'detCau_id', 'detCau_nombre', null, array('est_id' => '1'), /* readOnly? */ false); ?>
                                                                                <div class='input-group-addon'>
                                                                                    <a class='otra_causa' href='javascript:'>
                                                                                        <i class='fa fa-plus ' aria-hidden='true'></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <a class='new_campo_causas' href='javascript:'>
                                                                                <i class='fa fa-plus ' aria-hidden='true'></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-info" style="text-align: center">
                                                PLAN DE ACCIÓN (escribir las acciones que permitan eliminar las causas reales o potenciales o desarrollar la oportunidad de mejora)
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="cree table table-hover">
                                                            <thead>
                                                            <th>ACCIONES</th>
                                                            <th>RESPONSABLE</th>
                                                            <th>FECHA INICIO</th>
                                                            <th>FECHA FIN</th>
                                                            </thead>
                                                            <tbody class="body_table_plan_mejora">
                                                                <?php
                                                                if (isset($prevencion_plan_accion)) {
                                                                    foreach ($prevencion_plan_accion as $value) {
                                                                        ?>
                                                                        <tr>
                                                                            <td>
                                                                                <textarea name="plan_accion_acciones[]" class="form-control"><?php echo $value->prePlanAcc_acciones ?></textarea>
                                                                            </td>
                                                                            <td>
                                                                                <textarea name="plan_accion_responsable[]" class="form-control"><?php echo $value->prePlanAcc_responsable ?></textarea>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control fecha" name="plan_accion_fecha_ini[]" value="<?php echo $value->prePlanAcc_fecha_ini ?>">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control fecha" name="plan_accion_fecha_fin[]" value="<?php echo $value->prePlanAcc_fecha_fin ?>">
                                                                            </td>
                                                                            <td>
                                                                                <a class='new_campo_plan_mejora' href='javascript:'>
                                                                                    <i class='fa fa-plus ' aria-hidden='true'></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <textarea name="plan_accion_acciones[]" class="form-control"></textarea>
                                                                        </td>
                                                                        <td>
                                                                            <textarea name="plan_accion_responsable[]" class="form-control"></textarea>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control fecha" name="plan_accion_fecha_ini[]">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control fecha" name="plan_accion_fecha_fin[]">
                                                                        </td>
                                                                        <td>
                                                                            <a class='new_campo_plan_mejora' href='javascript:'>
                                                                                <i class='fa fa-plus ' aria-hidden='true'></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
<?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table cree table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2">EVIDENCIA DE LA EFICACIA DE LA ACCIÒN TOMADA</th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Variable o indicador de control antes</th>
                                                                    <th>variable o indicador de control después</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="control_antes" id="control_antes" value="<?php echo isset($Prevencion[0]->pre_control_antes)?$Prevencion[0]->pre_control_antes:'' ?>"></td>
                                                                    <td><input type="text" class="form-control" name="control_despues" id="control_despues" value="<?php echo isset($Prevencion[0]->pre_control_despues)?$Prevencion[0]->pre_control_despues:'' ?>"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="tab2" class="tab-pane">
                                        <form method="post" class="form-horizontal" id="frmAsignacionControl">
                                            <input type="hidden" value="" name="pre_id" id="pre_id">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-8" for="porcentaje">
                                                            <span class="">*</span>% cumplimiento de prevención
                                                        </label>
                                                        <div class="col-md-4">
                                                            <input type="text" name="porcentaje" id="porcentaje" class="form-control number obligatorioControl">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label" for="costoAvance">
                                                            <span class="">*</span>Costo del seguimiento
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="costoAvance" id="costoAvance" class="form-control number miles obligatorioControl">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <label class="col-md-4 control-label" for="fechaControl">
                                                            <span class="">*</span>Fecha
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="fechaControl" id="fechaControl" class="form-control fecha obligatorioControl">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                        <label class="col-md-2" for="descripcionControl">
                                                            <span class="">*</span>Descripción control
                                                        </label>
                                                        <div class="col-md-10">
                                                            <textarea name="descripcionControl" id="descripcionControl" class="form-control obligatorioControl"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="text-align: center">
                                                <button type="button" class="btn btn-success" id="guardarAsignacion">Guardar</button>
                                            </div>
                                        </form>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-striped table-bordered table-hover tabla-sst">
                                                    <thead>
                                                    <th>Porcentaje</th>
                                                    <th>Costo</th>
                                                    <th>Descripcion</th>
                                                    <th>fecha</th>
                                                    <th>Usuario</th>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('#fueOri_id').append('<option value="-1">Otro</option>')
    $('body').delegate('.menos_causa', 'click', function () {
        $(this).parents('.select_det_causas').remove();
    })
    $('body').delegate('.minun_campo_causas', 'click', function () {
        $(this).parents('tr').remove();
    })
    $('body').delegate('.minun_campo_plan_mejora', 'click', function () {
        $(this).parents('tr').remove();
    })
    $('body').delegate('.new_campo_plan_mejora', 'click', function () {
        var html = "<tr>"
                + "<td>"
                + "<textarea name='plan_accion_acciones[]' class='form-control'></textarea>"
                + "</td>"
                + "<td>"
                + "<textarea name='plan_accion_responsable[]' class='form-control'></textarea>"
                + "</td>"
                + "<td>"
                + "<input type='text' class='form-control fecha' name='plan_accion_fecha_ini[]'>"
                + "</td>"
                + "<td>"
                + "<input type='text' class='form-control fecha' name='plan_accion_fecha_fin[]'>"
                + "</td>"
                + "<td>"
                + "<a class='new_campo_plan_mejora' href='javascript:'>"
                + "<i class='fa fa-plus ' aria-hidden='true'></i>"
                + "</a>"
                + "<a class='minun_campo_plan_mejora' href='javascript:'>"
                + "<i class='fa fa-minus ' aria-hidden='true'></i>"
                + "</a>"
                + "</td>"
                + "</tr>"
        $('.body_table_plan_mejora').append(html);
    })
    $('body').delegate('.new_campo_causas', 'click', function () {
        var html = "<tr>"
                + "<td><textarea class='form-control obligatorio causa_' name='causa[]'></textarea></td>"
                + "<td><textarea class='form-control  subcausa_' name='subcausa[]'></textarea></td>"
                + "<td><textarea class='form-control  ultracausa_' name='ultracausa[]'></textarea></td>"
                + "<td>"
                + "<div class='input-group'>"
                + "<?php echo lista('detCau_id[]', '', 'form-control obligatorio', 'detalleCausa', 'detCau_id', 'detCau_nombre', null, array('est_id' => '1'), /* readOnly? */ false); ?>"
                + "<div class='input-group-addon'>"
                + "<a class='otra_causa' href='javascript:'>"
                + "<i class='fa fa-plus ' aria-hidden='true'></i>"
                + "</a>"
                + "</div>"
                + "</div>"
                + "</td>"
                + "<td>"
                + "<a class='new_campo_causas' href='javascript:'>"
                + "<i class='fa fa-plus ' aria-hidden='true'></i>"
                + "</a>"
                + "<a class='minun_campo_causas' href='javascript:'>"
                + "<i class='fa fa-minus ' aria-hidden='true'></i>"
                + "</a>"
                + "</td>"
                + "</tr>"
        $('.body_table_causas').append(html)
    })
    $('body').delegate('.otra_causa', 'click', function () {
        var html = "<div class='input-group select_det_causas'>"
                + "<?php echo lista("detCau_id[]", "", "form-control obligatorio", "detalleCausa", "detCau_id", "detCau_nombre", null, array("est_id" => "1"), /* readOnly? */ false); ?>"
                + "<div class='input-group-addon'>"
                + "<a class='otra_causa' href='javascript:'>"
                + "<i class='fa fa-plus ' aria-hidden='true'></i></a>"
                + "</div>"
                + "<div class='input-group-addon'>"
                + "<a class='menos_causa' href='javascript:'>"
                + "<i class='fa fa-minus  ' aria-hidden='true'></i></a>"
                + "</div>"
                + "</div>";
        $(this).parents('td').append(html)
    })
    $('#fueOri_id').change(function () {
        if ($(this).val() == -1) {
            $('.otra_fuente').show();
        } else {
            $('.otra_fuente').hide();
        }

    })
    $('.agregar_otro').click(function () {
        if ($('#otro_').val() == "") {
            alerta('rojo', 'El campo es obligatorios');
            return false;
        }
        $.post(url + 'index.php/Riesgo/guardar_fuente_origen', {campo_otro: $('#otro_').val()})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message']);
                    else {
                        var otro_ = $('#otro_').val()
                        $('#otro_').val('')
                        $('#fueOri_id').append('<option value="' + msg.Json + '">' + otro_ + '</option>')
                    }
                }).fail(function () {
            alerta('rojo', 'Error al guardar');
        })
    })



    $('.externo').hide();
    $('#pertenece').change(function () {
        if ($(this).val() == 1) {
            $('.interno').show();
            $('.externo').hide();
            $('.interno').addClass('obligatorio');
            $('.externo').removeClass('obligatorio');
        } else {
            $('.interno').removeClass('obligatorio');
            $('.externo').addClass('obligatorio');
            $('.interno').hide();
            $('.externo').show();
        }
    })
    $('document').ready(function () {

        $('#guardar').click(function () {
            if (obligatorio("obligatorio") == true) {
                if ($(this).attr('title') == 'Guardar') {
                    $.post(
                            url + "index.php/riesgo/guardarPrevencion",
                            $('#frmPrevencion').serialize()
                            )
                            .done(function (msg) {
                                if (!jQuery.isEmptyObject(msg.message))
                                    alerta("amarillo", msg['message']);
                                else {
                                    if (confirm("Desean guardar otra prevención")) {
                                        $('input,select,textarea').val("");
                                        $('#tiposriesgos *').remove();
                                        $('#lista_riesgos *').remove();
                                    } else {
                                        location.href=url+'index.php/riesgo/listadoPrevencion';
                                    }
                                }
                            })
                            .fail(function (msg) {
                                alerta("rojo", "fallo al traer los tipos de riesgo");
                            });
                }
            }
        });

        function clasificacionRiesgoTipo() {

            $.post(
                    url + "index.php/riesgo/consultatiporiesgoxclasificacion",
                    {categoria: $("#clasificacion").val()}
            )
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta("amarillo", msg['message'])
                        else {
                            $('#tiposriesgos *').remove();
                            var option = "";
                            var titulo = "";
                            $.each(msg.Json, function (key, val) {
                                if (titulo != val.rieCla_id) {
                                    option += '<optgroup label="' + val.rieCla_categoria + '">';
                                    titulo = val.rieCla_id;
                                }
                                option += "<option value='" + val.rieClaTip_id + "'>" + val.rieClaTip_tipo + "</option>";
                            });
                            $('#tiposriesgos').append(option);
                        }
                    }).fail(function (msg) {
                alerta("rojo", "fallo al traer los tipos de riesgo");
            });
        }
        $('#clasificacion').change(function () {
            clasificacionRiesgoTipo();
        });


        $('#tiposriesgos').change(function () {
            $.post(url + "index.php/tareas/traer_riesgos",
                    {tiposriesgos: $('#tiposriesgos').val(), clasificacionriesgo: $('#clasificacion').val()})
                    .done(function (msg) {
                        $('#lista_riesgos').html('');
                        var titulo = '';
                        $.each(msg, function (key, val) {
                            if (titulo != val.rieClaTip_tipo) {
                                var option = '<optgroup label="' + val.rieClaTip_tipo + '">';
                                titulo = val.rieClaTip_tipo;
                                $('#lista_riesgos').append(option);
                            }
                            $('#lista_riesgos').append('<option value="' + val.rie_id + '">' + val.rie_descripcion + '</option>');
                        })
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error por favor comunicarse con el administrador");
                    })
        });

        $('#guardarAsignacion').click(function () {
            if (obligatorio('obligatorioControl')) {
                $.post(url + "index.php/riesgo/guardarAsignacion",
                        $('#frmAsignacionControl').serialize()
                        ).done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {

                    }
                })
                        .fail(function (msg) {
                            alerta("rojo", "Error por favor comunicarse con el administrador");
                        });
            }
        });
        $('#cargo').change(function () {
            $.post(
                    url + "index.php/administrativo/consultausuarioscargo",
                    {
                        cargo: $(this).val()
                    }
            ).done(function (msg) {
                var data = "<option value=''>::Seleccionar::</option>";
                $('#empleado *').remove();
                $.each(msg.Json, function (key, val) {
                    data += "<option value='" + val.Emp_Id + "'>" + val.Emp_Nombre + " " + val.Emp_Apellidos + "</option>"
                });
                $('#empleado').append(data);
            }).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
            });
        });
    });
    
    $('#pertenece').trigger('change');
</script>   