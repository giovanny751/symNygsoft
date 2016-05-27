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
                            <li>
                                <a data-toggle="tab" href="#tab2">EXAMENES MEDICOS</a>
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
                                                    <input type="text" name="salario" id="salario" class="form-control miles number miles" value="<?php echo (!empty($parametros[0]->parNom_salarioMinimo)) ? $parametros[0]->parNom_salarioMinimo : ""; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="auxTransorte" class="col-md-3 control-label">Auxilio de transporte</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="auxTransorte" id="auxTransorte" class="form-control number miles" value="<?php echo (!empty($parametros[0]->parNom_auxilioTransporte)) ? $parametros[0]->parNom_auxilioTransporte : ""; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pension" class="col-md-3 control-label">% Aportes Salud</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="aportesSalud" id="pension" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteSalud)) ? $parametros[0]->parNom_aporteSalud : ""; ?>"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pension" class="col-md-3 control-label">% Pension</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="aportesPension" id="pension" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aportePension)) ? $parametros[0]->parNom_aportePension : ""; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="aporteSena" class="col-md-3 control-label">Aportes al SENA</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="aporteSena" id="aporteSena" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteSena)) ? $parametros[0]->parNom_aporteSena : ""; ?>"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="aporteICBF" class="col-md-3 control-label">Aportes al ICBF</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="aporteICBF" id="aporteICBF" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteICBF)) ? $parametros[0]->parNom_aporteICBF : ""; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="aporteCajaComensacion" class="col-md-3 control-label">Aportes a Caja de Compensación</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="aporteCajaComensacion" id="aporteCajaComensacion" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteCajaCompensacion)) ? $parametros[0]->parNom_aporteCajaCompensacion : ""; ?>"  />
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
                            <div id="tab2" class="tab-pane">
                                <div class="row">
                                    <center><h2>PROGRAMA DE MEDICINA PREVENTIVA Y DEL TRABAJO</h2></center>
                                </div>
                                <div class="row">
                                    <form method="post" id="frmExamenes">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <th style="text-align: center;width: 80%">DESCRIPCIÓN</th>
                                            <th style="text-align: center;width: 20%">VALOR</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($examenes as $e): ?>
                                                    <tr>
                                                        <td><?php echo $e->preExa_examen ?></td>
                                                        <td><input type="text" style="text-align: right" name="<?php echo $e->preExa_id ?>" value="<?php echo $e->valor ?>"  class="form-control number miles"></td>
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
<script>

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