<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="<?php echo (empty($ind_id)) ? "guardar" : "actualizar"; ?>" title="<?php echo (empty($ind_id)) ? "Guardar" : "Actualizar"; ?>"><i class="fa fa-floppy-o fa-3x"></i></div>
        <!--<div class="circuloIcon" ><i class="fa fa-trash-o fa-3x"></i></div> /* ELIMINAR */  -->
        <a href="<?php echo base_url() . "/index.php/indicador/nuevoindicador" ?>"><div class="circuloIcon" title="Nuevo Indicador" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
    <div class="col-md-6">
        <div id="posicionFlecha">
            <div class="envio flechaHeader IzquierdaDoble" metodo="flechaIzquierdaDoble" nuevo="<?php echo (isset($todo_izq) ? $todo_izq : '') ?>"><i class="fa fa-step-backward fa-2x"></i></div>
            <div class="envio flechaHeader Izquierda" metodo="flechaIzquierda" nuevo="<?php echo (isset($izq) ? $izq : '') ?>"><i class="fa fa-arrow-left fa-2x"></i></div>
            <div class="envio flechaHeader Derecha" metodo="flechaDerecha" nuevo="<?php echo (isset($derecha) ? $derecha : '') ?>"><i class="fa fa-arrow-right fa-2x"></i></div>
            <div class="envio flechaHeader DerechaDoble" metodo="flechaDerechaDoble" nuevo="<?php echo (isset($max_der) ? $max_der : '') ?>"><i class="fa fa-step-forward fa-2x"></i></div>
            <a href="<?php echo base_url('index.php/indicador/verindicadores') ?>"><div class="flechaHeader Archivo" metodo="documento"><i class="fa fa-sticky-note fa-2x"></i></div></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">NUEVO INDICADOR</span>
        </div>
    </div>
