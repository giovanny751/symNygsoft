<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Creaci&oacute;n Empleado
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="portlet box blue">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover tabla-sst">
                            <thead>
                            <th>Fecha</th>
                            <th>Responsable</th>
                            <th>Capacitación</th>
                            <th>Observación</th>
                            </thead>
                            <tbody>
                                <?php foreach ($capacitacion as $c): ?>
                                    <tr>
                                        <td><?php echo $c->cap_fechaCapacitacion ?></td>
                                        <td><?php echo $c->Emp_nombre . " " . $c->Emp_Apellidos ?></td>
                                        <td><?php echo $c->cap_nombreCapacitacion ?></td>
                                        <td><?php echo $c->cap_observacion ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
