
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
                </div>
                <fieldset>
                    <legend>Empleados</legend>
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-6">Activos</label>
                                        <div class="col-md-6">
                                            <?php echo $empleados[0]->empleadosActivos ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-6">empleadosInactivos</label>
                                        <div class="col-md-6">
                                            <?php echo $empleados[0]->empleadosActivos ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-6">Eliminados</label>
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
                                            <?php echo $empleados[0]->empleadosMujeres ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-6">Hombres Inactivos</label>
                                        <div class="col-md-6">
                                            <?php echo $empleados[0]->empleadosMujeresInactivos ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-6">Hombres eliminados</label>
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
                                        <label class="col-md-6">Planes eliminados</label>
                                        <div class="col-md-6">
                                            <?php echo $general[0]->planesEliminadas ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-6">tareas</label>
                                        <div class="col-md-6">
                                            <?php echo $general[0]->tarea ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-6">tareas inactivas</label>
                                        <div class="col-md-6">
                                            <?php echo $general[0]->tareaInactiva ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-6">tareas eliminadas</label>
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
                                        <label class="col-md-6">Quejas Eliminadas</label>
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
                                        <label class="col-md-6">Peticiones eliminadas</label>
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
                                        <label class="col-md-6">Sugerencia eliminadas</label>
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
                                        <label class="col-md-6">Felicitaciones eliminadas</label>
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