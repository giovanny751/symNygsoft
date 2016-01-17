<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url() . "/index.php/planes/nuevoplan" ?>"><div class="circuloIcon" title="Nuevo Plan" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">LISTADO PLANES</span>
        </div>
    </div>
</div>
<form method="post" id="f13" action="<?php echo base_url("index.php/planes/nuevoplan") ?>">
    <input type="hidden" name="pla_id" id="pla_id">
</form>
<div class="cuerpoContenido">
    <form method="post" id="f9">
        <div class="row">
            <div class="form-group">
                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1" for="nombre">Nombre</label>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><input type="text" id="nombre" name="nombre" class="form-control"></div>
                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1" for="estado">Estado</label>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <select id="estado" name="estado" class="form-control">
                        <option value="">::Seleccionar::</option>
                        <option value="1">Activos</option>
                        <option value="2">Inactivos</option>
                        <option value="3">Finalizados</option>
                    </select> 
                </div>
                <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1" for="responsable">Responsable</label>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <select id="responsable" name="responsable" class="form-control">
                        <option value="">::Seleccionar::</option>
                        <?php foreach ($responsable as $re) { ?>
                            <option value="<?php echo $re->Emp_Id ?>"><?php echo $re->Emp_Nombre . " " . $re->Emp_Apellidos ?></option>
                        <?php } ?>
                    </select> 
                </div>
                <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2" for="responsable">Tareas propias</label>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                    <input type="checkbox" name="tareapropia" id="tareapropia" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:right">
                <button id="consultar" class="btn-sst" type="button">Consultar</button>
            </div>
        </div>   
    </form>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="tablesst" id="sample_2">
                <thead>
                <th style="width: 20%">Nombre</th>
                <th style="width: 10%">Fecha inicio</th>
                <th style="width: 10%">Fecha fin</th>
                <th style="width: 10%">Fecha real</th>
                <th style="width: 20%">Responsable</th>
                <th style="width: 5%">Presupuesto</th>
                <th style="width: 10%">Descripción</th>
                <th style="width: 5%">Tareas propias</th>
                <th style="width: 10%">Editar</th>
                <th style="width: 10%">Eliminar</th>
                </thead>
                <tbody id="cargaplanes">
                    <tr class="odd gradeX">
                        <td colspan="9">
                <center>Consultar Registros</center>
                </td>
                </tr>
                </tbody>
            </table> 
        </div>    
    </div>
</div>
<script>


    $('body').delegate('.modificar', "click", function () {
        $('#pla_id').val($(this).attr('pla_id'));
        $('#f13').submit();
    });

    $('.limpiar').click(function () {
        $('select,input').val("");
    });

    $('#nombre').autocomplete({
        source: "<?php echo base_url("index.php/tareas/autocompletarresponsable") ?>",
        minLength: 3
    });

    $('#consultar').click(function () {
        $.post("<?php echo base_url("index.php/planes/consultaplanes") ?>",
                $('#f9').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                var body = "";
                $('#cargaplanes *').remove();
                $.each(msg.Json, function (key, val) {
                    body += "<tr class='odd gradeX'>";
                    body += "<td>" + val.pla_nombre + "</td>";
                    body += "<td style='text-align:center'>" + val.pla_fechaInicio + "</td>";
                    body += "<td style='text-align:center'>" + val.pla_fechaFin + "</td>";
                    body += "<td></td>";
                    body += "<td>" + val.Emp_Nombre + " " + val.Emp_Apellidos + "</td>";
                    if (val.tar_costopresupuestado != null)
                        var costopresupuesto = val.tar_costopresupuestado;
                    else
                        var costopresupuesto = 0;
                    body += "<td style='text-align:right'>" + num_miles(costopresupuesto) + "</td>";
                    body += "<td>" + val.pla_descripcion + "</td>";
                    body += "<td style='text-align:center'>" + val.num_tareas + "</td>";
                    body += '<td class="transparent" align="center">\n\
                        <i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar"  pla_id="' + val.pla_id + '"  data-toggle="modal" data-target="#myModal"></i>\n\
                    </td>';
                    body += '<td class="transparent" align="center">\n\
                        <i class="fa fa-trash-o fa-2x eliminar" title="Eliminar" coun="' + val.count_progreso + '" sum="' + val.sum_progreso + '" pla_id="' + val.pla_id + '"></i>\n\
                    </td>';
                    body += "</tr>";
                })
                $('#cargaplanes').append(body)
                alerta("verde", "Consulta exitosa");
            }
        })
                .fail(function (msg) {
                    alerta("rojo", "Error por favor comunicarse con el administrador");
                })
    });
    $('body').delegate('.eliminar', 'click', function () {
        var sum = $(this).attr('sum');
        var coun = $(this).attr('coun');
        if (coun != 0) {
            var result = (100 * coun);
            if (sum < result) {
                alerta('rojo', 'No se puede eliminar poque hay tareas pendientes');
                return false;
            }
        }
        var objeto = $(this);
        if (confirm("Esta seguro de eliminar el plan")) {
            $.post("<?php echo base_url("index.php/planes/eliminarplan") ?>"
                    , {
                        id: $(this).attr('pla_id')
                    }
            ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("amarillo", msg['message'])
                else {
                    objeto.parents('tr').remove();
                    alerta("verde", "Eliminado Correctamente");
                }
            }).fail(function (msg) {
                alerta("rojo", "Error en el sistema por favor verificar la conexion de internet");
            })
        }
    });
</script>