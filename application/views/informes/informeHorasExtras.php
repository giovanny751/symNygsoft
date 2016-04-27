<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>INFORME HORAS EXTRAS
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" id="frmHorasExtras" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-2">Empleado</label>
                                    <div class="col-md-2">
                                        <select name="empleado" class="form-control fecha" id="empleado">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($empleado as $emp): ?>
                                                <option value="<?php echo $emp->Emp_id ?>"><?php echo $emp->Emp_Nombre . " " . $emp->Emp_Apellidos ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-2">Fecha Desde</label>
                                    <div class="col-md-2"><input type="text" name="fechaDesde" class="form-control fecha" id="fechaDesde"/></div>
                                    <label class="col-md-2">Fecha Hasta</label>
                                    <div class="col-md-2"><input type="text" name="fechaHasta" class="form-control fecha" id="fechahasta"/></div>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <div class="col-md-offset-10 col-md-2">
                                        <button type="button" id="consultar" class="btn btn-success">Consultar</button>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <th>Empleado</th>
                                    <th>Fecha</th>
                                    <th>Cantidad de horas</th>
                                    <th>Tipo hora</th>
                                    </thead>
                                    <tbody id="cuerpoInforme">

                                    </tbody>
                                </table>
                            </div>    
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#consultar').click(function () {
        $.post(
                url + "index.php/Informes/consultaInformeHorasExtras",
                $('#frmHorasExtras').serialize()
                ).done(function (msg) {
            $('#cuerpoInforme *').remove();
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message']);
            else {
                var horas = "";
                var cantidad = 1;
                var total = 0;
                $.each(msg.Json, function (key, val) {
                    total += parseFloat(val.empHorExt_horas);
                    horas += "<tr>";
                    horas += "<td>" + val.Emp_Nombre + " " + val.Emp_Apellidos + "</td>";
                    horas += "<td>" + val.empHorExt_fecha + "</td>";
                    horas += "<td style='text-align:center'>" + val.empHorExt_horas + "</td>";
                    horas += "<td>" + val.horExtTip_tipo + "</td>";
                    horas += "</tr>";
                });
                horas += "<tr style='background-color:blue;color:white'>";
                horas += "<td Colspan='2' style='text-align:right'><b>TOTAL</b></td>";
                horas += "<td style='text-align:center'><b>"+total+"</b></td>";
                horas += "<td></td>";
                horas += "</tr>";
                $('#cuerpoInforme').append(horas);
            }
        }).fail(function (msg) {

        });
    });
</script>