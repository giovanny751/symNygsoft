<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>INFORME EXÁMENES MEDICOS
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="tabbable tabbable-tabdrop">
                        <ul class="nav nav-tabs">
                            <li class='active'>
                                <a data-toggle="tab" href="#tab1" id="grafica">GRAFICA</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab2" >INFORME</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane active">
                                <div class="col-md-5">
                                    <div class="responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <th style="text-align: center">Exámen</th>
                                            <th style="text-align: center">Valor</th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $total = 0;
                                                foreach ($valores as $v): 
                                                    $total += $v->preExaVal_valor;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $v->preExa_examen ?></td>
                                                        <td style="text-align: right"><?php echo $v->preExaVal_valor ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td style="text-align: right"><b>Total</b></td>
                                                    <td style="text-align: right"><?php echo $total ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div id="chart_div" style="width: 900px; height: 500px;"></div>
                                </div>
                            </div>
                            <div id="tab2" class="tab-pane ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                <th>Tipo documento</th>
                                                <th>Documento</th>
                                                <th>Nombre(s)</th>
                                                <th>Apellido(s)</th>
                                                <th>Sexo</th>
                                                <th>Examen</th>
                                                <th>Valor examen</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total = "";
                                                    foreach ($informeExamenesMedicos as $em):
                                                        ?>
                                                        <tr>
                                                            <td rowspan="2"><?php echo $em->tipIde_tipo ?></td>
                                                            <td rowspan="2"><?php echo $em->empPreExa_documento ?></td>
                                                            <td rowspan="2"><?php echo $em->empPreExa_nombre ?></td>
                                                            <td rowspan="2"><?php echo $em->empPreExa_apellido ?></td>
                                                            <td rowspan="2"><?php echo $em->Sex_Sexo ?></td>
                                                            <?php
                                                            $ulExamen = "<ul style='list-style:none;'>";
                                                            $info2 = explode(",", $em->preExa_examen);
                                                            for ($i = 0; $i < count($info2); $i++):
                                                                $ulExamen .= "<li> " . ($i + 1) . " - " . $info2[$i] . "</li>";
                                                            endfor;
                                                            $ulExamen .= "<ul>";
                                                            ?>
                                                            <td rowspan="2"><?php echo $ulExamen ?></td>
                                                            <?php
                                                            $ul = "<ul style='list-style:none;'>";
                                                            $info = explode(",", $em->preExaVal_valor);
                                                            $valor = '';
                                                            for ($i = 0; $i < count($info); $i++):
                                                                $total += str_replace('.', '', $info[$i]);
                                                                $valor += str_replace('.', '', $info[$i]);
                                                                $ul .= "<li> " . ($i + 1) . " - " . $info[$i] . "</li>";
                                                            endfor;
                                                            $ul .= "<ul>";
                                                            ?>
                                                            <td><?php echo $ul ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: #D8D8D8"><center><b>$ <?php echo $valor ?></b></center></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="6" style="text-align: right"><b>TOTAL</b></td>
                                                    <td style="text-align: center">$ <?php echo $total; ?></td>
                                                </tr>
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
<script>
    google.charts.load('current', {'packages': ['corechart']});

    function drawChart(array, title) {
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

    $('#grafica').click(function () {
        $.post(url + "index.php/Informes/graficaExamenesMedicos",
                $("#frmIndicadores").serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                google.charts.setOnLoadCallback(drawChart(msg.Json, "ACCIDENTES E INCIDENTES"));
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, comunicarse con el administrador del sistema");
        });
    });
    $('#grafica').trigger("click");
</script>