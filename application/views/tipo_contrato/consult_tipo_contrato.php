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
                    <table class="table table-striped table-bordered table-hover tabla-sst" id="tablesst">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Tipo de contrato</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <?php foreach ($datos as $key => $value): ?>
                                <tr>
                                    <?php
                                    $i = 0;
                                    foreach ($value as $key2 => $value2):
                                        ?>
                                        <td><?= $value->$key2 ?></td>
                                        <?php
                                        if ($i == 0) {
                                            $campo = $key2;
                                            $valor = "'" . $value->$key2 . "'";
                                        }
                                        if($i ==1){
                                            $campoTabla=   $value->$key2 ;
                                        }
                                        $i++;
                                    endforeach;
                                    ?>
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs default modificarContrato" tipoContratoId="<?= $valor ?>" tipoContrato="<?= $campoTabla ?>" >
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
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($campo)) { ?>
    <form  method="post" id="editar">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>2">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
    <form  method="post" id="delete">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>3">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modificar tipo de contrato</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="tiposDeContrato">
                    <input type="hidden" id="idTipoContrato" name="idTipoContrato"  value="<?php echo (!empty($empleado[0]->Emp_Id)) ? $empleado[0]->Emp_Id : ""; ?>" class="empleadoId" />
                    <div class="row">
                        <label for="nombrecarpeta" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Tipo de contrato:</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <input type="nombre" id="tipoContrato" name="tipoContrato" class="form-control ObligatorioCarpeta">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="opcionescarpeta">
                <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarTipoContrato">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('document').ready(function () {
        $('#TipCon_Descripcion').autocomplete({
            source: "<?php echo base_url("index.php//Tipo_contrato/autocomplete_TipCon_Descripcion") ?>",
            minLength: 3
        });
    });
    
    $('body').delegate(".modificarContrato","click",function(){
        id = $(this).attr('tipocontratoid');
        $('#idTipoContrato').val(id.replace("'",''));
        $('#tipoContrato').val($(this).attr('tipocontrato'));
        $("#myModal").modal("show");
    });
    
    $('#guardarTipoContrato').click(function (msg) {
        $.post(
                url + "index.php/Tipo_contrato/edit_tipo_contrato",
                $('#tiposDeContrato').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message']);
            else {
                table = $('#tablesst').DataTable();
                table.clear().draw();
                $.each(msg.Json, function (key, val) {
                    table.row.add([
                        val.TipCon_Id,
                        val.TipCon_Descripcion,
                        '<a href="javascript:;" class="btn btn-xs default modificarContrato"  tipoContratoId="'+val.TipCon_Id+'" tipoContrato="'+val.TipCon_Descripcion+'" ><i class="fa fa-pencil-square-o "></i>Modificar</a>',
                        '<a href="javascript:;" class="btn btn-xs default" onclick="delete_(' + val.TipCon_Id + ')" ><i class="fa fa-trash-o "></i>Eliminar</a>',
                    ]).draw();
                });
               $("#myModal").modal("hide"); 
            }
        }).fail(function (msg) {
            alerta("rojo", "Error comunicarse con el administrador")
        });
    });

    function editar(num, tipoContrato) {
//        $('#idTipoContrato').val(num);
//        $('#tipoContrato').val(tipoContrato);
        $('#myModal').modal("show");

    }
    function delete_(num) {
        var r = confirm('Confirma que desea eliminar el registro');
        if (r == false) {
            return false;
        }
        $('#<?php echo $campo ?>3').val(num);
        $.post(
                url + "index.php/Tipo_contrato/delete_tipo_contrato",
                $('#delete').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message']);
            else {
                table = $('#tablesst').DataTable();
                table.clear().draw();
                $.each(msg.Json, function (key, val) {
                    table.row.add([
                        val.TipCon_Id,
                        val.TipCon_Descripcion,
                        '<a href="javascript:;" class="btn btn-xs default" onclick="editar(' + val.TipCon_Id + ')" ><i class="fa fa-pencil-square-o "></i>Modificar</a>',
                        '<a href="javascript:;" class="btn btn-xs default" onclick="delete_(' + val.TipCon_Id + ')" ><i class="fa fa-trash-o "></i>Eliminar</a>',
                    ]).draw();
                });
                 $("#myModal").modal("hide");
            }
        }).fail(function (msg) {
            alerta("rojo", "Error comunicarse con el administrador")
        });
//        $('#delete').submit();
    }

    $('body').delegate('.number', 'keypress', function (tecla) {
        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
            return false;
    });

</script>
