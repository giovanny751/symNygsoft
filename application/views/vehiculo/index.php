
<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" id="guardarVehiculo" <?php echo (!empty($vehiculo->veh_id)) ? "title='Actualizar' at='actualizar'" : "title='Guardar' at='guardar'"; ?>><i class="fa fa-floppy-o fa-3x"></i></div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Registro vehicular
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
                                <li class='active'>
                                    <a data-toggle="tab" href="#tab1">Vehículo</a>
                                </li>

                                <li class="ocultoSinId">
                                    <a data-toggle="tab" href="#tab3">Soat</a>
                                </li>
                                <li  class="ocultoSinId">
                                    <a data-toggle="tab" href="#tab5">Rtm</a>
                                </li>
                                <li class="ocultoSinId" >
                                    <a data-toggle="tab" href="#tab2">Propietario</a>
                                </li>
                                <li  class="ocultoSinId">
                                    <a data-toggle="tab" href="#tab4">Mantenimiento</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab1" class="tab-pane active">
                                    <form method="post" id="frmVehiculo" class="form-horizontal">
                                        <input type="hidden" class="vehiculoId" name="idVehiculo" value="<?php echo (!empty($vehiculo->veh_id)) ? $vehiculo->veh_id : ""; ?>" id="idVehiculo">
                                        <div class="form-body">
                                            <div class="row">
                                                <fieldset>
                                                    <legend>Auditoria</legend>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label class='col-md-2' for="tipoVehiculo">Fecha de Creación:</label>
                                                            <div class='col-md-4'>
                                                                <input type="text" id="fechaCreacion" style="text-align: center" class="form-control" value="<?php echo (!empty($vehiculo->creatorDate)) ? $vehiculo->creatorDate : date("Y-m-d H:i:s"); ?>" disabled="disabled">
                                                            </div>
                                                            <label class='col-md-2' for="tipoServicio">Fecha última modificación:</label>
                                                            <div class='col-md-4'>
                                                                <input type="text" id="fechaUltimaModificacion" style="text-align: center" value="<?php echo (!empty($vehiculo->modificationDate)) ? $vehiculo->modificationDate : ""; ?>" class="form-control" disabled="disabled">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class='col-md-12'>
                                                        <div class="form-group">
                                                            <label for="dimension1" class=" col-md-2"><span style="color:red">*</span><?php echo $empresa[0]->Dim_id ?></label>
                                                            <div class="col-md-4">
                                                                <select id="dimension1" name="dimension1" class="form-control dimencion_uno_se obligatorio">
                                                                    <option value="">::Seleccionar::</option>
                                                                    <?php foreach ($dimension as $d) { ?>
                                                                        <option  <?php echo (!empty($vehiculo->dim_id) && $vehiculo->dim_id == $d->dim_id) ? "selected" : ""; ?> value="<?php echo $d->dim_id ?>"><?php echo $d->dim_descripcion ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>    
                                                            <label for="dimension2" class=" col-md-2"><?php echo $empresa[0]->Dimdos_id ?></label>  
                                                            <div class="col-md-4">
                                                                <select id="dimension2" name="dimension2" class="form-control dimencion_dos_se">
                                                                    <option value="">::Seleccionar::</option>
                                                                    <?php
                                                                    if (!empty($veh_id)) :
                                                                        foreach ($dimension2 as $d2):
                                                                            ?>
                                                                            <option  <?php echo (!empty($vehiculo->dim_id2) && $vehiculo->dim_id2 == $d2->dim_id) ? "selected" : ""; ?> value="<?php echo $d2->dim_id ?>"><?php echo $d2->dim_descripcion ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>    
                                                        </div>    
                                                    </div> 
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Datos vehículo</legend>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label class='col-md-1' for="claseVehiculo"><span style="color: red">*</span>Clases de vehículo:</label>
                                                            <div class='col-md-3'>
                                                                <select class='form-control obligatorio' id="claseVehiculo" name="claseVehiculo">
                                                                    <option value=''>::Seleccionar::</option>
                                                                    <?php foreach ($claseVehiculo as $cv): ?>
                                                                        <option <?php echo (!empty($vehiculo->claVeh_id) && $vehiculo->claVeh_id == $cv->claVeh_id) ? "selected" : ""; ?> value='<?php echo $cv->claVeh_id ?>'><?php echo $cv->claVeh_nombre ?></option>
                                                                    <?php endforeach; ?>                                                   
                                                                </select>
                                                            </div>
                                                            <label class='col-md-1' for="tipoVehiculo"><span style="color: red">*</span>Tipo de vehículo:</label>
                                                            <div class='col-md-3'>
                                                                <select class='form-control obligatorio' id="tipoVehiculo" name="tipoVehiculo">
                                                                    <option value=''>::Seleccionar::</option>
                                                                    <?php
                                                                    if (!empty($veh_id)) :
                                                                        foreach ($tipoVehiculo as $tv):
                                                                            ?>
                                                                            <option <?php echo (!empty($vehiculo->tipVeh_id) && $vehiculo->tipVeh_id == $tv->tipVeh_id) ? "selected" : ""; ?> value='<?php echo $tv->tipVeh_id ?>'><?php echo $tv->tipVeh_nombre ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <label class='col-md-1' for="tipoServicio">Tipo de servicio:</label>
                                                            <div class='col-md-3'>
                                                                <select class='form-control' id="tipoServicio" name="tipoServicio">
                                                                    <option value=''>::Seleccionar::</option>
                                                                    <?php foreach ($tipoServicio as $ts): ?>
                                                                        <option <?php echo (!empty($vehiculo->tipSer_id) && $vehiculo->tipSer_id == $ts->tipSer_id) ? "selected" : ""; ?> value='<?php echo $ts->tipSer_id ?>'><?php echo $ts->tipSer_nombre ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label class='col-md-2' for="kilometrajeActual">Kilometraje actual:</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group ">
                                                                    <span id="agregarKilometros"  class="input-group-addon" id="agregarKilometraje" style="cursor: pointer">
                                                                        <i class="fa fa-plus"></i>
                                                                    </span>
                                                                    <input type="text" class="form-control" value="<?php echo (!empty($vehiculo->kilometraje)) ? $vehiculo->kilometraje : ""; ?>" id="kilometrajeActual" style="text-align: center" readonly="" >
                                                                    <span class="input-group-addon" >
                                                                        KM
                                                                    </span>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label class='col-md-1' for="pais"><span style="color: red">*</span>Pais:</label>
                                                            <div class='col-md-3'>
                                                                <select name='pais' id='pais' class='form-control obligatorio'>
                                                                    <option value="">::Seleccionar::</option>
                                                                    <?php foreach ($pais as $p): ?>
                                                                        <option <?php echo (!empty($vehiculo->pai_id) && $vehiculo->pai_id == $p->pai_id) ? "selected" : ""; ?> value='<?php echo $p->pai_id ?>'><?php echo $p->pai_nombre ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <label class='col-md-1' for="departamento"><span style="color: red">*</span>Departamento:</label>
                                                            <div class='col-md-3'>
                                                                <select name='departamento' id='departamento' class='form-control obligatorio'>
                                                                    <option value="">::Seleccionar::</option>
                                                                    <?php
                                                                    if (!empty($veh_id)) :
                                                                        foreach ($departamento as $d):
                                                                            ?>
                                                                            <option <?php echo (!empty($vehiculo->dep_id) && $vehiculo->dep_id == $d->dep_id) ? "selected" : ""; ?> value='<?php echo $d->dep_id ?>'><?php echo $d->dep_nombre ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <label class='col-md-1' for="ciudad"><span style="color: red">*</span>Ciudad:</label>
                                                            <div class='col-md-3'>
                                                                <select name='ciudad' id='ciudad' class='form-control obligatorio'>
                                                                    <option value="">::Seleccionar::</option>
                                                                    <?php
                                                                    if (!empty($veh_id)) :
                                                                        foreach ($ciudad as $c):
                                                                            ?>
                                                                            <option <?php echo (!empty($vehiculo->ciu_id) && $vehiculo->ciu_id == $c->ciu_id) ? "selected" : ""; ?> value='<?php echo $c->ciu_id ?>'><?php echo $c->ciu_nombre ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-12'>
                                                        <div class='col-md-4'>
                                                            <div class='form-group'>
                                                                <label class='col-md-4' for="placa"><span style="color: red">*</span>Placa:</label>
                                                                <div class='col-md-8'>
                                                                    <input value="<?php echo (!empty($vehiculo->veh_placa)) ? $vehiculo->veh_placa : ""; ?>" type='text' name='placa' id='placa' class='form-control obligatorio'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-4'>
                                                            <div class='form-group'>
                                                                <label class='col-md-4' for="marca"><span style="color: red">*</span>Marca:</label>
                                                                <div class='col-md-8'>
                                                                    <input value="<?php echo (!empty($vehiculo->veh_marca)) ? $vehiculo->veh_marca : ""; ?>" type='text' name='marca' id='marca' class='form-control obligatorio'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-4'>
                                                            <div class='form-group'>
                                                                <label class='col-md-4' for="color">Color:</label>
                                                                <div class='col-md-8'>
                                                                    <input value="<?php echo (!empty($vehiculo->veh_color)) ? $vehiculo->veh_color : ""; ?>" type='text' name='color' id='color' class='form-control obligatorio'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-12'>
                                                            <div class='form-group'>
                                                                <label class='col-md-1' for="linea"><span style="color: red">*</span>N° Puertas:</label>
                                                                <div class='col-md-3'>
                                                                    <select style="text-align: center" name='noPuertas' id='noPuertas' class='form-control number obligatorio'>
                                                                        <option style="text-align: center" value="">::Seleccionar::</option>
                                                                        <?php for ($i = 1; $i < 21; $i++): ?>
                                                                            <option <?php echo (!empty($vehiculo->veh_numPuertas) && $vehiculo->veh_numPuertas == $i) ? "selected" : ""; ?> style="text-align: center" value="<?php echo $i ?>"><?php echo $i ?></option>
                                                                        <?php endfor;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <label class='col-md-1' for="linea">Linea:</label>
                                                                <div class='col-md-3'>
                                                                    <input type='text' value="<?php echo (!empty($vehiculo->veh_linea)) ? $vehiculo->veh_linea : ""; ?>" name='linea' id='linea' class='form-control'>
                                                                </div>
                                                                <label class='col-md-1' for="capacidadCarga">Tonelada(s) carga:</label>
                                                                <div class='col-md-3'>
                                                                    <input type='text' value="<?php echo (!empty($vehiculo->veh_toneladas)) ? $vehiculo->veh_toneladas : ""; ?>" name='toneladaCarga' id='toneladaCarga' class='form-control'>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class='col-md-12'>
                                                        <div class='col-md-4'>
                                                            <div class='form-group'>
                                                                <label class='col-md-4' for="noMotor"><span style="color: red">*</span>N° Motor:</label>
                                                                <div class='col-md-8'>
                                                                    <input type='text' value="<?php echo (!empty($vehiculo->veh_numMotor)) ? $vehiculo->veh_numMotor : ""; ?>" name='noMotor' id='noMotor' class='form-control obligatorio'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-4'>
                                                            <div class='form-group'>
                                                                <label class='col-md-4' for="noSerie">N° Serie:</label>
                                                                <div class='col-md-8'>
                                                                    <input type='text' value="<?php echo (!empty($vehiculo->veh_numSerie)) ? $vehiculo->veh_numSerie : ""; ?>" name='noSerie' id='noSerie' class='form-control '>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--                                                        <div class='col-md-4'>
                                                                                                                    <div class='form-group'>
                                                                                                                        <label class='col-md-4' for="noChasis"><span style="color: red">*</span>N° Chasis:</label>
                                                                                                                        <div class='col-md-8'>
                                                                                                                            <input type='text' value="<?php echo (!empty($vehiculo->veh_numChasis)) ? $vehiculo->veh_numChasis : ""; ?>" name='noChasis' id='noChasis' class='form-control obligatorio'>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>-->
                                                        <div class='col-md-4'>
                                                            <div class='form-group'>
                                                                <label class='col-md-4' for="noVin">No VIN (Chasis):</label>
                                                                <div class='col-md-8'>
                                                                    <input type='text' value="<?php echo (!empty($vehiculo->veh_numVin)) ? $vehiculo->veh_numVin : ""; ?>" name='noVin' id='noVin' class='form-control'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-12'>
                                                        <div class='col-md-4'>
                                                            <div class='form-group'>
                                                                <label class='col-md-4' for="cilindraje"><span style="color: red">*</span>Cilindraje:</label>
                                                                <div class='col-md-8'>
                                                                    <input type='text'  value="<?php echo (!empty($vehiculo->veh_cilindraje)) ? $vehiculo->veh_cilindraje : ""; ?>" name='cilindraje' id='cilindraje' class='form-control obligatorio'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-4'>
                                                            <div class='form-group'>
                                                                <label class='col-md-4' for="fechaUltimoMantenimiento">Fecha del último mantenimiento:</label>
                                                                <div class='col-md-8'>
                                                                    <input type='text' name='fechaUltimoMantenimiento' id='fechaUltimoMantenimiento' class='form-control' disabled="disabled">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-4'>
                                                            <div class='form-group'>
                                                                <label class='col-md-4' for="combustible"><span style="color: red">*</span>Conbustible:</label>
                                                                <div class='col-md-8'>
                                                                    <select name="combustible" id="combustible" class="form-control" multiple>
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>    
                                                    <!--<div class='col-md-12'>-->
                                                    <!--                                                        <div class='col-md-4'>
                                                                                                                <div class='form-group'>
                                                                                                                    <label class='col-md-4' for="tipoCarroceria">Tipo de Carrocería:</label>
                                                                                                                    <div class='col-md-8'>
                                                                                                                        <select name='tipoCarroceria' id='tipoCarroceria' class='form-control'>
                                                                                                                            <option value="">::Seleccionar::</option>
                                                    <?php foreach ($tipoCarroceria as $tc): ?>
                                                                                                                                                            <option <?php echo (!empty($vehiculo->tipCar_id) && $vehiculo->tipCar_id == $tc->tipCar_id) ? "selected" : ""; ?> value='<?php echo $tc->tipCar_id ?>'><?php echo $tc->tipCar_nombre ?></option>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                                                                                        </select>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>-->

                                                    <!--</div>-->
                                                    <div class='col-md-12'>
                                                        <div class='col-md-12'>
                                                            <div class='form-group'>
                                                                <label class='col-md-2' for="centroRealizaMantenimiento">Centro dónde realiza el mantenimiento:</label>
                                                                <div class='col-md-10'>
                                                                    <input type='text' value="<?php echo (!empty($vehiculo->veh_realizoMantenimiento)) ? $vehiculo->veh_realizoMantenimiento : ""; ?>" name='centroRealizaMantenimiento' id='centroRealizaMantenimiento' class='form-control'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-12'>
                                                        <div class='col-md-12'>
                                                            <div class='form-group'>
                                                                <label class='col-md-2' for="observaciones">Observaciones:</label>
                                                                <div class='col-md-10'>
                                                                    <textarea name='observaciones' id='observaciones' class='form-control'><?php echo (!empty($vehiculo->veh_observacion)) ? $vehiculo->veh_observacion : ""; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="tab2" class="tab-pane ">
                                    <div class='row'>
                                        <form id="frmPropietario">
                                            <input type="hidden" class="vehiculoId" name="veh_id" id="veh_id" value="<?php echo (!empty($vehiculo->veh_id)) ? $vehiculo->veh_id : ""; ?>">
                                            <div class='col-md-12'>
                                                <div class='col-md-4'>
                                                    <label class='col-md-8' for="perteneceCompania"><span style="color: red">*</span>¿Pertenece a la compañia?</label>
                                                    <div class='col-md-4'>
                                                        <select class='form-control obligatorioPropietario' id="perteneceCompania" name="perteneceCompania">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo ($propietario->vehPro_pertenece == 1 ) ? "selected" : ""; ?>>Si</option>
                                                            <option value="0" <?php echo ($propietario->vehPro_pertenece == 0 ) ? "selected" : ""; ?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class='col-md-4'>
                                                    <label class='col-md-4' for="tipoIdentificacion"><span style="color: red">*</span>T.D.</label>
                                                    <div class='col-md-8'>
                                                        <select class='form-control obligatorioPropietario' id="tipoIdentificacion" name="tipoIdentificacion">
                                                            <option value="">::Seleccionar::</option>
                                                            <?php foreach ($tipoIdentificacion as $ti): ?>
                                                                <option <?php echo (!empty($propietario->tipIde_id) && $propietario->tipIde_id == $ti->tipIde_id) ? "selected" : ""; ?> value="<?php echo $ti->tipIde_id ?>"><?php echo $ti->tipIde_tipo ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class='col-md-4'>
                                                    <label class='col-md-4' for="NoDocumento"><span style="color: red">*</span>N° Documento:</label>
                                                    <div class='col-md-8'>
                                                        <input  type="text" name="NoDocumento" id="NoDocumento" class="form-control obligatorioPropietario" value="<?php echo (!empty($propietario->vehPro_documento) ) ? $propietario->vehPro_documento : ""; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='col-md-4'>
                                                    <label class='col-md-4' for="direccionPropietario">Dirección:</label>
                                                    <div class='col-md-8'>
                                                        <input type="text" name="direccionPropietario" id="direccionPropietario" class="form-control"  value="<?php echo (!empty($propietario->vehPro_direccion) ) ? $propietario->vehPro_direccion : ""; ?>">
                                                    </div>
                                                </div>
                                                <div class='col-md-4'>
                                                    <label class='col-md-4' for="telefonoPropietario"><span style="color: red">*</span>Teléfono:</label>
                                                    <div class='col-md-8'>
                                                        <input type="text" name="telefonoPropietario" id="telefonoPropietario" class="form-control obligatorioPropietario" value="<?php echo (!empty($propietario->vehPro_telefono) ) ? $propietario->vehPro_telefono : ""; ?>">
                                                    </div>
                                                </div>
                                                <div class='col-md-4'>
                                                    <label class='col-md-4' for="correoPropietario"><span style="color: red">*</span>Correo electronico:</label>
                                                    <div class='col-md-8'>
                                                        <input type="text" name="correoPropietario" id="correoPropietario" class="form-control obligatorioPropietario"  value="<?php echo (!empty($propietario->vehPro_correo) ) ? $propietario->vehPro_correo : ""; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='col-md-5'>
                                                    <label class='col-md-8' for="tieneComparendosActualmente">Tiene comparendos actualmente:</label>
                                                    <div class='col-md-3'>
                                                        <select name="tieneComparendosActualmente" id="tieneComparendosActualmente" class="form-control">
                                                            <option value="1" <?php echo ($propietario->vehPro_comparendo == 1 ) ? "selected" : ""; ?>>Si</option>
                                                            <option value="0" <?php echo ($propietario->vehPro_comparendo == 0 ) ? "selected" : ""; ?>>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="text-align: center">
                                                <button type="button" class="btn btn-success" id="guardarPropietario">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab3" class="tab-pane ">
                                    <div class='row'>
                                        <form id="frmSoat">
                                            <input type="hidden" class="vehiculoId" name="veh_id" id="veh_id" value="<?php echo (!empty($vehiculo->veh_id)) ? $vehiculo->veh_id : ""; ?>">
                                            <div class='col-md-12'>
                                                <div class='col-md-6'>
                                                    <label class='col-md-4' for="fechaExpideSoat"><span style="color: red">*</span>Entidad expide el SOAT</label>
                                                    <div class='col-md-8'>
                                                        <input type="text" class='form-control obligatorioSoat' id="fechaExpideSoat" name="fechaExpideSoat"/>
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <label class='col-md-4' for="numeroSoat"><span style="color: red">*</span>Numero de SOAT</label>
                                                    <div class='col-md-8'>
                                                        <input type="text" class='form-control obligatorioSoat' id="numeroSoat" name="numeroSoat"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class='col-md-6'>
                                                    <label class='col-md-4' for="fechaInicioSoat"><span style="color: red">*</span>Fecha de inicio vigencia</label>
                                                    <div class='col-md-8'>
                                                        <input type="text" name="fechaInicioSoat" id="fechaInicioSoat" class="form-control fecha obligatorioSoat">
                                                    </div>
                                                </div>
                                                <div class='col-md-6'>
                                                    <label class='col-md-4' for="fechaFinSoat"><span style="color: red">*</span>Fecha de fin de vigencia</label>
                                                    <div class='col-md-8'>
                                                        <input type="text" name="fechaFinSoat" id="fechaFinSoat" class="form-control fecha obligatorioSoat">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="text-align: center">
                                                <button type="button" class="btn btn-success" id="guardarSoat">Guardar</button>
                                            </div>
                                            <br>
                                            <hr>
                                            <br>
                                            <div class="col-md-12">
                                                <table class="table table-striped table-bordered table-hover ">
                                                    <thead>
                                                    <th>Entidad expide el SOAT</th>
                                                    <th>Numero de SOAT</th>
                                                    <th>Fecha de inicio vigencia</th>
                                                    <th>Fecha de fin de vigencia</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab5" class="tab-pane">
                                    <div class="row">
                                        <form id="frmRtm" class="form-horizontal">
                                            <input type="hidden" class="vehiculoId" name="veh_id" id="veh_id" value="<?php echo (!empty($vehiculo->veh_id)) ? $vehiculo->veh_id : ""; ?>">
                                            <div class='col-md-12'>
                                                <div class="form-group">
                                                    <label class='col-md-2' for="entidadExpideRtm"><span style="color: red">*</span>Entidad expide RTM</label>
                                                    <div class='col-md-10' >
                                                        <input type="text" name="entidadExpideRtm" id="entidadExpideRtm" class="form-control obligatorioRTM">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='col-md-12'>
                                                <div class="form-group">
                                                    <label class='col-md-2' for="fechaInicioRtm"><span style="color: red">*</span>Fecha inicio de vigencia</label>
                                                    <div class='col-md-4' for="fechaInicioRtm">
                                                        <input type="text" name="fechaInicioRtm" id="fechaInicioRtm" class="form-control fecha obligatorioRTM">
                                                    </div>
                                                    <label class='col-md-2' for="fechaFinRTM"><span style="color: red">*</span>Fecha fin de vigencia</label>
                                                    <div class='col-md-4'>
                                                        <input type="text" name="fechaFinRTM" id="fechaFinRTM" class="form-control fecha obligatorioRTM">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="text-align: center">
                                                <button type="button" class="btn btn-success" id="guardarRtm">Guardar</button>
                                            </div>
                                            <br>
                                            <hr>
                                            <br>
                                            <div class="col-md-12">
                                                <table class="table table-striped table-bordered table-hover ">
                                                    <thead>
                                                    <th>Entidad expide RTM</th>
                                                    <th>Fecha inicio de vigencia</th>
                                                    <th>Fecha fin de vigencia</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="tab4" class="tab-pane ">
                                    <input type="hidden" class="vehiculoId" name="veh_id" id="veh_id" value="<?php echo (!empty($vehiculo->veh_id)) ? $vehiculo->veh_id : ""; ?>">
                                    <button type="button" class="btn btn-info" id="modalVehiculo" title="Datos estado del vehículo"><i class="fa fa-plus"></i></button>
                                    <table class="table table-striped table-bordered table-hover ">
                                        <thead>
                                        <th style="text-align: center">Observación</th>
                                        <th style="text-align: center">Precio</th>
                                        <th style="text-align: center">Estado vehículo actual</th>
                                        <th style="text-align: center">Eliminar</th>
                                        </thead>
                                        <tbody id="observacionesEstado">
                                            <?php foreach ($observacionVehiculo as $ov): ?>
                                                <tr>
                                                    <td><?php echo $ov->vehObs_observacion ?></td>
                                                    <td style="text-align: right"><?php echo $ov->vehObs_precio ?></td>
                                                    <td><?php echo $ov->est_nombre ?></td>
                                                    <td style='text-align:center'><button type="button" class="btn btn-danger eliminarObservacion" at="<?php echo $ov->vehObs_id ?>"><i class="fa fa-remove"></i></button></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------
MODALES
------------------------------------------------------------------------------->
<div class="modal fade" id="nuevoKilometraje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Nuevo Kilometraje</h4>
            </div>
            <div class="modal-body form-horizontal">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-2" class="control-label">Kilometros</div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input style="text-align: center" type="text" name="kilometro" id="kilometro" class="form-control number miles">
                                    <div class="input-group-btn " id="guardarKilometros" style="cursor: pointer">
                                        <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th style='text-align:center'>KM</th>
                            <th style='text-align:center'>FECHA REGISTRO</th>
                            <th style='text-align:center'>ELIMINAR</th>
                            </thead>
                            <tbody id="cuerpoKilometraje">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="opcionescarpeta">
                <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalObservacionVehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Nuevo Kilometraje</h4>
            </div>
            <div class="modal-body form-horizontal">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-4" class="control-label">Observaciones</div>
                            <div class="col-md-8">
                                <textarea class="form-control" id="observacionVehiculo" name="observacionVehiculo"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-4" class="control-label">Precio</div>
                            <div class="col-md-8">
                                <input type="text" name="precioVehiculo" id="precioVehiculo" class="form-control number miles">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-4" class="control-label">Estado</div>
                            <div class="col-md-8">
                                <select name="estadoVehiculo" id="estadoVehiculo" class="form-control">
                                    <option value="">::Seleccionar::</option>
                                    <?php foreach ($estados as $e): ?>
                                        <option value="<?php echo $e->est_id ?>"><?php echo $e->est_nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="opcionescarpeta">
                <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="guardarObservaciones" >Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modalVehiculo').click(function () {
        $('#modalObservacionVehiculo').modal("show");
    });

    $('#guardarObservaciones').click(function () {
        $.post(
                url + "index.php/Vehiculo/guardarObservacionesVehiculo",
                {
                    observacion: $('#observacionVehiculo').val(),
                    precio: $('#precioVehiculo').val(),
                    estado: $('#estadoVehiculo').val(),
                    vehiculo: $('#idVehiculo').val()
                }
        ).done(function (msg) {

            if (!jQuery.isEmptyObject(msg.message))
                alerta(msg["color"], msg['message'])
            else {
                $('#observacionesEstado *').remove();
                var tr = "";
                $.each(msg.Json, function (key, val) {
                    tr += "<tr>";
                    tr += "<td>" + val.vehObs_observacion + "</td>";
                    tr += "<td style='text-align:right'>" + val.vehObs_precio + "</td>";
                    tr += "<td >" + val.est_nombre + "</td>";
                    tr += "<td style='text-align:center'><button class='btn btn-danger eliminarObservacion' at='" + val.vehObs_id + "'><i class='fa fa-remove'></i></button></td>";
                    tr += "</tr>";
                });
                $("#observacionVehiculo").val("");
                $("#precioVehiculo").val("");
                $("#estadoVehiculo").val("");
                $('#observacionesEstado').append(tr);
                $("#modalObservacionVehiculo").modal("hide");
            }
        }).fail(function (msg) {

        })
    });

    $('body').delegate(".eliminarObservacion", "click", function () {
        if (confirm("Esta seguro de eliminar el registro")) {
            var puntero = $(this);
            $.post(
                    url + "index.php/Vehiculo/eliminarObservacion",
                    {
                        observacionId: $(this).attr('at'),
                    }
            ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta(msg["color"], msg['message'])
                else {
                    puntero.parents("tr").remove();
                }
            }).fail(function (msg) {

            })
        }
    });

    $('#pais').change(function () {
        $('#departamento *').remove();
        $('#ciudad *').remove();
        $.post(
                url + "index.php/Vehiculo/consultaDepartamentoXPais",
                {
                    pais: $(this).val()
                }
        ).done(function (msg) {

            if (!jQuery.isEmptyObject(msg.message))
                alerta(msg["color"], msg['message'])
            else {
                var option = "<option value=''>::Seleccionar:: </option>";
                $.each(msg.Json, function (key, val) {
                    option += "<option value='" + val.dep_id + "'>" + val.dep_nombre + "</option>";
                });
                $('#departamento').append(option);
            }
        }).fail(function (msg) {

        })
    })

    $('#departamento').change(function () {
        $('#ciudad *').remove();
        $.post(
                url + "index.php/Vehiculo/consultaCiudadXDepartamento",
                {
                    dpto: $(this).val()
                }
        ).done(function (msg) {

            if (!jQuery.isEmptyObject(msg.message))
                alerta(msg["color"], msg['message'])
            else {
                var option = "<option value=''>::Seleccionar:: </option>";
                $.each(msg.Json, function (key, val) {
                    option += "<option value='" + val.ciu_id + "'>" + val.ciu_nombre + "</option>";
                });
                $('#ciudad').append(option);
            }
        }).fail(function (msg) {

        })
    })

    $('#guardarKilometros').click(function () {
        if ($("#kilometro").val() != "") {
            $.post(
                    url + "index.php/Vehiculo/guardarKilometro",
                    {
                        kilometro: $("#kilometro").val(),
                        veh_id: $('#idVehiculo').val()
                    }
            ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta(msg["color"], msg['message'])
                else {
                    $('#cuerpoKilometraje *').remove();
                    var tr = "";
                    $("#kilometrajeActual").val(msg.ultimoKilometro['vehKil_kilometros']);
                    $.each(msg.Json, function (key, val) {
                        tr += "<tr>"
                        tr += "<td style='text-align:center'>" + val.vehKil_kilometros + "</td>"
                        tr += "<td style='text-align:center'>" + val.creatorDate + "</td>"
                        tr += "<td style='text-align:center'><button type='button' class='btn btn-danger'><i class='fa fa-remove'></i></button></td>"
                        tr += "</tr>"
                    });
                    $("#kilometro").val("");
                    $('#cuerpoKilometraje').append(tr);
                }
            }).fail(function (msg) {

            });
        } else {
            alerta("amarillo", "Ingresa kilometraje");
        }
    });

    $('body').delegate(".eliminarKilometro", "click", function () {
        if (confirm("Esta seguro de eliminar el kilometraje")) {
            var puntero = $(this);
            $.post(
                    url + "index.php/Vehiculo/eliminarKilometraje",
                    {
                        vehKil_id: $(this).attr("kilometroId"),
                        veh_id: $('#idVehiculo').val()
                    }
            ).done(function (msg) {
                puntero.parents('tr').remove();
            }).fail(function (msg) {

            })
        }
    });

    $('body').delegate("#agregarKilometros", "click", function () {
        $('#cuerpoKilometraje *').remove();
        $.post(
                url + "index.php/Vehiculo/consultaKilometrosVehiculo",
                {
                    veh_id: $('#idVehiculo').val()
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta(msg["color"], msg['message'])
            else {
                var tr = "";
                $.each(msg.Json, function (key, val) {
                    tr += "<tr>"
                    tr += "<td style='text-align:center'>" + val.vehKil_kilometros + "</td>"
                    tr += "<td style='text-align:center'>" + val.creatorDate + "</td>"
                    tr += "<td style='text-align:center'><button kilometroId='" + val.vehKil_id + "' type='button' class='btn btn-danger eliminarKilometro'><i class='fa fa-remove'></i></button></td>"
                    tr += "</tr>"
                });
                $('#cuerpoKilometraje').append(tr);
            }
            $('#nuevoKilometraje').modal('show');
        }).fail(function (msg) {

        });
    });

    $('#claseVehiculo').change(function () {
        $('#tipoVehiculo *').remove();
        $.post(
                url + "index.php/Vehiculo/consultaTipoVehiculo",
                {
                    clase: $(this).val()
                }
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta(msg["color"], msg['message'])
            else {
                var option = "<option value=''>::Seleccionar::</option>";
                $.each(msg.Json, function (key, val) {
                    option += "<option value='" + val.tipVeh_id + "'>" + val.tipVeh_nombre + "</option>"
                });
                $('#tipoVehiculo').append(option);
            }
        }).fail(function (msg) {

        });
    });

    $('#guardarVehiculo').click(function () {
        if (obligatorio('obligatorio')) {
            if ($(this).attr('at') == "actualizar")
                direccion = url + "index.php/Vehiculo/actualizarVehiculo";
            if ($(this).attr('at') == "guardar")
                direccion = url + "index.php/Vehiculo/guardarVehiculo";
            $.post(
                    direccion,
                    $('#frmVehiculo').serialize()
                    ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta(msg["color"], msg['message'])
                else {
                    $('.vehiculoId').val(msg.veh_id);
                    $("#kilometro").val("");
                    $(".ocultoSinId").show('slow');
                    $('#agregarKilometros').show('slow')
                }
            }).fail(function () {

            })
        }
    });
    $('#guardarPropietario').click(function () {
        if (obligatorio('obligatorioPropietario')) {
            $.post(
                    url + "index.php/Vehiculo/guardarPropietario",
                    $('#frmPropietario').serialize()
                    ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta(msg["color"], msg['message'])
                else {

                }
            }).fail(function () {

            })
        }
    });
    $('#guardarRtm').click(function () {
        if (obligatorio('obligatorioRTM')) {
            $.post(
                    url + "index.php/Vehiculo/guardarRtm",
                    $('#frmVehiculo').serialize()
                    ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta(msg["color"], msg['message'])
                else {

                }
            }).fail(function () {

            })
        }
    });
    $('#guardarSoat').click(function () {
        if (obligatorio('obligatorioSoat')) {
            $.post(
                    url + "index.php/Vehiculo/guardarSoat",
                    $('#frmVehiculo').serialize()
                    ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta(msg["color"], msg['message'])
                else {

                }
            }).fail(function () {

            })
        }
    });

<?php if (empty($veh_id)) : ?>
        $('document').ready(function () {
            $(".ocultoSinId").hide();
            $("#agregarKilometros").hide();
        })
<?php endif; ?>
</script>    