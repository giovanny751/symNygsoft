<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url() . "index.php/administrativo/creacionempleados" ?>"><div class="circuloIcon" title="Nuevo Empleado" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">
                <a href="<?php echo base_url("index.php/presentacion/principal") ?>">HOME</a>/
                <a href="<?php echo base_url("index.php/administrativo/empresa") ?>">EMPRESA</a>/
                LISTADO EMPLEADOS</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form method="post" id="f2" class="form-horizontal">
        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2" for="cedula">Cédula</label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><input type="text" name="cedula" id="cedula" class="form-control"></div>
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2" for="nombre">Nombre</label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><input type="text" name="nombre" id="nombre" class="form-control"></div>
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2" for="apellido">Apellido</label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><input type="text" name="apellido" id="apellido" class="form-control"></div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2" for="dim1">
                <?php echo $empresa[0]->Dim_id ?>
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <select id="dimension1" name="dimension1" class="form-control">
                    <option value="">::Seleccionar::</option>
                    <?php foreach ($dimension as $d) { ?>
                        <option  <?php echo (!empty($empleado[0]->Dim_id) && $empleado[0]->Dim_id == $d->dim_id) ? "selected" : ""; ?> value="<?php echo $d->dim_id ?>"><?php echo $d->dim_descripcion ?></option>
                    <?php } ?>
                </select>    
            </div>
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2" for="dim2">
                <?php echo $empresa[0]->Dimdos_id ?>
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <select id="dimension2" name="dimension2" class="form-control">
                    <option value="">::Seleccionar::</option>
                    <?php foreach ($dimension2 as $d2) { ?>
                        <option  <?php echo (!empty($empleado[0]->Dim_IdDos) && $empleado[0]->Dim_IdDos == $d2->dim_id) ? "selected" : ""; ?> value="<?php echo $d2->dim_id ?>"><?php echo $d2->dim_descripcion ?></option>
                    <?php } ?>
                </select>
            </div>
            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3" for="dim2">
                Contratos vencidos 
            </label>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <input type="checkbox" value="1" name="contratosvencidos" class="form-control">
            </div>
        </div>    
        <div class="form-group">
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2" for="tipocontrato">
                Tipo Contrato
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <select name="tipocontrato" id="tipocontrato" class="form-control">
                    <option value="">::Seleccionar::</option>
                    <?php foreach ($tipocontrato as $tp) { ?>
                        <option value="<?php echo $tp->TipCon_Id ?>"><?php echo $tp->TipCon_Descripcion ?></option>
                    <?php } ?>
                </select>
            </div>
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2" for="cargo">
                Cargo
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <select name="cargo" id="cargo" class="form-control">
                    <option value="">::Seleccionar::</option>
                    <?php foreach ($cargo as $c) { ?>
                        <option value="<?php echo $c->car_id ?>"><?php echo $c->car_nombre ?></option>
                    <?php } ?>
                </select>
            </div>
            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2" for="estado">
                Estado
            </label>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <select name="estado" id="estado" class="form-control">
                    <option value="">::Seleccionar::</option>
                    <?php foreach ($estado as $e) { ?>
                        <option value="<?php echo $e->est_id ?>"><?php echo $e->est_nombre ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right">
                <label>&nbsp;</label><button type="button" class="btn-sst limpiar">Limpiar</button>
                <label>&nbsp;</label><button type="button" class="btn-sst consultar">Consultar</button>
            </div>
        </div>
    </form>   
    <div class="row">
        <table class="tablesst">
            <thead>
            <th>Cédula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Estado</th>
            <th>Tipo contrato</th>
            <th>Cargo</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Editar</th>
            <th>Eliminar</th>
            </thead>
            <tbody id="bodyempleados">
                <tr>
                    <td colspan="10"><center>Consultar Registros</center></td> 
            </tr>
            </tbody>
        </table>
    </div> 
</div> 


<form id="f10" method="post" action="<?php echo base_url("index.php/administrativo/creacionempleados") ?>">
    <input type="hidden" value="" name="emp_id" id="emp_id">
</form>
<script>
    $('#cedula').autocomplete({
        source: "<?php echo base_url("index.php/administrativo/autocompletarcedula") ?>",
        minLength: 3
    });
    $('#nombre').autocomplete({
        source: "<?php echo base_url("index.php/administrativo/autocompletarnombre") ?>",
        minLength: 3
    });
    $('#apellido').autocomplete({
        source: "<?php echo base_url("index.php/administrativo/autocompletarapellido") ?>",
        minLength: 3
    });


    $('body').delegate(".modificar", "click", function () {
        $("#emp_id").val($(this).attr("emp_id"));
        $("#f10").submit();
    });

    $('.limpiar').click(function () {
        $('select,input').val('');
    });
    $('.consultar').click(function () {
        $.post(
                "<?php echo base_url('index.php/administrativo/consultaempleados') ?>",
                $('#f2').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message)) alerta("rojo", msg['message']);
            else {
                $('#bodyempleados *').remove();
                var body = "";
                $.each(msg.Json, function (key, val) {
                    body += "<tr>";
                    body += "<td>" + val.Emp_Cedula + "</td>";
                    body += "<td>" + val.Emp_Nombre + "</td>";
                    body += "<td>" + val.Emp_Apellidos + "</td>";
                    body += "<td>" + val.Emp_Telefono + "</td>";
                    body += "<td>" + val.est_nombre + "</td>";
                    body += "<td>" + val.TipCon_Descripcion + "</td>";
                    body += "<td>" + val.car_nombre + "</td>";
                    body += "<td>" + val.Emp_FechaInicioContrato + "</td>";
                    body += "<td>" + val.Emp_FechaFinContrato + "</td>";
                    body += '<td class="transparent">\n\
                                <i class="fa fa-pencil-square-o fa-2x  modificar" aria-hidden="true" title="Modificar"  emp_id="' + val.Emp_Id + '"  data-toggle="modal" data-target="#myModal"></i>\n\
                                </td>';
                    body += '<td class="transparent">\n\
                                <i class="fa fa-trash-o fa-2x   eliminar" aria-hidden="true" title="Eliminar" tareas="' + val.tareas_emp + '" planes="' + val.planes_emp + '" emp_id="' + val.Emp_Id + '"></i>   \n\
                                </td>';
                    body += "</tr>";
                });
                $('#bodyempleados').append(body);
            }
        }).fail(function (msg) {
            alerta("rojo", "Error, por favor comunicarse con el administrador del sitema")
        });
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
            $.post("<?php echo base_url("index.php/administrativo/eliminarempleado") ?>"
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