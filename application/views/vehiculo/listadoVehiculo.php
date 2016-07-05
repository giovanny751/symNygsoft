<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>LISTADO DE VEHÍCULOS
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form class="form-horizontal" id="frmBuscaVehiculo">
                        <div class="row">
                            <div class='col-md-12'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='col-md-4' for="tipoVehiculo">Tipo de vehículo:</label>
                                        <div class='col-md-8'>
                                            <select class='form-control' id="tipoVehiculo" name="tipoVehiculo">
                                                <option value=''>::Seleccionar::</option>
                                                <?php foreach ($tipoVehiculo as $tv): ?>
                                                    <option value='<?php echo $tv->tipVeh_id ?>'><?php echo $tv->tipVeh_nombre ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='col-md-4' for="tipoServicio">Tipo de servicio:</label>
                                        <div class='col-md-8'>
                                            <select class='form-control' id="tipoServicio" name="tipoServicio">
                                                <option value=''>::Seleccionar::</option>
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label class='col-md-4' for="placa">Placa:</label>
                                        <div class='col-md-8'>
                                            <input type='text' name='placa' id='placa' class='form-control'>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label class='col-md-4' for="marca">Marca:</label>
                                        <div class='col-md-8'>
                                            <input type='text' name='marca' id='marca' class='form-control'>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label class='col-md-4' for="noMotor">N° Motor:</label>
                                        <div class='col-md-8'>
                                            <input type='text' name='noMotor' id='noMotor' class='form-control'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label class='col-md-4' for="noSerie">N° Serie:</label>
                                        <div class='col-md-8'>
                                            <input type='text' name='noSerie' id='noSerie' class='form-control'>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label class='col-md-4' for="noChasis">N° Chasis:</label>
                                        <div class='col-md-8'>
                                            <input type='text' name='noChasis' id='noChasis' class='form-control'>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label class='col-md-4' for="noVin">No VIN:</label>
                                        <div class='col-md-8'>
                                            <input type='text' name='noVin' id='noVin' class='form-control'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dimension1" class=" col-md-4"><?php echo $empresa[0]->Dim_id ?></label>
                                        <div class="col-md-8">
                                            <select id="dimension1" name="dimension1" class="form-control dimencion_uno_se">
                                                <option value="">::Seleccionar::</option>
                                                <?php foreach ($dimension as $d) { ?>
                                                    <option  <?php echo (!empty($empleado[0]->Dim_id) && $empleado[0]->Dim_id == $d->dim_id) ? "selected" : ""; ?> value="<?php echo $d->dim_id ?>"><?php echo $d->dim_descripcion ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>    
                                    </div>    
                                </div>    
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dimension2" class=" col-md-4"><?php echo $empresa[0]->Dimdos_id ?></label>  
                                        <div class="col-md-8">
                                            <select id="dimension2" name="dimension2" class="form-control dimencion_dos_se">
                                                <option value="">::Seleccionar::</option>
                                            </select>
                                        </div>    
                                    </div>    
                                </div> 
                            </div>
                            <div class='col-md-12' style="text-align: center">
                                <button type="button" class="btn btn-success" id="consultar">Consultar</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover " id="tablesst">
                                <thead>
                                <th style="text-align: center">Placa</th>
                                <th style="text-align: center">Marca</th>
                                <th style="text-align: center">N° Motor</th>
                                <th style="text-align: center">N° Vin (Chasis)</th>
                                <th style="text-align: center">N° Serie</th>
                                <th style="text-align: center"><?php echo $empresa[0]->Dim_id ?></th>
                                <th style="text-align: center"><?php echo $empresa[0]->Dimdos_id ?></th>
                                <th style="text-align: center">Eliminar</th>
                                <th style="text-align: center">Editar</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#consultar').click(function () {
        $.post(
                url + "index.php/Vehiculo/consultaVehiculo"
                ).done(function (msg) {
            var table = $('#tablesst').DataTable();
            table.clear().draw();
            $.each(msg['Json'], function (key, val) {

                table.row.add([
                    val.veh_placa,
                    val.veh_marca,
                    val.veh_numMotor,
                    val.veh_numVin,
                    val.veh_numSerie,
                    val.dim1,
                    val.dim2,
                    '<center><i style="cursor:pointer" class="fa fa-trash-o fa-2x  eliminar" aria-hidden="true" vehiculoId="' + val.veh_id + '" title="Eliminar" ></i></center>',
                    '<center><i style="cursor:pointer" class="fa fa-pencil-square-o fa-2x  modificar" vehiculoId="' + val.veh_id + '"  aria-hidden="true" title="Modificar" ></i></center>'
                ]).draw();
            });
        })
                .fail(function (msg) {

                });
    });

    $('body').delegate(".eliminar", "click", function () {
        if (confirm("Esta seguro de eliminar el vehiculo")) {
            $.post(
                    url + "index.php/Vehiculo/eliminarVehiculo",
            {
                veh_id : $(this).attr("vehiculoId")
            }
                    ).done(function (msg) {
                        $('#consultar').trigger("click")
            })
                    .fail(function (msg) {

                    });
        }
    })
    $('body').delegate(".modificar", "click", function () {
        var form = "<form method='post' id='frmEditarVehiculo' action='" + "<?php echo base_url("index.php/Vehiculo/index") ?>" + "'>";
        form += "<input type='hidden' value='" + $(this).attr('vehiculoId') + "' name='veh_id'>"
        form += "</form>";
        $('body').append(form);
        $('#frmEditarVehiculo').submit();
    });
</script>