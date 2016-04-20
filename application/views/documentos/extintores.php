<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>INSPECCIÓN DE EXTINTORES
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="circuloIcon" id="guardarInsExtintores" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
                        </div>
                    </div>
                    <form method="post" id="FrmExtintores" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4" for="fechaInspeccion">Fecha Inspección</label>
                                    <div class="col-md-8">
                                        <input type="text" name="fecha" id="fechaInspeccion" class="form-control fecha obliContrato" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4" for="empleado">Nombre de quien realiza la inspección:</label>
                                    <div class="col-md-8">
                                        <select name="empleado" id="empleado" class="form-control obliContrato">
                                            <option value=''>::Seleccionar::</option>
                                            <?php foreach ($empleado as $emp): ?>
                                                <option value="<?php echo $emp->Emp_id ?>"><?php echo strtoupper($emp->Emp_Nombre . " " . $emp->Emp_Apellidos) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">NO. Extintor</label>
                                    <div class="col-md-8">
                                        <input type="text" name="noextintor" class="form-control obliContrato">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="capacidad">Capacidad</label>
                                    <div class="col-md-8">
                                        <input type="text" name="capacidad" id="capacidad" class="form-control obliContrato">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="clase">Clase</label>
                                    <div class="col-md-8">
                                        <input type="text" name="clase" id="clase" class="form-control obliContrato">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="agente">Agente</label>
                                    <div class="col-md-8">
                                        <input type="text" name="agente" id="agente" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="fechaPruebaHistorica">Fecha de prueba hidrostatica</label>
                                    <div class="col-md-8">
                                        <input type="text" name="pruebaHidrostatica" id="fechaPruebaHistorica" class="form-control fecha">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="fechaEntrega">Fecha recarga</label>
                                    <div class="col-md-8">
                                        <input type="text" name="fechaRecarga" id="fechaEntrega" class="form-control fecha">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info" role="alert" style='margin-top:10px;font-weight: bold;text-align: center;'>
                                    ESTADO DEL EXTINTOR
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!--<div class="form-group">-->
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="pintura" value=""> <b>PINTURA</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="mamometro" value=""> <b>MANOMETRO</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="pasador" value=""> <b>PASADOR</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="manguera" value=""> <b>MANGUERA</b>
                                        </label>
                                    </div>
                                </div>
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="boquilla" value=""> <b>BOQUILLA</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="envase" value=""> <b>ENVASE</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="soporteColgar" value=""> <b>SOPORTE DE COLGAR</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="Manija" value=""> <b>MANIJA</b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-offset-3 col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="estadoSatisfactorio" value=""> <b>ESTADO SATISFACTORIO  FUNCIONAMIENTO</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="corrosion" value=""> <b>CORROSION</b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info" role="alert" style='margin-top:10px;font-weight: bold;text-align: center;'>
                                    SEÑALIZACION		
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="tarjetaRegistro" value=""> <b> TIENE TARJETA DE REGISTRO DE OPERACIÓN</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ManejoVisible" value=""> <b>INSTRUCCIONES DE MANEJO VISIBLE</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="encuentraSenalizado" value=""> <b>SE ENCUENTRA SEÑALIZADO</b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info" role="alert" style='margin-top:10px;font-weight: bold;text-align: center;'>
                                    UBICACIÓN		
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="acceso" value=""> <b>ACCESO</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="Altura" value=""> <b>ALTURA</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="Visibilidad" value=""> <b>VISIBILIDAD E IDENTIFICACION</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="limpieza" value=""> <b>LIMPIEZA</b>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observaciones" class="col-md-2">Observaciones</label>
                                    <div class="col-md-10">
                                        <textarea id="observaciones" name="observaciones" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#guardarInsExtintores').click(function () {
        if (obligatorio('obligatorio')) {
            $.post(
                    url + "index.php/documento/guardarExtintor"
                    , $('#FrmExtintores').serialize()
                    ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("rojo", msg['message'])
                else {
                    $('input[type="text"],select,textarea').val('');
                    $('input').prop('checked', false);
                    alerta("verde", "Datos guardados correctamente");
                }
            }).fail(function (msg) {

            });
        }
    });
</script>