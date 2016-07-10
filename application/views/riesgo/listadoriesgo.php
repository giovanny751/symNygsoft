<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>LISTADO RIESGO
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
                            <a href="<?php echo base_url() . "/index.php/riesgo/nuevoriesgo" ?>"><div class="circuloIcon" title="Nuevo Riesgo" ><i class="fa fa-folder-open fa-3x"></i></div></a>
                            <hr>
                        </div>
                    </div>
                    <form method="post" id="busquedariesgo" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="categoria" class="col-md-1 control-label">Categoría</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="categoria" id="categoria">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($categoria as $ca): ?>
                                                <option value="<?php echo $ca->rieCla_id ?>"><?php echo $ca->rieCla_categoria ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label for="tipo" class="col-md-1 control-label">Tipo</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="tipo" id="tipo" >
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div> 
                                    <label for="dimensionuno" class="col-md-1 control-label"><?php echo $empresa[0]->Dim_id ?></label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="dimensionuno" id="dimensionuno" >
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension as $d1) { ?>
                                                <option value="<?php echo $d1->dim_id ?>"><?php echo $d1->dim_descripcion ?></option>
                                            <?php } ?>
                                        </select>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dimensiondos" class="col-md-1 control-label"><?php echo $empresa[0]->Dimdos_id ?></label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="dimensiondos" id="dimensiondos" >
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension2 as $d2) { ?>
                                                <option value="<?php echo $d2->dim_id ?>"><?php echo $d2->dim_descripcion ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label for="cargo" class="col-md-1 control-label">Cargo</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="cargo" id="cargo">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($cargo as $c) { ?>
                                                <option value="<?php echo $c->car_id ?>"><?php echo $c->car_nombre ?></option> 
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4" style="text-align: center">
                                        <button type="button" class="btn btn-danger limpiar" >Limpiar</button>
                                        <button type="button" class="btn btn-info" >Consultar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="bodyRiesgo"></div>
<form method="post" id="f13" action="<?php echo base_url("index.php/riesgo/nuevoriesgo") ?>">
    <input type="hidden" name="rie_id" id="rie_id">
</form>
</div>
<!-- Modal -->
<div class="modal fade" id="modalCargos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">CARGOS</h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="cargosMultiple" class="col-md-offset-2 col-md-2 control-label">Cargos</label>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <select name="cargosMultiple" class="form-control" disabled="disabled" multiple="multiple" id="cargosMultiple">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Modal -->
<script>
    $("body").on("click", ".cargoMultiple", function () {
        var rie_id = $(this).attr("rie_id");
        $.post(
                url + "index.php/riesgo/listadoriesgocargos",
                {rie_id: rie_id})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message']);
                    else {
                        $("#cargosMultiple").html("");
                        var option = "";
                        $.each(msg.Json, function (index, value) {
                            option += "<option value=''>" + value.car_nombre + "</option>"
                        });
                        $("#cargosMultiple").html(option);
                        $("#modalCargos").modal("toggle");
                    }
                })
                .fail(function () {
                    alerta("rojo", "Error alistar cargos")
                })
    });
    $('body').delegate('.modificar', "click", function () {
        $('#rie_id').val($(this).attr('rie_id'));
        $('#f13').submit();
    });
    $('#categoria').change(function () {
        $.post(
                url + "index.php/riesgo/consultatiporiesgo",
                {categoria: $(this).val()})
                .done(function (msg) {
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
    $(".limpiar").click(function () {
        $("select, input").val("");
    });

    $('.buscar').click(function () {

        $.post(
                url + "index.php/riesgo/busquedariesgo",
                $('#busquedariesgo').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message'])
            else {
                $('#bodyRiesgo *').remove();
                var tbody = "";
                $.each(msg.Json, function (id, tipos) {
                    $.each(tipos, function (tipo, data) {
                        tbody += "<table class='tablesst'>\n\
                                        <thead style='text-align:center;'>\n\
                                        <tr><th colspan='11'>" + tipo + "</th></tr>\n\
                                        <tr>\n\
                                        <th width='15%'>Tipo</th>\n\
                                        <th width='14%'>Descripción</th>\n\
                                        <th width='9%'><?php echo $empresa[0]->Dim_id ?></th>\n\
                                        <th width='10%'><?php echo $empresa[0]->Dimdos_id ?></th>\n\
                                        <th width='6%'>Lugar/Zona</th>\n\
                                        <th width='12%'>Actividades</th>\n\
                                        <th width='5%'>Cargo</th>\n\
                                        <th width='7%'>Fecha Creación</th>\n\
                                        <th width='8%'>Estado de aceptación</th>\n\
                                        <th width='8%'>Tareas(activas)</th>\n\
                                        <th width='7%'>Accion</th></tr>\n\
                                    </thead>";
                        $.each(data, function (key, val) {
                            tbody += "<tr>";
                            tbody += "<td >" + (val.rieClaTip_tipo != null ? val.rieClaTip_tipo : '') + "</td>";
                            tbody += "<td >" + (val.rie_descripcion != null ? val.rie_descripcion : '') + "</td>";
                            tbody += "<td >" + (val.des1 != null ? val.des1 : '') + "</td>";
                            tbody += "<td >" + (val.des2 != null ? val.des2 : '') + "</td>";
                            tbody += "<td >" + (val.rie_zona != null ? val.rie_zona : '') + "</td>";
                            tbody += "<td >" + (val.rie_actividad != null ? val.rie_actividad : '') + "</td>";
                            tbody += "<td class='transparent' style='background-color:" + val.rieCol_colorhtml + "'>\n\
                                            <i class='fa fa-street-view fa-2x cargoMultiple' title='Cargos' rie_id='" + val.rie_id + "' ></i>\n\
                                    </td>"; //Cargos
                            tbody += "<td >" + (val.rie_fecha != null ? val.rie_fecha : '') + "</td>";
                            tbody += "<td style='background-color:" + val.nivRie_color + "'>" + (val.estadoAceptacion != null ? val.estadoAceptacion : '') + "</td>";
                            tbody += "<td ></td>";
                            tbody += '<td class="transparent" >\n\
                                            <i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar" rie_id="' + val.rie_id + '" ></i>\n\
                                            <i class="fa fa-trash-o fa-2x eliminar" title="Eliminar" rie_id="' + val.rie_id + '" ></i>\n\
                                        </td>';
                            tbody += "</tr>";
                        });
                        tbody += "</table>";
                    });
                });
                $('#bodyRiesgo').append(tbody);
                alerta("verde", "Consulta cargada con exito");
            }
        }).fail(function (msg) {
            alerta("rojo", "Error en el sistema por favor comunicarse con el administrador");
        });

    });

    $('body').delegate('.eliminar', 'click', function () {
        $.post(url + "index.php/riesgo/eliminar_riesgos",
                {rie_id: $(this).attr('rie_id')})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        $('.buscar').trigger('click');
                    }
                })
                .fail(function (msg) {
                    alerta('Error al eliminar el registro');
                })
    })
</script>    