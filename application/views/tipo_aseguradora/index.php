<div class="row">
    <span id="boton_guardar">
        <div class="col-md-6">
            <?php if (isset($post['campo'])) { ?>
                <div class="circuloIcon" id="btnguardar" title="Actualizar"><i class="fa fa-pencil-square-o fa-3x"></i></div>
            <?php } else { ?>
                <div class="circuloIcon" id="btnguardar" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
            <?php } ?>
            <div class="circuloIcon limpiar"  title="Limpiar"><i class="fa fa-eraser fa-3x"></i></div>
            <a href="<?php echo base_url('index.php') . "/Tipo_aseguradora/consult_tipo_aseguradora" ?>">
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
                CREAR TIPO DE ASEGURADORA
            </span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form action="<?php echo base_url('index.php/') . "/Tipo_aseguradora/save_tipo_aseguradora"; ?>" method="post" onsubmit="return campos()" id="form1"  enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <label for="TipAse_Nombre">
                    *                             Tipo aseguradora                        </label>
            </div>
            <div class="col-md-6">
                <input type="text" value="<?php echo (isset($datos[0]->TipAse_Nombre) ? $datos[0]->TipAse_Nombre : '' ) ?>" class=" form-control obligatorio  " id="TipAse_Nombre" name="TipAse_Nombre">
            </div>

        </div>
        <?php if (isset($post['campo'])) { ?>
            <input type="hidden" name="<?php echo $post['campo'] ?>" value="<?php echo $post[$post['campo']] ?>">
            <input type="hidden" name="campo" value="<?php echo $post['campo'] ?>">
        <?php } ?>
        <div class="row">
            <span id="boton_guardar">

            </span>
            <span id="boton_cargar" style="display: none">
                <h2>Cargando ...</h2>
            </span>
        </div>
        <div class="row"><div style="float: right"><b>Los campos en * son obligatorios</b></div></div>
    </form>
</div>
<script>

    $('#TipAse_Nombre').change(function () {

        var data = $(this);
        $.post(
                "<?php echo base_url("index.php/Tipo_aseguradora/validatipoaseguradora") ?>",
                {TipAse_Nombre: $(this).val()}
        ).done(function (msg) {
            if (msg == 1) {
                data.val("");
                data.focus();
                alerta("amarillo", "Tipo de aseguradora ya existe en el sistema")
            }
        })
                .fail(function (msg) {

                });

    });
    
    $("#btnguardar").click(function(){
        $("#form1").submit();
    });
    $('.limpiar').click(function () {
        $('#TipAse_Nombre').val('')
    })

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
