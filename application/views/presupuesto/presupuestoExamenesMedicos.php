<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>PARAMETRIZACIÓN
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
                                <a data-toggle="tab" href="#tab2">EXAMENES MEDICOS</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab2" class="tab-pane active">
                                <div class="row">
                                    <center><h2>PROGRAMA DE MEDICINA PREVENTIVA Y DEL TRABAJO</h2></center>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-info" title="Agregar" id="agregar"><i class="fa fa-plus fa-2x"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <form method="post" id="frmExamenes">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                <th style="text-align: center;width: 80%">DESCRIPCIÓN</th>
                                                <th style="text-align: center;width: 20%">VALOR</th>
                                                <th style="text-align: center;width: 20%">ELIMINAR</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($examenes as $e): ?>
                                                        <tr>
                                                            <td><?php echo $e->preExa_examen ?></td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">$</span>
                                                                    <input type="text" style="text-align: right" name="<?php echo $e->preExa_id ?>" value="<?php echo $e->valor ?>"  class="form-control number miles">
                                                                </div>
                                                            </td>
                                                            <td>
                                                    <center>
                                                        <button type="button" class="btn btn-danger eliminar" preExa_id="<?php echo $e->preExa_id ?>"  title="Eliminar" ><i class="fa fa-remove"></i></button>
                                                    </center>
                                                    </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-4">
                                                <button type="button" class="btn btn-block green" id="guardarExamenesMedicos">GUARDAR</button>
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
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">NUEVO EXAMEN</h4>
            </div>
            <div class="modal-body" id="incluiraseguradoras">
                <div id="agregarClones">
                    <form method="post" id="frmAgregarExamen" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4">Descripción</label>
                                    <div class="col-md-8">
                                        <input type="text" name="descripcion" id="descripcion" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-4">Valor</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input type="text" name="valor" id="valor" class="form-control miles number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="guardarExamen" >Guardar</button>
                <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>

    $('body').delegate(".eliminar", "click", function () {
        var puntero = $(this);
        if (confirm("Esta seguro de eliminar el exámen")) {
            $.post(
                    url + "index.php/Presupuesto/eliminarExamen",
                    {preExa_id: $(this).attr('preExa_id')}
            ).done(function (msg) {
                puntero.parents('tr').remove();
                alerta("verde", "Eliminado correctamente")
            }).fail(function (msg) {

            });
        }
    });

    $('#guardarExamen').click(function () {
        $.post(
                url + "index.php/Presupuesto/guardarExamen",
                $("#frmAgregarExamen").serialize()
                ).done(function (msg) {
            if (confirm("Desea guardar otro exámen")) {
            } else {
                $('#myModal3').modal('hide');
            }
            $("#frmAgregarExamen *").val("");
        }).fail(function (msg) {

        });
    });

    $('#agregar').click(function () {
        $("#frmAgregarExamen *").val("");
        $('#myModal3').modal('show');
    });

    $('#guardar').click(function () {

        $.post(
                url + "index.php/nomina/guardarParametros",
                $('#frmParametros').serialize()
                ).done(function (msg) {

        }).fail(function (msg) {

        });

    });
    $('#guardarExamenesMedicos').click(function () {

        $.post(
                url + "index.php/Presupuesto/guardarExamenes",
                $('#frmExamenes').serialize()
                ).done(function (msg) {

        }).fail(function (msg) {

        });

    });

</script>