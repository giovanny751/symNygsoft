<style type="text/css">
    #clasificacionRiesgo{
        background-color: #D7EBFC;
    }
    #clasificacionRiesgo > .hijoCategoria:hover{
        background-color: #C2E0FA;
    }

</style>
<div class="row">
    <div class="col-md-6">
        <br>
        <?php if (isset($accidente)) { ?>
            <div class="circuloIcon" id="guardarAccidente" title="Editar"><i class="fa fa fa-pencil-square-o fa-3x"></i></div>
        <?php } else { ?>
            <div class="circuloIcon" id="guardarAccidente" title="Guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
        <?php } ?>
            <a href="<?php echo base_url('index.php/Administrativo/listadoaccidente')?>">
            <div class="circuloIcon" metodo="documento" title="Listado Accidentes">
                <i class="fa fa-sticky-note fa-2x"></i>
            </div>
        </a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> <span class="">
                        <a href="<?php echo base_url("index.php/presentacion/principal") ?>" style="color: #FFF">HOME</a>/
                        <a href="<?php echo base_url("index.php/administrativo/empresa") ?>" style="color: #FFF">EMPRESA</a>/
                        ACCIDENTES</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="formAccidente" method="post" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <label><b>A. INFORMACI&Oacute;N GENERAL</b></label>
                                        </center>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="empresa" class="col-md-4"><span class="campoobligatorio">*</span>Empleado:</label>  
                                            <div class="col-md-8">
                                                <select name="empleado" id="empleado" class="form-control obligatorio">
                                                    <option value="">::Seleccionar::</option>
                                                    <?php foreach ($empleados as $empleado): ?>
                                                        <option <?php echo ((isset($accidente) && $empleado->Emp_Id == $accidente["datos"]["empleado"]) ? "selected" : ""); ?> value="<?php echo $empleado->Emp_Id ?>"><?php echo $empleado->Emp_Nombre . " " . $empleado->Emp_Apellidos ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1">
                                                <label for="lugar"><span class="campoobligatorio">*</span>Lugar</label>  
                                            </div>
                                            <div class="col-md-11">
                                                <input type="text" name="lugar" id="lugar" class="form-control obligatorio" value="<?php echo (isset($accidente)) ? $accidente["datos"]["lugar"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1">
                                                <label for="dimension1"><span class="campoobligatorio">*</span><?php echo $empresa->Dim_id ?></label>
                                            </div>
                                            <div class="col-md-5">
                                                <select name="dimension1" id="dimension1" class="form-control obligatorio dimencion_uno_se">
                                                    <option value="">::Seleccionar::</option>
                                                    <?php foreach ($dimension as $d): ?>
                                                        <option <?php echo ((isset($accidente) && $d->dim_id == $accidente["datos"]["dimension1"]) ? "selected" : ""); ?> value="<?php echo $d->dim_id; ?>"><?php echo $d->dim_descripcion ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="dimension2"><?php echo $empresa->Dimdos_id ?></label>
                                            </div>
                                            <div class=" col-md-5 ">
                                                <select name="dimension2" id="dimension2" class="form-control dimencion_dos_se">
                                                    <option value="">::Seleccionar::</option>
                                                    <?php foreach ($dimension2 as $d2): ?>
                                                        <option <?php echo ((isset($accidente) && $d2->dim_id == $accidente["datos"]["dimension2"]) ? "selected" : ""); ?> value="<?php echo $d2->dim_id; ?>"><?php echo $d2->dim_descripcion ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="zona" class="col-md-1 "><span class="campoobligatorio">*</span>Zona</label>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control obligatorio" id="zona" name="zona" value="<?php echo (isset($accidente)) ? $accidente["datos"]["zona"] : "" ?>" />
                                            </div>
                                            <label for="jefe" class="col-md-1 ">Jefe Inmediato</label>
                                            <div class="col-md-5">
                                                <input type="text" name="jefe" id="jefe" class="form-control" value="<?php echo (isset($accidente)) ? $accidente["datos"]["jefeInmediato"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <center>
                                            <label><b>INCAPACIDAD</b></label>
                                        </center>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="responsable" class="col-md-1 ">Responsable</label>
                                            <div class="col-md-2">
                                                <select name="responsable" id="responsable" class="form-control campoIncapacidad">
                                                    <option value="">::Seleccionar::</option>
                                                    <?php foreach ($responsables as $responsable): ?>
                                                        <option <?php echo ((isset($accidente) && $responsable->empRes_id == $accidente["incapacidad"]["responsable"]) ? "selected" : ""); ?> value="<?php echo $responsable->empRes_id ?>"><?php echo $responsable->empRes_descripcion ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <label for="fechaInicioIncapacidad" class="col-md-1 ">Fecha Inicio</label>
                                            <div class="col-md-2">
                                                <input type="date" class="fecha form-control campoIncapacidad fechaIncapacidad" id="fechaInicioIncapacidad" name="fechaInicioIncapacidad" value="<?php echo ((isset($accidente)) ? $accidente["incapacidad"]["fInicial"] : ""); ?>" />
                                            </div>
                                            <label for="fechaFinIncapacidad" class="col-md-1 ">Fecha Final</label>
                                            <div class="col-md-2">
                                                <input type="date" class="fecha form-control campoIncapacidad fechaIncapacidad" id="fechaFinIncapacidad" name="fechaFinIncapacidad" value="<?php echo ((isset($accidente)) ? $accidente["incapacidad"]["fFinal"] : ""); ?>" />
                                            </div>
                                            <label for="diasIncapacidad" class="col-md-1 ">Dias Incapacidad</label>
                                            <div class="col-md-2">
                                                <input style="text-align: center;" type="text" class="form-control" id="diasIncapacidad" disabled="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> 
                                            <label class="col-md-12"><span class="campoobligatorio">*</span>1. Tipo de Evento:</label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i = 0;
                                $j = 0;
                                foreach ($tipo_eventos as $tipo_evento):
                                    echo ($i == 0) ? "<div class='row'><div class='col-md-12'><div class=' form-group'>" : "";
                                    ?>
                                    <div class="col-md-3">
                                        <div class="checkbox">
                                            <label>
                                                <input <?php echo ((isset($accidente) && $tipo_evento->tipEve_id == $accidente["datos"]["tipoEvento"]) ? "checked" : ""); ?> type="radio" class="radioObligatorio" name="tipo" value="<?php echo $tipo_evento->tipEve_id; ?>"> <b><?php echo $tipo_evento->tipEve_descripcion; ?></b>
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    $i = (($i == 3) ? 0 : $i + 1);
                                    $j++;
                                    echo ($i == 0 || count($tipo_eventos) == $j) ? "</div></div></div>" : "";
                                endforeach;
                                ?>
                                <div class="row buscar_accidente" style="display: none" >
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-1">
                                                        <label for="dimension1_bus"><?php echo $empresa->Dim_id ?></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select  id="dimension1_bus" class="form-control dimencion_uno_se">
                                                            <option value="">::Seleccionar::</option>
                                                            <?php foreach ($dimension as $d): ?>
                                                                <option value="<?php echo $d->dim_id; ?>"><?php echo $d->dim_descripcion ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label for="dimension2_bus"><?php echo $empresa->Dimdos_id ?></label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <select  id="dimension2_bus" class="form-control dimencion_dos_se">
                                                            <option value="">::Seleccionar::</option>
                                                            <?php foreach ($dimension2 as $d2): ?>
                                                                <option value="<?php echo $d2->dim_id; ?>"><?php echo $d2->dim_descripcion ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row buscar_accidente" style="display: none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-1">
                                                Lugar
                                            </div>
                                            <div class="col-md-11">
                                                <select id="lugar_asociado" name="lugar_asociado" class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12">2. Clase de Eventos:</label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i = 0;
                                $j = 0;
                                foreach ($clases_eventos as $clase_evento):
                                    echo ($i == 0) ? "<div class='row'><div class='col-md-12'>" : "";
                                    ?>
                                    <div class="col-md-3">
                                        <div class="checkbox">
                                            <label>
                                                <input <?php echo ((isset($accidente) && in_array($clase_evento->claEve_id, $accidente["tipEve"]) ) ? "checked" : ""); ?> type="checkbox" name="claseEventos[]" value="<?php echo $clase_evento->claEve_id; ?>"> <b><?php echo $clase_evento->claEve_descripcion; ?></b>
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    $i = (($i == 3) ? 0 : $i + 1);
                                    $j++;
                                    echo ($i == 0 || count($clases_eventos) == $j) ? "</div></div>" : "";
                                endforeach;
                                ?>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <center>
                                                    <label><b>B. DESCRIPCI&Oacute;N DEL ACCIDENTE</b></label>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12 ">
                                                <label>6. Parte del Cuerpo Afectada:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i = 0;
                                $j = 0;
                                foreach ($partes_del_cuerpo as $parte_del_cuerpo):
                                    echo ($i == 0) ? "<div class='row'><div class='col-md-12'>" : "";
                                    ?>
                                    <div class="col-md-3">
                                        <div class="checkbox">
                                            <label>
                                                <input <?php echo ((isset($accidente) && in_array($parte_del_cuerpo->parCue_id, $accidente["parCUe"]) ) ? "checked" : ""); ?> type="checkbox" name="parteCuerpo[]" value="<?php echo $parte_del_cuerpo->parCue_id; ?>"> <b><?php echo $parte_del_cuerpo->parCue_descripcion; ?></b>
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    $i = (($i == 3) ? 0 : $i + 1);
                                    $j++;
                                    echo ($i == 0 || count($partes_del_cuerpo) == $j) ? "</div></div>" : "";
                                endforeach;
                                ?>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label for="sitio"><span class="campoobligatorio">*</span>7. Sitio o Lugar del Accidente: </label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" name="sitio" id="sitio" class="form-control obligatorio" value="<?php echo (isset($accidente)) ? $accidente["datos"]["lugarAccidente"] : "" ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3 "><span class="campoobligatorio">*</span>8. Hora y Fecha del Accidente</label>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control fecha obligatorio" name="accidenteFecha" placeholder="Fecha" value="<?php echo (isset($accidente)) ? $accidente["datos"]["fechaAccidente"][0] : "" ?>">
                                            </div>
                                            <div class="col-md-1">
                                                <input type="text" class="form-control obligatorio" name="accidenteHora" placeholder="HH:MM" value="<?php echo (isset($accidente)) ? $accidente["datos"]["fechaAccidente"][1] : "" ?>" >
                                            </div>
                                            <label class="col-md-2 " for="accidenteReportado"><span class="campoobligatorio">*</span>10. Accidente reportado por(nombre):</label>
                                            <div class="col-md-4">
                                                <input type="text" name="accidenteReportado" id="accidenteReportado" class="form-control obligatorio" value="<?php echo (isset($accidente)) ? $accidente["datos"]["reportado"] : "" ?>"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="descripcion"><span class="campoobligatorio">*</span>11. Descripci&oacute;n de lo ocurrido:<i>(posici&oacute;n,personas,partes,documentos)</i></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <textarea id="descripcion" name="descripcion" class="form-control obligatorio"><?php echo (isset($accidente)) ? $accidente["datos"]["descripcion"] : "" ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>12. Tipo de Riesgo:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $i = 0;
                                $j = 0;
                                $f = 1;
                                foreach ($tipo_riesgos as $tipo_riesgo):
                                    echo ($i == 0) ? "<div class='row'><div class='col-md-12'>" : "";
                                    ?>
                                    <div class="col-md-3">
                                        <div class="checkbox">
                                            <label>
                                                <input <?php echo ((isset($accidente) && in_array($tipo_riesgo->rieCla_id, $accidente["rieClasificacion"]) ) ? "fila='" . $f . "' checked" : ""); ?> class="tipoRiesgo" type="checkbox" name="tipoRiesgo[]" value="<?php echo $tipo_riesgo->rieCla_id; ?>"> <b><?php echo $tipo_riesgo->rieCla_categoria; ?></b>
                                                <?php $f = ( (isset($accidente) && in_array($tipo_riesgo->rieCla_id, $accidente["rieClasificacion"]) ) ? $f + 1 : $f ); ?>
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    $i = (($i == 3) ? 0 : $i + 1);
                                    $j++;
                                    echo ($i == 0 || count($tipo_riesgos) == $j) ? "</div></div>" : "";
                                endforeach;
                                ?>
                                <hr />
                                <div id="clasificacionRiesgo">
                                    <?php
                                    $z = 0;
                                    if (isset($accidente)) {
                                        $z++;
                                        foreach ($rieClasificaciones as $rieClasificacion => $categoria):
                                            ?>
                                            <div class='hijoCategoria' fila='<?php echo $z ?>'>
                                                <div class="row">
                                                    <div class='col-md-12'>
                                                        <center><label><?php echo $categoria["categoria"] ?></label></center>
                                                    </div>
                                                </div>
                                                <?php
                                                $i = 0;
                                                $j = 0;
                                                foreach ($categoria['tipo'] as $id => $nombre):
                                                    ?>
                                                    <?php if ($i == 0) { ?> 
                                                        <div class='row'>
                                                            <div class=' form-group'>
                                                            <?php } ?>
                                                            <div class='col-md-3'>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input <?php echo ((in_array($id, $accidente["rieClasificacionTipo"])) ? "checked" : ""); ?>  type='checkbox' name='dato/<?php echo $rieClasificacion ?>[]' value="<?php echo $id ?>"> <b><?php echo $nombre ?></b>
                                                                    </label>
                                                                </div>        
                                                            </div>
                                                            <?php
                                                            $i = (($i == 3) ? 0 : ($i + 1));
                                                            $j++;
                                                            if (($i == 0) || (count($categoria['tipo']) == $j)) {
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                endforeach;
                                                $z++;
                                                ?>
                                                <hr />
                                            </div>
                                            <?php
                                        endforeach;
                                    }
                                    ?>
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <center>
                                                    <label><b>C. INFORMACI&Oacute;N DEL REPORTE</b></label>
                                                </center>
                                            </div> 
                                        </div> 
                                    </div> 
                                </div>
                                <hr />
                                <div id="correoAdicional">
                                    <?php if (isset($accidente)) { ?>
                                        <?php
                                        $c = 1;
                                        foreach ($accidente["correo"] as $idCorreo => $correo):
                                            ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="correo" class="col-md-2 ">Correo</label>
                                                        <div class="col-md-9">
                                                            <input type="email" class="form-control" name="correo[]" id="correo" placeholder="Correo" value="<?php echo $correo ?>">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn <?php echo (($c == 1) ? " btn-success agregarCorreo" : "btn-danger eliminarCorreo"); ?>"><i class="fa <?php echo (($c == 1) ? "fa-plus" : "fa-times") ?>"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $c++;
                                        endforeach;
                                        ?>
                                    <?php }else { ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="correo" class="col-md-2 ">Correo</label>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control" name="correo[]" id="correo" placeholder="Correo">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn btn-success agregarCorreo"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php if (isset($accidente)) { ?>
                                    <input type="hidden" name="registro" id="registro" value="<?php echo $accidente["datos"]["id"] ?>" />
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<br>
<br>
<script type="text/javascript">
    
    $('.fechaIncapacidad').change(function(){
        if($('#fechaInicioIncapacidad').val() != '' && $('#fechaFinIncapacidad').val() != '' ){
            f1 = $('#fechaInicioIncapacidad').val();
            f2 =  $('#fechaFinIncapacidad').val();
            
            var aFecha1 = f1.split('-'); 
            var aFecha2 = f2.split('-'); 
            var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]); 
            var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]); 
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
//            alert(dias);
            $('#diasIncapacidad').val(parseInt(dias)+1)
        }
    });
    
    
    $('#dimension1_bus').change(function () {
        obtener_lugar();
    })
    $('#dimension2_bus').change(function () {
        obtener_lugar();
    })
    function obtener_lugar() {
        var dim1 = $('#dimension1_bus').val();
        var dim2 = $('#dimension2_bus').val();
        $('#lugar_asociado').html('');
        $.post(url + "index.php/Administrativo/obtener_lugar", {dim1: dim1, dim2: dim2})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message']);
                    else {
                        var body = "";
                        $.each(msg.Json, function (key, val) {
                            body += "<option value='" + val.acc_id + "'>";
                            body += "" + val.acc_lugar + "-" + val.acc_zona + "";
                            body += "</option>";
                        });
                        $('#lugar_asociado').html(body);
                    }
                }).fail(function () {

        })

    }

    $('input[name="tipo"]').click(function () {
        if ($(this).val() == 1) {
            $('.buscar_accidente').show()
        } else {
            $('.buscar_accidente').hide()
        }
    })
    $("#guardarAccidente").click(function () {

        var radio = false;
        $(".radioObligatorio").each(function (indice, campo) {
            if ($(this).is(':checked')) {
                radio = true;
            }
        });

        var incapacidad = metodoIncapacidad();

        if (obligatorio("obligatorio") && radio && incapacidad) {
            var url = "<?php echo (isset($accidente) ? base_url("index.php/Administrativo/editarAccidente") : base_url("index.php/Administrativo/guardarAccidente")); ?>";
            var datos = $("#formAccidente").serialize();
            $(".radioObligatorio").parent().removeClass("obligado");
            $.post(url, datos)
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta("rojo", msg['message']);
                        else {
                            alerta("verde", "Guardado");
                            if (confirm("Desea generar otro accidente?")) {
                                $(":input", "#formAccidente").not(":button, :submit, :reset, :hidden").val("").removeAttr("checked").removeAttr("selected")
                            } else {
                                location.href = '<?php echo base_url('index.php/Administrativo/listadoaccidente') ?>'
                            }
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error");
                    })
        } else if (radio == false) {
            $(".radioObligatorio").parent().addClass("obligado");
        } else {
            $(".radioObligatorio").parent().removeClass("obligado");
        }

    });
    $("body").on("click", ".agregarCorreo", function () {
        var html = "";
        html += "<div class='row'>";
        html += "<div class='form-group'>";
        html += "<label for='correo' class='col-md-2 '>Correo</label>";
        html += "<div class='col-md-9'>";
        html += "<input type='email' class='form-control' name='correo[]' id='correo' placeholder='Correo'>";
        html += "</div>";
        html += "<div class='col-md-1'>";
        html += "<button type='button' class='btn btn-danger eliminarCorreo'><i class='fa fa-times'></i></button>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        $("#correoAdicional").append(html);
    });
    $("body").on("click", ".eliminarCorreo", function () {
        $(this).parents("div.row")[0].remove();
    });

    var numFila = <?php echo $z ?>;

    $("body").on("click", ".tipoRiesgo", function () {
        if ($(this).is(":checked")) {
            var check = $(this);
            var datos = {riesgo: $(this).val()};
            var html = "";
            $.post(url + "index.php/Administrativo/consultaClasificacion", datos)
                    .done(function (msg) {
                        var i = 0;
                        var j = 0;
                        numFila++;
                        check.attr("fila", numFila);
                        if (msg.length > 0) {
                            html += "<div class='hijoCategoria' fila='" + numFila + "'>"
                            html += "<div class='row'>";
                            html += "<div class='col-md-12'>";
                            html += "<center><label>" + msg[0]["categoria"] + "</label></center>";
                            html += "</div>";
                            html += "</div>";
                            $.each(msg, function (index, valor) {
                                html += ((i == 0) ? "<div class='row'><div class=' form-group'>" : "");
                                html += "<div class='col-md-3'>";
                                html += "<div class='checkbox'>";
                                html += "<label>"
                                html += "<input type='checkbox' name='dato/" + valor.clasificacion + "[]' value='" + valor.clasificacion_id + "'> <b>" + valor.tipo + "</b>";
                                html += "</label>";
                                html += "</div>";
                                html += "</div>";
                                i = ((i == 3) ? 0 : (i + 1))
                                j++;
                                html += (((i == 0) || (msg.length == j)) ? "</div></div>" : "");
                            });
                            html += "<hr />"
                            html += "</div>"
                            $("#clasificacionRiesgo").append(html);
                        } else {
                            console.info("No hay Datos")
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "error")
                    })
        } else {
            var posicion = $(this).attr("fila");
            $(".hijoCategoria[fila='" + posicion + "']").remove();
        }
    });

    function metodoIncapacidad() {
        var vacio = true;
        $(".campoIncapacidad").each(function (indice, campo) {
            if ($(this).val() != "") {
                vacio = false;
            }
        });
        if (vacio === true) {
            return true
        } else {
            var cantidadDias = difFechaIncapacidad("#fechaInicioIncapacidad", "#fechaFinIncapacidad");
            if (cantidadDias != false) {
                $("#diasIncapacidad").val(cantidadDias);
                var i = 0;
                var campos = false;
                $(".campoIncapacidad").each(function (indice, campo) {
                    if ($(this).val() != "") {
                        i++
                        $(this).removeClass("obligado")
                    } else {
                        $(this).addClass("obligado")
                    }
                    if (i == $(".campoIncapacidad").length) {
                        campos = true;
                    }
                });
                return campos;
            } else {
                return false;
            }
        }
    }
<?php if (isset($accidente["datos"]["acc_lugar_incidente"])) { ?>
        $('.buscar_accidente').show()
        var url = "<?php echo base_url("index.php/Administrativo/obtener_lugar") ?>";
        $.post(url, {acc_lugar_incidente:<?php echo $accidente["datos"]["acc_lugar_incidente"]; ?>})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message']);
                    else {
                        var body = "";
                        $.each(msg.Json, function (key, val) {
                            body += "<option value='" + val.acc_id + "'>";
                            body += "" + val.acc_lugar + "-" + val.acc_zona + "";
                            body += "</option>";
                        });
                        $('#lugar_asociado').html(body);
                    }
                })
                .fail(function () {

                })
<?php } ?>


</script>