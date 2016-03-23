<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>AVANCE EN EL CICLO PHVA
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <th>Tipo</th>
                        <th># Tareas</th>
                        <th>% Avance promedio</th>
                        <th>Costo presupuestado</th>
                        <th>Costo Real</th>
                        </thead>
                        <tbody>
                            <?php
                            $costopresupuestado = 0;
                            $numerotareas = 0;
                            $costoreal = 0;
                            $tipo_t = "";
                            $valores_t = "";
                            $avacenprogreso = "";
                            foreach ($tipo as $t):
                                $tipo_t.='"' . $t->tip_tipo . '",';
                                $valores_t.='' . $t->numerotareas . ',';
                                $avacenprogreso .= '' . number_format($t->progreso, 0) . ',';
                                $costopresupuestado += $t->tar_costopresupuestado;
                                $numerotareas += $t->numerotareas;
                                $costoreal += $t->costo;
                                ?>
                                <tr>
                                    <td><?php echo $t->tip_tipo; ?></td>
                                    <td style="text-align: center"><?= $t->numerotareas; ?></td>
                                    <td style="text-align: center"><?= number_format($t->progreso, 2); ?></td>
                                    <td style="text-align:right"><?= $t->tar_costopresupuestado; ?></td>
                                    <td style="text-align:right"><?= $t->costo; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><b>Resumen</b></td>
                                <td style="text-align: center"><b><?= $numerotareas ?></b></td>
                                <td><b></b></td>
                                <td style="text-align:right"><b><?= $costopresupuestado; ?></b></td>
                                <td style="text-align:right"><b><?= $costoreal; ?></b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('js/graficas/Chart.min.js') ?>"></script>
<div class="grafica"></div>
<center>
    <div style="width:35%">
        <canvas id="canvas" height="450" width="450"></canvas>
    </div>    
</center>
<script>

    var radarChartData = {
        labels: [<?php echo $tipo_t; ?>],
        datasets: [
            {
                label: "Numero de tareas",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [<?php echo $valores_t; ?>]
            },
            {
                label: "Porcentaje tareas",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [<?php echo $avacenprogreso; ?>]
            }
        ]
    };
    window.onload = function () {
        window.myRadar = new Chart(document.getElementById("canvas").getContext("2d")).Radar(radarChartData, {
            responsive: true
        });
    }

</script>    