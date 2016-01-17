<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="guardarInsExtintores" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">INSPECCIÓN DE EXTINTORES</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form method="post" id="FrmExtintores" >
    <div class="row">
            <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Fecha Inspección</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" name="fecha" id="fecha" class="form-control fecha" >
            </div>
            <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Nombre de quien realiza la inspección:</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <select name="empleado" class="form-control">
                    <option>::Seleccionar::</option>
                    <?php foreach ($empleado as $emp): ?>
                        <option value="<?php echo $emp->Emp_Id ?>"><?php echo $emp->Emp_Nombre . " " . $emp->Emp_Apellidos ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <div class="row">
        <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">NO. Extintor</label>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <input type="text" name="noextintor" class="form-control">
        </div>
        <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Capacidad</label>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <input type="text" name="capacidad" class="form-control">
        </div>
        <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Clase</label>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <input type="text" name="clase" class="form-control">
        </div>
    </div>
    <div class="row">
        <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Agente</label>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <input type="text" name="agente" class="form-control">
        </div>
        <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Fecha de prueba hidrostatica</label>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <input type="text" name="pruebaHidrostatica" class="form-control fecha">
        </div>
        <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Fecha recarga</label>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <input type="text" name="fechaRecarga" class="form-control fecha">
        </div>
    </div>
    <div class="alert alert-info" role="alert" style='margin-top:10px;font-weight: bold;text-align: center;'>
            ESTADO DEL EXTINTOR
        </div>
    <div class="row">
        <div class="form-group">
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
        </div>
    </div>
    <div class="row">
        <div class="form-group">
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
        <div class="form-group">
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
    <div class="alert alert-info" role="alert" style='margin-top:10px;font-weight: bold;text-align: center;'>
            SEÑALIZACION		
        </div>
    <div class="row">
        <div class="form-group">
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
    <div class="alert alert-info" role="alert" style='margin-top:10px;font-weight: bold;text-align: center;'>
        UBICACIÓN		
    </div>
    <div class="row">
        <div class="form-group">
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
        <label>Observaciones</label>
        <textarea name="observaciones" class="form-control"></textarea>
    </div>
    </form>
</div>
<script>
    $('#guardarInsExtintores').click(function(){
        $.post("<?php echo base_url("index.php/documento/guardarExtintor") ?>"
                ,$('#FrmExtintores').serialize()
            ).done(function(msg){
                
            }).fail(function(msg){
                
            });
    });
</script>