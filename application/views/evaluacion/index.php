<br>
<script src="<?php echo base_url("js/tinymce/js/tinymce/tinymce.min.js") ?>"></script>
<div class="row">
    <div class="col-md-6">
        <div title="Guardar" id="guardarEvaluacion" class="circuloIcon"><i class="fa fa-floppy-o fa-3x"></i></div>
        <!--<div class="circuloIcon" ><i class="fa fa-trash-o fa-3x"></i></div>-->
        <a href="<?php echo base_url('index.php/Evaluacion/consult_evaluacion') ?>"><div title="Listado Evaluaciones" class="circuloIcon"><i class="fa fa-sticky-note fa-3x"></i></div></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i>Evaluación
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?php echo base_url('index.php/') . "/Evaluacion/save_evaluacion"; ?>" method="post" onsubmit="return campos()"  enctype="multipart/form-data" id="form1">
                    <div class="form-body">
                        <div class="row">
                            <?php $id = (isset($datos[0]->eva_id) ? $datos[0]->eva_id : '' ) ?>
                            <input type="hidden" value="<?php echo (isset($datos[0]->eva_id) ? $datos[0]->eva_id : '' ) ?>" class=" form-control   " id="eva_id" name="eva_id">
                            <div class="col-md-3">
                                <label for="eva_nombre">
                                    * Nombre                        
                                </label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->eva_nombre) ? $datos[0]->eva_nombre : '' ) ?>" class=" form-control obligatorio  " id="eva_nombre" name="eva_nombre">
                                <br>
                            </div>
                            <div class="col-md-3">
                                <label for="eva_nombre">
                                    * Preguntas aleatorias                        
                                </label>
                            </div>
                            <div class="col-md-3">
                                <select id="eva_random" name="eva_random" class="form-control">
                                    <option value="SI" <?php echo (isset($datos[0]->eva_random) ? (($datos[0]->eva_random=='SI')?'selected':'') : '' ) ?> >Si</option>
                                    <option value="NO" <?php echo (isset($datos[0]->eva_random) ? (($datos[0]->eva_random=='NO')?'selected':'') : '' ) ?> >No</option>
                                </select>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="eva_nombre">
                                    * Tiempo en minutos                        
                                </label>
                            </div>
                            <div class="col-md-3">
                                <select id="eva_tiempo" name="eva_tiempo" class="form-control">
                                    <?php for ($i = 0; $i < 60; $i++) { ?>
                                        <option value="<?php echo $i ?>" <?php echo (isset($datos[0]->tiempo) ? (($datos[0]->tiempo == $i) ? 'selected' : '') : '' ) ?>><?php echo ($i==0)?'Sin tiempo':$i ?> </option>
                                    <?php } ?>
                                </select><br>
                            </div>
                            <div class="col-md-3">
                                <label for="eva_nombre">
                                    * Numero de preguntas a evaluar                        
                                </label>
                            </div>
                            <div class="col-md-3">
                                <select id="eva_num_preguntas" name="eva_num_preguntas" class="form-control">
                                    <?php for ($i = 0; $i < 60; $i++) { ?>
                                        <option value="<?php echo $i ?>" <?php echo (isset($datos[0]->tiempo) ? (($datos[0]->tiempo == $i) ? 'selected' : '') : '' ) ?>><?php echo ($i==0)?'Todas':$i ?> </option>
                                    <?php } ?>
                                </select><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="eva_nombre">
                                    Mensaje de inicio:
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="eva_texto" id="eva_texto" class="textarea"><?php echo (isset($datos[0]->eva_texto) ? $datos[0]->eva_texto : '' ) ?></textarea>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div style="float: right"><b>Los campos en * son obligatorios</b></div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    tinymce.init({selector: '.textarea'});
    
    $('#guardarEvaluacion').click(function () {
        $('#form1').submit();
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
