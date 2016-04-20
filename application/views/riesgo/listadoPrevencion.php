<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Listado prevenciones
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="portlet box blue">
                        <div class="portlet-body">
                            <form method="post" class="form-horizontal" id="frmListado">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Plan de prevención</label>
                                            <div class="col-md-8">
                                                <input type="text" name="planPrevencion" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Responsable</label>
                                            <div class="col-md-8">
                                                <input type="text" name="responsable" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Fecha Inicial</label>
                                            <div class="col-md-8">
                                                <input type="text" name="fechaDesde" class="form-control fecha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Fecha Final</label>
                                            <div class="col-md-8">
                                                <input type="text" name="fechaHasta" class="form-control fecha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="text-align: center">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success" id="consultar">Consultar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="tablesst" class="table table-striped table-bordered table-hover tabla-sst">
                                <thead>
                                <th>Plan de prevención</th>
                                <th>Responsable</th>
                                <th>Cargo</th>
                                <th>Fecha Desde</th>
                                <th>Fecha Hasta</th>
                                <th>Riesgos</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="row" id="matrizLegal">

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
    $('#consultar').click(function () {
        $.post(url + "index.php/riesgo/consultaListadoPrevencion",
                $('#frmListado').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message']);
            else {
                var table = $('#tablesst').DataTable();
                table.clear().draw();
                $.each(msg['Json'], function (key, val) {
                    table.row.add([
                        val.pre_nombre,
                        val.Emp_nombre + " " + val.Emp_Apellidos,
                        val.car_nombre,
                        val.pre_fechaInicio,
                        val.pre_fechaFin,
                        "",
                        '<i class="fa fa-pencil-square-o fa-2x  modificar" aria-hidden="true" title="Modificar"  pre_id="' + val.pre_id + '" ></i>',
                        '<i class="fa fa-trash-o fa-2x   eliminar" aria-hidden="true" title="Eliminar" pre_id="' + val.pre_id + '"></i>'
                    ]).draw();
                });
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, comunicarse con el administrador del sistema");
        });
    });
    
    $('body').delegate('.modificar','click',function(){
        var form = "<form method='post' id='frmModificarPrevencion' action='<?php echo base_url('index.php/Riesgo/prevencionRiesgo') ?>'>";
        form += "<input type='hidden' value='"+$(this).attr("pre_id")+"' name='pre_id'>"
        form += "</form>";
        $('body').append(form);
        $('#frmModificarPrevencion').submit();
        
    }); 
</script>    