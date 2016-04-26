<br>
<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url() . "/index.php/indicador/nuevoindicador" ?>"><div class="circuloIcon" title="Nuevo Indicador" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> Ver Indicador
                </div> 
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form method="post" id="f4" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tipo" class="col-md-1">Tipo</label>
                                    <div class="col-md-3">
                                        <select name="tipo" id="tipo" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($tipo as $ti) { ?>
                                                <option value="<?php echo $ti->indTip_id ?>"><?php echo $ti->indTip_tipo ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label for="dimensionUno" class="col-md-1"><?php echo $empresa[0]->Dim_id ?></label>
                                    <div class="col-md-3">
                                        <select name="dimensionUno" id="dimensionUno" class="form-control dimencion_uno_se">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension as $d1) { ?>
                                                <option value="<?php echo $d1->dim_id ?>"><?php echo $d1->dim_descripcion ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label for="dimesionDos" class="col-md-1"><?php echo $empresa[0]->Dimdos_id ?></label>
                                    <div class="col-md-3">
                                        <select name="dimesionDos" id="dimesionDos" class="form-control dimencion_dos_se">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension2 as $d2) { ?>
                                                <option value="<?php echo $d2->dim_id ?>"><?php echo $d2->dim_descripcion ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-offset-8 col-md-4" style="text-align: right">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>&nbsp;</label><button type="button" class="btn-sst" id="limpiar">Limpiar</button>
                                        <label>&nbsp;</label><button type="button" class="btn-sst" id="consultar">Consultar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row" id="bodyIndicador">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" id="fEnvio" action="<?php echo base_url("index.php/indicador/nuevoindicador") ?>">
    <input type="hidden" name="ind_id" id="ind_id">
</form>
<script>
    $("body").on("click", ".modificar", function () {
        $('#ind_id').val($(this).attr('ind_id'));
        $('#fEnvio').submit();
    });
    $("body").on("click", "#limpiar", function () {
        $('select,input').val("");
    });
    $("body").on("click", "#consultar", function () {
        $.post(
                url + "index.php/indicador/consultarindicador", $("#f4").serialize()
                )
                .done(function (msg) {
                    $('#bodyIndicador *').remove();
                    var tbody = "";
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("amarillo", msg['message'])
                    else {
                        $.each(msg.Json, function (id, tipos) {
                            $.each(tipos, function (tipo, data) {
                                tbody += "<table class='tablesst'>\n\
                                        <thead style='text-align:center;'>\n\
                                        <tr>\n\
                                        <th colspan='10' style='width:20%'>" + tipo + "</th></tr>\n\
                                        <th style='width:15%'>Indicador</th>\n\
                                        <th style='width:8%'>Dimensión</th>\n\
                                        <th style='width:8%'>Dimensión 2</th>\n\
                                        <th style='width:15%'>Que mide</th>\n\
                                        <th style='width:6%'>Frecuencia</th>\n\
                                        <th style='width:4%'>Valor Mínimo</th>\n\
                                        <th style='width:4%'>Valor Máximo</th>\n\
                                        <th style='width:15%'>Responsable</th>\n\
                                        <th style='width:5%'>Editar</th></tr>\n\
                                    </thead>";
                                $.each(data, function (key, val) {
                                    tbody += "<tr>";
                                    tbody += "<td>" + val.ind_indicador + "</td>";
                                    tbody += "<td>" + val.dimuno + "</td>";
                                    tbody += "<td>" + val.dimdos + "</td>";
                                    tbody += "<td>" + val.ind_mide + "</td>";
                                    tbody += "<td>" + val.ind_frecuencia + "</td>";
                                    tbody += "<td style='text-align:center'>" + val.ind_minimo + "</td>";
                                    tbody += "<td style='text-align:center'>" + val.ind_maximo + "</td>";
                                    tbody += "<td>" + val.nombre + "</td>";
                                    tbody += '<td class="transparent">\n\
                                <i class="fa fa-pencil-square-o fa-2x modificar" title="Modificar" ind_id="' + val.ind_id + '"></i>\n\
                                <i class="fa fa-trash-o fa-2x eliminar" title="Eliminar" ind_id="' + val.ind_id + '"></i>\n\
</td>';
                                    tbody += "</tr>";
                                });
                                tbody += "</table>";
                            });
                        });
                    }
                    $('#bodyIndicador').append(tbody);
                })
                .fail(function () {
                    alerta("rojo", "Error al consultar");
                });

    });
    $('body').delegate('.eliminar', 'click', function () {
        $.post(url + "index.php/Indicador/eliminar_Indicador", {ind_id: $(this).attr('ind_id')})
                .done(function () {
                    $('#consultar').trigger('click');
                    alerta("verde","Eliminado correctamente")
                })
                .fail(function () {
                    alerta('Error al eliminar el registro')
                })
    })
</script>