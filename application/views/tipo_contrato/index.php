<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i><?= $title ?>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?php echo base_url('index.php/') . "/Tipo_contrato/save_tipo_contrato"; ?>" class="form-horizontal" method="post" onsubmit="return campos()"  enctype="multipart/form-data" id="frmcontrato">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="TipCon_Descripcion" class="control-label col-md-3">*Tipo de contrato</label>
                                    <div class="col-md-9">
                                        <input type="text" value="<?php echo (isset($datos[0]->TipCon_Descripcion) ? $datos[0]->TipCon_Descripcion : '' ) ?>" class=" form-control obligatorio  " id="TipCon_Descripcion" name="TipCon_Descripcion">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-6 col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <?php if (isset($post['campo'])) { ?>
                                        <button class="btn btn-block green" id="btnguardar" title="Actualizar">Actualizar</button>
                                        <?php } else { ?>
                                        <button class="btn btn-block green" id="btnguardar" title="Guardar">Guardar</button>
                                        <?php }?>
                                        <button class="btn btn-block yellow" id="boton_cargar" style="display: none" title="Cargando...">Cargando...</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <a href="<?php echo base_url('index.php') . "/Tipo_contrato/consult_tipo_contrato" ?>" class="btn btn-block green">Listado</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($post['campo'])) { ?>
                        <input type="hidden" name="<?php echo $post['campo'] ?>" value="<?php echo $post[$post['campo']] ?>">
                        <input type="hidden" name="campo" value="<?php echo $post['campo'] ?>">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div> 
<script>
    $('.limpiar').click(function () {
        $('#TipCon_Descripcion').val('')
    })

    $('#btnguardar').click(function () {
        var tipo = $('#TipCon_Descripcion').val();
        $.post(
                url + "index.php/tipo_contrato/exist"
                , {tipo: tipo})
                .done(function (msg) {
                    if (msg == 1) {
                        $('#TipCon_Descripcion').val("");
                        $('#TipCon_Descripcion').focus();
                        alerta("amarillo", "Tipo de contrato ya existe en el sistema")
                    } else {
                        $('#frmcontrato').submit();
                    }
                })
                .fail(function (msg) {
                    alerta("rojo", "Error, Comunicarse con el administrador");
                });
    });

    function campos() {
        $('input[type="file"]').each(function (key, val) {
            var img = $(this).val();
            if (img != "") {
                var r = (img.indexOf('jpg') != -1) ? '' : ((img.indexOf('png') != -1) ? '' : ((img.indexOf('gif') != -1) ? '' : false))
                if (r === false) {
                    alert('Tipo de archivo no valido');
                    return false;
                }
            }
        });
        if (obligatorio('obligatorio') == false) {
            return false
        } else {
            $('#btnguardar').hide();
            $('#boton_cargar').show();
            return true;
        }
    }
</script>
