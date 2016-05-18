<style>
    .mayuscula{  
        text-transform: uppercase;  
    }  
</style>    
<div class="row">
    <div class="row">
        <div class="col-md-6">
            <br>
            <div class="circuloIcon" id="guardarplan" title="<?php echo (empty($plan[0]->pla_id)) ? "Guardar" : "Actualizar"; ?>"><i class="fa fa-floppy-o fa-3x"></i></div>
            <a href="<?php echo base_url() . "/index.php/planes/nuevoplan" ?>"><div class="circuloIcon" title="Nuevo Plan" ><i class="fa fa-folder-open fa-3x"></i></div></a>
            <br>
        </div>
        <div class="col-md-6">
            <br>
            <div id="posicionFlecha">
                <a href="<?php echo base_url('index.php/Planes/listadoplanes') ?>"><div class="flechaHeader Archivo" metodo="documento"><i class="fa fa-sticky-note fa-2x"></i></div></a>
            </div>
            <br>
        </div>
    </div>
    <div class="col-md-12">
        <div class="portlet box green">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog fa-2x"></i>PLANES
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>  
            <div class="portlet-body form">
                <div class="portlet box blue">
                    <div class="portlet-body">
                        <div class="tabbable tabbable-tabdrop">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab0">Plan</a>
                                </li>
                                <?php if (!empty($plan[0]->pla_id)): ?>
                                    <li>
                                        <a data-toggle="tab" href="#tab1">Tareas</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab2">Tareas Inactivas</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab3">Avance tareas</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab4">Actividades</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab5">Gráfica de Gantt</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab6">Registros</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <div class="tab-content">
                                <div id="tab0" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <?php if (!empty($plan[0]->pla_id)) { ?>
                                                <form method="post" id="frmdireccionar">
                                                    <input type="hidden" value="<?php echo $plan[0]->pla_id ?>" name="pla_id">
                                                    <input type="hidden" name="fecha_inicio_plan" value="<?php echo (!empty($plan[0]->pla_fechaInicio) ) ? $plan[0]->pla_fechaInicio : ""; ?>"/>
                                                </form>
                                                <button type="button" class="btn btn-default direccionar" num="1">
                                                    Nueva tarea
                                                </button>
                                                <button  type="button" class="btn btn-default direccionar" num="2">
                                                    Nuevo registro
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <form method="post" id="f7" class="form-horizontal">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="nombre" class="col-md-4"> <span class="campoobligatorio">*</span>Nombre</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="nombre" id="nombre" class="form-control obligatorio mayuscula" value="<?php echo (!empty($plan[0]->pla_nombre) ) ? $plan[0]->pla_nombre : ""; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fechainicio" class="col-md-4"><span class="campoobligatorio">*</span>Fecha Inicio</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="fechainicio" id="fechainicio" class="form-control fecha obligatorio"  value="<?php echo (!empty($plan[0]->pla_fechaInicio) ) ? $plan[0]->pla_fechaInicio : ""; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fechafin" class="col-md-4">Fecha Fin</label>
                                                        <div class="col-md-8">
                                                            <input type="text" readonly="readonly" name="fechafin" id="fechafin" class="form-control"  value="<?php echo (!empty($tareafechafinal[0]->fechafinalizacion) ) ? $tareafechafinal[0]->fechafinalizacion : ""; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-info">
                                                                <center>Responsable</center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cargo" class="col-md-4">Cargo</label>
                                                        <div class="col-md-8">
                                                            <select name="cargo" id="cargo" class="form-control" >
                                                                <option value="">::Seleccionar::</option>
                                                                <?php foreach ($cargo as $c) { ?>
                                                                    <option <?php echo (!empty($plan[0]->car_id) && $c->car_id == $plan[0]->car_id) ? "selected" : ""; ?> value="<?php echo $c->car_id ?>"><?php echo strtoupper($c->car_nombre) ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="empleado" class="col-md-4">Empleado</label>
                                                        <div class="col-md-8">
                                                            <select name="empleado" id="empleado" class="form-control">
                                                                <option value="">::seleccionar::</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="presupuesto" class="col-md-4">Presupuesto</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="presupuesto" id="presupuesto" class="form-control miles number presupuesto"  value="<?php echo (!empty($plan[0]->tar_costopresupuestado) ) ? $plan[0]->tar_costopresupuestado : ""; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="costoreal" class="col-md-4">Costo Real</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="costoreal" id="costorealplan" class="form-control costoreal" readonly="readonly" value="<?php echo (!empty($plan[0]->avaTar_costo) ) ? $plan[0]->avaTar_costo : ""; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="norma" class="col-md-4">Normatividad</label>
                                                        <div class="col-md-8">
                                                            <select name="norma[]" id="norma" class="form-control " multiple>
                                                                <?php foreach ($norma as $n): ?>
                                                                    <option <?php echo (!empty($plan[0]->pla_id) ? (in_array($n->nor_id, $norma_planes) ? "selected" : '') : '' ); ?> value="<?php echo $n->nor_id ?>"><?php echo strtoupper($n->nor_norma) ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="estado" class="col-md-4"><span class="campoobligatorio">*</span>Estado</label>
                                                    <div class="col-md-8">
                                                        <select name="estado" id="estado" class="form-control obligatorio">
                                                            <option value="">::Seleccionar::</option>
                                                            <?php foreach ($estado as $e) { ?>
                                                                <option <?php echo (!empty($plan[0]->est_id) && $e->est_id == $plan[0]->est_id) ? "selected" : ""; ?> value="<?php echo $e->est_id ?>"><?php echo strtoupper($e->est_nombre) ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="descripcion" class="col-md-4">Descripción</label>
                                                    <div class="col-md-8">
                                                        <textarea name="descripcion" id="descripcion" class="form-control mayuscula" style=" height: 116px;"> <?php echo (!empty($plan[0]->pla_descripcion) ) ? $plan[0]->pla_descripcion : ""; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="avanceprogramado" class="col-md-4">Avance programado</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="avanceprogramado" id="avanceprogramado" class="form-control"  value="<?php echo (!empty($plan[0]->pla_avanceProgramado) ) ? $plan[0]->pla_avanceProgramado : ""; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="avancereal" class="col-md-4">Avance real</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="avancereal" id="avancereal" class="form-control"  value="<?php echo (!empty($plan[0]->pla_avanceReal) ) ? $plan[0]->pla_avanceReal : ""; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <input type="hidden" value="<?php echo (!empty($plan[0]->pla_id)) ? $plan[0]->pla_id : ""; ?>" name="pla_id" id="pla_id">
                                </form>    
                                <hr>
                            </div>
                            <?php if (!empty($plan[0]->pla_id)): ?>
                                <div id="tab1" class="tab-pane">
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
                                            foreach ($tareas as $tar) {
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
                                                    <td><?php echo $ti->Emp_Nombre . " " . $ti->Emp_Apellidos ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tab3" class="tab-pane">
                                    <table class="tablesst">
                                        <thead>
                                        <th>Fecha</th>
                                        <th>Resumen</th>
                                        <th>Usuario</th>
                                        <th>Horas</th>
                                        <th>Costo</th>
                                        <th>Comentarios</th>
                                        <th>Acción</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $horas = 0;
                                            $costo = 0;
                                            foreach ($avances as $av):
                                                $horas += $av->avaTar_horasTrabajadas;
                                                $costo += str_replace(",", "", str_replace(".", "", $av->avaTar_costo));
                                                ?>
                                                <tr>
                                                    <td><?php echo $av->avaTar_fecha ?></td>
                                                    <td><?php echo $av->tar_nombre ?></td>
                                                    <td><?php echo $av->nombre ?></td>
                                                    <td><?php echo $av->avaTar_horasTrabajadas ?></td>
                                                    <td><?php echo $av->avaTar_costo ?></td>
                                                    <td><?php echo $av->avaTar_comentarios ?></td>
                                                    <td>
                                                        <i class="fa fa-times eliminaravance btn btn-danger" title="Eliminar" avaTar_id="<?php echo $av->avaTar_id ?>"></i>
                                                        <i class='fa fa-pencil btn btn-default editarhistorial' avance="<?php echo $av->avaTar_id ?>" tar_id='<?php echo $av->tar_id ?>'></i>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="color:black">
                                                <td colspan="3" align="right"><b>Total</b></td>
                                                <td><?php echo $horas ?></td>
                                                <td id="costo"><?php echo $costo ?></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>   
                                </div>
                                <div id="tab4" class="tab-pane">
                                    <div class="portlet box blue" style="margin-top: 30px;">
                                        <div class="portlet-title">
                                            <div class="caption">
                                            </div>
                                            <div class="tools">
                                                <i class="fa fa-clipboard carpeta btn btn-default crear_padre" data-toggle="modal" data-target="#myModal" title='ACTIVIDAD PADRE'></i>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="panel-group accordion" id="accordion1">
                                                <?php
                                                $i = 1;
                                                foreach ($actividades as $id => $nom):
                                                    foreach ($nom as $nombre => $num):
                                                        ?>
                                                        <div class="panel panel-default" id="<?php echo $id ?>">
                                                            <div class="panel-heading">
                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        <h4 class="panel-title">
                                                                            <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_<?php echo $id . 'c'; ?>" aria-expanded="false"> 
                                                                                <i class="fa fa-folder-o carpeta"></i>&nbsp;<?php echo $nombre ?>
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <h4 class="panel-title">
                                                                            <div class="posicionIconoActividad">
                                                                                <i class="fa fa-file-o carpeta nuevo_hijo" car_id="<?php echo $id ?>" data-toggle="modal" data-target="#myModal8" title='ACTIVIDAD HIJO'></i>
                                                                                <i class="fa fa-edit editaractividad" car_id="<?php echo $id ?>"></i>
                                                                                <i class="fa fa-times eliminarcarpeta" tipo="c" title="Eliminar" car_id="<?php echo $id ?>"></i>
                                                                            </div>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="collapse_<?php echo $id . 'c'; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                <div class="panel-body">
                                                                    <table class="tablesst">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Nombre</th>
                                                                                <th>Fecha inicio</th>
                                                                                <th>Fecha fin</th>
                                                                                <th>Presupuesto</th>
                                                                                <th>Descripción</th>
                                                                                <th>Acción</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($num as $numero => $campo): ?>
                                                                                <tr>
                                                                                    <td><?php echo $campo[4] ?></td>
                                                                                    <td><?php echo $campo[6] ?></td>
                                                                                    <td><?php echo $campo[7] ?></td>
                                                                                    <td><?php echo $campo[2] ?></td>
                                                                                    <td><?php echo $campo[3] ?></td>
                                                                                    <td>
                                                                                        <i class="fa fa-times eliminar btn btn-danger" actHij_id="<?php echo $campo[5] ?>" title="Eliminar"></i>
                                                                                        <i class="fa fa-pencil-square-o modificar btn btn-info" data-target="#myModal8" data-toggle="modal" actHij_id="<?php echo $campo[5] ?>" title="Modificar"></i>
                                                                                    </td>
                                                                                </tr>   
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>

                                                                    <?php
                                                                    foreach ($num as $numero => $campo):
                                                                        ?>

                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $i++;
                                                    endforeach;
                                                endforeach;
                                                ?>
                                            </div> 
                                        </div> 
                                    </div> 
                                </div>
                                <div id="tab5" class="tab-pane">
                                    <div class="table-responsive">
                                        <div id="grafica_granf">
                                            <form id="formulario_grant">
                                                <input type="text" id="fecha_maxima" name="fecha_maxima" value="<?php echo (isset($plan_grant[0][0]->fecha_maxima) ? $plan_grant[0][0]->fecha_maxima : '') ?>">
                                                <input type="text" id="fecha_minima" name="fecha_minima" value="<?php echo (isset($plan_grant[0][0]->fecha_minima) ? $plan_grant[0][0]->fecha_minima : '') ?>">
                                                <?php foreach ($plan_grant[1] as $value) { ?>
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
                                    </div>
                                </div>
                                <div id="tab6" class="tab-pane">
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
                                                                            <i class="fa fa-file-archive-o nuevoregistro"  data-toggle="modal" data-target="#myModal15" car_id="<?php echo $idcar ?>"></i>
                                                                            <i class="fa fa-edit editarcarpeta" car_id="<?php echo $idcar ?>"></i>
                                                                            <i class="fa fa-times eliminarcarpeta" tipo="r" title="Eliminar" car_id="<?php echo $idcar ?>"></i>
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
                                                                                            <td><a target='_black' href='<?php echo base_url() . $campocar[7] . "/" . $campocar[6] . "/" . $campocar[0] ?>'><?php echo $campocar[0] ?></a></td>
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($plan[0]->pla_id)): ?>
            <div class="portlet box blue">
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">ACTIVIDAD</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="formactividadpadre">
                                    <input type="hidden" value="<?php echo (!empty($plan[0]->pla_id)) ? $plan[0]->pla_id : ""; ?>" name="pla_id" id="pla_id"/>
                                    <input type="hidden" value="" name="actPad_id" id="actPad_id"/>
                                    <div class="row">
                                        <label for="idactividad" class="col-md-2">Código:</label>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <input type="text" id="idactividad" name="idactividad" class="form-control acobligatorio">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="nombreactividad" class="col-md-2">Nombre:</label>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <input type="text" id="nombreactividad" name="nombreactividad" class="form-control acobligatorio">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer" id="editaractividadpadre">
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardaractividadpadre">Guardar</button>
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
                                <form method="post" id="frmagregarregistro" class="form-horizontal">
                                    <input type="hidden" value="<?php echo (!empty($plan[0]->pla_id)) ? $plan[0]->pla_id : ""; ?>" name="pla_id" id="pla_id"/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <label for="idactividad">Carpeta:</label>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                    <select id="carpeta" name="carpeta" class="form-control obligatorioRegistro">
                                                        <option value="">::Seleccionar::</option>
                                                        <?php foreach ($carpetas as $carp): ?>
                                                            <option value="<?php echo $carp->regCar_id ?>"><?php echo $carp->regCar_nombre ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="version" class="col-md-2">Versión:</label>

                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                    <input type="text" id="version" name="version" class="form-control obligatorioRegistro">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="reg_descripcion" class="col-md-2">Descripción:</label>

                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                    <textarea id="reg_descripcion" name="reg_descripcion" class="form-control obligatorioRegistro"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="archivo" class="col-md-2">Adjuntar archivo:</label>
                                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                                    <input type="file" id="archivo" name="archivo" class="form-control obligatorioRegistro">
                                                </div>
                                            </div>
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
                <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">NUEVA CARPETA</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="frmcarpetaregistro" class="form-horizontal">
                                    <input type="hidden" value="<?php echo (!empty($plan[0]->pla_id)) ? $plan[0]->pla_id : ""; ?>" name="pla_id" id="pla_id"/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nombrecarpeta" class="col-md-2" for="nombrecarpeta">Nombre</label>
                                                <div class="col-md-10">
                                                    <input type="text" id="nombrecarpeta" name="nombrecarpeta" class="form-control carbligatorio">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcioncarpeta" class="col-md-2" for="descripcioncarpeta">Descripción:</label>
                                                <div class="col-md-10">
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
                <div class="modal fade" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">ACTIVIDAD HIJO</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <form method="post" id="f6">
                                        <input type="hidden" value="<?php echo $plan[0]->pla_id; ?>" name="pla_id">
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><label for="idpadre">Id Padre</label></div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <select id="idpadre" name="idpadre" class="form-control idpadre2 actividadobligatoria">
                                                <option value="">::Seleccionar::</option>
                                                <?php foreach ($actividadpadre as $ap): ?>
                                                    <option value="<?php echo $ap->actPad_id ?>"><?php echo $ap->actPad_codigo . " - " . $ap->actPad_nombre ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"><label for="nombre">Nombre</label></div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><input type="text" id="nombre" name="nombre" class="form-control nombre2 actividadobligatoria"></div>
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="fechainicio">Fecha Inicio</label>
                                                    <input type="text" class="form-control fecha fechainicio2" id="fechainicio" disabled="disabled"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="fechafinalizacion">Fecha Finalización</label>
                                                    <input type="text" class="form-control fecha" id="fechafinalizacion" disabled="disabled"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="peso">Peso</label>
                                                    <input type="text" class="form-control" id="peso" name="peso" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="riesgosancion">Valor Sanción</label>
                                                    <input type="text" class="form-control number miles" id="riesgosancion" name="riesgosancion" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="tipo">Tipo</label>
                                                    <select class="form-control" id="tipo" name="tipo" >
                                                        <option value="">::Seleccionar::</option>
                                                        <?php foreach ($tipo as $t) { ?>
                                                            <option value="<?php echo $t->tip_id; ?>"><?php echo $t->tip_tipo; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="presupuestototal">Presupuesto Total</label>
                                                    <input type="text" class="form-control number miles" id="presupuestototal" name="presupuestototal" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="costoreal">Costo Real</label>
                                                    <input type="text" class="form-control number costoreal2" id="costoreal" readonly="readonly" name="costoreal" />
                                                    <input type="hidden" name="actHij_id" id="actHij_id" class="form-control" readonly="readonly" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="descripcion">Descripción</label>
                                                <textarea class="form-control descripcion2" id="descripcion" name="descripcion"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="modoverificacion">Modo Verificación</label>
                                                <textarea class="form-control" id="modoverificacion" name="modoverificacion"></textarea>
                                            </div>
                                        </div>
                                </div>
                                </form>  
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>
<script>

    $(".fecha").datepicker("option", "maxDate", "+0m +0d");

    $('document').ready(function () {
        costo = $('#costo').text();
        costoreal = $('#costorealplan').val();
        $('#costo').text(num_miles(costo.replace(",", "").replace(".", "")));
        $('#costorealplan').val(num_miles(costoreal.replace(",", "").replace(".", "")));
        $('.presupuesto').val(num_miles($('.presupuesto').val()));
    });

    $('body').delegate(".editartarea", "click", function () {
        var form = "<form method='post' id='frmFormAvance' action='" + url + "index.php/tareas/nuevatarea" + "'>";
        form += "<input type='hidden' name='tar_id' value='" + $(this).attr("tar_id") + "'>"
        form += "</form>";
        $("body").append(form);
        $('#frmFormAvance').submit();
    });
    $('body').delegate(".nuevoavance", "click", function () {
        var form = "<form method='post' id='frmFormAvance' action='" + url + "index.php/tareas/nuevatarea" + "'>";
        form += "<input type='hidden' name='tar_id' value='" + $(this).attr("tar_id") + "'>"
        form += "<input type='hidden' name='nuevoavance' value='" + $(this).attr("tar_id") + "'>"
        form += "</form>";
        $("body").append(form);
        $('#frmFormAvance').submit();
    });

    $('body').delegate(".editarhistorial", "click", function () {

        var form = "<form method='post' id='frmFormAvance' action='" + url + "index.php/tareas/nuevatarea" + "'>";
        form += "<input type='hidden' name='avaTar_id' value='" + $(this).attr("avance") + "'>"
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

    $('body').delegate(".carpeta", "click", function () {
        var pla_id = $('#pla_id').val();
        var car_id = $(this).attr('car_id');
        $("#idpadre *").remove();
        $.post(
                url + "index.php/planes/detailxplaid"
                , {pla_id: pla_id}
        ).done(function (msg) {
            var option = "<option value=''>::Seleccionar::</option>";
            $.each(msg, function (key, val) {
                option += "<option " + ((car_id == val.actPad_id) ? "selected" : "") + " value='" + val.actPad_id + "'>" + val.actPad_codigo + " - " + val.actPad_nombre + "</option>"
            });
            $("#idpadre").append(option);
        }).fail(function (msg) {
            alerta("rojo", "Error, favor comunicarse con el administrador del sistema");
        });

        $('#eliminaractividad').remove();
        $('#actPad_id').remove();
        $('#nombrecarpeta,#descripcioncarpeta').val("");
        $('.modificaractividad').replaceWith('<button class="btn btn-primary" id="guardaractividadpadre" type="button">Guardar</button>');

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

    $('body').delegate(".editaractividad", "click", function () {
        $.post(
                url + "index.php/planes/datosactividad",
                {carpeta: $(this).attr("car_id")}
        )
                .done(function (msg) {
                    $('#actividadpadreid').remove();
                    $('#formactividadpadre').append("<input type='hidden' value='" + msg.actPad_id + "' name='actividadpadre' id='actividadpadreid' >");
                    $('#eliminaractividad').remove()
                    $('#editaractividadpadre').append("<button type='button' id='eliminaractividad' class='btn btn-danger' actPad_id='" + msg.actPad_id + "'>Eliminar</button>");
                    $('#idactividad').val(msg.actPad_nombre);
                    $('#nombreactividad').val(msg.actPad_codigo);
                    $('#guardaractividadpadre').replaceWith("<button type='button' empCar_id='" + msg.actPad_id + "' class='btn btn-primary modificaractividad'>Actualizar</button>");
                    $('#myModal').modal("show");
                })
                .fail(function (msg) {
                    alerta("rojo", "Error,por favor comunicarse con el administrador del sistema");
                });
    });
    $('body').delegate(".modificaractividad", "click", function () {

        $.post(
                url + "index.php/planes/modificaractividad",
                $('#formactividadpadre').serialize()
                ).done(function (msg) {
            $('a[href="#collapse_' + msg.actPad_id + 'c"]').html("<i class='fa fa-folder-o carpeta'></i>&nbsp; " + msg.actPad_codigo + " - " + msg.actPad_nombre);
            $('#myModal').modal("toggle");
            alerta("verde", "Se actualizaron los datos correctamente");
        }).fail(function (msg) {

        });
    });
    $('body').delegate(".modificarcarpeta", "click", function () {
        if (obligatorio("carbligatorio")) {
            $.post(
                    url + "index.php/planes/modificarpeta",
                    $('#frmcarpetaregistro').serialize()
                    ).done(function (msg) {
                $('a[href="#collapse_' + msg.Json.regCar_id + 'r"]').html("<i class='fa fa-folder-o carpeta'></i> " + msg.Json.regCar_nombre + " - " + msg.Json.regCar_descripcion);
                $('#myModal4').modal("toggle");
                alerta("verde", "Se actualizaron los datos correctamente");
            }).fail(function (msg) {
                alerta("rojo", "Error comunicarse con el administrador")
            });
        }
    });

    $('body').delegate(".nuevoregistro,.modificarregistro", "click", function () {
        $('#carpeta,#version,#reg_descripcion').val("");
        $("#archivoadescargar").remove();
        $('#carpeta').val($(this).attr('car_id'));
    });

    $('body').delegate('.modificarregistro', 'click', function () {
        $.post(
                url + "index.php/planes/modificarregistro",
                {registro: $(this).attr('reg_id')}
        ).done(function (msg) {
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

        })
                ;
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

    $('body').delegate('.accordion-toggle', "click", function () {

        if ($(this).attr('aria-expanded') == "true") {
            $(this).children('.carpeta').removeClass('fa fa-folder-open-o');
            $(this).children('.carpeta').addClass('fa fa-folder-o');
        } else {
            $(this).children('.carpeta').removeClass('fa fa-folder-o');
            $(this).children('.carpeta').addClass('fa fa-folder-open-o');
        }
    });

    $('#guardarcarpeta').click(function () {
        if (obligatorio("carbligatorio")) {
            $.post(
                    url + "index.php/planes/guardarcarpetaregistro",
                    $('#frmcarpetaregistro').serialize()
                    ).done(function (msg) {
                var option = "<option value='" + msg.uno + "'>" + msg.dos + "</option>"
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
                                            <td colspan='7'>\n\
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
    $('.direccionar').click(function () {
        var archivo = ($(this).attr('num') == 1) ? "nuevatarea" : "registro";
        $('#frmdireccionar').attr("action", url + "index.php/tareas/" + archivo);
        $('#frmdireccionar').submit();
    });
    $('body').delegate(".editarhistorial", "click", function () {
        $('#internotarea').val($(this).attr('tar_id'));
    });

    $('#guardar').click(function () {
        if (obligatorio('actividadobligatoria')) {
            $.post(
                    url + "index.php/planes/guardaractividadhijo",
                    $('#f6').serialize()
                    ).done(function (msg) {
                var body = "";
                var id = "";
                $.each(msg, function (key, val) {
                    id = val.actHij_padreid;
                    body += "<tr>";
                    body += "<td>" + ((val.actHij_nombre != null) ? val.actHij_nombre : "") + "</td>";
                    body += "<td>" + ((val.actHij_fechaInicio != null) ? val.actHij_fechaInicio : "") + "</td>";
                    body += "<td>" + ((val.actHij_fechaFinalizacion != null) ? val.actHij_fechaFinalizacion : "") + "</td>";
                    body += "<td>" + ((val.actHij_presupuestoTotal != null) ? val.actHij_presupuestoTotal : "") + "</td>";
                    body += "<td>" + ((val.actHij_descripcion != null) ? val.actHij_descripcion : "") + "</td>";
                    body += "<td>" +
                            '<i class="fa fa-times eliminar btn btn-danger" title="Eliminar" acthij_id="' + val.actHij_id + '"></i><i class="fa fa-pencil-square-o modificar btn btn-info" title="Modificar" acthij_id="' + val.actHij_id + '" data-toggle="modal" data-target="#myModal8"></i>'
                            + "</td>";
                    body += "</tr>";
                });
                $('#' + id).find('table tbody *').remove();
                $('#' + id).find('table tbody').append(body);
                $('#myModal8').modal("toggle")
                $('#myModal8').find('input[type="text"],select,textarea').val("");
                alerta("verde", "Datos guardados correctamente");
            }).fail(function (msg) {
                alerta("rojo", "Error en el sistema por favor verificar la conexion de internet");
            });
        }
    });

    $('body').delegate("#guardaractividadpadre", "click", function () {

        numero = $('#accordion1').last('div').attr("id");
        if (obligatorio('acobligatorio')) {

            $.post(
                    url + "index.php/planes/guardaractividadpadre",
                    $('#formactividadpadre').serialize()
                    )
                    .done(function (msg) {
                        $('.acobligatorio').val('');
                        var option = "<option value='" + msg.uno + "'>" + msg.dos + " - " + msg.tres + "</option>";
                        $('#idpadre').append(option);
                        var contenido = '<table class="tablesst">\n\
                                                        <thead>\n\
                                                            <th>Nombre</th>\n\
                                                            <th>Fecha inicio</th>\n\
                                                            <th>Fecha fin</th>\n\
                                                            <th>Presupuesto</th>\n\
                                                            <th>Descripción</th>\n\
                                                            <th>Acción</th>\n\
                                                        </thead> \n\
                                                        <tbody>\n\
                                                            <tr>\n\
                                                                <td colspan="5">\n\
                                                                    <center><b>Agregar Actividad Hijo</b></center>\n\
                                                                </td>\n\
                                                            </tr>\n\
                                                        </tbody>\n\
                                                    </table>';

                        agregarregistro('accordion1', msg, contenido, 'c', 'editaractividad');
                        $('#myModal').modal("toggle")
                        alerta("verde", "Actividad padre guardada con exito");
                    })
                    .fail(function (msg) {
                        alerta("error", "Error por favor comunicarse con el administrador del sistema");
                    });
        }

    });
    function agregarregistro(tabla, msg, contenido, destino, clase) {
        var acordeon = '<div class="panel panel-default" id="' + msg.uno + '">\n\
                                           <div class="panel-heading">\n\
                                           <div class="row">\n\
                                            <div class="col-md-10"> \n\
                                                <div class="panel-heading">\n\
                                                    <h4 class="panel-title">\n\
                                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_' + msg.uno + destino + '" aria-expanded="false">\n\
                                                        <i class="fa fa-folder-o carpeta"></i> ' + msg.dos + " - " + msg.tres + '\n\
                                                    </a></h4>\n\
                                                </div></div><div class="col-md-2"><h4>\n\
                                                    <div class="posicionIconoActividad">';
        if (destino == 'c')
            acordeon += '<i class="fa fa-file-o carpeta nuevo_hijo" data-toggle="modal" data-target="#myModal8" title="ACTIVIDAD HIJO" car_id="' + msg.uno + '"></i> ';
        if (destino == 'r')
            acordeon += '<i class="fa fa-file-archive-o nuevoregistro"   data-toggle="modal" data-target="#myModal15" car_id="' + msg.uno + '"></i> ';

        acordeon += '<i class="fa fa-edit ' + clase + '" car_id="' + msg.uno + '"></i>\n\
                                                        <i class="fa fa-times eliminarcarpeta" title="Eliminar" tipo="' + destino + '" car_id="' + msg.uno + '"></i>\n\
                                                    </div>\n\
                                                </h4>\n\
                                            </div>\n\
                                            </div>\n\
                                            <div id="collapse_' + msg.uno + destino + '" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">\n\
                                                <div class="panel-body">\n\
                                                    ' + contenido + '\n\
                                                </div>\n\
                                            </div>\n\
                                    </div>';
        $('#' + tabla).append(acordeon);
    }

    $('#cargo').change(function () {
        if ($('#cargo').val() == '')
            return false;
        $.post(
                url + "index.php/administrativo/consultausuarioscargo",
                {
                    cargo: $(this).val()
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message'])
            else {
                var data = "";
                $('#empleado *').remove();
                $.each(msg.Json, function (key, val) {
                    nombre = val.Emp_Nombre;
                    apellido = val.Emp_Apellidos;
                    data += "<option value='" + val.Emp_Id + "'>" + nombre.toUpperCase() + " " + apellido.toUpperCase() + "</option>"
                });
                $('#empleado').append(data);
<?php if (isset($plan[0]->emp_id)) { ?>
                    $('#empleado').val('<?php echo $plan[0]->emp_id; ?>');
<?php } ?>
            }
        }).fail(function (msg) {

        });
    });
    $('#guardarplan').click(function () {
        if (obligatorio('obligatorio') == true) {
            $.post(
                    "<?php echo (empty($plan[0]->pla_id)) ? base_url('index.php/planes/guardarplan') : base_url('index.php/planes/actualizarplan'); ?>",
                    $('#f7').serialize()
                    ).done(function (msg) {

                if (!jQuery.isEmptyObject(msg.message))
                    alerta("rojo", msg['message']);
                else {
                    if (confirm("Desea guardar otro Plan ?")) {
                        $('input,select,textarea').val("");
                    } else {
                        var form = "<form method='post' id='frmEditarPlan'>";
                        form += "<input type='hidden' value='" + msg + "' name='pla_id'>";
                        form += "</form>";
                        $('body').append(form);
                        $('#frmEditarPlan').submit();
                    }
                    alerta("verde", "Datos guardados correctamente");
                }
            }).fail(function (msg) {
                alerta("rojo", "Error en el sistema por favor verificar la conexion de internet");
            });
        }
    });
    $('#btnguardarregistro').click(function () {
        if (obligatorio("obligatorioRegistro")) {
            var file_data = $('#archivo').prop('files')[0];
            var form_data = new FormData();
            form_data.append('archivo', file_data);
            form_data.append('pla_id', $('#pla_id').val());
            form_data.append('regCar_id', $('#carpeta').val());
            form_data.append('reg_version', $('#version').val());
            form_data.append('reg_descripcion', $('#reg_descripcion').val());
            $.ajax({
                url: url + "index.php/planes/guardarregistroempleado",
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
                        filas += "<td><a target='_black' href='<?php echo base_url('') ?>" + val.reg_ruta + '/' + val.reg_id + '/' + val.reg_archivo + "'>" + (val.reg_archivo == null ? '' : val.reg_archivo) + "</a></td>";
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
        }
    });

    $('.crear_padre').click(function () {
        $('#actPad_id,#idactividad,#nombreactividad').val('');
    });

    $('body').delegate('.eliminar', 'click', function () {
        if ($(this).attr('acthij_id') == '')
            return false;
        var r = confirm('Desea eliminar el registro')
        if (r == false) {
            return false;
        }
        $(this).parent().parent().remove();
        $.post(url + 'index.php/tareas/eliminar_actividad_hijo', {actHij_id: $(this).attr('actHij_id')})
                .done(function () {
                    alerta('verde', 'Eliminado con exito')
                }).fail(function () {
            alerta('rojo', 'Error, por favor comunicarse con el administrador del sistema');
        })
    });
    $('body').delegate('.modificar', 'click', function () {
        var acthij_id = $(this).attr('acthij_id');
        if (acthij_id == "")
            return false;
        $.post(url + 'index.php/tareas/editar_actividad_hijo',
                {
                    acthij_id: acthij_id,
                    actPad_id: $(this).parents(".panel").attr('id')
                })
                .done(function (msg) {
                    $('#idpadre').val(msg[0].actHij_padreid)
                    $('.nombre2').val(msg[0].actHij_nombre)
                    $('.fechainicio2').val(msg[0].minimo)
                    $('.descripcion2').val(msg[0].actHij_descripcion)
                    $('#fechafinalizacion').val(msg[0].maximo)
                    $('#modoverificacion').val(msg[0].actHij_modoVerificacion)
                    $('#peso').val(msg[0].actHij_peso)
                    $('#riesgosancion').val(msg[0].actHij_riesgoSancion)
                    $('#tipo').val(msg[0].tip_id)
                    $('#presupuestototal').val(msg[0].actHij_presupuestoTotal)
                    $('.costoreal2').val(msg[0].actHij_costoReal)
                    $('#actHij_id').val(msg[0].actHij_id)
                })
                .fail(function () {
                    alerta('rojo', 'Error, por favor comunicarse con el administrador del sistema')
                });
    });
    $('.nuevo_hijo').click(function () {
        $('#actHij_id').val('')
    });

    $.post('<?php echo base_url("grant/index.php") ?>', $('#formulario_grant').serialize())
            .done(function (msg) {
                var imagen = '<img src="<?php echo base_url("grant") ?>/imagenprueba.jpg">';
                $('#grafica_granf').html(imagen)
            })
            .fail(function () {

            })
    $('#cargo').trigger('change');

</script>
