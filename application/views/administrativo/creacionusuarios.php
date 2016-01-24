<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon <?php echo (!empty($usuario[0]->usu_id)) ? "none" : "" ?> guardar" metodo="guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
        <div class="circuloIcon <?php echo (!empty($usuario[0]->usu_id)) ? "" : "none" ?> guardar" metodo="actualizar"><i class="fa fa-floppy-o fa-3x"></i></div>
        <a href="<?php echo base_url() . "/index.php/administrativo/creacionusuarios" ?>"><div class="circuloIcon" title="Nuevo Plan" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
    <div class="col-md-6">
        <div id="posicionFlecha">
            <div class="flechaHeader IzquierdaDoble" metodo="flechaIzquierdaDoble"><i class="fa fa-step-backward fa-2x"></i></div>
            <div class="flechaHeader Izquierda" metodo="flechaIzquierda"><i class="fa fa-arrow-left fa-2x"></i></div>
            <div class="flechaHeader Derecha" metodo="flechaDerecha"><i class="fa fa-arrow-right fa-2x"></i></div>
            <div class="flechaHeader DerechaDoble" metodo="flechaDerechaDoble"><i class="fa fa-step-forward fa-2x"></i></div>
            <div class="flechaHeader Archivo" metodo="documento"><i class="fa fa-sticky-note fa-2x"></i></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">CREACIÓN USUARIOS</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form id="f3" method="post">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <a href="<?php echo base_url('index.php/presentacion/roles') ?>"><button type="button" class="btn-sst">Crear Rol</button></a>
            </div>
        </div>
        <div class="row">
            <label for="cedula" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <span class="campoobligatorio">*</span>Cédula
            </label>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                <input type="text" id="cedula" name="cedula" class="form-control obligatorio" value="<?php echo (!empty($usuario[0]->usu_cedula)) ? $usuario[0]->usu_cedula : ""; ?>" />
            </div>    
        </div>
        <div class="row">
            <label for="nombres" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <span class="campoobligatorio">*</span>Nombres
            </label>   
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                <input type="text" id="nombres" name="nombres" class="form-control obligatorio"  value="<?php echo (!empty($usuario[0]->usu_nombre)) ? $usuario[0]->usu_nombre : ""; ?>" />
            </div> 
        </div>
        <div class="row">
            <label for="apellidos" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                Apellidos
            </label>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo (!empty($usuario[0]->usu_apellido)) ? $usuario[0]->usu_apellido : ""; ?>" />
            </div> 
            <label for="rol" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <span class="campoobligatorio">*</span>Rol
            </label>   
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                <select name="rol" id="rol" class="form-control obligatorio">
                    <option value="">::Seleccionar::</option>
                    <?php foreach ($roles as $ro) { ?>
                        <option <?php echo (!empty($usuario[0]->rol_id) && $usuario[0]->rol_id == $ro['rol_id']) ? "selected" : ""; ?> value="<?php echo $ro['rol_id'] ?>"><?php echo $ro['rol_nombre'] ?></option>
                    <?php } ?>
                </select>
            </div> 
        </div>
        <div class="row">
            <label for="usuario" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <span class="campoobligatorio">*</span>Usuario
            </label>  
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                <input type="text" id="usuario" name="usuario" class="form-control obligatorio"  value="<?php echo (!empty($usuario[0]->usu_usuario)) ? $usuario[0]->usu_usuario : ""; ?>" />
            </div> 
            <label for="cambiocontrasena" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante">
                Cambio contraseña inicial
            </label>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante">
                <input type="checkbox" id="cambiocontrasena" name="cambiocontrasena" class="form-control" <?php echo (!empty($usuario[0]->usu_cambiocontrasena) && $usuario[0]->usu_cambiocontrasena == 1) ? "checked" : ""; ?> />
            </div> 
        </div>
        <div class="row">
            <label for="contrasena" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <span class="campoobligatorio">*</span>Contraseña
            </label>   
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                <input type="password" id="contrasena" name="contrasena" class="form-control obligatorio" value="<?php echo (!empty($usuario[0]->usu_contrasena)) ? $usuario[0]->usu_contrasena : ""; ?>" />
            </div>    
            <label for="estado" class="col-lg-3 col-md-3 col-sm-3 col-xs-3  aspirante">Estado</label> 
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante">
                <select id="estado" name="estado" class="form-control">
                    <?php foreach ($estado as $e) { ?>
                        <option <?php echo (!empty($usuario[0]->est_id) && $usuario[0]->est_id == $e->est_id) ? "selected" : ""; ?> value="<?php echo $e->est_id ?>"><?php echo $e->est_nombre ?></option>
                    <?php } ?>
                </select>
            </div>    
        </div>
        <div class="row">
            <label for="email" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">Email</label>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                <input type="email" id="email" name="email" class="form-control email" value="<?php echo (!empty($usuario[0]->usu_email)) ? $usuario[0]->usu_email : ""; ?>" />
            </div> 
            <label for="cargo" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante"><span class="campoobligatorio">*</span>Cargo</label>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante">
                <select id="cargo" name="cargo" class="form-control obligatorio">
                    <option value="">::Seleccionar::</option>
                    <?php foreach ($cargo as $c) { ?>
                        <option <?php echo (!empty($usuario[0]->car_id) && $usuario[0]->car_id == $c->car_id) ? "selected" : ""; ?> value="<?php echo $c->car_id ?>"><?php echo $c->car_nombre ?></option>
                    <?php } ?>
                </select>
            </div>    
        </div>
        <div class="row">
            <label for="genero" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <span class="campoobligatorio">*</span>Genero
            </label>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                <select id="genero" name="genero" class="form-control obligatorio">
                    <option value="">::Seleccionar::</option> 
                    <?php foreach ($sexo as $s) { ?>
                        <option <?php echo (!empty($usuario[0]->sex_id) && $usuario[0]->sex_id == $s->Sex_id) ? "selected" : ""; ?> value="<?php echo $s->Sex_id ?>"><?php echo $s->Sex_Sexo ?></option>
                    <?php } ?>
                </select>
            </div>    
            <label for="empleado" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante"><span class="campoobligatorio">*</span>Empleado</label>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 aspirante">
                <select id="empleado" name="empleado" class="form-control obligatorio">
                    <option value="">::Seleccionar::</option>
                    <?php foreach ($empleado as $mp): ?>
                        <option <?php echo (!empty($usuario[0]->emp_id) && $usuario[0]->emp_id == $mp->Emp_Id) ? "selected" : ""; ?> value="<?php echo $mp->Emp_Id ?>"><?php echo $mp->Emp_Nombre . " " . $mp->Emp_Apellidos ?></option> 
                    <?php endforeach; ?>
                </select>
            </div>    
        </div>
        <input type="hidden" name="usuid" id="usuid" value="<?php echo (!empty($usuario[0]->usu_id)) ? $usuario[0]->usu_id : ""; ?>">
    </form>
