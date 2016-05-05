<div class="row">
    <div class="col-md-6">
        <br>
        <a href="<?php echo base_url() . "/index.php/planes/nuevoplan" ?>"><div class="circuloIcon" title="Nuevo Plan" ><i class="fa fa-folder-open fa-3x"></i></div></a>
        <br>
    </div>
    <br>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> Listado Planes
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <form method="post" id="f13" action="<?php echo base_url("index.php/planes/nuevoplan") ?>">
                <input type="hidden" name="pla_id" id="pla_id">
            </form>
            <div class="portlet-body form">
                <div class="form-body">
                    <form method="post" id="f9" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 " for="nombre">Nombre</label>
                                    <div class="col-md-8">
                                        <input type="text" id="nombre" name="nombre" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 " for="estado">Estado</label>
                                    <div class="col-md-8">
                                        <select id="estado" name="estado" class="form-control select2me">
                                            <option value="">::Seleccionar::</option>
                                            <option value="1">Activos</option>
                                            <option value="2">Inactivos</option>
                                            <option value="3">Finalizados</option>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 " for="responsable">Responsable</label>
                                    <div class="col-md-8">
                                        <select id="responsable" name="responsable" class="form-control select2me">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($responsable as $re) { ?>
                                                <option value="<?php echo $re->Emp_Id ?>"><?php echo $re->Emp_Nombre . " " . $re->Emp_Apellidos ?></option>
                                            <?php } ?>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-md-8 " for="responsable">Tareas propias</label>
                                    <div class="col-md-4">
                                        <input type="checkbox" name="tareapropia" id="tareapropia">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                                <button id="consultar" class="btn btn-block" type="button">Consultar</button>
                            </div>
                        </div>   
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover tabla-sst" id="sample_2">
                                <thead>
                                <th style="width: 20%">Nombre</th>
                                <th style="width: 10%">Fecha inicio</th>
                                <th style="width: 10%">Fecha fin</th>
                                <th style="width: 10%">Fecha real</th>
                                <th style="width: 20%">Responsable</th>
                                <th style="width: 5%">Presupuesto</th>
                                <th style="width: 10%">Descripción</th>
                                <th style="width: 5%">Tareas</th>
                                <th style="width: 10%">Editar</th>
                                <th style="width: 10%">Eliminar</th>
                                </thead>
                                <tbody id="cargaplanes">
                                </tbody>
                            </table> 
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--</div>-->
</div>
<div class="modal fade" id="myModalDescripcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Descripción</h4>
            </div>
            <div class="modal-body" id="incluiraseguradoras">
                <div id="agregarClones">
                    <textarea id="descripcion" class="form-control" readonly="readonly"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
            </div>
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
        source: url + "index.php/tareas/autocompletarresponsable",
        minLength: 3
    });

    $('#consultar').click(function () {
        $.post(
                url + "index.php/planes/consultaplanes",
                $('#f9').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                var body = "";
                $('#cargaplanes *').remove();
                $.each(msg.Json, function (key, val) {

                    var costopresupuesto = 0;
                    if (val.tar_costopresupuestado != null)
                        costopresupuesto = val.tar_costopresupuestado;

                    var table = $('#sample_2').DataTable();
                    table.row.add([
                        val.pla_nombre,
                        val.pla_fechaInicio,
                        val.pla_fechaFin,
                        '',
                        val.Emp_Nombre + " " + val.Emp_Apellidos,
                        num_miles(costopresupuesto),
                        '<center><i class="fa fa-pencil-square-o fa-2x descripcion" title="Modificar"  pla_id="' + val.pla_id + '"  data-toggle="modal" data-target="#myModalDescripcion"></i></center>',
                        val.num_tareas,
                        '<center><i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar"  pla_id="' + val.pla_id + '"  data-toggle="modal" data-target="#myModal"></i></center>',
                        '<center><i class="fa fa-trash-o fa-2x eliminar" title="Eliminar" coun="' + val.count_progreso + '" sum="' + val.sum_progreso + '" pla_id="' + val.pla_id + '"></i></center>'
                    ]).draw();


                })
//                $('#cargaplanes').append(body)
//                alerta("verde", "Consulta exitosa");
            }
        })
                .fail(function (msg) {
                    alerta("rojo", "Error por favor comunicarse con el administrador");
                })
    });
    $('body').delegate(".descripcion", "click", function () {
        $('#descripcion').val('');
        $.post(
                url + "index.php/planes/consultaDescripcion",
                {pla_id: $(this).attr("pla_id")}
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                $('#descripcion').val(msg.Json);
                $("#myModalDescripcion").modal("show");
            }
        }).fail(function (msg) {

        });
    });
    $('body').delegate('.eliminar', 'click', function () {
        var sum = $(this).attr('sum');
        var coun = $(this).attr('coun');
        var enumeracion = "";
        if (coun != 0) {
            var result = (100 * coun);
            if (sum < result) {
                enumeracion = 1;
            }
        }
        var objeto = $(this);
        if (enumeracion == 1)
            var confirmacion = confirm("El plan tiene tareas asignadas ¿esta seguro de eliminarlo? - Se eliminaran las tareas asignadas al plan");
        else
            var confirmacion = confirm("¿Esta seguro de eliminar el plan?");
        if (confirmacion) {
            $.post(
                    url + "index.php/planes/eliminarplan"
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