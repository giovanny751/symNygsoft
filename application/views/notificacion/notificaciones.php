<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>NOTIFICACIONES
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <th>Notificacion</th>
                        <th>Permiso</th>
                        </thead>
                        <tbody>
                            <?php foreach ($notificacion as $not): ?>
                            <tr>
                                <td><?php echo $not->not_notificacion  ?></td>
                                <td style="text-align:center">
                                    <button type="button" class="btn btn-success">Permiso</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>