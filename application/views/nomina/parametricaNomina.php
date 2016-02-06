<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>PARAMETRICA NOMINA
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form action="" class="form-horizontal" id="frmParametros">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salario" class="col-md-3 control-label">Salario Minimo</label>
                                    <div class="col-md-9">
                                        <input type="text" name="salario" id="salario" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_salarioMinimo))?$parametros[0]->parNom_salarioMinimo:""; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="auxTransorte" class="col-md-3 control-label">Auxilio de transporte</label>
                                    <div class="col-md-9">
                                        <input type="text" name="auxTransorte" id="auxTransorte" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_auxilioTransporte))?$parametros[0]->parNom_auxilioTransporte:"";  ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pension" class="col-md-3 control-label">% Aportes Salud</label>
                                    <div class="col-md-9">
                                        <input type="text" name="aportesSalud" id="pension" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteSalud))?$parametros[0]->parNom_aporteSalud:"";  ?>"  />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pension" class="col-md-3 control-label">% Pension</label>
                                    <div class="col-md-9">
                                        <input type="text" name="aportesPension" id="pension" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aportePension))?$parametros[0]->parNom_aportePension:""; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="aporteSena" class="col-md-3 control-label">Aportes al SENA</label>
                                    <div class="col-md-9">
                                        <input type="text" name="aporteSena" id="aporteSena" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteSena))?$parametros[0]->parNom_aporteSena:"";  ?>"  />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="aporteICBF" class="col-md-3 control-label">Aportes al ICBF</label>
                                    <div class="col-md-9">
                                        <input type="text" name="aporteICBF" id="aporteICBF" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteICBF))?$parametros[0]->parNom_aporteICBF:""; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="aporteCajaComensacion" class="col-md-3 control-label">Aportes a Caja de Compensación</label>
                                    <div class="col-md-9">
                                        <input type="text" name="aporteCajaComensacion" id="aporteCajaComensacion" class="form-control" value="<?php echo (!empty($parametros[0]->parNom_aporteCajaCompensacion))?$parametros[0]->parNom_aporteCajaCompensacion:"";  ?>"  />
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
<script>

$('#guardar').click(function(){
  
  $.post(
          url+"index.php/nomina/guardarParametros",
          $('#frmParametros').serialize()
          ).done(function(msg){
              
          }).fail(function(msg){
              
          });
  
});

</script>