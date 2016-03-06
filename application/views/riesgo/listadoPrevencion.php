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
                                            <label class="control-label col-md-4">Fecha Desde</label>
                                            <div class="col-md-8">
                                                <input type="text" name="fechaDesde" class="form-control fecha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Fecha Hasta</label>
                                            <div class="col-md-8">
                                                <input type="text" name="fechaHasta" class="form-control fecha">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="row" style="text-align: center">
                                <button type="button" id="consultar" class="btn btn-success">Consultar</button>
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

            }
        }).fail(function (msg) {
            alerta("rojo", "Error, comunicarse con el administrador del sistema");
        });
    });
</script>    