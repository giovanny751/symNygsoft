
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-clipboard"></i>Inventario
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?php echo base_url('index.php/') . "/Inventario/save_inventario"; ?>" method="post" id="form1"  enctype="multipart/form-data">
                    <br>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <span id="boton_guardar">
                                    <div class="circuloIcon" onclick="campos()" title="Guardar Inventario" metodo="guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
                                </span>
                                <span id="boton_cargar" style="display: none">
                                    <h2>Cargando ...</h2>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <div id="posicionFlecha">
                                    <a href="<?php echo base_url('index.php') . "/Inventario/consult_inventario" ?>">
                                        <div class="flechaHeader Archivo" metodo="documento">
                                            <i class="fa fa-sticky-note fa-2x"></i>
                                        </div>
                                        <p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php $id = (isset($datos[0]->inv_id) ? $datos[0]->inv_id : '' ) ?>
                            <input type="hidden" value="<?php echo (isset($datos[0]->inv_id) ? $datos[0]->inv_id : '' ) ?>" class=" form-control   " id="inv_id" name="inv_id">
                            <label for="inv_referencia" class="col-md-3"> * Referencia </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->inv_referencia) ? $datos[0]->inv_referencia : '' ) ?>" class=" form-control obligatorio  " id="inv_referencia" name="inv_referencia">
                                <br>
                            </div>
                            <label for="inv_nombre" class="col-md-3"><span>*</span> Nombre </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->inv_nombre) ? $datos[0]->inv_nombre : '' ) ?>" class=" form-control obligatorio  " id="inv_nombre" name="inv_nombre">
                                <br>
                            </div>
                            <label for="inv_unidades" class="col-md-3"><span>*</span>Unidades </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->inv_unidades) ? $datos[0]->inv_unidades : '' ) ?>" class=" form-control obligatorio  number" id="inv_unidades" name="inv_unidades">
                                <br>
                            </div>
                            <label for="inv_marca" class="col-md-3"> Marca </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->inv_marca) ? $datos[0]->inv_marca : '' ) ?>" class=" form-control   " id="inv_marca" name="inv_marca">
                                <br>
                            </div>
                            <label for="inv_modelo" class="col-md-3"> Modelo </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->inv_modelo) ? $datos[0]->inv_modelo : '' ) ?>" class=" form-control   " id="inv_modelo" name="inv_modelo">
                                <br>
                            </div>
                            <label for="inv_serie" class="col-md-3">Serie</label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->inv_serie) ? $datos[0]->inv_serie : '' ) ?>" class=" form-control   " id="inv_serie" name="inv_serie">
                                <br>
                            </div>
                            <label for="inv_fecha_ingreso" class="col-md-3"> * Fecha ingreso </label>

                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->inv_fecha_ingreso) ? $datos[0]->inv_fecha_ingreso : '' ) ?>" class=" form-control obligatorio  fecha" id="inv_fecha_ingreso" name="inv_fecha_ingreso">
                                <br>
                            </div>
                            <label for="inv_dias_vencimiento" class="col-md-3">Dias vencimiento</label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->inv_dias_vencimiento) ? $datos[0]->inv_dias_vencimiento : '' ) ?>" class=" form-control   " id="inv_dias_vencimiento" name="inv_dias_vencimiento">
                                <br>
                            </div>
                            <label for="tipInv_id" class="col-md-3">
                                Tipo Dotación          
                            </label>
                            <div class="col-md-3">
                                <?php echo lista("tipInv_id", "tipInv_id", "form-control obligatorio", "tipo_inventario_estado", "tipInv_id", "tipInv_nombre", (isset($datos[0]->tipInv_id) ? $datos[0]->tipInv_id : ''), array("est_id" => "1"), /* readOnly? */ false); ?>
                                <br>
                            </div>
                            <label for="tipInv_id" class="col-md-3"></label>
                            <div class="col-md-3"><br></div>
                            <label for="inv_imagen" class="col-md-3">
                                Imagen                        
                            </label>
                            <div class="col-md-3">
                                <input type="file" value="<?php echo (isset($datos[0]->inv_imagen) ? $datos[0]->inv_imagen : '' ) ?>" class="    " id="inv_imagen" name="inv_imagen">
                                <?php if (!empty($id) && $datos[0]->inv_imagen != '') { ?>
                                    <img style="width: 200px" src="<?php echo base_url('uploads') ?>/inventario/<?php echo $id . "/" . $datos[0]->inv_imagen ?>">
                                <?php } ?>
                                <br>
                            </div>
                        </div>
                        <?php if (isset($post['campo'])) { ?>
                            <input type="hidden" name="<?php echo $post['campo'] ?>" value="<?php echo $post[$post['campo']] ?>">
                            <input type="hidden" name="campo" value="<?php echo $post['campo'] ?>">
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-12" style="text-align: right"><b>Los campos en * son obligatorios</b></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
<script>
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
            $('#form1').submit()
        }
    }
    $('body').delegate('.number', 'keypress', function (tecla) {
        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
            return false;
    });



</script>
