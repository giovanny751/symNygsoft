<div class="row">
    <div class="col-md-6">
        <br>
        <a href="<?php echo base_url() . "index.php/administrativo/creacionempleados" ?>"><div class="circuloIcon" title="Nuevo Empleado" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i><?= $title ?>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class='col-md-12'>
                            <form method="post" id="f2" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-1" for="cedula">Cédula</label>
                                    <div class="col-md-3"><input type="text" name="cedula" id="cedula" class="form-control"></div>
                                    <label class="col-md-1" for="nombre">Nombre</label>
                                    <div class="col-md-3"><input type="text" name="nombre" id="nombre" class="form-control"></div>
                                    <label class="col-md-1" for="apellido">Apellido</label>
                                    <div class="col-md-3"><input type="text" name="apellido" id="apellido" class="form-control"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1" for="dimension1"><?php echo $empresa[0]->Dim_id ?></label>
                                    <div class="col-md-3">
                                        <select id="dimension1" name="dimension1" class="form-control dimencion_uno_se">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension as $d) { ?>
                                                <option  <?php echo (!empty($empleado[0]->Dim_id) && $empleado[0]->Dim_id == $d->dim_id) ? "selected" : ""; ?> value="<?php echo $d->dim_id ?>"><?php echo $d->dim_descripcion ?></option>
                                            <?php } ?>
                                        </select>    
                                    </div>
                                    <label class="col-md-1" for="dimension2"><?php echo $empresa[0]->Dimdos_id ?></label>
                                    <div class="col-md-3">
                                        <select id="dimension2" name="dimension2" class="form-control dimencion_dos_se">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension2 as $d2) { ?>
                                                <option  <?php echo (!empty($empleado[0]->Dim_IdDos) && $empleado[0]->Dim_IdDos == $d2->dim_id) ? "selected" : ""; ?> value="<?php echo $d2->dim_id ?>"><?php echo $d2->dim_descripcion ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2" for="contratosvencidos">Contratos vencidos</label>
                                    <div class="col-md-2">
                                        <input type="checkbox" id="contratosvencidos" value="1" name="contratosvencidos" class="form-control">
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="col-md-1" for="cargo">Cargo</label>
                                    <div class="col-md-3">
                                        <select name="cargo" id="cargo" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($cargo as $c) { ?>
                                                <option value="<?php echo $c->car_id ?>"><?php echo $c->car_nombre ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-md-1" for="estado">Estado</label>
                                    <div class="col-md-3">
                                        <select name="estado" id="estado" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($estado as $e) { ?>
                                                <option value="<?php echo $e->est_id ?>"><?php echo $e->est_nombre ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="text-align: center">
                                        <label>&nbsp;</label><button type="button" class="btn btn-danger limpiar">Limpiar</button>
                                        <label>&nbsp;</label><button type="button" class="btn btn-info consultar">Consultar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list"></i>Resultado
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
<div class="portlet-body form">
                <div class="form-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="tablesst" class="table table-striped table-bordered table-hover tabla-sst">
                        <thead>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Cargo</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Hoja de vida</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        </thead>
                        <tbody >

                        </tbody>
                    </table>
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
</div> 
</div> 
<form id="f10" method="post" action="<?php echo base_url("index.php/administrativo/creacionempleados") ?>">
    <input type="hidden" value="" name="emp_id" id="emp_id">
</form>
<style>
    th{
        text-align: center;
    }
    i{
        cursor:pointer
    }
</style>
<script>
    $(document).ready(function () {


        $('.consultar').click(function () {
            $.post(
                    url + 'index.php/administrativo/consultaempleados',
                    $('#f2').serialize()
                    ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("rojo", msg['message']);
                else {

                    var table = $('#tablesst').DataTable();
                    table.clear().draw();
                    $.each(msg['Json'], function (key, val) {
                        
                        hasta = "";
                        if(val.empCon_fechaHasta == '0000-00-00 00:00:00')
                            hasta = 'Indefinido';
                        
                        table.row.add([
                            val.Emp_Cedula,
                            val.Emp_Nombre,
                            val.Emp_Apellidos,
                            val.Emp_Telefono,
                            val.est_nombre,
                            val.car_nombre,
                            val.empCon_fechaDesde,
                            hasta,
                            '<center><i class="fa fa-file-pdf-o  fa-2x  Hoja de vida" ></i></center>',
                            '<center><i class="fa fa-pencil-square-o fa-2x  modificar" aria-hidden="true" title="Modificar"  emp_id="' + val.Emp_Id + '"  data-toggle="modal" data-target="#myModal"></i></center>',
                            '<center><i class="fa fa-trash-o fa-2x   eliminar" aria-hidden="true" title="Eliminar" tareas="' + val.tareas_emp + '" planes="' + val.planes_emp + '" emp_id="' + val.Emp_Id + '"></i></center>'
                        ]).draw();
                    });
                }
            }).fail(function (msg) {
                alerta("rojo", "Error, por favor comunicarse con el administrador del sitema");
            });
        });
    });
    $('#cedula').autocomplete({
        source: url + "index.php/administrativo/autocompletarcedula",
        minLength: 3
    });
    $('#nombre').autocomplete({
        source: url + "index.php/administrativo/autocompletarnombre",
        minLength: 3
    });
    $('#apellido').autocomplete({
        source: url + "index.php/administrativo/autocompletarapellido",
        minLength: 3
    });


    $('body').delegate(".modificar", "click", function () {
        $("#emp_id").val($(this).attr("emp_id"));
        $("#f10").submit();
    });

    $('.limpiar').click(function () {
        $('select,input').val('');
    });

    $('body').delegate('.eliminar', 'click', function () {
        var tareas = $(this).attr('tareas');
        var planes = $(this).attr('planes');
        if (planes > 0) {
            alerta('rojo', 'El usuario tiene planes asignados');
            return false;
        }
        if (tareas > 0) {
            alerta('rojo', 'El usuario tiene tareas sin finalizar');
            return false;
        }
        var boton = $(this);
        if (confirm("Esta seguro de eliminar el empleado?")) {
            $.post(
                    url + "index.php/administrativo/eliminarempleado"
                    , {id: $(this).attr('emp_id')}
            ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("rojo", msg['message'])
                else {
                    boton.parents('tr').remove();
                    alerta("verde", "Eliminado Correctamente");
                }
            }).fail(function (msg) {
                alerta("rojo", "Error en el sistema por favor verificar la conexion de internet");
            })
        }

    })
</script>    