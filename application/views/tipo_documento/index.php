<div class="row">
    <span id="boton_guardar">
        <div class="col-md-6">
            <?php if (isset($post['campo'])) { ?>
                <div class="circuloIcon" id="btnguardar" title="Actualizar"><i class="fa fa-pencil-square-o fa-3x"></i></div>
            <?php } else { ?>
                <div class="circuloIcon" id="btnguardar" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
            <?php } ?>
            <div class="circuloIcon limpiar"  title="Limpiar"><i class="fa fa-eraser fa-3x"></i></div>
            <a href="<?php echo base_url('index.php') . "/Tipo_documento/consult_tipo_documento" ?>">
                <div class="circuloIcon"  title="Listado"><i class="fa fa-sticky-note fa-3x"></i></div>
            </a>
        </div>
    </span>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">
                TIPO DE DOCUMENTO
            </span>
        </div>
    </div>
</div>
<div class="cuerpoContenido">
    <form action="<?php echo base_url('index.php/') . "/Tipo_documento/save_tipo_documento"; ?>" method="post" onsubmit="return campos()"  enctype="multipart/form-data">
        <div class="row">

            <div class="col-md-12">
                <label for="tipDoc_Descripcion" style="color: black" >
                    * Tipo de documento                        
                </label>
                <input type="text" value="<?php echo (isset($datos[0]->tipDoc_Descripcion) ? $datos[0]->tipDoc_Descripcion : '' ) ?>" class=" form-control obligatorio  " id="tipDoc_Descripcion" name="tipDoc_Descripcion">
            </div>
        </div>
        <div class="col-md-12" style="color:black;text-align:right;"><b>Los campos en * son obligatorios</b></div>
        <?php if (isset($post['campo'])) { ?>
            <input type="hidden" name="<?php echo $post['campo'] ?>" value="<?php echo $post[$post['campo']] ?>">
            <input type="hidden" name="campo" value="<?php echo $post['campo'] ?>">
        <?php } ?>
        <div class="row">
            <span id="boton_cargar" style="display: none">
                <h2>Cargando ...</h2>
            </span>
        </div>
    </form>
</div>
<script>
    $('.limpiar').click(function () {
        $('#tipDoc_Descripcion').val('')
    })
    $('#btnguardar').click(function () {
        var tipDoc_Descripcion = $('#tipDoc_Descripcion').val();
        $.post("<?php echo base_url("index.php/tipo_documento/save_tipo_documento") ?>"
                , {tipDoc_Descripcion: tipDoc_Descripcion}
        )
                .done(function (msg) {
                        $('#tipDoc_Descripcion').val("");
                        $('#tipDoc_Descripcion').focus();
                        alerta("verde", "Tipo de contrato guardado correctamente")
                })
                .fail(function (msg) {
                    return false
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
            $('#boton_guardar').hide();
            $('#boton_cargar').show();
            return true;
        }
    }
    $('body').delegate('.number', 'keypress', function (tecla) {
        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
            return false;
    });
    $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});
</script>
