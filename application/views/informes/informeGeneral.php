<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>INFORME GENERAL
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
                                <a data-toggle="tab" href="#tab2">GRAFICA</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab1" id="grafica">INFORME</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab2" class="tab-pane active">
                                <div class='row'>
                                    <div class="col-md-6">
                                        <div id="empleados" style="width: 100%; height: 500px"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="graficapqr" style="width: 100%; height: 500px"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab1" class="tab-pane ">
                                <fieldset>
                                    <legend>Empleados</legend>
                                    <div class="form-horizontal">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Total empleados activos</label>
                                                        <div class="col-md-6">
                                                            <?php echo $empleados[0]->empleadosActivos ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Total empleados inactivos</label>
                                                        <div class="col-md-6">
                                                            <?php echo $empleados[0]->empleadosInactivos ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Total empleados eliminados del sistema</label>
                                                        <div class="col-md-6">
                                                            <?php echo $empleados[0]->empleadosEliminados ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Hombres activos</label>
                                                        <div class="col-md-6">
                                                            <?php echo $empleados[0]->empleadosHombres ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Hombres Inactivos</label>
                                                        <div class="col-md-6">
                                                            <?php echo $empleados[0]->empleadosHombresInactivos ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Hombres eliminados sistema</label>
                                                        <div class="col-md-6">
                                                            <?php echo $empleados[0]->empleadosHombresEliminados ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Mujeres activas</label>
                                                        <div class="col-md-6">
                                                            <?php echo $empleados[0]->empleadosMujeres ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Mujeres Inactivas</label>
                                                        <div class="col-md-6">
                                                            <?php echo $empleados[0]->empleadosMujeresInactivos ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Mujeres eliminadas del sistema</label>
                                                        <div class="col-md-6">
                                                            <?php echo $empleados[0]->empleadosMujeresEliminados ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Procesos</legend>
                                    <div class="form-horizontal">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Planes</label>
                                                        <div class="col-md-6">
                                                            <?php echo $general[0]->planes ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Planes inactivos</label>
                                                        <div class="col-md-6">
                                                            <?php echo $general[0]->planesInactivos ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Planes eliminados sistema</label>
                                                        <div class="col-md-6">
                                                            <?php echo $general[0]->planesEliminadas ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Tareas</label>
                                                        <div class="col-md-6">
                                                            <?php echo $general[0]->tarea ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Tareas inactivas</label>
                                                        <div class="col-md-6">
                                                            <?php echo $general[0]->tareaInactiva ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Tareas eliminadas del sistema</label>
                                                        <div class="col-md-6">
                                                            <?php echo $general[0]->tareaEliminada ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>PQR</legend>
                                    <div class="form-horizontal">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Quejas</label>
                                                        <div class="col-md-6">
                                                            <?php echo $pqr[0]->queja ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Quejas Eliminadas del sistema</label>
                                                        <div class="col-md-6">
                                                            <?php echo $pqr[0]->quejaEliminada ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Peticiones</label>
                                                        <div class="col-md-6">
                                                            <?php echo $pqr[0]->peticion ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Peticiones eliminadas del sistema</label>
                                                        <div class="col-md-6">
                                                            <?php echo $pqr[0]->peticionEliminada ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Sugerencia</label>
                                                        <div class="col-md-6">
                                                            <?php echo $pqr[0]->sugerencia ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Sugerencia eliminadas del sistema</label>
                                                        <div class="col-md-6">
                                                            <?php echo $pqr[0]->sugerenciaEliminada ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Felicitaciones</label>
                                                        <div class="col-md-6">
                                                            <?php echo $pqr[0]->felicitaciones ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-md-6">Felicitaciones eliminadas del sistema</label>
                                                        <div class="col-md-6">
                                                            <?php echo $pqr[0]->felicitacionesEliminada ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
       
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Empleados'],
                ['Hombres', <?php echo $empleados[0]->empleadosHombres ?>],
                ['Mujeres', <?php echo $empleados[0]->empleadosMujeres ?>]
            ]);

            var options = {
                title: 'EMPLEADOS ACTIVOS',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('empleados'));
            chart.draw(data, options);
        }
        
//        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart2);
        
        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'PQR'],
                ['Quejas', <?php echo $pqr[0]->queja ?>],
                ['Peticiones', <?php echo $pqr[0]->peticion ?>],
                ['Sugerencia', <?php echo $pqr[0]->sugerencia ?>],
                ['Felicitaciones', <?php echo $pqr[0]->felicitaciones ?>]
            ]);

            var options = {
                title: 'PQR',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('graficapqr'));
            chart.draw(data, options);
        }
</script>
