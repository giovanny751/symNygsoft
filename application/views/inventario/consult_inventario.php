<div class="row">

    <div class="col-md-6">
        <br>
        <a href="<?php echo base_url('index.php/') . "/Inventario/index"; ?>"><div title="Nuevo" class="circuloIcon"><i class="fa fa-folder-open fa-3x"></i></div></a>
        <br>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="glyphicon glyphicon-ok"></i>Inventario
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?php echo base_url('index.php/') . '/Inventario/consult_inventario'; ?>" method="post" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inv_referencia" class="col-md-4"> Referencia </label>
                                        <div class="col-md-8">
                                            <input type="text" value="<?php echo (isset($post['inv_referencia']) ? $post['inv_referencia'] : '' ) ?>" class="form-control obligatorio  " id="inv_referencia" name="inv_referencia">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inv_nombre" class="col-md-4"> Nombre </label>
                                        <div class="col-md-8">
                                            <input type="text" value="<?php echo (isset($post['inv_nombre']) ? $post['inv_nombre'] : '' ) ?>" class="form-control obligatorio  " id="inv_nombre" name="inv_nombre">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inv_marca" class="col-md-4"> Marca </label>
                                        <div class="col-md-8">
                                            <input type="text" value="<?php echo (isset($post['inv_marca']) ? $post['inv_marca'] : '' ) ?>" class="form-control   " id="inv_marca" name="inv_marca">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inv_modelo" class="col-md-4"> Modelo </label>
                                        <div class="col-md-8">
                                            <input type="text" value="<?php echo (isset($post['inv_modelo']) ? $post['inv_modelo'] : '' ) ?>" class="form-control   " id="inv_modelo" name="inv_modelo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inv_serie" class="col-md-4">Serie</label>
                                        <div class="col-md-8">
                                            <input type="text" value="<?php echo (isset($post['inv_serie']) ? $post['inv_serie'] : '' ) ?>" class="form-control   " id="inv_serie" name="inv_serie">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-2">
                            <button class="btn btn-dcs" >Consultar</button><p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-table"></i>Información
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th></th>
                        <th>Referencia</th>
                        <th>Nombre</th>
                        <th>Unidades</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Serie</th>
                        <th>Fecha ingreso</th>
                        <th>Dias vencimiento</th>
                        <th>Acción</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($datos as $key => $value) {
                                echo "<tr>";
                                $i = 0;

                                foreach ($value as $key2 => $value2) {
                                    echo "<td>" . $value->$key2 . "</td>";
                                    if ($i == 0) {
                                        $campo = $key2;
                                        $valor = "'" . $value->$key2 . "'";
                                    }
                                    $i++;
                                }
                                echo "<td>"
                                . '<a href="javascript:" class="btn btn-dcs" onclick="editar(' . $valor . ')"><i class="fa fa-pencil"></i></a>'
                                . '<a href="javascript:" class="btn btn-danger" onclick="delete_(' . $valor . ')"><i class="fa fa-trash-o"></i></a>'
                                . "</td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
<?php if (isset($campo)) { ?>
    <form action="<?php echo base_url('index.php/') . "/Inventario/edit_inventario"; ?>" method="post" id="editar">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>2">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
    <form action="<?php echo base_url('index.php/') . "/Inventario/delete_inventario"; ?>" method="post" id="delete">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>3">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
<?php } ?>
<script>
    function editar(num) {

        $.post(url + 'index.php/Inventario/edit_inventario', {campo: 1})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message']);
                    else {
                        $('#<?php echo $campo ?>2').val(num);
                        $('#editar').submit();
                    }
                })
                .fail(function () {
                    alerta('rojo', 'Error al consultar.');
                })
    }
    function delete_(num) {
        var r = confirm('Confirma que desea eliminar el registro');
        if (r == false) {
            return false;
        }
        $.post(url + 'index.php/Inventario/delete_inventario', {campo: 1})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message']);
                    else {
                        $('#<?php echo $campo ?>3').val(num);
                        $('#delete').submit();
                    }
                })
                .fail(function () {
                    alerta('rojo', 'Error al consultar.');
                })
    }

    $('body').delegate('.number', 'keypress', function (tecla) {
        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
            return false;
    });
    $('.fecha').datepicker({
        rtl: Metronic.isRTL(),
        autoclose: true
    });
</script>
