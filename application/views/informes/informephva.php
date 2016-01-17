<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">AVANCE EN EL CICLO PHVA</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <table class="tablesst">
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
            $tipo_t="";
            $valores_t="";
            $avacenprogreso="";
            foreach ($tipo as $t):
            $tipo_t.='"'.$t->tip_tipo.'",';
            $valores_t.=''.$t->numerotareas.',';
            $avacenprogreso .=  ''.number_format($t->progreso,0).',';
                $costopresupuestado += $t->tar_costopresupuestado;
                $numerotareas += $t->numerotareas;
                $costoreal += $t->costo;
                ?>
                <tr>
                    <td><?php echo $t->tip_tipo; ?></td>
                    <td style="text-align: center"><?=  $t->numerotareas; ?></td>
                    <td style="text-align: center"><?=  number_format($t->progreso,2); ?></td>
                    <td style="text-align:right"><?=  $t->tar_costopresupuestado; ?></td>
                    <td style="text-align:right"><?=  $t->costo; ?></td>
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
<script type="text/javascript" src="<?php echo base_url('js/graficas/Chart.min.js') ?>"></script>
<div class="grafica"></div>
<center>
    <div style="width:35%">
        <canvas id="canvas" height="450" width="450"></canvas>
    </div>    
</center>
<?php echo $avacenprogreso;?>
<script>

    var radarChartData = {
        labels: [<?php echo $tipo_t; ?>],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [<?php echo $valores_t; ?>]
            },
            {
                label: "My Second dataset",
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
    window.onload = function() {
        window.myRadar = new Chart(document.getElementById("canvas").getContext("2d")).Radar(radarChartData, {
            responsive: true
        });
    }

</script>    