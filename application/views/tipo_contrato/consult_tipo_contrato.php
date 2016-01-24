<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i><?= $title ?>
                </div>
                <div class="tools">
                    <a class="btn btn-xs yellow" href="<?php echo base_url() . "index.php/Tipo_contrato/index" ?>" title="Nuevo Tipo De Contrato">Nuevo</a>
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?php echo base_url('index.php/') . '/Tipo_contrato/consult_tipo_contrato'; ?>" method="post" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="TipCon_Descripcion" class="control-label col-md-3">Tipo Contrato</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php echo (isset($post['TipCon_Descripcion']) ? $post['TipCon_Descripcion'] : '' ) ?>" class="form-control obligatorio  " id="TipCon_Descripcion" name="TipCon_Descripcion">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class=" col-md-offset-9 col-md-3">
                                        <input type="submit" class="btn btn-block green" value="Consultar" />
                                    </div>
                                </div>
                            </div>
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
                    <i class="fa fa-table"></i> Tabla
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <table class="table table-striped table-bordered table-hover tabla-sst">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Tipo de contrato</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <?php  foreach ($datos as $key => $value): ?>
                                <tr>
                                    <?php $i = 0;
                                    foreach ($value as $key2 => $value2): ?>
                                        <td><?= $value->$key2 ?></td>
                                        <?php if ($i == 0) {
                                            $campo = $key2;
                                            $valor = "'" . $value->$key2 . "'";
                                        } 
                                        $i++; 
                                    endforeach; ?>
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs default" onclick="editar(<?= $valor ?>)" >
                                            <i class="fa fa-pencil-square-o "></i>
                                            Modificar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs default" onclick="delete_(<?= $valor ?>)" >
                                            <i class="fa fa-trash-o "></i>
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($campo)) { ?>
    <form action="<?php echo base_url('index.php/') . "/Tipo_contrato/edit_tipo_contrato"; ?>" method="post" id="editar">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>2">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
    <form action="<?php echo base_url('index.php/') . "/Tipo_contrato/delete_tipo_contrato"; ?>" method="post" id="delete">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>3">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
<?php } ?>


<script>
    $('document').ready(function () {
        $('#TipCon_Descripcion').autocomplete({
            source: "<?php echo base_url("index.php//Tipo_contrato/autocomplete_TipCon_Descripcion") ?>",
            minLength: 3
        });
    });
    function editar(num) {
        $('#<?php echo $campo ?>2').val(num);
        $('#editar').submit();
    }
    function delete_(num) {
        var r = confirm('Confirma que desea eliminar el registro');
        if (r == false) {
            return false;
        }
        $('#<?php echo $campo ?>3').val(num);
        $('#delete').submit();
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
