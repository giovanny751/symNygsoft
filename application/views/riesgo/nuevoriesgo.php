<br>
<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="<?php echo (empty($rie_id)) ? "guardar" : "actualizar"; ?>" title="<?php echo (empty($rie_id)) ? "Guardar" : "Actualizar"; ?>"><i class="fa fa-floppy-o fa-3x"></i></div>
        <a href="<?php echo base_url() . "/index.php/riesgo/nuevoriesgo" ?>"><div class="circuloIcon" title="Nuevo Riesgo" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
    <div class="col-md-6">
        <div id="posicionFlecha">
            <a href="<?php echo base_url("index.php/riesgo/listadoriesgo") ?>"><div class="flechaHeader Archivo" metodo="documento"><i class="fa fa-sticky-note fa-2x"></i></div></a>
        </div>
    </div>
</div>
<br>
<div class="general_div">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cog"></i> Riesgo
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <form method="post" id="riesgos" class="form-horizontal">
                                <div class="col-lg-6 col-md-6 col-sx-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="descripcion" class="col-md-4">
                                                    <span class="campoobligatorio">*</span>Descripción
                                                </label>
                                                <div class="col-md-8"> 
                                                    <input type="text" name="descripcion" id="descripcion" class="form-control obligatorio" value="<?php echo ((!empty($riesgo->rie_descripcion)) ? $riesgo->rie_descripcion : ""); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="categoria" class="col-md-4"><span class="campoobligatorio">*</span>Clasificación</label>
                                                <div class="col-md-8">
                                                    <select name="categoria" id="categoria" class="form-control obligatorio">
                                                        <option value="">::Seleccionar::</option>
                                                        <?php foreach ($categoria as $ca) { ?>
                                                            <option <?php echo (!empty($riesgo->rieCla_id) && $riesgo->rieCla_id == $ca->rieCla_id) ? "selected" : ""; ?> value="<?php echo $ca->rieCla_id ?>"><?php echo strtoupper($ca->rieCla_categoria) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tipo" class="col-md-4">
                                                    <span class="campoobligatorio">*</span>Tipo
                                                </label>
                                                <div class="col-md-8 ">
                                                    <select class="form-control obligatorio" id="tipo" name="tipo" >
                                                        <option value="">::Seleccionar::</option>
                                                        <?php
                                                        if (!empty($rie_id)):
                                                            foreach ($tipo as $t):
                                                                ?>
                                                                <option <?php echo ((!empty($riesgo->rieClaTip_id)) && ($t->rieClaTip_id == $riesgo->rieClaTip_id)) ? "selected" : ""; ?> value="<?php echo $t->rieClaTip_id ?>"><?php echo $t->rieClaTip_tipo ?></option> <?php
                                                            endforeach;
                                                        endif;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="dimensionuno" class="col-md-4"><?php echo $empresa[0]->Dim_id ?></label>
                                                <div class="col-md-8">
                                                    <select type="text" name="dimensionuno" id="dimensionuno" class="form-control dimencion_uno_se" >
                                                        <option value="">::Seleccionar::</option>
                                                        <?php foreach ($dimension as $d1) : ?>
                                                            <option <?php echo ((!empty($riesgo->dim1_id)) && ($d1->dim_id == $riesgo->dim1_id)) ? "selected" : ""; ?> value="<?php echo $d1->dim_id; ?>"><?php echo strtoupper($d1->dim_descripcion); ?></option>
                                                        <?php endforeach; ?>
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="dimensiondos" class="col-md-4">
                                                    <?php echo $empresa[0]->Dimdos_id ?>
                                                </label>
                                                <div class="col-md-8">
                                                    <select type="text" name="dimensiondos" id="dimensiondos" class="form-control dimencion_dos_se" >
                                                        <option value="">::Seleccionar::</option>
                                                        <?php foreach ($dimension2 as $d2) { ?>
                                                            <option <?php echo ((!empty($riesgo->dim2_id)) && ($d2->dim_id == $riesgo->dim2_id) ? "selected" : "") ?> value="<?php echo $d2->dim_id ?>"><?php echo strtoupper($d2->dim_descripcion) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="zona" class="col-md-4">Lugar/Zona</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="zona" id="zona" class="form-control" value="<?php echo ((!empty($riesgo->rie_zona)) ? $riesgo->rie_zona : ""); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="requisito" class="col-md-4">Requisito legal asociado</label>   
                                                <div class="col-md-8">
                                                    <input type="text" name="requisito" id="requisito" class="form-control" value="<?php echo ((!empty($riesgo->rie_requisito)) ? $riesgo->rie_requisito : ""); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nivelDeficiencia" class="col-md-4"><span>*</span>Nivel de deficiencia</label> 
                                                <div class="col-md-8">
                                                    <select name="nivelDeficiencia" id="nivelDeficiencia" class="form-control calculoNivelProbabilidad obligatorio" >
                                                        <option value="">::Seleccionar::</option>
                                                        <?php foreach ($deficiencia as $d): ?>
                                                        <option <?php echo (!empty($riesgo->nivDef_id) && $d->nivDef_id == $riesgo->nivDef_id )?"selected ":"";?> value="<?php echo $d->nivDef_id ?>"><?php echo strtoupper($d->nivDef_nivel) . " (" . $d->nivDef_valor . ")" ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nivelExposicion" class="col-md-4"><span>*</span>Nivel de exposición</label>
                                                <div class="col-md-8">
                                                    <select name="nivelExposicion" id="nivelExposicion" class="form-control calculoNivelProbabilidad obligatorio" >
                                                        <option value="">::Seleccionar::</option>
                                                        <?php foreach ($exposicion as $e): ?>
                                                            <option <?php echo (!empty($riesgo->nivExp_id) && $e->nivExp_id == $riesgo->nivExp_id )?"selected ":"";?> value="<?php echo $e->nivExp_id ?>"><?php echo strtoupper($e->nivExp_nivel) . " (" . $e->nivExp_valor . ")" ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nivelProbabilidad" class="col-md-4">Nivel de Probabilidad</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="nivelProbabilidad" value="<?php echo (!empty($riesgo->nivPro_Nivel))?$riesgo->nivPro_Nivel:""; ?>" name="nivelProbabilidad" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nivelConsecuencia" class="col-md-4"><span>*</span>Nivel de consecuencia</label>
                                                <div class="col-md-8">
                                                    <select name="nivelConsecuencia" id="nivelConsecuencia" class="form-control calculoNivelProbabilidad obligatorio" >
                                                        <option value="">::Seleccionar::</option>
                                                        <?php foreach ($consecuencia as $c): ?>
                                                            <option <?php echo (!empty($riesgo->nivCon_id) && $e->nivCon_id == $riesgo->nivCon_id )?"selected ":"";?> value="<?php echo $c->nivCon_id ?>"><?php echo strtoupper($c->nivCon_nivel) . " (" . $c->nivCon_nc . ")" ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nivelRiesgo" class="col-md-4">Nivel de riesgo</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="nivelRiesgo" value="<?php echo (!empty($riesgo->nivRie_nivel))?$riesgo->nivRie_nivel:""; ?>" name="nivelRiesgo" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="observaciones" class="col-md-4">Observaciones</label>
                                                <div class="col-md-8">
                                                    <textarea name="observaciones" id="observaciones" class="form-control"><?php echo ((!empty($riesgo->rie_observaciones)) ? $riesgo->rie_observaciones : ""); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sx-6 col-sm-6 ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="actividades" class="col-md-3"><span class="campoobligatorio">*</span>Actividades</label>
                                                <div class="col-md-9">   
                                                    <textarea name="actividades" id="actividades" class="form-control obligatorio"><?php echo ((!empty($riesgo->rie_actividad)) ? $riesgo->rie_actividad : ""); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cargos" class="col-md-3">Cargos</label>
                                                <div class="col-md-9 "> 
                                                    <?php
                                                    $select = array();
                                                    if (!empty($rie_id))
                                                        foreach ($cargoId as $value) :
                                                            $select[] = $value->car_id;
                                                        endforeach;
                                                    echo listaMultiple2("cargo[]", "cargo", "form-control", "cargo", "car_id", "car_nombre", $select, array("cargo.est_id" => 1), null)
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fecha" class="col-md-3">Fecha</label>
                                                <div class="col-md-9"> 
                                                    <input type="text" name="fecha" id="fecha" class="form-control fecha" value="<?php echo ((!empty($riesgo->rie_fecha)) ? $riesgo->rie_fecha : date("Y-m-d")); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="rie_id" id="rie_id" value="<?php echo (!empty($rie_id)) ? $rie_id : ""; ?>" />
                            </form>
                        </div>
                        <?php if (!empty($rie_id)): ?>
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                    </div>
                                    <div class="tools">
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tabbable tabbable-tabdrop">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a data-toggle="tab" href="#tab1">Tareas</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#tab2">Tareas inactivas</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#tab3">Avance de tareas</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#tab5">Gráfica de Gantt</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#tab4">Registros</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="tab1" class="tab-pane active">
                                                <table class="tablesst" id="datatable_ajax">
                                                    <thead >
                                                    <th>Editar</th>
                                                    <th>Nuevo avance</th>
                                                    <th>Avance</th>
                                                    <th>Tipo</th>
                                                    <th>Nombre de la Tarea</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>Duración presupuestada (Horas)</th>
                                                    <th>Responsables</th>
                                                    </thead> 
                                                    <tbody>
                                                        <?php if (empty($tareas)) { ?>
                                                            <tr>
                                                                <td colspan="9">
                                                        <center>
                                                            <b>
                                                                No hay tareas asociadas al plan
                                                            </b>
                                                        </center>
                                                        </td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        $fecha_minima = '1000-12-26';
                                                        $fecha_maxima = '1000-12-26';
                                                        foreach ($tareas as $tar) {
                                                            $f = strtotime($tar->tar_fechaInicio);
                                                            $er = strtotime($fecha_minima);
                                                            if ($er < $f)
                                                                $fecha_minima = $tar->tar_fechaInicio;
                                                            $D = strtotime($tar->tar_fechaFinalizacion);
                                                            $H = strtotime($fecha_maxima);
                                                            echo $H . '***' . $D . '||';
                                                            if ($H < $D)
                                                                $fecha_maxima = $tar->tar_fechaFinalizacion;
                                                            ?>
                                                            <tr>
                                                                <td style="text-align: center"><i class='fa fa-pencil btn btn-default editartarea' tar_id='<?php echo $tar->tar_id ?>' ></i></td>
                                                                <td style="text-align: center"><i class='fa fa-bookmark-o btn btn-default nuevoavance' tar_id='<?php echo $tar->tar_id ?>' ></i></td>
                                                                <td><?php echo $tar->progreso ?></td>
                                                                <td><?php echo $tar->tip_tipo ?></td>
                                                                <td><?php echo $tar->tar_nombre ?></td>
                                                                <td><?php echo $tar->tar_fechaInicio ?></td>
                                                                <td><?php echo $tar->tar_fechaFinalizacion ?></td>
                                                                <td style="text-align:center"><?php echo $tar->diferencia ?></td>
                                                                <td><?php echo $tar->Emp_Nombre ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="tab2" class="tab-pane">
                                                <table class="tablesst" id="datatable_ajax2">
                                                    <thead>
                                                    <th>Nuevo Historial</th>
                                                    <th>Avance</th>
                                                    <th>Tipo</th>
                                                    <th>Nombre de la tarea</th>
                                                    <th>Fecha Inicio</th>
                                                    <th>Fecha Fin</th>
                                                    <th>Duración presupuestada</th>
                                                    <th>Responsables</th>
                                                    </thead>
                                                    <tbody >
                                                        <?php foreach ($tareasinactivas as $ti): ?>
                                                            <tr>
                                                                <td><i class='fa fa-pencil btn btn-default editartarea' tar_id='<?php echo $ti->tar_id ?>' ></i></td>
                                                                <td></td>
                                                                <td><?php echo $ti->tip_tipo ?></td>
                                                                <td><?php echo $ti->tar_nombre ?></td>
                                                                <td><?php echo $ti->tar_fechaInicio ?></td>
                                                                <td><?php echo $ti->tar_fechaFinalizacion ?></td>
                                                                <td><?php echo $ti->diferencia ?>&nbsp;Días</td>
                                                                <td><?php echo $ti->nombre ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="tab3" class="tab-pane">
                                                <table class="tablesst">
                                                    <thead>
                                                    <th>Acción</th>
                                                    <th>Fecha</th>
                                                    <th>Resumen</th>
                                                    <th>Usuario</th>
                                                    <th>Horas</th>
                                                    <th>Costo</th>
                                                    <th>Comentarios</th>
                                                    </thead>
                                                    <tbody class="datatable_ajax12">
                                                        <tr>
                                                            <td colspan="7"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>   
                                            </div>
                                            <div id="tab4" class="tab-pane">
                                                <div class="portlet box blue" style="margin-top: 30px;">
                                                    <div class="portlet-title">
                                                        <div class="caption">

                                                        </div>
                                                        <div class="tools">
                                                            <i class=" btn btn-default fa fa-folder-o carpeta" data-toggle="modal" data-target="#myModal4" ></i>

                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="tabbable tabbable-tabdrop">
                                                            <div class="tab-content">
                                                                <br>
                                                                <div class="panel-group accordion" id="accordion5">
                                                                    <?php
                                                                    $o = 1;
                                                                    foreach ($carpeta as $idcar => $nomcar):
                                                                        foreach ($nomcar as $nombrecar => $numcar):
                                                                            ?>
                                                                            <div class="panel panel-default" id="<?php echo $idcar ?>">
                                                                                <div class="panel-heading">
                                                                                    <h4 class="panel-title">
                                                                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_<?php echo $idcar . 'r'; ?>" aria-expanded="false" id=""> 
                                                                                            <i class="fa fa-folder-o carpeta"></i>&nbsp;<?php echo $nombrecar ?>
                                                                                        </a>
                                                                                        <div class="posicionIconoAcordeon">
                                                                                            <i class="fa fa-file-archive-o nuevoregistro"  data-toggle="modal" data-target="#myModal15" car_id="<?php echo $idcar ?>"></i>
                                                                                            <i class="fa fa-edit editarcarpeta" car_id="<?php echo $idcar ?>"></i>
                                                                                            <i class="fa fa-times eliminarcarpeta" tipo="r" title="Eliminar" car_id="<?php echo $idcar ?>"></i>
                                                                                        </div>
                                                                                    </h4>
                                                                                </div>
                                                                                <div id="collapse_<?php echo $idcar . 'r'; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                                    <div class="panel-body">
                                                                                        <table class="tablesst">
                                                                                            <thead>
                                                                                            <th>Nombre de archivo</th>
                                                                                            <th>Descripción</th>
                                                                                            <th>Versión</th>
                                                                                            <th>Responsable</th>
                                                                                            <th>Tamaño</th>
                                                                                            <th>Fecha</th>
                                                                                            <th>Acción</th>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <?php foreach ($numcar as $numerocar => $campocar): ?>
                                                                                                    <tr>
                                                                                                        <td><?php echo $campocar[0] ?></td>
                                                                                                        <td><?php echo $campocar[1] ?></td>
                                                                                                        <td><?php echo $campocar[2] ?></td>
                                                                                                        <td><?php echo $campocar[3] ?></td>
                                                                                                        <td><?php echo $campocar[4] ?></td>
                                                                                                        <td><?php echo $campocar[5] ?></td>
                                                                                                        <td>
                                                                                                            <i class="fa fa-times fa-2x eliminarregistro btn btn-danger" title="Eliminar" reg_id="<?php echo $campocar[6] ?>"></i>
                                                                                                            <i class="fa fa-pencil-square-o fa-2x modificarregistro btn btn-info" title="Modificar" reg_id="<?php echo $campocar[6] ?>" data-target="#myModal15" data-toggle="modal"></i>
                                                                                                        </td>
                                                                                                    </tr>   
                                                                                                <?php endforeach; ?>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            $o++;
                                                                        endforeach;
                                                                    endforeach;
                                                                    ?>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab5" class="tab-pane">
                                                <p><br></p>
                                                <?php if (!empty($tareas)) { ?>
                                                    <div id="grafica_granf">
                                                        <form id="formulario_grant">
                                                            <input type="text" id="fecha_maxima" name="fecha_maxima" value="<?php echo (isset($fecha_maxima) ? $fecha_maxima : '') ?>">
                                                            <input type="text" id="fecha_minima" name="fecha_minima" value="<?php echo (isset($fecha_minima) ? $fecha_minima : '') ?>">
                                                            <?php foreach ($tareas as $value) { ?>
                                                                <input type="text" id="tar_fechaInicio" name="tar_fechaInicio[]" value="<?php echo $value->tar_fechaInicio ?>">        
                                                                <input type="text" id="tar_nombre" name="tar_nombre[]" value="<?php echo $value->tar_nombre ?>">        
                                                                <input type="text" id="diferencia" name="diferencia[]" value="<?php echo $value->diferencia ?>">        
                                                                <input type="text" id="tar_fechaFinalizacion" name="tar_fechaFinalizacion[]" value="<?php echo $value->tar_fechaFinalizacion ?>">        
                                                                <input type="text" id="ultimafechacreacion" name="ultimafechacreacion[]" value="<?php echo $value->ultimafechacreacion ?>">        
                                                                <input type="text" id="tar_id" name="tar_id[]" value="<?php echo $value->tar_id ?>">        
                                                                <input type="text" id="progreso" name="progreso[]" value="<?php echo $value->progreso ?>">        
                                                            <?php } ?>                                        
                                                        </form>
                                                    </div>
                                                <?php } ?>                                        
                                            </div>
                                            <div id="tab6" class="tab-pane">
                                                <table class="tablesst">
                                                    <thead>
                                                    <th>Nombre archivo</th>
                                                    <th>Descripción</th>
                                                    <th>Versión</th>
                                                    <th>Responsable</th>
                                                    <th>Tamaño</th>
                                                    <th>Fecha</th>
                                                    <th>Accion</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <p>   </p>
                                    <p>   </p>
                                    <div class="tabbable tabbable-tabdrop">
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">NUEVA CARPETA</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" id="frmcarpetaregistro" class="form-horizontal">
                                                <input type="hidden" value="<?php echo (!empty($riesgo->rie_id)) ? $riesgo->rie_id : ""; ?>" name="rie_id" id="rie_id"/>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="nombrecarpeta" class="col-md-4">Nombre</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="nombrecarpeta" name="nombrecarpeta" class="form-control carbligatorio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="descripcioncarpeta" class="col-md-4">Descripción:</label>
                                                            <div class="col-md-8">
                                                                <input type="text" id="descripcioncarpeta" name="descripcioncarpeta" class="form-control carbligatorio">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer" id="opcionescarpeta">
                                            <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary" id="guardarcarpeta">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="myModal15" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">NUEVO REGISTRO</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" id="frmagregarregistro">
                                                <input type="hidden" value="<?php echo (!empty($riesgo->rie_id)) ? $riesgo->rie_id : ""; ?>" name="rie_id" id="rie_id"/>
                                                <input type="hidden" value="" name="reg_id" id="reg_id"/>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <label for="idactividad">Carpeta:</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                        <select id="carpeta" name="carpeta" class="form-control ">
                                                            <option value="">::Seleccionar::</option>
                                                            <?php foreach ($carpetas as $carp): ?>
                                                                <option value="<?php echo $carp->regCar_id ?>"><?php echo $carp->regCar_nombre . " " . $carp->regCar_descripcion ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <label for="version">Versión:</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                        <input type="text" id="version" name="version" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <label for="reg_descripcion">Descripción:</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                        <textarea id="reg_descripcion" name="reg_descripcion" class="form-control "></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <label for="archivo">Adjuntar archivo:</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                        <input type="file" id="archivo" name="archivo" class="form-control ">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary" id="btnguardarregistro">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('body').delegate(".calculoNivelProbabilidad", "change", function () {
        var deficiencia = $("#nivelDeficiencia").val();
        var exposicion = $("#nivelExposicion").val();
        if (deficiencia != "" && exposicion != "") {
            $.post(
                    url + "index.php/riesgo/nivelProbabilidad",
                    {
                        deficiencia: deficiencia,
                        exposicion: exposicion,
                        consecuencia: $("#nivelConsecuencia").val()
                    }
            )
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message)) {
                            alerta("rojo", msg['message'])
                            $('#nivelProbabilidad').val("");
                            $('#nivelRiesgo').val("");
                            $('#nivelRiesgo').css({
                                border: "1px black",
                                background: "whilte",
                                color: "black"
                            });
                        } else {
                            if (msg.Json[0].nivRie_nivel != undefined) {
                                $('#nivelRiesgo').val(msg.Json[0].nivRie_nivel + " - " + msg.Json[0].nivRie_tipo);
                                if (msg.Json[0].nivRie_nivel == 'I')
                                    $('#nivelRiesgo').css({
                                        border: "2px solid red",
                                        background: "red",
                                        color: "white"
                                    });
                                else if (msg.Json[0].nivRie_nivel == 'II')
                                    $('#nivelRiesgo').css({
                                        border: "2px solid yellow",
                                        background: "yellow",
                                        color: "black"
                                    });
                                else if (msg.Json[0].nivRie_nivel == 'III')
                                    $('#nivelRiesgo').css({
                                        border: "2px solid green",
                                        background: "green",
                                        color: "black"
                                    });
                                else if (msg.Json[0].nivRie_nivel == 'IV')
                                    $('#nivelRiesgo').css({
                                        border: "2px solid orange",
                                        background: "orange",
                                        color: "black"
                                    });
                            }
                            $('#nivelProbabilidad').val(msg.Json[0].nivPro_Nivel);
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error por favor comunicarse con el administrador del sistema");
                    });
        }
    });

    $('body').delegate(".editartarea", "click", function () {
        var tarea = $(this).attr("tar_id");
        var form = "<form method='post' id='frmFormAvance' action='" + url + "index.php/tareas/nuevatarea" + "'>";
        form += "<input type='hidden' name='tar_id' value='" + tarea + "'>";
        form += "<input type='hidden' name='rie_id' value='" + tarea + "'>";
        form += "</form>";
        $("body").append(form);
        $('#frmFormAvance').submit();
    });
    $('body').delegate(".nuevoavance", "click", function () {
        var tarea = $(this).attr("tar_id");
        var form = "<form method='post' id='frmFormAvance' action='" + url + "index.php/tareas/nuevatarea" + "'>";
        form += "<input type='hidden' name='tar_id' value='" + tarea + "'>";
        form += "<input type='hidden' name='nuevoavance' value='" + tarea + "'>";
        form += "</form>";
        $("body").append(form);
        $('#frmFormAvance').submit();
    });
    $('body').delegate(".eliminarcarpeta", "click", function () {
        if (confirm("Confirma la eliminación")) {
            var carpeta = $(this).attr("car_id");
            var tipo = $(this).attr("tipo");
            if ($(this).attr('tipo') == "r")
                var ruta = url + "index.php/planes/eliminarcarpeta";
            else if ($(this).attr('tipo') == "c")
                var ruta = url + "index.php/planes/eliminaractividad";
            $.post(ruta,
                    {carpeta: carpeta}
            ).done(function (msg) {
                $('a[href="#collapse_' + carpeta + tipo + '"]').parents('.panel-default').remove();
            }).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
            });
        }
    });
    $('body').delegate(".editarcarpeta", "click", function () {
        $.post(
                url + "index.php/planes/cargarplanescarpeta",
                {carpeta: $(this).attr("car_id")}
        )
                .done(function (msg) {
                    if ($('#plaCar_id').length == 0)
                        $('#frmcarpetaregistro').append("<input type='hidden' value='" + msg.regCar_id + "' name='plaCar_id' id='plaCar_id' >");
                    $('#nombrecarpeta').val(msg.regCar_nombre);
                    $('#descripcioncarpeta').val(msg.regCar_descripcion);
                    $('#guardarcarpeta').replaceWith("<button type='button' empCar_id='" + msg.regCar_id + "' class='btn btn-primary modificarcarpeta'>Actualizar</button>");
                    $('#myModal4').modal("show");
                })
                .fail(function (msg) {
                    alerta("rojo", "Error,por favor comunicarse con el administrador del sistema");
                });

    });
    $('body').delegate(".eliminarregistro", "click", function () {
        var reg_id = $(this).attr("reg_id");
        var registro = $(this);
        $.post(
                url + "index.php/planes/eliminarregistroplan",
                {reg_id: reg_id}
        ).done(function (msg) {
            registro.parents('tr').remove();
        }).fail(function (msg) {

        })
    });
    $('#guardarcarpeta').click(function () {
        if (obligatorio("carbligatorio")) {
            $.post(
                    url + "index.php/planes/guardarcarpetaregistroriesgo",
                    $('#frmcarpetaregistro').serialize()
                    ).done(function (msg) {
                var option = "<option value='" + msg.uno + "'>" + msg.dos + " - " + msg.tres + "</option>"
                var contenido = "<table class='tablesst'>\n\
                                        <thead>\n\
                                            <th>Nombre de archivo</th>\n\
                                            <th>Descripción</th>\n\
                                            <th>Versión</th>\n\
                                            <th>Responsable</th>\n\
                                            <th>Tamaño</th>\n\
                                            <th>Fecha</th>\n\
                                            <th>Acción</th>\n\
                                        </thead>\n\
                                        <tbody>\n\
                                            <tr>\n\
                                            <td colspan='6'>\n\
                                            <center><b>No hay registros asociados</b></center>\n\
                                            </td>\n\
                                            </tr>\n\
                                        </tbody>\n\
                                </table>";
                $('#carpeta').append(option);
                agregarregistro('accordion5', msg, contenido, 'r', 'editarcarpeta');
                $('.carbligatorio').val("");
                $('#myModal4').modal("toggle")
                alerta("verde", "Carpeta agregada con exito")
            }).fail(function (msg) {
                alerta("rojo", "ha ocurrido un error por favor cumunicarse con el administrador del sistema")
            });
        }
    });

    $('body').delegate(".modificarcarpeta", "click", function () {

        $.post(
                url + "index.php/planes/modificarpeta",
                $('#frmcarpetaregistro').serialize()
                ).done(function (msg) {
            $('a[href="#collapse_' + msg.regCar_id + 'r"]').text(msg.regCar_nombre + " - " + msg.regCar_descripcion);
            $('#myModal4').modal("toggle");
            alerta("verde", "Se actualizaron los datos correctamente");
        }).fail(function (msg) {
            alerta("rojo","Error comunicarse con el administrador");
        });
    });

    $('#btnguardarregistro').click(function () {
        var file_data = $('#archivo').prop('files')[0];
        var form_data = new FormData();
        form_data.append('archivo', file_data);
        form_data.append('rie_id', $('#rie_id').val());
        form_data.append('reg_id', $('#reg_id').val());
        form_data.append('regCar_id', $('#carpeta').val());
        form_data.append('reg_version', $('#version').val());
        form_data.append('reg_descripcion', $('#reg_descripcion').val());
        $.ajax({
            url: url + "index.php/planes/guardarregistroriesgo",
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (result) {

                $("#myModal15").modal("toggle");
                result = jQuery.parseJSON(result);
                var idcarpeta = $('#carpeta').val()
                $('#collapse_' + idcarpeta + 'r').find('table tbody *').remove();
                var filas = "";
                $.each(result, function (key, val) {
                    filas += "<tr>";
                    filas += "<td>" + '<a target="_black" href="<?php echo base_url() ?>' + val.reg_ruta + "/" + val.reg_id + '/' + val.reg_archivo + '">' + val.reg_archivo + "</a></td>";
                    filas += "<td>" + val.reg_descripcion + "</td>";
                    filas += "<td>" + val.reg_version + "</td>";
                    filas += "<td>" + val.usu_nombre + " " + val.usu_apellido + "</td>";
                    filas += "<td>" + val.reg_tamano + "</td>";
                    filas += "<td>" + val.reg_fechaCreacion + "</td>";
                    filas += "<td>";
                    filas += "<i class='fa fa-times fa-2x eliminarregistro btn btn-danger' title='Eliminar' reg_id='" + val.reg_id + "'></i>";
                    filas += "<i class='fa fa-pencil-square-o fa-2x modificarregistro btn btn-info' title='Modificar' reg_id='" + val.reg_id + "'  data-target='#myModal15' data-toggle='modal'></i>";
                    filas += "</td>";
                    filas += "</tr>";
                });
                $('#collapse_' + idcarpeta + 'r').find('table tbody').append(filas)
                $('#carpeta').val('');
                $('#version').val('');
                $('#reg_descripcion').val('');
                $('#archivo').val('');
                alerta('verde', 'Registro guardado con exito.');
            }
        });
    });

    $('body').delegate(".nuevoregistro,.modificarregistro", "click", function () {
        $('#reg_id').val("");
        $('#carpeta').val("");
        $('#version').val("");
        $('#reg_descripcion').val("");
        $("#archivoadescargar").remove();
        $('#carpeta').val($(this).attr('car_id'));
    });

    $('body').delegate('.modificarregistro', 'click', function () {
        var reg_id = $(this).attr('reg_id');
        $.post(
                url + "index.php/planes/modificarregistro",
                {registro: $(this).attr('reg_id')}
        ).done(function (msg) {
            $('#reg_id').val(reg_id);
            $('#carpeta').val(msg.regCar_id);
            $('#version').val(msg.reg_version);
            $('#reg_descripcion').val(msg.reg_descripcion);
            var fila = "<div class='row' id='archivoadescargar' >\n\
                                    <label style='color:black' class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>\n\
                                        ARCHIVO\n\
                                    </label>\n\
                                    <div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>\n\
                                        <a target='_blank' href='" + "<?php echo base_url() ?>" + msg.reg_ruta + "'>" + msg.reg_archivo + "</a>\n\
                                    </div>\n\
                                </div>"
            $('#frmagregarregistro').append(fila);
        }).fail(function (msg) {
            alerta("rojo","Error comunicarse con el administrador");
        });
    });
    function agregarregistro(tabla, msg, contenido, destino, clase) {
        var acordeon = '<div class="panel panel-default" id="' + msg.uno + '">\n\
                                            <div class="panel-heading">\n\
                                                <h4 class="panel-title">\n\
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_' + msg.uno + destino + '" aria-expanded="false">\n\
                                                        <i class="fa fa-folder-o carpeta"></i> ' + msg.dos + " - " + msg.tres + '\n\
                                                    </a>\n\
                                                    <div class="posicionIconoAcordeon">';
        if (destino == 'c')
            acordeon += '<i class="fa fa-file-o carpeta nuevo_hijo" data-toggle="modal" data-target="#myModal8" title="ACTIVIDAD HIJO" car_id="' + msg.uno + '"></i> ';
        if (destino == 'r')
            acordeon += '<i class="fa fa-file-archive-o nuevoregistro"   data-toggle="modal" data-target="#myModal15" car_id="' + msg.uno + '"></i> ';

        acordeon += '<i class="fa fa-edit ' + clase + '" car_id="' + msg.uno + '"></i>\n\
                                                        <i class="fa fa-times eliminarcarpeta" title="Eliminar" tipo="' + destino + '" car_id="' + msg.uno + '"></i>\n\
                                                    </div>\n\
                                                </h4>\n\
                                            </div>\n\
                                            <div id="collapse_' + msg.uno + destino + '" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">\n\
                                                <div class="panel-body">\n\
                                                    ' + contenido + '\n\
                                                </div>\n\
                                            </div>\n\
                                    </div>';
        $('#' + tabla).append(acordeon);
    }

    $('document').ready(function () {
        $('body').delegate(".editarhistorial", "click", function () {
            var form = "<form method='post' id='frmFormAvance' action='" + url + "index.php/tareas/nuevatarea" + "'>";
            form += "<input type='hidden' name='avaTar_id' value='" + $(this).attr("avaTar_id") + "'>"
            form += "<input type='hidden' name='tar_id' value='" + $(this).attr("tar_id") + "'>"
            form += "</form>";
            $("body").append(form);
            $('#frmFormAvance').submit();
        })
        $('body').delegate(".eliminaravance", "click", function () {
            var puntero = $(this);
            $.post(
                    url + "index.php/tareas/eliminaravance",
                    {avaTar_id: $(this).attr("avaTar_id")}
            ).done(function (msg) {
                puntero.parents("tr").remove();
                alerta("verde", "Avance eliminado correctamente");
            }).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador del sistema")
            });
        });
        tabla();
        function tabla() {
            $.post(
                    url + "index.php/riesgo/listadoavance2",
                    {clasificacionriesgo: $('#categoria').val()})
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta("rojo", msg['message'])
                        else {
                            $('.datatable_ajax12').html('');
                            var html = "";
                            var totalhoras = 0;
                            var costo = 0;
                            $.each(msg, function (key, val) {
                                totalhoras += parseInt(val.avaTar_horasTrabajadas);
                                costo += parseInt(val.avaTar_costo);
                                html += "<tr>"
                                        + "<td>"
                                        + "<a href='javascript:' class='editarhistorial fa fa-pencil-square-o fa-2x btn btn-info' avaTar_id='" + val.avaTar_id + "' tar_id='" + val.tar_id + "' ></a>"
                                        + "<i class='fa fa-times btn btn-danger eliminaravance'  avaTar_id='" + val.avaTar_id + "'></i></td>"
                                        + "<td>" + val.avaTar_fecha + "</td>"
                                        + "<td>" + val.tar_nombre + "</td>"
                                        + "<td>" + val.nombre + "</td>"
                                        + "<td>" + val.avaTar_horasTrabajadas + "</td>"
                                        + "<td>" + val.avaTar_costo + "</td>"
                                        + "<td>" + val.avaTar_comentarios + "</td>"
                                        + "</tr>";
                            });
                            html += "<tr>\n\
                                        <td colspan='4' style='text-align:right;'><b>Total</b></td>\n\
                                        <td>" + totalhoras + "</td>\n\
                                        <td>" + costo + "</td>\n\
                                        <td></td>\n\
                                        </tr>"
                            $('.datatable_ajax12').html(html);
                        }
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error, comunicarse con el administrador del sistema")
                    })
        }
        $('#categoria').change(function () {

            $.post(
                    url + "index.php/riesgo/consultatiporiesgo",
                    {categoria: $(this).val()}
            ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("amarillo", msg['message'])
                else {
                    $('#tipo *').remove();
                    var option = "<option value=''>::Seleccionar::</option>"
                    $.each(msg.Json, function (key, val) {
                        option += "<option value='" + val.rieClaTip_id + "'>" + val.rieClaTip_tipo + "</option>";
                    })
                    $('#tipo').append(option);
                }
            }).fail(function (msg) {
                alerta("rojo", "Error en el sistema por favor comunicarse con el administrador del sistema");
            });

        });
    });


    $("body").on("click", "#guardar", function () {
        if (obligatorio("obligatorio")) {
            $.post(
                    url + "index.php/riesgo/guardarriesgo"
                    , $("#riesgos").serialize()
                    ).done(function (msg) {

                alerta("verde", "Guardado");
                if (confirm("Desea guardar otro riesgo?")) {
                    $("#riesgos").find("input").val("");
                    $("#riesgos").find("textarea").val("");
                    $("#riesgos").find("select").val("");
                    $("#riesgos").find("#tipo").html("<option>::Seleccionar::</option>");
                } else {
                    var form = "<form method='post' id='frmEditarPlan'>";
                    form += "<input type='hidden' value='" + msg + "' name='rie_id'>";
                    form += "</form>";
                    $('body').append(form);
                    $('#frmEditarPlan').submit();
                }
            })
                    .fail(function (msg) {
                        alerta("rojo", "Error en el sistema por favor comunicarse con el administrador del aplicativo");
                    });
        }
    });
    $("body").on("click", "#actualizar", function () {
        if (obligatorio("obligatorio")) {
            $.post(
                    url + "index.php/riesgo/actualizarriesgo"
                    , $("#riesgos").serialize()
                    ).done(function (msg) {
                alerta("verde", "Actualizado");
            })
                    .fail(function (msg) {
                        alerta("rojo", "Error en el sistema por favor comunicarse con el administrador del aplicativo");
                    });
        }
    });
    $.post('<?php echo base_url("grant/index.php") ?>', $('#formulario_grant').serialize())
            .done(function (msg) {
                var imagen = '<img src="<?php echo base_url("grant") ?>/imagenprueba.jpg">';
                $('#grafica_granf').html(imagen)
            })
            .fail(function () {
                alerta("rojo","Error comunicarse con el administrador");
            });
</script>