</div>    
<script>
    $('#rol').change(function () {
        if ($(this).val() == 60) {
            $('.aspirante select').attr('class', 'form-control ');
        } else {
            $('.aspirante select').attr('class', 'form-control obligatorio obligado');
        }
    })
    $(".flechaHeader").click(function () {
        var idUsuarioCreado = $("#usuid").val();
        var metodo = $(this).attr("metodo");
        if (metodo != "documento") {
            $.post(url+"index.php/administrativo/consultausuariosflechas", {idUsuarioCreado: idUsuarioCreado, metodo: metodo})
                    .done(function (msg) {
                        $("input[type='text'],select").val("");
                        $("#usuid").val(msg.usu_id);
                        $("#cedula").val(msg.usu_cedula);
                        $("#nombres").val(msg.usu_nombre);
                        $("#apellidos").val(msg.usu_apellido);
                        $("#usuario").val(msg.usu_usuario);
                        $("#contrasena").val(msg.usu_contrasena);
                        $("#rol").val(msg.rol_id);
                        if (msg.usu_cambiocontrasena == "1") {
                            $("#cambiocontrasena").parent().addClass("checked")
                            document.getElementById("cambiocontrasena").checked = true;
                        } else {
                            $("#cambiocontrasena").parent().removeClass("checked")
                            document.getElementById("cambiocontrasena").checked = false;
                        }
                        $("#email").val(msg.usu_email);
                        $("#genero").val(msg.sex_id);
                        $("#estado").val(msg.est_id);//estado
                        $("#cargo").val(msg.car_id);//cargo
                        var option = "<option value='" + msg.emp_id + "'>" + msg.nombre + "</option>"
                        $("#empleado").html(option);


                        if (msg.cambiocontrasena == "1") {
                            $("#cambiocontrasena").is(":checked");
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error en el sistema por favor verificar la conexion de internet");
                        $("input[type='text'], select").val();
                    })
        } else {
            window.location = url+"index.php/administrativo/listadousuarios";
        }

    });

    $('#cargo').change(function () {

        $.post(
                url+"index.php/administrativo/consultausuarioscargo",
                {
                    cargo: $(this).val()
                }
        ).done(function (msg) {
            var data = "<option value=''>::Seleccionar::</option>";
            $('#empleado *').remove();
            $.each(msg, function (key, val) {
                data += "<option value='" + val.Emp_Id + "'>" + val.Emp_Nombre + " " + val.Emp_Apellidos + "</option>"
            });
            $('#empleado').append(data);
        }).fail(function (msg) {

        })
    });

    $('.guardar').click(function () {
        var campousuid = $("#usuid").val();
        if (campousuid == "") {
             var ruta = url+'index.php/administrativo/guardarusuario';
        } else {
             var ruta = url+'index.php/administrativo/actualizarusuario';
        }
        if ((obligatorio('obligatorio') == true) && (email("email") == true)) {
            $.post(ruta, $('#f3').serialize()).
                    done(function (msg) {
                        alerta("verde", "Datos guardados correctamente");
                        if (confirm("¿Desea Guardar otro usuario?")) {
                            $(".guardar").addClass("none");
                            $(".guardar[metodo=guardar]").removeClass("none");
                            $('select,input').val('');
                            $('input[type="checkbox"]').attr("checked", false)
                            $('#empleado *').remove();
                        } else {
                            window.location.href = url+"index.php/administrativo/listadousuarios";
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error en el sistema por favor verificar la conexion de internet");
                    });
        }
    });
</script>    