<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url() . "/index.php/indicador/nuevoindicador" ?>"><div class="circuloIcon" title="Nuevo Indicador" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">VER INDICADORES</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form method="post" id="f4">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="">::Seleccionar::</option>
                        <?php foreach ($tipo as $ti) { ?>
                            <option value="<?php echo $ti->indTip_id ?>"><?php echo $ti->indTip_tipo ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="form-group">
                    <label for="dimensionUno"><?php echo $empresa[0]->Dim_id ?></label>
                    <select name="dimensionUno" id="dimensionUno" class="form-control">
                        <option value="">::Seleccionar::</option>
                        <?php foreach ($dimension as $d1) { ?>
                            <option value="<?php echo $d1->dim_id ?>"><?php echo $d1->dim_descripcion ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="form-group">
                    <label for="dimesionDos"><?php echo $empresa[0]->Dimdos_id ?></label>
                    <select name="dimesionDos" id="dimesionDos" class="form-control">
                        <option value="">::Seleccionar::</option>
                        <?php foreach ($dimension2 as $d2) { ?>
                            <option value="<?php echo $d2->dim_id ?>"><?php echo $d2->dim_descripcion ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="text-align: center">
                <div class="form-group">
                    <label>&nbsp;</label><button type="button" class="btn-sst" id="limpiar">Limpiar</button>
                    <label>&nbsp;</label><button type="button" class="btn-sst" id="consultar">Consultar</button>
                </div>
            </div>
        </div>
    </form>
    <hr>
    <div class="row" id="bodyIndicador">

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
        var datos = $("#f4").serialize();
        var url = "<?php echo base_url("index.php/indicador/consultarindicador") ?>";
        $.post(url, datos)
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
                                        <th style='width:15%'>Que miede</th>\n\
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
//                    
                    alerta("verde", "Exito al consultar");
                })
                .fail(function () {
                    alerta("rojo", "Error al consultar");
                });

    });
    $('body').delegate('.eliminar', 'click', function () {
        var url = "<?php echo base_url("index.php/Indicador/eliminar_Indicador") ?>";
        $.post(url, {ind_id: $(this).attr('ind_id')})
                .done(function () {
                    $('#consultar').trigger('click');
                })
                .fail(function () {
                    alerta('Error al eliminar el registro')
                })
    })
</script>