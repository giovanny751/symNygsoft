<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>LISTADO CAPACITACIONES
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="portlet box blue">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" title="Crar capacitación" class="btn btn-success"><i class="fa fa-plus"></i></button>
                            <br>
                            <hr>
                            <br>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover tabla-sst">
                                    <thead>
                                    <th style="text-align: center">Fecha</th>
                                    <th style="text-align: center">Responsable</th>
                                    <th style="text-align: center">Capacitación</th>
                                    <th style="text-align: center">Observación</th>
                                    <th style="text-align: center">Eliminar</th>
                                    <th style="text-align: center">Editar</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($capacitacion as $c): ?>
                                            <tr>
                                                <td><?php echo $c->cap_fechaCapacitacion ?></td>
                                                <td><?php echo $c->Emp_nombre . " " . $c->Emp_Apellidos ?></td>
                                                <td><?php echo $c->cap_nombreCapacitacion ?></td>
                                                <td><?php echo $c->cap_observacion ?></td>
                                                <td style="text-align: center"><button type="button" class="btn btn-danger"><i class="fa fa-remove"></i></button></td>
                                                <td style="text-align: center"><button type="button" class="btn btn-info"><i class="fa fa-edit"></i></button></td>
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
    </div>
</div>
