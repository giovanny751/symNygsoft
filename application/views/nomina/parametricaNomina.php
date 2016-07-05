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
                                <a data-toggle="tab" href="#tab1">NOMINA</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane active">
                                <form action="" class="form-horizontal" id="frmParametros">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="salario" class="col-md-3 control-label">Salario Minimo</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" name="salario"  style="text-align: right" id="salario" class="form-control miles number miles" value="<?php echo (!empty($parametros[0]->parNom_salarioMinimo)) ? $parametros[0]->parNom_salarioMinimo : ""; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="auxTransorte" class="col-md-3 control-label">Auxilio de transporte</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" style="text-align: right" name="auxTransorte" id="auxTransorte" class="form-control number miles" value="<?php echo (!empty($parametros[0]->parNom_auxilioTransporte)) ? $parametros[0]->parNom_auxilioTransporte : ""; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pension" class="col-md-3 control-label">Aportes Salud</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">%</span>
                                                        <input type="text" name="aportesSalud" id="pension" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteSalud)) ? $parametros[0]->parNom_aporteSalud : ""; ?>"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pension" class="col-md-3 control-label">Pension</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">%</span>
                                                        <input type="text" name="aportesPension" id="pension" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aportePension)) ? $parametros[0]->parNom_aportePension : ""; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="aporteSena" class="col-md-3 control-label">Aportes al SENA</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">%</span>
                                                        <input type="text" name="aporteSena" id="aporteSena" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteSena)) ? $parametros[0]->parNom_aporteSena : ""; ?>"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="aporteICBF" class="col-md-3 control-label">Aportes al ICBF</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input type="text" name="aporteICBF" id="aporteICBF" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteICBF)) ? $parametros[0]->parNom_aporteICBF : ""; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="aporteCajaComensacion" class="col-md-3 control-label">Aportes a Caja de Compensación</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">%</span>
                                                        <input type="text" name="aporteCajaComensacion" id="aporteCajaComensacion" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteCajaCompensacion)) ? $parametros[0]->parNom_aporteCajaCompensacion : ""; ?>"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-offset-4 col-md-4">
                                                <button type="button" class="btn btn-block green" id="guardar">GUARDAR</button>
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