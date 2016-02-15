<div class="row">
    <div class="col-md-6">
        <br>
        <a href="<?php echo base_url('index.php/administrativo/accidente ') ?>"><div title="Nuevo Accidente" class="circuloIcon"><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> Listado accidentes
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form method="post" id="f2" class="form-horizontal">
                        <div class="row">
                            <label for="empleado" class="control-label col-sm-2">Reporte</label>
                            <div class="col-sm-4">
                                <input type="text" name="reporte" id="reporte" class="form-control" />
                            </div>
                            <label for="empleado" class="control-label col-sm-2">Empelado</label>
                            <div class="col-sm-4">
                                <select name="empleado" id="empleado" class="form-control">
                                    <option value="" >::Seleccionar::</option>
                                    <?php foreach ($empleados as $empleado): ?>
                                        <option value="<?php echo $empleado->Emp_Id ?>"><?php echo $empleado->Emp_Nombre . " " . $empleado->Emp_Apellidos ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dimension1" class="control-label col-sm-2"><?php echo $empresa->Dim_id ?></label>
                            <div class="col-sm-4">
                                <select name="dimension1" id="dimension1" class="form-control dimencion_uno_se">
                                    <option value="" >::Seleccionar::</option>
                                    <?php foreach ($dimension1 as $dimension1): ?>
                                        <option value="<?php echo $dimension1->dim_id ?>"><?php echo $dimension1->dim_descripcion ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <label for="dimension2" class="control-label col-sm-2"><?php echo $empresa->Dimdos_id ?></label>
                            <div class="col-sm-4">
                                <select name="dimension2" id="dimension2" class="form-control dimencion_dos_se">
                                    <option value="" >::Seleccionar::</option>
                                    <?php foreach ($dimension2 as $dim2): ?>
                                        <option value="<?php echo $dim2->dim_id ?>"><?php echo $dim2->dim_descripcion ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zona" class="control-label col-sm-2">Zona</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="zona" id="zona" />
                            </div>
                            <label for="lugar" class="control-label col-sm-2">Lugar</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="lugar" id="lugar" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="fInicial" class="control-label col-sm-2">Fecha Inicial Accidente</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control fecha" name="fInicial" id="fInicial" />
                            </div>
                            <label for="fFinal" class="control-label col-sm-2">Fecha Final Accidente</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control fecha" name="fFinal" id="fFinal" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fCreacion" class="control-label col-sm-2">Fecha Creación</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control fecha" name="fCreacion" id="fCreacion" />
                            </div>
                            <label for="fCreacion" class="control-label col-sm-2">Incapacidad</label>
                            <div class="col-sm-4">
                                <select name="incapacidad" id="incapacidad" class="form-control">
                                    <option value="">::Seleccionar::</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: right">
                                <input type="reset" value="Limpiar" class="btn-sst" />
                                <label>&nbsp;</label><button type="button" class="btn-sst" id="consultar">Consultar</button>
                            </div>
                        </div>
                    </form>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <table id="tablesst" class="table table-striped table-bordered table-hover ">
                                <thead>
                                <th>Reporte N°</th>
                                <th>Empleado</th>
                                <th>Zona</th>
                                <th>Lugar</th>
                                <th><?php echo $empresa->Dim_id; ?></th>
                                <th><?php echo $empresa->Dimdos_id; ?></th>
                                <th>Lugar del accidente</th>
                                <th>Fecha Accidente</th>
                                <th>Accidente Reportado</th>
                                <th>Fecha Creación</th>
                                <th>Incapacidad</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                </thead>
                                <tbody id="bodyaccidente">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" id="frmAccidente">
    <input type="hidden" name="accidente" id="accidente">
</form>

<script>

    $(function () {
        table = $('#tablesst').DataTable();
        $("body").on("click", "#consultar", function () {
            var datos = $("#f2").serialize();
            $.post(
                    url + "index.php/Administrativo/filtroaccidente", datos)
                    .done(function (msg) {
                        var html = ""
                        $("#bodyaccidente").empty();
                        if (typeof (msg.message) != "undefined") {
                            alerta("rojo", "Error al momento de ingresar datos");
                        } else {
                            table.clear();
                            $.each(msg['Json'], function (key, valor) {
                                table.row.add([
                                    valor.accidente,
                                    valor.empleado,
                                    valor.zona,
                                    valor.lugar,
                                    valor.dimension1,
                                    ((valor.dimension2 == null) ? "" : valor.dimension2),
                                    valor.lugarAccidente,
                                    valor.fechaAccidente,
                                    valor.reportado,
                                    valor.fCreacion,
                                    ((valor.incapacidad == 1) ? "<i class='fa fa-check fa-2x' style='color:#32B512'></i>" : "<i class='fa fa-times fa-2x' style='color:#C23F44'></i>"),
                                    "<i class='fa fa-pencil-square-o fa-2x  modificar' accidente='" + valor.accidente + "'></i>",
                                    "<i class='fa fa-trash-o fa-2x eliminarAccidente'></i>"
                                ]).draw();
                            });

                        }
                    })
                    .fail(function () {
                        alerta("rojo", "Error")
                    });
        });
    })

    $("body").on("click", ".modificar", function () {
        var accidente = $(this).attr("accidente");
        if (accidente != "") {
            document.getElementById("accidente").value = accidente;
            var formulario = document.getElementById("frmAccidente");
            formulario.method = "post";
            formulario.action = url + "index.php/administrativo/accidente";
            formulario.submit();
        } else {
            return false
        }
    });
</script>