<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>INDICADORES GENERALES
                </div>
                <div class="tools"> 
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form method="post" class="form-horizontal" id="frmIndicadores">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4">Fecha Inicial</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control fecha obligatorio" name="fechaInicial" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4">Fecha Final</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control fecha obligatorio" name="fechaFinal" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4"></label>
                                    <div class="col-md-8">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4"><?php echo $empresa[0]->Dim_id ?></label>
                                    <div class="col-md-8">
                                        <select name="dimensionuno" id="dimensionuno" class="form-control dimencion_uno_se" >
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension as $d1) { ?>
                                                <option <?php echo (isset($indicador->dim_id) && ($d1->dim_id == $indicador->dim_id)) ? "Selected" : ""; ?> value="<?php echo $d1->dim_id ?>"><?php echo $d1->dim_descripcion ?></option>
                                            <?php } ?>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4"><?php echo $empresa[0]->Dimdos_id ?></label>
                                    <div class="col-md-8">
                                        <select  name="dimensiondos" id="dimensiondos" class="form-control dimencion_dos_se" >
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4">Cargo</label>
                                    <div class="col-md-8">
                                        <select name="cargo" id="cargo" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($cargo as $c) { ?>
                                                <option <?php echo (isset($indicador->car_id) && ($c->car_id == $indicador->car_id)) ? "Selected" : ""; ?> value="<?php echo $c->car_id ?>"><?php echo $c->car_nombre ?></option> 
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4">Clasificacion Indicador</label>
                                    <div class="col-md-8">
                                        <select name="clasificacion" id="clasificacion" class="form-control obligatorio" >
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($clasificacion as $cl) { ?>
                                                <option value="<?php echo $cl->claInd_id ?>"><?php echo $cl->claInd_clasificacion ?></option>
                                            <?php } ?>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4">Tipo Clasificacion</label>
                                    <div class="col-md-8">
                                        <select  name="tipoClasificacion" id="tipoClasificacion" class="form-control obligatorio" >
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="text-align: center">
                                    <button type="button" class="btn btn-success" id="crearIndicador">Consultar indicador</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                    </head>
                    <body>
                        <div id="chart_div" style="width: 900px; height: 500px;"></div>
                    </body>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    google.charts.load('current', {'packages': ['corechart']});

    function drawChart(array,title) {
//          console.log(array);
        var data = google.visualization.arrayToDataTable(array);

        var options = {
            title: title,
            hAxis: {title: 'Year', titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    $('#crearIndicador').click(function () {
        if (obligatorio('obligatorio')) {
            if ($('#clasificacion').val() == 2 && $('#tipoClasificacion').val() == 7)
            {
                $.post(url + "index.php/indicador/filtroIndicador",
                        $("#frmIndicadores").serialize()
                        ).done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        google.charts.setOnLoadCallback(drawChart(msg.Json,"ACCIDENTES E INCIDENTES"));
                    }
                }).fail(function (msg) {
                    alerta("rojo", "Error, comunicarse con el administrador del sistema");
                });
            }
            if ($('#clasificacion').val() == 2 && $('#tipoClasificacion').val() == 12)
            {
                $.post(url + "index.php/indicador/indicadorAusentismo",
                        $("#frmIndicadores").serialize()
                        ).done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        google.charts.setOnLoadCallback(drawChart(msg.Json,"AUSENTISMO"));
                    }
                }).fail(function (msg) {
                    alerta("rojo", "Error, comunicarse con el administrador del sistema");
                });
            }
            if ($('#clasificacion').val() == 2 && $('#tipoClasificacion').val() == 6)
            {
                $.post(url + "index.php/indicador/accidentesConIncapacidad",
                        $("#frmIndicadores").serialize()
                        ).done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        google.charts.setOnLoadCallback(drawChart(msg.Json,"ACCIDENTES CON INCAPACIDAD"));
                    }
                }).fail(function (msg) {
                    alerta("rojo", "Error, comunicarse con el administrador del sistema");
                });
            }
            if ($('#clasificacion').val() == 1 && $('#tipoClasificacion').val() == 1)
            {
                $.post(url + "index.php/indicador/inspecciones",
                        $("#frmIndicadores").serialize()
                        ).done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        google.charts.setOnLoadCallback(drawChart(msg.Json,"INSPECCIONES"));
                    }
                }).fail(function (msg) {
                    alerta("rojo", "Error, comunicarse con el administrador del sistema");
                });
            }
            if ($('#clasificacion').val() == 1 && $('#tipoClasificacion').val() == 3)
            {
                $.post(url + "index.php/indicador/capacitaciones",
                        $("#frmIndicadores").serialize()
                        ).done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        google.charts.setOnLoadCallback(drawChart(msg.Json,"CAPACITACIONES"));
                    }
                }).fail(function (msg) {
                    alerta("rojo", "Error, comunicarse con el administrador del sistema");
                });
            }
        }
    });

    $('#clasificacion').change(function () {
        $.post(url + "index.php/indicador/tiposIndicadores", {
            clasificacion: $(this).val()
        })
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        $('#tipoClasificacion *').remove();
                        var option = "<option value=''>::Seleccionar::</option>";
                        $.each(msg.Json, function (key, val) {
                            option += "<option value='" + val.indClaTip_id + "'>" + val.indClaTip_tipo + "</option>";
                        });
                        $('#tipoClasificacion').append(option);
                    }
                })
                .fail(function (msg) {
                    alerta("rojo", "Error comunicarse con el administrador")
                });
    });
</script>    
