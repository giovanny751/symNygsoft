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
                    <i class="glyphicon glyphicon-ok"></i>EXAMENES DE PERSONAL
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
                                <div class="form-group">
                                    <label class="col-md-2">
                                        Pertenece a la compañia
                                    </label>
                                    <div class="col-md-2">
                                        <select name="pertenece" id="pertenece" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2">Tipo de documento</label>
                                    <div class="col-md-2">
                                        <select name="nombre" id="nombre" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2">N° documento</label>
                                    <div class="col-md-2">
                                        <input type="" name="noDocumento" id="noDocumento" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2">Nombre(s)</label>
                                    <div class="col-md-2">
                                        <select name="nombre" id="nombre" class="form-control">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    <label class="col-md-2">Apellido(s)</label>
                                    <div class="col-md-2">
                                        <select name="apellido" id="apellido" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2">Género</label>
                                    <div class="col-md-2">
                                        <select name="apellido" id="apellido" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2">Telefono</label>
                                    <div class="col-md-2">
                                        <input type="tex" name="telefono" id="telefono" class="form-control"> 
                                    </div>
                                    <label class="col-md-2">Celular</label>
                                    <div class="col-md-2">
                                        <input type="tex" name="celular" id="celular" class="form-control"> 
                                    </div>
                                    <label class="col-md-2">Dirección</label>
                                    <div class="col-md-2">
                                        <input type="text" name="direccion" id="direccion" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2">Correo</label>
                                    <div class="col-md-2">
                                        <input type="tex" name="correo" id="correo" class="form-control"> 
                                    </div>
                                    <label class="col-md-2">Tipos de examenes</label>
                                    <div class="col-md-2">
                                        <select name="nombre" id="nombre" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2">Proveedor</label>
                                    <div class="col-md-2">
                                        <select name="nombre" id="nombre" class="form-control">
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
    $('.guardar').click(function () {
        $.post(
                url + "index.php/Presupuesto/guardarExamenMedico",
                $("#frmExamenMedico").serialize()
                ).done(function (msg) {

        }).fail(function (msg) {

        });
    });
</script>