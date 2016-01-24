<form action="<?php echo base_url('index.php/') . "/Tipo_contrato/save_tipo_contrato"; ?>" method="post" onsubmit="return campos()"  enctype="multipart/form-data" id="frmcontrato">
    <div class="row">
        <span id="boton_guardar">
            <div class="col-md-6">
                <?php if (isset($post['campo'])) { ?>
                    <div class="circuloIcon" id="btnguardar" title="Actualizar"><i class="fa fa-pencil-square-o fa-3x"></i></div>
                <?php } else { ?>
                    <div class="circuloIcon" id="btnguardar" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
                <?php } ?>
                <a href="<?php echo base_url('index.php') . "/Tipo_contrato/consult_tipo_contrato" ?>">
                    <div class="circuloIcon"  title="Listado"><i class="fa fa-sticky-note fa-3x"></i></div>
                </a>
            </div>
        </span>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tituloCuerpo">
                <span class="txtTitulo">
                    <a href="<?php echo base_url("index.php/presentacion/principal") ?>">HOME</a>/
                    <a href="<?php echo base_url("index.php/administrativo/empresa") ?>">EMPRESA</a>/
                    TIPO DE CONTRATO
                </span>
            </div>
        </div>
    </div>
    <div class='cuerpoContenido'>
        <div class="row">
            <label for="TipCon_Descripcion" class="col-md-12">
                *Tipo de contrato                        
            </label>
            <div class="col-md-12">
                <input type="text" value="<?php echo (isset($datos[0]->TipCon_Descripcion) ? $datos[0]->TipCon_Descripcion : '' ) ?>" class=" form-control obligatorio  " id="TipCon_Descripcion" name="TipCon_Descripcion">
                <br>
            </div>
        </div>
        <?php if (isset($post['campo'])) { ?>
            <input type="hidden" name="<?php echo $post['campo'] ?>" value="<?php echo $post[$post['campo']] ?>">
            <input type="hidden" name="campo" value="<?php echo $post['campo'] ?>">
        <?php } ?>
        <div class="row">
            <span id="boton_cargar" style="display: none">
                <h2>Cargando ...</h2>
            </span>
        </div>
        <div class="row"><div style="float: right"><b>Los campos en * son obligatorios</b></div></div>
    </div>
</form>
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
            $('#boton_guardar').hide();
            $('#boton_cargar').show();
            return true;
        }
    }
</script>
