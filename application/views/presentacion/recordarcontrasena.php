<br><div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="guardar" title="Guardar" ><i class="fa fa-floppy-o fa-3x"></i></div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> Cambiar contraseña
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('body').delegate('#guardar', 'click', function () {
        if (obligatorio('obligatorio') == true && $('#password').val() == $('#rpassword').val()) {
            $('.error').remove();
            $.post(
                    url + 'index.php/presentacion/guardarcontrasena',
                    {password: $('#password').val()}, function () {
                alerta("verde", 'Contraseña Actualizada');
            });
        }
        if ($('#password').val() != $('#rpassword').val()) {
            alerta("rojo", 'No coinciden las contraseñas');
        }

    });
</script>    