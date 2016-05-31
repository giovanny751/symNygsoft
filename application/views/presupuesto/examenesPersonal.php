<br>
<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon guardar" title="Guardar dimension" metodo="guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="glyphicon glyphicon-ok"></i>NUEVO EXAMEN
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <form  id="frmExamenMedico" class="form-horizontal">
                            <div class="col-md-12">
                                <div class="form-group" id="desicionCompania">
                                    <label class="col-md-2">
                                        <span>* </span>Pertenece a la compañia
                                    </label>
                                    <div class="col-md-2">
                                        <select name="pertenece" id="pertenece" class="form-control obligatorio">
                                            <option value="">::Seleccionar::</option>
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2">
                                        <span>* </span>Examen de:
                                    </label>
                                    <div class="col-md-2">
                                        <select name="examen" id="examen" class="form-control obligatorio">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($tipoExamen as $te): ?>
                                                <option value="<?php echo $te->tipExa_id ?>"><?php echo $te->tipExa_tipo ?></option> 
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2"><span>* </span>Tipo de documento</label>
                                    <div class="col-md-2">
                                        <select name="tipoIdentificacion" id="tipoIdentificacion" class="form-control obligatorio">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($tipoIdentificacion as $ti): ?>
                                                <option value="<?php echo $ti->tipIde_id ?>"><?php echo $ti->tipIde_tipo ?></option> 
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2"><span>* </span>N° documento</label>
                                    <div class="col-md-2">
                                        <input type="text" name="noDocumento" id="noDocumento" class="form-control obligatorio" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2">Fecha de nacimiento</label>
                                    <div class="col-md-2">
                                        <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control fecha inactivar">
                                    </div>
                                    <label class="col-md-2">Nombre(s)</label>
                                    <div class="col-md-2">
                                        <input type="text" name="nombre" id="nombre" class="form-control inactivar">
                                    </div>
                                    <label class="col-md-2">Apellido(s)</label>
                                    <div class="col-md-2">
                                        <input type="text" name="apellidos" id="apellidos" class="form-control inactivar">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2">Sexo</label>
                                    <div class="col-md-2">
                                        <select name="sexo" id="sexo" class="form-control inactivar">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($sexo as $s): ?>
                                                <option value="<?php echo $s->Sex_id ?>"><?php echo $s->Sex_Sexo ?></option> 
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2">Teléfono</label>
                                    <div class="col-md-2">
                                        <input type="tel" name="telefono" id="telefono" class="form-control inactivar number"> 
                                    </div>
                                    <label class="col-md-2">Celular</label>
                                    <div class="col-md-2">
                                        <input type="tex" name="celular" id="celular" class="form-control inactivar number"> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2">Dirección</label>
                                    <div class="col-md-2">
                                        <input type="text" name="direccion" id="direccion" class="form-control inactivar">
                                    </div>
                                    <label class="col-md-2">Correo</label>
                                    <div class="col-md-2">
                                        
                                        <input type="tex" name="correo" id="correo" class="form-control inactivar"> 
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2">Tipos de examenes</label>
                                    <div class="col-md-2">
                                        <select title="Pulsa Ctrl + Click para seleccionar exámenes" name="tipoExamen[]" id="tipoExamen" class="form-control" multiple>
                                            <?php foreach ($examenes as $e): ?>
                                                <option value="<?php echo $e->preExaVal_id ?>"><?php echo $e->preExa_examen ?></option> 
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2">Proveedor</label>
                                    <div class="col-md-2">
                                        <select name="proveedor" id="proveedor" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#noDocumento').autocomplete({
        source: url + "index.php/administrativo/autocompletarcedula?tipoDocumento=" + $('#tipoIdentificacion').val(),
        minLength: 3
    });

    $('#tipoIdentificacion').change(function () {
        if ($(this).val() != "") {
            $('#noDocumento').attr('disabled',false);
        } else {
            $('#noDocumento').attr('disabled',true);
        }
    });

    $('.guardar').click(function () {
        $.post(
                url + "index.php/Presupuesto/guardarExamenMedico",
                $("#frmExamenMedico").serialize()
                ).done(function (msg) {
                    if(confirm("decea guardar otra solicitud de examen medico")){
                        $('input,select').val("");
                    }else{
                        
                    }
        }).fail(function (msg) {

        });
    });

    $('#pertenece').change(function () {
        
        if ($(this).val() == 1) {
            $('.inactivar').attr('disabled', true);
        } else {
            $('.inactivar').attr('disabled', false);
        }
    });

    $('body').delegate("#noDocumento", "change", function () {
        if ($("#pertenece").val() == 1 && $("#tipoIdentificacion").val() != "" && $("#noDocumento").val() != "") {
            $.post(
                    url + "index.php/Presupuesto/consultaEmpleadoXId",
                    {
                        documento : $(this).val()
                    }
            ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("rojo", msg['message']);
                else {
                    $('#tipoIdentificacion').val(msg.Json.tipIde_id);
                    $('#noDocumento').val(msg.Json.Emp_cedula);
                    $('#fechaNacimiento').val(msg.Json.Emp_FechaNacimiento);
                    $('#nombre').val(msg.Json.Emp_Nombre);
                    $('#apellidos').val(msg.Json.Emp_Apellidos);
                    $('#sexo').val(msg.Json.sex_Id);
                    $('#telefono').val(msg.Json.Emp_Telefono);
                    $('#celular').val(msg.Json.Emp_ceular);
                    $('#direccion').val(msg.Json.Emp_Direccion);
                    $('#correo').val(msg.Json.Emp_Email);
                }
            }).fail(function (msg) {

            });
        }
    });
</script>