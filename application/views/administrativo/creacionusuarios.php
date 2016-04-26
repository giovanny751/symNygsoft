<br><div class="row">
    <div class="col-md-6">
        <br>
        <div class="circuloIcon <?php echo (!empty($usuario[0]->usu_id)) ? "none" : "" ?> guardar" title="Guardar Usuario" metodo="guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
        <div class="circuloIcon <?php echo (!empty($usuario[0]->usu_id)) ? "" : "none" ?> guardar" title="Guardar Usuario"  metodo="actualizar"><i class="fa fa-floppy-o fa-3x"></i></div>
        <a href="<?php echo base_url() . "/index.php/administrativo/creacionusuarios" ?>"><div class="circuloIcon" title="Nuevo Usuario" ><i class="fa fa-folder-open fa-3x"></i></div></a>
        <a href="<?php echo base_url('index.php/presentacion/roles') ?>"><div class="circuloIcon" title="Crear Rol" ><i class="fa fa-cog fa-3x"></i></div></a>
        <a href="<?php echo base_url('index.php/Administrativo/listadousuarios') ?>" style="color: #FFF"><div class="circuloIcon" title="Listado Usuarios" ><i class="fa fa-sticky-note fa-2x"></i></div></a>
    </div>

</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>CREACIÓN USUARIOS
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">

                <form id="f3" method="post" class="form-horizontal">
                    <div class="form-body">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cedula" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <span class="campoobligatorio">*</span>Cédula
                                    </label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
                                        <input type="text" id="cedula" name="cedula" class="form-control obligatorio" value="<?php echo (!empty($usuario[0]->usu_cedula)) ? $usuario[0]->usu_cedula : ""; ?>" />
                                    </div>    
                                </div>    
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombres" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <span class="campoobligatorio">*</span>Nombres
                                    </label>   
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" id="nombres" name="nombres" class="form-control obligatorio"  value="<?php echo (!empty($usuario[0]->usu_nombre)) ? $usuario[0]->usu_nombre : ""; ?>" />
                                    </div> 
                                </div> 
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombres" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <span class="campoobligatorio">*</span>Tipo Usuario
                                    </label>   
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        <select id="TipoUsuario" name="TipoUsuario" class="form-control obligatorio" >
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($tipoUsuario as $tu): ?>
                                                <option <?php echo (isset($usuario[0]->tipUsuEva_id)) ? (($usuario[0]->tipUsuEva_id == $tu->tipUsuEva_id) ? "selected" : "") : ''; ?> value="<?php echo $tu->tipUsuEva_id ?>"><?php echo strtoupper($tu->tipUsuEva_tipo) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> 
                                </div> 
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellidos" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        Apellidos
                                    </label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo (!empty($usuario[0]->usu_apellido)) ? $usuario[0]->usu_apellido : ""; ?>" />
                                    </div> 
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rol" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <span class="campoobligatorio">*</span>Rol
                                    </label>   
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        <select name="rol" id="rol" class="form-control obligatorio ">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($roles as $ro) { ?>
                                                <option <?php echo (!empty($usuario[0]->rol_id) && $usuario[0]->rol_id == $ro['rol_id']) ? "selected" : ""; ?> value="<?php echo $ro['rol_id'] ?>"><?php echo strtoupper($ro['rol_nombre']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div> 
                                </div> 
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usuario" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <span class="campoobligatorio">*</span>Usuario
                                    </label>  
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        <input type="text" id="usuarioIngreso" autocomplete="false" name="usuario" class="form-control obligatorio"  value="<?php echo (!empty($usuario[0]->usu_usuario)) ? $usuario[0]->usu_usuario : ""; ?>" />
                                    </div> 
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cambiocontrasena" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante">
                                        Cambio contraseña inicial
                                    </label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 aspirante">
                                        <input type="checkbox" id="cambiocontrasena" autocomplete="false" name="cambiocontrasena" <?php echo (!empty($usuario[0]->usu_cambiocontrasena) && $usuario[0]->usu_cambiocontrasena == 1) ? "checked" : ""; ?> />
                                    </div> 
                                </div> 
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contrasena" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <span class="campoobligatorio">*</span>Contraseña
                                    </label>   
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        <input type="password" id="contrasenaIngreso" name="contrasena" class="form-control obligatorio"  />
                                    </div>    
                                </div>    
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado" class="col-lg-3 col-md-3 col-sm-3 col-xs-3  aspirante">Estado</label> 
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 aspirante">
                                        <select id="estado" name="estado" class="form-control select2me">
                                            <?php foreach ($estado as $e) { ?>
                                                <option <?php echo (!empty($usuario[0]->est_id) && $usuario[0]->est_id == $e->est_id) ? "selected" : ""; ?> value="<?php echo $e->est_id ?>"><?php echo $e->est_nombre ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>    
                                </div>    
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><span>*</span>Email</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        <input type="email" id="email" name="email" class="form-control email obligatorio" value="<?php echo (!empty($usuario[0]->usu_email)) ? $usuario[0]->usu_email : ""; ?>" />
                                    </div> 
                                </div> 
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cargo" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante"><span class="campoobligatorio">*</span>Cargo</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 aspirante">
                                        <select id="cargo" name="cargo" class="form-control obligatorio select2me">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($cargo as $c) { ?>
                                                <option <?php echo (!empty($usuario[0]->car_id) && $usuario[0]->car_id == $c->car_id) ? "selected" : ""; ?> value="<?php echo $c->car_id ?>"><?php echo strtoupper($c->car_nombre) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>    
                                </div>    
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="genero" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <span class="campoobligatorio">*</span>Genero
                                    </label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                                        <select id="genero" name="genero" class="form-control obligatorio ">
                                            <option value="">::Seleccionar::</option> 
                                            <?php foreach ($sexo as $s) { ?>
                                                <option <?php echo (!empty($usuario[0]->sex_id) && $usuario[0]->sex_id == $s->Sex_id) ? "selected" : ""; ?> value="<?php echo $s->Sex_id ?>"><?php echo strtoupper($s->Sex_Sexo) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>    
                                </div>    
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="empleado" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante"><span class="campoobligatorio">*</span>Empleado</label>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 aspirante">
                                        <select id="empleado" name="empleado" class="form-control obligatorio select2me">
                                            <option value="">::Seleccionar::</option>
                                            <?php
                                            if (!empty($usuario[0]->emp_id)) {
                                                foreach ($empleado as $mp):
                                                    ?>
                                                    <option <?php echo (!empty($usuario[0]->emp_id) && $usuario[0]->emp_id == $mp->Emp_id) ? "selected" : ""; ?> value="<?php echo $mp->Emp_id ?>"><?php echo $mp->Emp_Nombre . " " . $mp->Emp_Apellidos ?></option> 
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </select>
                                    </div>    
                                </div>    
                            </div>    
                        </div>
                        <input type="hidden" name="usuid" id="usuid" value="<?php echo (!empty($usuario[0]->usu_id)) ? $usuario[0]->usu_id : ""; ?>">
                    </div>    
                </form>
            </div>    
        </div>    
    </div>    
</div>    
<script>
    $('#TipoUsuario').change(function () {
        if ($(this).val() == 1) {
            $('.aspirante select').removeClass("form-control");
            $('.aspirante select').removeClass("form-control ");
            $('.aspirante select').removeClass("form-control obligatorio");
            $('.aspirante select').attr('class', 'form-control ');
            $('.aspirante').hide();
        } else {
            $('.aspirante select').attr('class', 'form-control obligatorio ');
            $('.aspirante').show();
        }
    });

    $('#cargo').change(function () {

        $.post(
                url + "index.php/administrativo/consultausuarioscargo",
                {
                    cargo: $(this).val()
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message'])
            else {
                var data = "<option value=''>::Seleccionar::</option>";
                $('#empleado *').remove();
                $.each(msg.Json, function (key, val) {
                    data += "<option value='" + val.Emp_Id + "'>" + val.Emp_Nombre.toUpperCase() + " " + val.Emp_Apellidos.toUpperCase() + "</option>"
                });
                $('#empleado').append(data);

<?php if (isset($usuario[0]->emp_id)) { ?>
                    var emp_id = "<?php echo $usuario[0]->emp_id ?>";
                    $('#empleado').val(emp_id)
<?php } ?>
            }
        }).fail(function (msg) {

        })
    });

    $('.guardar').click(function () {
        var campousuid = $("#usuid").val();
        if (campousuid == "") {
            var ruta = url + 'index.php/administrativo/guardarusuario';
        } else {
            var ruta = url + 'index.php/administrativo/actualizarusuario';
        }
        if ((obligatorio('obligatorio') == true) && (email("email") == true)) {
        $.post(ruta, $('#f3').serialize()).
                done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message']);
                    else {
                        alerta("verde", "Datos guardados correctamente");
<?php if (!isset($usuario[0]->emp_id)) { ?>
                            if (confirm("¿Desea Guardar otro usuario?")) {
                                $(".guardar").addClass("none");
                                $(".guardar[metodo=guardar]").removeClass("none");
                                $('select,input').val('');
                                $('input[type="checkbox"]').attr("checked", false)
                                $('#empleado *').remove();
                            } else {
                                window.location.href = url + "index.php/administrativo/listadousuarios";
                            }
<?php } else { ?>
                            window.location.href = url + "index.php/administrativo/listadousuarios";
<?php } ?>
                    }
                    })
                
                .fail(function (msg) {
                    alerta("rojo", "Error en el sistema por favor verificar la conexion de internet");
                });
                }
            });
    $('#TipoUsuario').trigger('change');
    $('#cargo').trigger('change');
</script>    