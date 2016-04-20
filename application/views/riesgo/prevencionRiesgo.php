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
                    <i class="fa fa-gift"></i>PREVENCIÓN RIESGO
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
                                        <a data-toggle="tab" href="#tab1">Prevensión</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab2">Asignación de control</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab1" class="tab-pane active">
                                        <form id="frmPrevencion" class="form-horizontal">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="planPrevencion" class="col-md-2 "><span>*</span>Plan de prevención</label>
                                                        <div class="col-md-10">
                                                            <input type="text" name="planPrevencion" id="planPrevencion" class="form-control obligatorio" value="<?php echo (!empty($Prevencion->pre_nombre))?$Prevencion->pre_nombre:"";?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="clasificacion" class="col-md-4 control-label">Clasificación del riesgo</label>
                                                        <div class="col-md-8">
                                                            <select name='clasificacion[]' id='clasificacion' class="form-control obligatorio" multiple>
                                                                <?php foreach ($categoria as $ca) : ?>
                                                                    <option <?php echo (!empty($tarea->rieCla_id) && $ca->rieCla_id == $tarea->rieCla_id ) ? "Selected" : ""; ?> value="<?php echo $ca->rieCla_id ?>"><?php echo strtoupper($ca->rieCla_categoria) ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="tiposriesgos" class="col-md-4 control-label ">Tipo riesgo</label>
                                                        <div class="col-md-8">
                                                            <select name='tiposriesgos[]' id='tiposriesgos' class="form-control obligatorio" multiple>
                                                                <?php foreach ($tipoClasificacion as $tc): ?>
                                                                    <option <?php echo (!empty($tarea->tipRie_id) && $tc->rieClaTip_id == $tarea->tipRie_id ) ? "Selected" : ""; ?> vale="<?php echo $tc->rieClaTip_id ?>"><?php echo $tc->rieClaTip_tipo ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="lista_riesgos" class="col-md-4 control-label">Riesgo</label>
                                                    <div class="col-md-8">
                                                        <select name='lista_riesgos[]' id='lista_riesgos' class="form-control obligatorio" multiple>
                                                            <?php foreach ($riesgos as $e) { ?>
                                                                <?php
                                                                $select = "";
                                                                if (isset($riesgos_guardada))
                                                                    foreach ($riesgos_guardada as $tn) :
                                                                        if ($tn->rie_id == $e->rie_id):
                                                                            $select = "selected";
                                                                            break;
                                                                        endif;
                                                                    endforeach;
                                                                ?>
                                                                <option <?php echo $select; ?>  value="<?php echo $e->rie_id ?>"><?php echo $e->rie_descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="fechaInicio" class="col-md-4"><span>*</span>Fecha inicio</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="fechaInicio" id="fechaInicio" value="<?php echo (!empty($Prevencion->pre_fechaInicio))?$Prevencion->pre_fechaInicio:"";?>" class="form-control fecha obligatorio">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="fechaFin" class="col-md-4 control-label">Fecha fin</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="fechaFin" id="fechaFin" value="<?php echo (!empty($Prevencion->pre_fechaInicio))?$Prevencion->pre_fechaFin:"";?>" class="form-control fecha">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-info" style="text-align: center">
                                                Prevención
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label" for="medidasPreventivas">
                                                            Medidas preventivas apropiadas
                                                        </label>
                                                        <div class="col-md-10">
                                                            <textarea name="medidasPreventivas" id="medidasPreventivas" class="form-control"><?php echo (!empty($Prevencion->pre_medPreApropiadas))?$Prevencion->pre_medPreApropiadas:"";?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label" for="medidasAdoptadas">
                                                            Medidas adoptadas
                                                        </label>
                                                        <div class="col-md-10">
                                                            <textarea name="medidasAdoptadas" id="medidasAdoptadas" class="form-control"><?php echo (!empty($Prevencion->pre_medPreApropiadas))?$Prevencion->pre_medidasAdoptadas:"";?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-2 control-label" for="medidasAdoptar">
                                                            <span>*</span>Medidas adoptar
                                                        </label>
                                                        <div class="col-md-10">
                                                            <textarea name="medidasAdoptar" id="medidasAdoptar" class="form-control obligatorio"><?php echo (!empty($Prevencion->pre_medidasAAdoptar))?$Prevencion->pre_medidasAAdoptar:"";?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="presupuesto" class="col-md-6 control-label">Presupuesto</label>
                                                        <div class="col-md-6">
                                                            <input type="text" name="presupuesto" value="<?php echo (!empty($Prevencion->pre_presupuesto))?$Prevencion->pre_presupuesto:"";?>" id="presupuesto" class="form-control miles number obligatorio"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="costoReal" class="col-md-6 control-label">Costo real</label>
                                                        <div class="col-md-6">
                                                            <input type="text" name="costoReal" id="costoReal" class="form-control number"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alert alert-info" style="text-align: center">
                                                Responsable
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="dimUno" class="col-md-4 control-label"><span>*</span><?php echo $empresa[0]->Dim_id ?></label>
                                                        <div class="col-md-8">
                                                            <select name="dimUno" id="dimUno" class="form-control dimencion_uno_se obligatorio">
                                                                <option value="">::Seleccionar::</option>
                                                                <?php foreach ($dimension as $d1) { ?>
                                                                    <option <?php echo (!empty($Prevencion->dimUno_id == $d1->dim_id ))?"selected":"";?> value="<?php echo $d1->dim_id; ?>"><?php echo strtoupper($d1->dim_descripcion); ?></option>
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
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lugar" class="col-md-3 control-label">Lugar</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="lugar" id="lugar" class="form-control" value="<?php echo (!empty($Prevencion->pre_lugar))?$Prevencion->pre_lugar:"";?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="cargo" class="col-md-3 control-label"><span>*</span>Cargo</label>
                                                        <div class="col-md-9">
                                                            <select name="cargo" id="cargo" class="form-control obligatorio">
                                                                <option value="">::Seleccionar::</option>
                                                                <?php foreach ($cargo as $c): ?> 
                                                                <option <?php echo (!empty($Prevencion->car_id == $c->car_id ))?"selected":"";?> value="<?php echo $c->car_id ?>"><?php echo strtoupper($c->car_nombre) ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="empleado" class="col-md-3 control-label"><span>*</span>Empleado</label>
                                                        <div class="col-md-9">
                                                            <select name="empleado" id="empleado" class="form-control obligatorio">
                                                                <option value="">::Seleccionar::</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="observacion" class="col-md-1 control-label">Observación</label>
                                                        <div class="col-md-11">
                                                            <textarea class="form-control" name="observacion" id="observacion"><?php echo (!empty($Prevencion->pre_observacion))?$Prevencion->pre_observacion:"";?></textarea>
                                                        </div>
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
                                                            <span class="">*</span>Costo del avance
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
                                    }else{
                                        $('#pre_id').val(msg.Json);
                                        $('#guardar').attr("pre_id", msg.message);
                                        $('#guardar').removeAttr("title");
                                        $('#guardar').attr("title", "Actualizar");
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
                $.each(msg, function (key, val) {
                    data += "<option value='" + val.Emp_Id + "'>" + val.Emp_Nombre + " " + val.Emp_Apellidos + "</option>"
                });
                $('#empleado').append(data);
            }).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
            });
        });
    });
</script>   