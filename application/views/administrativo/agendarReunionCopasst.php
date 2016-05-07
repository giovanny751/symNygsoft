<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Agendamiento reunión Copasst
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form method="post" id="frmReunion" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12"><a href="<?php echo base_url("uploads/sgsst/FormatodeActadeReunióndelCOPASST.docx") ?>"><i class="fa fa-archive"></i>&nbsp;Descargar formato de reunión copasst</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4">Fecha</label>
                                        <div class="col-md-8">
                                            <input type="text" class="fecha form-control" name="fecha" id="fecha">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4">Hora inicial</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control timepicker timepicker-no-seconds" name="fecha" id="fecha">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4">Hora final</label>
                                        <div class="col-md-8">
                                            <input class="form-control timepicker timepicker-no-seconds" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4">Responsable</label>
                                        <div class="col-md-8" id="selectResponsable">
                                            <select name="responsable" id="responsable" class="form-control responsable">
                                                <option value="">::Seleccionar::</option>
                                                <?php foreach ($empleados as $e): ?>
                                                    <option value="<?php echo $e->Emp_id ?>"><?php echo $e->Emp_Nombre . " " . $e->Emp_Apellidos ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-md-4">Agenda</label>
                                        <div class="col-md-8">
                                            <select name="agenda[]" id="agenda" class="form-control" multiple>
                                                <?php foreach ($agenda as $a): ?>
                                                    <option value="<?php echo $a->ageCom_id ?>"><?php echo $a->ageCom_agenda ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label class="col-md-4">Estado</label>
                                        <div class="col-md-8" id="selectResponsable">
                                            <select name="responsable" id="responsable" class="form-control responsable">
                                                <option value="">::Seleccionar::</option>
                                                <?php foreach ($estado as $est): ?>
                                                    <option value="<?php echo $est->est_id ?>"><?php echo $est->est_nombre ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4 fechaProxima">
                                    <div class="form-group">
                                        <label class="col-md-4"><span>*</span>Fecha proxima reunión</label>
                                        <div class="col-md-8">
                                            <input type="text" name="fechaProximaReunion" id="fechaProximaReunion"  class="form-control obligatorio">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="agregar" class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <th style="width: 15%">¿Pertenece a la compañia?</th>
                                    <th style="width: 40%">Persona</th>
                                    <th style="width: 40%">Correo</th>
                                    <th style="width: 5%">Eliminar</th>
                                    </thead>
                                    <tbody id="cuerpoTablaComite">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-md-2">Observaciones</label>
                                <div class="col-md-10">
                                    <textarea name="observacion" class="form-control" id="observacion"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.fechaProxima').hide();
    var responsable = $('#selectResponsable').html();

    $('#agregar').click(function () {
        var table = "<tr>";
        table += "<td><select name='compania' class='form-control integrante'><option value=''>::Seleccionar::</option><option value='1'>Si</option><option value='2'>No</option></select></td>";
        table += "<td class='persona'></td>";
        table += "<td class='correo'></td>";
        table += "<td class='eliminar' style='text-align:center;cursor:pointer'><i class='fa fa-remove fa-2x; eliminar'></i></td>";
        table += "</tr>";
        $('#cuerpoTablaComite').append(table);
    })

    $('body').delegate('.eliminar', 'click', function () {
        $(this).parents("tr").remove();
    });

    $('body').delegate('.integrante', 'change', function () {
        $(this).parents('td').siblings('.persona').children("input,select").remove();
        $(this).parents('td').siblings('.correo').children("input,select").remove();
        if ($(this).val() == 1) {
            $(this).parents('td').siblings('.persona').append(responsable);
            $(this).parents('td').siblings('.correo').append('<input type="text" name="correo[]" class="form-control">');
        }
        if ($(this).val() == 2) {
            $(this).parents('td').siblings('.persona').append('<input type="text" name="persona[]" class="form-control">');
            $(this).parents('td').siblings('.correo').append('<input type="text" name="correo[]" class="form-control">');
        }
    });

    $('body').delegate('.table tbody tr td .responsable', "change", function () {
        var empId = $(this).val();
        var apuntador = $(this);
        if (empId != "") {
            $.post(
                    url + "index.php/administrativo/consultaCorreo",
                    {
                        empId: empId
                    }
            ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("amarillo", msg['message']);
                else {
                    apuntador.parents('td').siblings('.correo').children('input').val(msg.Json.Emp_Email)
                }
            })
                    .fail(function (msg) {
                        alerta("rojo", "Error intente mas tarde");
                    });
        }
    });

    $('#agenda').change(function () {
        var index = $(this).val();
        if (index.indexOf("5") < 0) {
            $('.fechaProxima').hide('slow');
        } else {
            $('.fechaProxima').show('slow');
        }
    });


</script>