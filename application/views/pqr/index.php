<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="glyphicon glyphicon-ok"></i> PQR
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?php echo base_url('index.php/') . "/Pqr/save_pqr"; ?>" method="post" onsubmit="return campos()"  enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <?php $id = (isset($datos[0]->pqr_id) ? $datos[0]->pqr_id : '' ) ?>
                            <input type="hidden" value="<?php echo (isset($datos[0]->pqr_id) ? $datos[0]->pqr_id : '' ) ?>" class=" form-control   " id="pqr_id" name="pqr_id">


                            <div class="col-md-3">
                                <label for="tipSol_id">
                                    *                             Tipo De Solicitud:                        </label>
                            </div>
                            <div class="col-md-3">
                                <?php echo lista("tipSol_id", "tipSol_id", "form-control obligatorio", "tipo_solicitud", "tipSol_id", "tipSol_nombre", (isset($datos[0]->tipSol_id) ? $datos[0]->tipSol_id : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                        <br>
                            </div>



                            <div class="col-md-3">
                                <label for="temSol_id">
                                    *                             Tema:                        </label>
                            </div>
                            <div class="col-md-3">
                                <?php echo lista("temSol_id", "temSol_id", "form-control obligatorio", "temaSolicitud", "temSol_id", "temSol_nombre", (isset($datos[0]->temSol_id) ? $datos[0]->temSol_id : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                        <br>
                            </div>



                            <div class="col-md-3">
                                <label for="pqr_detalle">
                                    *                             Detalles:                        </label>
                            </div>
                            <div class="col-md-9">
                                <textarea class=" form-control obligatorio  " id="pqr_detalle" name="pqr_detalle"><?php echo (isset($datos[0]->pqr_detalle) ? $datos[0]->pqr_detalle : '' ) ?></textarea>
                                <br>
                            </div>



                            <div class="col-md-3">
                                <label for="sol_id">
                                    *                             Solicitante:                        </label>
                            </div>
                            <div class="col-md-3">
                                <?php echo lista("sol_id", "sol_id", "form-control obligatorio", "solicitante", "sol_id", "sol_nombre", (isset($datos[0]->sol_id) ? $datos[0]->sol_id : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                        <br>
                            </div>



                            <div class="col-md-3">
                                <label for="pqr_nombre">
                                    *                             Nombre:                        </label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->pqr_nombre) ? $datos[0]->pqr_nombre : '' ) ?>" class=" form-control obligatorio  " id="pqr_nombre" name="pqr_nombre">
                                <br>
                            </div>



                            <div class="col-md-3">
                                <label for="email">
                                    *                             E-mail:                        </label>
                            </div>
                            <div class="col-md-3">
                                <input type="email" value="<?php echo (isset($datos[0]->email) ? $datos[0]->email : '' ) ?>" class=" form-control obligatorio  " id="email" name="email">


                                <br>
                            </div>



                            <div class="col-md-3">
                                <label for="telefono">
                                    *                             Teléfono:                        </label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($datos[0]->telefono) ? $datos[0]->telefono : '' ) ?>" class=" form-control obligatorio  number" id="telefono" name="telefono">
                                <br>
                            </div>



                            <div class="col-md-3">
                                <label for="dep_id">
                                    *                             Departamento:                        </label>
                            </div>
                            <div class="col-md-3">
                                <?php echo lista("dep_id", "dep_id", "form-control obligatorio", "departamento", "dep_id", "dep_nombre", (isset($datos[0]->dep_id) ? $datos[0]->dep_id : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                        <br>
                            </div>
                            <?php if (isset($post['campo'])) { ?>
                                <div class="col-md-3">
                                    <label for="dep_id">
                                        *                             Estado:                        </label>
                                </div>
                                <div class="col-md-3">
                                    <?php echo lista("estSol_id", "estSol_id", "form-control obligatorio", "estado_solicitud", "estSol_id", "estSol_nombre", (isset($datos[0]->estSol_id) ? $datos[0]->estSol_id : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                        <br>
                                </div>
                            <?php } ?>

                        </div>
                        <?php if (isset($post['campo'])) { ?>
                            <input type="hidden" name="<?php echo $post['campo'] ?>" value="<?php echo $post[$post['campo']] ?>">
                            <input type="hidden" name="campo" value="<?php echo $post['campo'] ?>">
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-12">
                                <span id="boton_guardar">
                                    <button class="btn btn-dcs" >Guardar</button> 
                                    <input class="btn btn-dcs" type="reset" value="Limpiar">
                                    <a href="<?php echo base_url('index.php') . "/Pqr/consult_pqr" ?>" class="btn btn-info">Listado </a>
                                </span>
                                <span id="boton_cargar" style="display: none">
                                    <h2>Cargando ...</h2>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="float: right"><b>Los campos en * son obligatorios</b></div>
                            </div>
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
            return true;
        }
    }
    $('body').delegate('.number', 'keypress', function (tecla) {
        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
            return false;
    });
    $('.fecha').datepicker({dateFormat: 'yy-mm-dd'});


</script>
