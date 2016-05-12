<br>
<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url() . "index.php/administrativo/agendarReunionCopasst" ?>"><div class="circuloIcon" title="Nuevo Usuario" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> Lista reuniones COPASST
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form method="post" class="form-horizontal" id="frmListadoCopasst">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4" for="">Reunión</label>
                                        <div class="col-md-8">
                                            <input type="text" name="reunión" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4" for="fechaDesde">Fecha desde</label>
                                        <div class="col-md-8">
                                            <input type="text" name="fechaDesde" id="fechaDesde" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4" for="fechaHasta">Fecha hasta</label>
                                        <div class="col-md-8">
                                            <input type="text" name="fechaHasta" id="fechaHasta" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4" for="responsable">Responsable</label>
                                        <div class="col-md-8">
                                            <input type="text" name="responsable" id="responsable" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4" for="">Revisión en el comite</label>
                                        <div class="col-md-8">
                                            <select name="agenda[]" id="agenda" class="form-control obligatorio" multiple>
                                                <?php foreach ($agenda as $a): ?>
                                                    <option value="<?php echo $a->ageCom_id ?>"><?php echo $a->ageCom_agenda ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4" for="">Estado</label>
                                        <div class="col-md-8">
                                            <select name="estadoReunion" id="estadoReunion" class="form-control responsable obligatorio">
                                                <option value="">::Seleccionar::</option>
                                                <?php foreach ($estado as $est): ?>
                                                    <option value="<?php echo $est->est_id ?>"><?php echo $est->est_nombre ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-offset-10 col-md-2">
                                    <button type="button" class="btn btn-success" id="consultar">Consultar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tablesst" class="table table-striped table-bordered table-hover tabla-sst">
                                <thead>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Hora Inicial</th>
                                <th style="text-align: center">Hora Final</th>
                                <th style="text-align: center">Responsable</th>
                                <th style="text-align: center">Revisión en el comite</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Eliminar</th>
                                <th style="text-align: center">Modificar</th>
                                </thead>
                                <tbody>

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
                url + "index.php/administrativo/consultaCopasst",
                $("#frmListadoCopasst").serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta(msg.color, msg['message'])
            else {
                var table = $('#tablesst').DataTable();
                    table.clear().draw();
                    $.each(msg['Json'], function (key, val) {
                        var agenda = val.agenda.split(",");
                        var ul = "<ul>"
                        $.each(agenda,function(key,val){
                            ul +="<li>"+val+"</li>"
                        })
                        ul + "</ul>";
                        
                        table.row.add([
                            val.copReu_fecha,
                            val.copReu_horaInicial,
                            val.copReu_horaFinal,
                            val.Emp_Nombre+" "+val.Emp_Apellidos,
                            ul,
                            val.est_nombre,
                            '<i class="fa fa-trash-o fa-2x   eliminar" aria-hidden="true" title="Eliminar" tareas="' + val.tareas_emp + '" planes="' + val.planes_emp + '" emp_id="' + val.Emp_Id + '"></i>',
                            '<i class="fa fa-pencil-square-o fa-2x  modificar" aria-hidden="true" title="Modificar"  emp_id="' + val.Emp_Id + '" ></i>'
                        ]).draw();
                    });
            }
        }).fail(function (msg) {

        });
    });
</script>