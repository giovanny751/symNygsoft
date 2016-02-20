<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> Roles
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" id="f20">
                    <div class="form-body">
                        <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover tabla-sst">
                                <thead>
                                <th>Rol</th><th>Seleccionar</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($roles as $r) { ?>
                                        <tr>
                                            <td><?php echo $r->rol_nombre ?></td>
                                            <td align="center"><input type="radio" name="rol" id="rol" value="<?php echo $r->rol_id ?>"></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </form>   
                <div class="row" style="text-align:center">
                    <button type="button" class="btn-sst defecto">Rol por defecto</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    $('.defecto').click(function () {
        if ($('input[type="radio"]:checked').val()) {

        } else {
            alerta('rojo', 'Por favor seleccionar un Rol');
            return false;
        }


        return false;
        $.post(
                url + "index.php/presentacion/guardarroldefecto"
                , $('#f20').serialize()
                ).done(function (msg) {
            window.location.href = '<?php echo base_url("index.php") ?>';
        }).fail(function (msg) {

        })

    });
</script>    