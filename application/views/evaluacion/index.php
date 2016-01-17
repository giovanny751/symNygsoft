
<div class="row">
    <div class="col-md-6">
        <div title="Guardar" id="guardarEvaluacion" class="circuloIcon"><i class="fa fa-floppy-o fa-3x"></i></div>
        <!--<div class="circuloIcon" ><i class="fa fa-trash-o fa-3x"></i></div>-->
        <a href="<?php echo base_url('index.php/Evaluacion/consult_evaluacion') ?>"><div title="Listado Evaluaciones" class="circuloIcon"><i class="fa fa-sticky-note fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">EVALUACIÓN</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form action="<?php echo base_url('index.php/')."/Evaluacion/save_evaluacion"; ?>" method="post" onsubmit="return campos()"  enctype="multipart/form-data" id="form1">
        <div class="row">
                                    <?php $id=(isset($datos[0]->eva_id)?$datos[0]->eva_id:'' ) ?>
                                                <input type="hidden" value="<?php echo (isset($datos[0]->eva_id)?$datos[0]->eva_id:'' ) ?>" class=" form-control   " id="eva_id" name="eva_id">
                    

                    <div class="col-md-3">
                        <label for="eva_nombre">
                            *                             Nombre                        </label>
                    </div>
                    <div class="col-md-3">
                                                    <input type="text" value="<?php echo (isset($datos[0]->eva_nombre)?$datos[0]->eva_nombre:'' ) ?>" class=" form-control obligatorio  " id="eva_nombre" name="eva_nombre">

                            
                                                <br>
                    </div>

                            </div>
        <?php if(isset($post['campo'])){ ?>
        <input type="hidden" name="<?php echo $post['campo']?>" value="<?php echo $post[$post['campo']]?>">
        <input type="hidden" name="campo" value="<?php echo $post['campo']?>">
        <?php } ?>
        <div class="row">
<!--            <span id="boton_guardar">
                <button class="btn btn-dcs" >Guardar</button> 
                <input class="btn btn-dcs" type="reset" value="Limpiar">
                <a href="<?php echo base_url('index.php')."/Evaluacion/consult_evaluacion" ?>" class="btn btn-dcs">Listado </a>
            </span>-->
            <span id="boton_cargar" style="display: none">
                <h2>Cargando ...</h2>
            </span>
        </div>
        <div class="row"><div style="float: right"><b>Los campos en * son obligatorios</b></div></div>
    </form>
</div>
<script>
    $('#guardarEvaluacion').click(function(){
        $('#form1').submit();
    })
    function campos() {
        $('input[type="file"]').each(function(key, val) {
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
    $('body').delegate('.number', 'keypress', function(tecla) {
        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
            return false;
    });
    $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });


</script>
