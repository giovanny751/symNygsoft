<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="guardar" title="Guardar" ><i class="fa fa-floppy-o fa-3x"></i></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">CAMBIAR CONTRASEÑA</span>
        </div>
    </div>
</div>
<div class="cuerpoContenido">
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" class="form-control obligatorio" />
    </div>
    <div class="form-group">
        <label for="rpassword">Repetir Contraseña</label>
        <input type="password" id="rpassword" class="form-control obligatorio" />
    </div>
    <div class="row alerta">

    </div>
</div>
<script>
    $('body').delegate('#guardar', 'click', function () {
        if (obligatorio('obligatorio') == true && $('#password').val() == $('#rpassword').val()) {
            $('.error').remove();
            $.post("<?php echo base_url('index.php/presentacion/guardarcontrasena') ?>",
                    {password: $('#password').val()}, function () {
                        alerta("verde",'Contraseña Actualizada');
            });
        }
        if ($('#password').val() != $('#rpassword').val()) {
            alerta("rojo",'No coinciden las contraseñas');
        }

    });
</script>    