</div>
<div class="cuerpoContenido">
    <div class="row">
        <form method="post" id="indicador">
            <div class="col-lg-6 col-md-6 col-sx-6 col-sm-6 ">
                <div class="row">
                    <label for="nombreindicador" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <span class="campoobligatorio">*</span>Indicador
                    </label>
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">    
                        <input type="text" name="indicador" id="nombreindicador" class="form-control obligatorio" value="<?php echo (isset($indicador->ind_indicador)) ? $indicador->ind_indicador : "" ?>">
                    </div>
                </div>
                <div class="row">
                    <label for="tipo" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        Tipo
                    </label>
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">       
                        <select name="tipo" id="tipo" class="form-control" >
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($indicadortipo as $t) { ?>
                                <option <?php echo (isset($indicador->indTip_id) && ($t->indTip_id == $indicador->indTip_id)) ? "Selected" : ""; ?> value="<?php echo $t->indTip_id ?>"><?php echo $t->indTip_tipo ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="mide" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <span class="campoobligatorio">*</span>Que Mide
                    </label>   
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <textarea name="mide" id="mide" class="form-control obligatorio"><?php echo (isset($indicador->ind_mide)) ? $indicador->ind_mide : "" ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <label for="dimensionuno" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <?php echo $empresa[0]->Dim_id ?>
                    </label>  
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 "> 
                        <select name="dimensionuno" id="dimensionuno" class="form-control" >
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($dimension as $d1) { ?>
                                <option <?php echo (isset($indicador->dim_id) && ($d1->dim_id == $indicador->dim_id)) ? "Selected" : ""; ?> value="<?php echo $d1->dim_id ?>"><?php echo $d1->dim_descripcion ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                </div>
                <div class="row">
                    <label for="dimensiondos" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <?php echo $empresa[0]->Dimdos_id ?>
                    </label>  
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <select  name="dimensiondos" id="dimensiondos" class="form-control" >
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($dimension2 as $d2) { ?>
                                <option <?php echo (isset($indicador->dimdos_id) && ($d2->dim_id == $indicador->dimdos_id)) ? "Selected" : ""; ?> value="<?php echo $d2->dim_id ?>"><?php echo $d2->dim_descripcion ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">    
                    <label for="frecuencia" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <span class="campoobligatorio">*</span>Frecuencia
                    </label>   
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <input type="text" name="frecuencia" id="frecuencia" class="form-control obligatorio" value="<?php echo (isset($indicador->ind_frecuencia)) ? $indicador->ind_frecuencia : "" ?>">
                    </div>
                </div>
                <div class="row">    
                    <label for="cargo" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <span class="campoobligatorio">*</span>Cargo
                    </label>   
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <select name="cargo" id="cargo" class="form-control obligatorio">
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($cargo as $c) { ?>
                                <option <?php echo (isset($indicador->car_id) && ($c->car_id == $indicador->car_id)) ? "Selected" : ""; ?> value="<?php echo $c->car_id ?>"><?php echo $c->car_nombre ?></option> 
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row"> 
                    <label for="nombreempleado" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <span class="campoobligatorio">*</span>Empleado
                    </label>   
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <select name="nombreempleado" id="nombreempleado" class="form-control obligatorio">
                            <option value="">::Seleccionar::</option>
                            <?php
                            if (!empty($ind_id)):
                                foreach ($empleado as $em):
                                    ?>
                                    <option <?php echo (isset($indicador->emp_id) && ($em->Emp_Id == $indicador->emp_id)) ? "Selected" : ""; ?> value="<?php echo $em->Emp_Id ?>"><?php echo $em->Emp_Nombre . " " . $em->Emp_Apellidos ?></option>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">    
                    <label for="minimo" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        Valor mínimo
                    </label>
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <input type="text" name="minimo" id="minimo" class="form-control" value="<?php echo (isset($indicador->ind_minimo)) ? $indicador->ind_minimo : "" ?>">
                    </div>
                </div>
                <div class="row">    
                    <label for="maximo" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        Valor máximo
                    </label> 
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <input type="text" name="maximo" id="maximo" class="form-control" value="<?php echo (isset($indicador->ind_maximo)) ? $indicador->ind_maximo : "" ?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sx-6 col-sm-6 ">
                <div class="row">
                    <label for="estado" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <span class="campoobligatorio">*</span>Estado
                    </label> 
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <select name="estado" id="estado" class="form-control obligatorio" >
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($estados as $e) { ?>
                                <option <?php echo ((isset($indicador->est_id) && ($e->est_id == $indicador->est_id)) || (empty($indicador->est_id) && $e->est_id == 1)) ? "Selected" : ""; ?> value="<?php echo $e->est_id ?>"><?php echo $e->est_nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="fecha" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <span class="campoobligatorio">*</span>Fecha
                    </label> 
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <input type="text" name="fecha" id="fecha" value="<?php echo (isset($indicador->ind_fecha)) ? $indicador->ind_fecha : date("Y-m-d") ?>" class="form-control fecha" />
                    </div>
                </div>
                <div class="row">
                    <label for="objetivo" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        <span class="campoobligatorio">*</span>Objetivo
                    </label>
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <textarea id="objetivo" name="objetivo" class="form-control obligatorio"><?php echo (isset($indicador->ind_objetivo)) ? $indicador->ind_objetivo : "" ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <label for="observaciones" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        Observaciones
                    </label>
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <textarea id="observaciones" name="observaciones" class="form-control"><?php echo (isset($indicador->ind_observaciones)) ? $indicador->ind_observaciones : "" ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <label for="meta" class="col-lg-4 col-md-4 col-sx-4 col-sm-4 ">
                        Meta
                    </label>
                    <div class="col-lg-8 col-md-8 col-sx-8 col-sm-8 ">   
                        <input type="text" class="form-control number" id="meta" name="meta" value="<?php echo (isset($indicador->ind_meta)) ? $indicador->ind_meta : "" ?>">
                    </div>
                </div>
            </div>
            <input type="hidden" id="ind_id" name="ind_id" value="<?php echo (!empty($ind_id)) ? $ind_id : ""; ?>" />
        </form>
    </div>
    <?php if (!empty($ind_id)): ?>
        <div class="portlet box blue">
            <div class="portlet-body">
                <div class="tabbable tabbable-tabdrop">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab1">Valores</a></li>
                        <li><a data-toggle="tab" href="#tab2">Registrar valores</a></li>
                        <li id="graficar"><a data-toggle="tab" href="#tab3">Gráfica</a></li>
                        <li><a data-toggle="tab" href="#tab4">Registros</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                            <table class="tablesst">
                                <thead>
                                <th>Fecha</th>
                                <th>Unidad</th>
                                <th>Comentario</th>
                                <th>Valor</th>
                                <th>Usuario</th>
                                <th>Acción</th>
                                </thead>
                                <tbody id="bodyvalores">
                                    <?php
                                    $fechas = "";
                                    $valores2 = "";
                                    $valores3 = "";
                                    $contador = count($valores);
                                    $e = 0;
                                    foreach ($valores as $v):
                                        $e++;
                                        $valores3.=$indicador->ind_meta . ',';
                                        if ($contador == $e) {
                                            $fechas.='"' . $v->indVal_fecha . '"';
                                            $valores2.=$v->indVal_valor;
                                        } else {
                                            $fechas.='"' . $v->indVal_fecha . '",';
                                            $valores2.=$v->indVal_valor . ',';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $v->indVal_fecha ?></td>
                                            <td><?php echo $v->indVal_unidad ?></td>
                                            <td><?php echo $v->indVal_comentario ?></td>
                                            <td><?php echo $v->indVal_valor ?></td>
                                            <td><?php echo $v->usu_nombre . " " . $v->usu_apellido ?></td>
                                            <td>
                                                <a href="javascript:"><i class="fa fa-pencil-square-o fa-2x modificar_indicador_valores" id="<?php echo $v->indVal_id ?>" title="Modificar" ></i></a>
                                                <a href="javascript:"><i class="fa fa-trash-o fa-2x eliminar" id="<?php echo $v->indVal_id ?>" title="Eliminar"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="tab2" class="tab-pane">
                            <div class="col-lg-12 col-md-12 col-sx-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sx-12 col-sm-12"><p><br></p></div>
                                </div>
                                <form method="post" id="frmvalores">
                                    <input type="hidden" class="ind_id_ind_id" id="ind_id" name="ind_id" value="<?php echo (!empty($ind_id)) ? $ind_id : ""; ?>" />
                                    <div class="col-lg-6 col-md-6 col-sx-6 col-sm-6">
                                        <div class="row">
                                            <label for="valor" class="col-lg-3 col-md-3 col-sx-3 col-sm-3">
                                                Valor
                                            </label>
                                            <div class="col-lg-9 col-md-9 col-sx-9 col-sm-9">
                                                <input type="text" name="valor" id="valor" class="form-control miles valorobligatorio">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="valor" class="col-lg-3 col-md-3 col-sx-3 col-sm-3">
                                                Unidad
                                            </label>
                                            <div class="col-lg-9 col-md-9 col-sx-9 col-sm-9">
                                                <input type="text" name="unidad" id="unidad" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="usuario" class="col-lg-3 col-md-3 col-sx-3 col-sm-3">
                                                Fecha
                                            </label>
                                            <div class="col-lg-9 col-md-9 col-sx-9 col-sm-9">
                                                <input type="text" name="fecha" value="<?= date("Y-m-d"); ?>" id="fecha" class="form-control fecha valorobligatorio fecha_formulario">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sx-6 col-sm-6">
                                        <label for="comentarios">Comentarios</label>
                                        <textarea name="comentarios" id="comentarios" class="form-control"></textarea>
                                    </div>
                                    <input type="hidden" class="form-control" name="indVal_id" id="indVal_id">
                                </form>   
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sx-12 col-sm-12" style="text-align: center">
                                    <br>

                                    <button type="button" class="btn btn-success" id="guardarindicador">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div id="tab3" class="tab-pane">
                            <canvas id="chart-area4" style="width: 100% !important;height: 100% !important;"></canvas>
                        </div>
                        <div id="tab4" class="tab-pane">
                            <div class="portlet box blue" style="margin-top: 30px;">
                                <div class="portlet-title">
                                    <div class="caption">
                                    </div>
                                    <div class="tools">                                        
                                        <i class=" btn btn-default fa fa-folder-o carpeta" data-toggle="modal" data-target="#modalCarpeta" ></i>
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
                                                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_<?php echo $idcar; ?>" aria-expanded="false" id=""> 
                                                                        <i class="fa fa-folder-o carpeta"></i>&nbsp;<?php echo $nombrecar ?>
                                                                    </a>
                                                                    <div class="posicionIconoAcordeon">
                                                                        <i class="fa fa-file-archive-o nuevoregistro" car_id="<?php echo $idcar ?>" data-toggle="modal" data-target="#myModal"></i>
                                                                        <i class="fa fa-edit editarcarpeta" car_id="<?php echo $idcar ?>"></i>
                                                                        <i class="fa fa-times eliminarcarpeta" car_id="<?php echo $idcar ?>"></i>
                                                                    </div>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse_<?php echo $idcar; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="panel-body">
                                                                    <table class="table table-hover table-bordered">
                                                                        <thead style="background-color: blue">
                                                                        <th>Nombre de archivo</th>
                                                                        <th>Descripción</th>
                                                                        <th>Versión</th>
                                                                        <th>Responsable</th>
                                                                        <th>Tamaño</th>
                                                                        <th>Fecha</th>
                                                                        <th>Editar</th>
                                                                        <th>Eliminar</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($numcar as $numerocar => $campocar): ?>
                                                                                <tr>
                                                                                    <td><a href="<?= base_url($campocar[3]) ?>" target="_blank" ><?php echo $campocar[4] ?></a></td>
                                                                                    <td><?php echo $campocar[2] ?></td>
                                                                                    <td><?php echo $campocar[1] ?></td>
                                                                                    <td><?php echo $campocar[6] ?></td>
                                                                                    <td><?php echo $campocar[5] ?></td>
                                                                                    <td><?php echo $campocar[5] ?></td>
                                                                                    <td style='text-align:center'>
                                                                                        <i class="fa fa-pencil-square-o fa-2x modificarregistro" title="Modificar" reg_id="<?php echo $campocar[7] ?>" ></i>
                                                                                    </td>
                                                                                    <td style='text-align:center'>
                                                                                        <i class="fa fa-trash-o fa-2x eliminarregistro" title="Eliminar" reg_id="<?php echo $campocar[7] ?>"></i>
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
                    </div>
                </div>
                <div class="tabbable tabbable-tabdrop">
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Carpeta -->
        <div class="modal fade" id="modalCarpeta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">NUEVA CARPETA</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="frmcarpetaregistro">
                            <input type="hidden" id="ind_id" name="ind_id" value="<?php echo (!empty($ind_id)) ? $ind_id : ""; ?>" />
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <label for="nombrecarpeta">Nombre</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <input type="text" id="nombrecarpeta" name="nombrecarpeta" class="form-control carbligatorio">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <label for="descripcioncarpeta">Descripción:</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <input type="text" id="descripcioncarpeta" name="descripcioncarpeta" class="form-control carbligatorio">
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
        <!-- Registro -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">REGISTROS</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="formactividadpadre">
                            <input type="hidden" id="ind_id" name="ind_id" value="<?php echo (!empty($ind_id)) ? $ind_id : ""; ?>" />
                            <input type="hidden" id="reg_id" name="reg_id" value="" />
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <label for="carpeta">Carpeta:</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <select id="carpeta" name="carpeta" class="form-control tarRegObligatorio">
                                        <option value="">::Seleccionar::</option>
                                        <?php foreach ($registrocarpeta as $carp): ?>
                                            <option value="<?php echo $carp->regCar_id ?>"><?php echo $carp->regCar_nombre . ' - ' . $carp->regCar_descripcion ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <label for="version">Versión:</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <input type="text" id="version" name="tarReg_version" class="form-control tarRegObligatorio">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <label for="descripcion">Descripción:</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <textarea id="descripcion" name="tarReg_descripcion" class="form-control tarRegObligatorio"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <label for="nombreactividad">Adjuntar Archivo:</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <input type="file" id="nombreactividad" name="archivo" class="form-control tarRegObligatorio">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" id="guardarregistro">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<style>
    canvas{
        width: 100% !important;
    }
</style>
<script type="text/javascript" src="<?php echo base_url('js/graficas/Chart.min.js') ?>"></script>
<script>

    $('body').delegate(".editarcarpeta", "click", function () {
        $.post(
                "<?php echo base_url("index.php/planes/cargarplanescarpeta") ?>",
                {carpeta: $(this).attr("car_id")}
        )
                .done(function (msg) {
                    if ($('#plaCar_id').length == 0)
                        $('#frmcarpetaregistro').append("<input type='hidden' value='" + msg.regCar_id + "' name='plaCar_id' id='plaCar_id' >");
                    $('#nombrecarpeta').val(msg.regCar_nombre);
                    $('#descripcioncarpeta').val(msg.regCar_descripcion);
                    $('#guardarcarpeta').replaceWith("<button type='button' empCar_id='" + msg.regCar_id + "' class='btn btn-primary modificarcarpeta'>Actualizar</button>");
                    $('#modalCarpeta').modal("show");
                })
                .fail(function (msg) {
                    alerta("rojo", "Error,por favor comunicarse con el administrador del sistema");
                });

    });

    $('body').delegate(".eliminarregistro", "click", function () {
        var reg_id = $(this).attr("reg_id");
        var registro = $(this);
        $.post(
                "<?php echo base_url("index.php/planes/eliminarregistroplan") ?>",
                {reg_id: reg_id}
        ).done(function (msg) {
            registro.parents('tr').remove();
        }).fail(function (msg) {

        })
    });
    $('body').delegate(".eliminar", "click", function () {
        var indVal_valor = $(this).attr("id");
        $.post(
                "<?php echo base_url("index.php/indicador/eliminar_indicador_valores") ?>",
                {indVal_valor: indVal_valor, ind_id: $('#ind_id').val()}
        ).done(function (msg) {
            tabla(msg);
        }).fail(function (msg) {

        })
    });
    $('body').delegate(".modificar_indicador_valores", "click", function () {
        var indVal_valor = $(this).attr("id");
        $.post(
                "<?php echo base_url("index.php/indicador/modificar_indicador_valores") ?>",
                {indVal_valor: indVal_valor, ind_id: $('#ind_id').val()}
        ).done(function (msg) {
            $('a[href="#tab2"]').trigger('click')
            $('#comentarios').val(msg[0].indVal_comentario);
            $('#indVal_id').val(msg[0].indVal_id);
            $('#valor').val(msg[0].indVal_valor);
            $('#unidad').val(msg[0].indVal_unidad);
//            alert(msg[0].indVal_fecha)
            $('.fecha_formulario').val(msg[0].indVal_fecha);

        }).fail(function (msg) {

        })
    });
    $('a[href="#tab2"]').click(function () {
        $('#indVal_id').val('');
        $('#frmvalores input').val('');
        $('#frmvalores textarea').val('');
        $('.ind_id_ind_id').val($('#ind_id').val());
        $('.fecha_formulario').val('<?= date("Y-m-d"); ?>');
    })

    $('body').delegate(".carpeta", "click", function () {

        $('#eliminaractividad').remove();
        $('#actPad_id').remove();
        $('#nombrecarpeta').val("");
        $('#descripcioncarpeta').val("");
        $('.modificaractividad').replaceWith('<button class="btn btn-primary" id="guardaractividadpadre" type="button">Guardar</button>');

    });

    $('body').delegate(".eliminarcarpeta", "click", function () {
        if (confirm("Confirma la eliminación")) {
            var carpeta = $(this).attr("car_id");
            var url = "<?php echo base_url("index.php/planes/eliminarcarpeta") ?>";
            $.post(url, {carpeta: carpeta}
            ).done(function (msg) {
                $('a[href="#collapse_' + carpeta + '"]').parents('.panel-default').remove();
            }).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
            });
        }
    });
    $('body').delegate(".modificarcarpeta", "click", function () {

        $.post("<?php echo base_url("index.php/planes/modificarpeta") ?>",
                $('#frmcarpetaregistro').serialize()
                ).done(function (msg) {
            $('a[href="#collapse_' + msg.regCar_id + '"]').text(msg.regCar_nombre + " - " + msg.regCar_descripcion);
            $('#carpeta option[value="' + msg.regCar_id + '"]').replaceWith("<option value='" + msg.regCar_id + "'>" + msg.regCar_nombre + " - " + msg.regCar_descripcion + "</option>");
            $('#modalCarpeta').modal("hide");
            alerta("verde", "Se actualizaron los datos correctamente");
        }).fail(function (msg) {

        });
    });
    $('#valor').change(function () {
        if ((parseInt($(this).val()) >= parseInt($('#minimo').val())) && (parseInt($(this).val()) <= parseInt($('#maximo').val()))) {
            return true;
        } else {
            $(this).val('');
            alert("El valor no esta en el rango establecido");
            $(this).focus();
        }
    });


    $('#guardarregistro').click(function () {
        if (obligatorio("tarRegObligatorio")) {
            //Capturamos el archivo
            var file_data = $('#nombreactividad').prop('files')[0];
            //Creamos formularios archivo
            var form_data = new FormData();
            //Agremamos Datos a enviar (Archivo)
            form_data.append('archivo', file_data);
            form_data.append('regCar_id', $('#carpeta').val());
            form_data.append('reg_version', $('#version').val());
            form_data.append('ind_id', $('#ind_id').val());
            form_data.append('reg_descripcion', $('#descripcion').val());
            form_data.append('reg_id', $('#reg_id').val());
            $.ajax({
                url: '<?php echo base_url("index.php/tareas/guardarregistroindicador") ?>',
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (result) {
                    $('#myModal').modal('hide')
                    result = jQuery.parseJSON(result);
                    var idcarpeta = $('#carpeta').val()
                    $('#collapse_' + idcarpeta).find('table tbody *').remove();
                    var filas = "";
                    $.each(result, function (key, val) {
                        filas += "<tr>";
                        filas += "<td><a target'_black' href='<?php echo base_url(); ?>" + val.reg_ruta + val.reg_id + "/" + val.reg_archivo + "'>" + val.reg_archivo + "</a></td>";
                        filas += "<td>" + val.reg_descripcion + "</td>";
                        filas += "<td>" + val.reg_version + "</td>";
                        filas += "<td>" + val.usu_nombre + " " + val.usu_apellido + "</td>";
                        filas += "<td>" + val.reg_tamano + "</td>";
                        filas += "<td>" + val.reg_fechaCreacion + "</td>";
                        filas += "<td style='text-align:center'>";
                        filas += "<i class='fa fa-pencil-square-o fa-2x modificarregistro' title='Modificar' reg_id='" + val.reg_id + "' ></i>";
                        filas += "</td>";
                        filas += "<td style='text-align:center'>";
                        filas += "<i class='fa fa-trash-o fa-2x eliminarregistro' title='Eliminar' reg_id='" + val.reg_id + "'></i>";
                        filas += "</td>";
                        filas += "</tr>";
                    });
                    $('#collapse_' + idcarpeta).find('table tbody').append(filas)
                    $('#carpeta,#version,#reg_descripcion,#archivo').val('');
                    alerta('verde', 'Registro guardado con exito.');
                }
            });
        }
    })

//    $(".flechaHeader").click(function () {
//        var url = "<?php echo base_url("index.php/administrativo/consultausuariosflechas") ?>";
//        var idUsuarioCreado = $("#usuid").val();
//        var metodo = $(this).attr("metodo");
//        if (metodo != "documento") {
//            $.post(url, {idUsuarioCreado: idUsuarioCreado, metodo: metodo})
//                    .done(function (msg) {
//                        $("input[type='text'],select").val("");
//                        $("#usuid").val(msg.usu_id);
//                        $("#cedula").val(msg.usu_cedula);
//                        $("#nombres").val(msg.usu_nombre);
//                        $("#apellidos").val(msg.usu_apellido);
//                        $("#usuario").val(msg.usu_usuario);
//                        $("#contrasena").val(msg.usu_contrasena);
//                        $("#email").val(msg.usu_email);
//                        $("#genero").val(msg.sex_id);
//                        $("#estado").val(msg.est_id);//estado
//                        $("#cargo").val(msg.car_id);//cargo
//                        $("#empleado").val(msg.emp_id);//empleado
//                        if (msg.cambiocontrasena == "1") {
//                            $("#cambiocontrasena").is(":checked");
//                        }
//                    })
//                    .fail(function (msg) {
//                        alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
//                        $("input[type='text'], select").val();
//                    })
//        } else {
//            window.location = "<?php echo base_url("index.php/indicador/verindicadores"); ?>";
//        }
//
//    });
    $("body").on("click", "#actualizar", function () {
        if (obligatorio("obligatorio")) {
            $.post("<?php echo base_url("index.php/indicador/actualizarindicador") ?>", $("#indicador").serialize())
                    .done(function (msg) {
                        alerta("verde", "Actualizado");
                    })
                    .fail(function (msg) {
                        alerta("rojo", "Error al actualizar.");
                    });
        }

    });
    $("body").on("click", "#guardar", function () {
        if (obligatorio("obligatorio")) {
            $.post("<?php echo base_url("index.php/indicador/guardarindicador") ?>", $("#indicador").serialize())
                    .done(function (msg) {
                        alerta("verde", "Guardado con exito");
                        if (confirm("Desea guardar otro indicador?")) {
                            $("#indicador").find("input,textarea,select").val("");
                            $("#indicador").find("#nombreempleado").html("<option>::Seleccionar::</option>");
                        } else {
                            var form = "<form method='post' id='frmindicador'>";
                            form += "<input type='hidden' value='" + msg + "' name='ind_id'>";
                            form += "</form>";
                            $('body').append(form);
                            $('#frmindicador').submit();
                        }
                    }).fail(function (msg) {
                        alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
                    });
        }

    });
    $('#cargo').change(function () {
        $.post(
                "<?php echo base_url("index.php/administrativo/consultausuarioscargo") ?>",
                {
                    cargo: $(this).val()
                }
        ).done(function (msg) {
            var data = "";
            $('#nombreempleado *').remove();
            data += "<option>::Seleccionar::</option>";
            $.each(msg, function (key, val) {
                data += "<option value='" + val.Emp_Id + "'>" + val.Emp_Nombre + " " + val.Emp_Apellidos + "</option>"
            });
            $('#nombreempleado').append(data);
        }).fail(function (msg) {

        })
    });

    $('#guardarindicador').click(function () {
        if (obligatorio('valorobligatorio')) {
            $.post(
                    "<?php echo base_url("index.php/indicador/guardarvalores") ?>",
                    $('#frmvalores').serialize()
                    ).done(function (msg) {
                tabla(msg);
            }).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador del sistema")
            });
        }
    });
    function tabla(msg) {
        $("#graficar,#tab3").siblings().removeClass("active");
        $("#graficar").attr("class", "active")
        $("#tab3").attr("class", "tab-pane active")
        $("#graficar").trigger("click");
        $("#bodyvalores *").remove();
        var body = ''
        var label = [];
        var valores = [];
        var valores2 = [];
        $.each(msg[0], function (key, val) {
            label.push(val.indVal_fecha);
            valores.push(parseInt(val.indVal_valor));
            valores2.push(parseInt($('#meta').val()));
            body += "<tr>";
            body += "<td>" + val.indVal_fecha + "</td>";
            body += "<td>" + val.indVal_unidad + "</td>";
            body += "<td>" + val.indVal_comentario + "</td>";
            body += "<td>" + val.indVal_valor + "</td>";
            body += "<td>" + val.usu_nombre + " " + val.usu_apellido + "</td>";
            body += "<td>";
            body += '<a href="javascript:">\n\
                <i class="fa fa-pencil-square-o fa-2x modificar_indicador_valores" id="' + val.indVal_id + '" title="Modificar" ></i></a>\n\
                <a href="javascript:"><i class="fa fa-trash-o fa-2x eliminar" id="' + val.indVal_id + '" title="Eliminar"></i></a>';
            body += "</td>";
            body += "</tr>";
        });
        $("#bodyvalores").append(body);
        grafi(label, valores, valores2);
        $('#frmvalores').find('input[type="text"]').val('');
        $('#frmvalores').find('textarea').val('');
        alerta("verde", "Guardado correctamente");
    }

    $('body').delegate('.nuevoregistro', 'click', function () {
        $('#carpeta,#version,#descripcion,#nombreactividad').val('');
        $('#carpeta').val($(this).attr('car_id'));
        $('#reg_id').val('');
    });
    $('body').delegate('.modificarregistro', 'click', function () {
        var registro = $(this).attr('reg_id');
        $.post(
                "<?php echo base_url("index.php/planes/modificarregistro") ?>",
                {registro: registro}
        ).done(function (msg) {
            $('#reg_id').val(registro);
            $('#carpeta').val(msg.regCar_id);
            $('#version').val(msg.reg_version);
            $('#descripcion').val(msg.reg_descripcion);
            var fila = "<div class='row' id='archivoadescargar' >\n\
                                    <label style='color:black' class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>\n\
                                        ARCHIVO\n\
                                    </label>\n\
                                    <div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>\n\
                                        <a target='_blank' href='" + "<?php echo base_url() ?>" + msg.reg_ruta +registro+"/"+ msg.reg_archivo+ "'>" + msg.reg_archivo + "</a>\n\
                                    </div>\n\
                                </div>"
            $('#archivoadescargar').remove();
            $('#formactividadpadre').append(fila);
            $('#myModal').modal('show')
        }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sistema");
        });
    });
    $('body').delegate("#guardarcarpeta", "click", function () {
        if (obligatorio("carbligatorio")) {
            $.post("<?php echo base_url("index.php/indicador/guardarcarpetatarea") ?>",
                    $('#frmcarpetaregistro').serialize()
                    ).done(function (msg) {
                var option = "<option value='" + msg.regCar_id + "'>" + msg.regCar_nombre + " - " + msg.regCar_descripcion + "</option>"
                $('#carpeta').append(option);
                var acordeon = '<div class="panel panel-default" id="' + msg.indCar_id + '">\n\
                                            <div class="panel-heading">\n\
                                                <h4 class="panel-title">\n\
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_' + msg.regCar_id + '" aria-expanded="false">\n\
                                                        <i class="fa fa-folder-o carpeta"></i> ' + msg.regCar_nombre + " - " + msg.regCar_descripcion + '\n\
                                                    </a>\n\
                                                    <div class="posicionIconoAcordeon">\n\
                                                        <i class="fa fa-file-archive-o nuevoregistro" car_id="' + msg.regCar_id + '" data-toggle="modal" data-target="#myModal"></i>\n\
                                                        <i class="fa fa-edit" car_id="' + msg.regCar_id + '"></i>\n\
                                                        <i class="fa fa-times eliminarcarpeta" car_id="' + msg.regCar_id + '"></i>\n\
                                                    </div>\n\
                                                </h4>\n\
                                            </div>\n\
                                            <div id="collapse_' + msg.regCar_id + '" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">\n\
                                                <div class="panel-body">\n\
                                                    <table class="table table-hover table-bordered">\n\
                                                        <thead>\n\
                                                            <th>Nombre de archivo</th>\n\
                                                            <th>Descripción</th>\n\
                                                            <th>Versión</th>\n\
                                                            <th>Responsable</th>\n\
                                                            <th>Tamaño</th>\n\
                                                            <th>Fecha</th>\n\
                                                            <th>Editar</th>\n\
                                                            <th>Eliminar</th>\n\
                                                        </thead>\n\
                                                        <tbody>\n\
                                                            <tr>\n\
                                                            <td colspan="8">\n\
                                                            <center><b>No hay registros asociados</b></center>\n\
                                                            </td>\n\
                                                            </tr>\n\
                                                        </tbody>\n\
                                                </table>\n\
                                                </div>\n\
                                            </div>\n\
                                    </div>';
                $('#accordion5').append(acordeon);
                $('.carbligatorio').val("");
                $('#modalCarpeta').modal("hide");
                alerta("verde", "Carpeta agregada con exito");
            }).fail(function (msg) {
                alerta("rojo", "ha ocurrido un error por favor cumunicarse con el administrador del sistema");
            });
        }
    });

    function grafi(label, valor, valor2) {
        var lineChartData = {
            labels: label,
            datasets: [
                {
                    label: "Primera serie de datos",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "#6b9dfa",
                    pointColor: "#1e45d7",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: valor
                },
                {
                    label: "Primera serie de datos",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "red",
                    pointColor: "red",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(225,225,225,1)",
                    data: valor2
                }
            ]

        }
        var ctx4 = document.getElementById("chart-area4").getContext("2d");
        window.myPie = new Chart(ctx4).Line(lineChartData, {responsive: true});
    }

<?php if (!empty($fechas) && !empty($valores2)) { ?>
        grafi([<?php echo $fechas; ?>], [<?php echo $valores2; ?>], [<?php echo $valores3; ?>]);
<?php } ?>

    $('.envio').click(function () {
        $('#pla_id_3').val($(this).attr('nuevo'));
        $('#formulario_siguiente').submit();
    })
</script>
<style>
    .tab-content{
        color: #000;
    }
</style>
<form id="formulario_siguiente" action="<?php echo base_url('index.php/indicador/nuevoindicador') ?>" method="POST">
    <input type="hidden" id="pla_id_3" name="ind_id">
</form>