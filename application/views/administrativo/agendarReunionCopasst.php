<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-support"></i>Agendamiento reunión Copasst
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
                                <br>
                                <?php if (!empty($empleado[0]->Emp_Id)) { ?>
                                    <div class="circuloIcon" id="actualizar" title="Actualizar Reunión"><i class="fa fa-floppy-o fa-3x"></i></div>
                                <?php } else { ?>
                                    <div class="circuloIcon" id="guardar" title="Guardar Reunion"><i class="fa fa-floppy-o fa-3x"></i></div>
                                <?php } ?>
                                <a href="<?php echo base_url() . "index.php/administrativo/creacionempleados" ?>">
                                    <div class="circuloIcon" title="Nueva reunión" ><i class="fa fa-folder-open fa-3x"></i></div>
                                </a>
                                <a href="<?php echo base_url("index.php/administrativo/listadoempleados"); ?>">
                                    <div class="circuloIcon" title="Listado reuniones Copasst"><i class="fa fa-sticky-note fa-2x"></i></div>
                                </a>
                                <hr>
                            </div>
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
                                <div class="form-group">
                                    <label class="col-md-1" for="nombreReunion"><span>*</span>Nombre</label>
                                    <div class="col-md-11">
                                        <input type="text" class="fecha form-control obligatorio" name="nombreReunion" id="nombreReunion">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-1" for="fechaReunion"><span>*</span>Fecha</label>
                                    <div class="col-md-3">
                                        <input type="text" class="fecha form-control obligatorio" name="fechaReunion" id="fechaReunion">
                                    </div>
                                    <label class="col-md-1" for="horaInicial"><span>*</span>Hora inicial</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control timepicker timepicker-no-seconds obligatorio" name="horaInicial" id="horaInicial">
                                    </div>
                                    <label class="col-md-1" for="horaFinal"><span>*</span>Hora final</label>
                                    <div class="col-md-3">
                                        <input class="form-control timepicker timepicker-no-seconds obligatorio" name="horaFinal" id="horaFinal" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-1" for="responsable"><span>*</span>Responsable</label>
                                    <div class="col-md-3" id="selectResponsable">
                                        <select name="responsable" id="responsable" class="form-control responsable obligatorio">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($empleados as $e): ?>
                                                <option value="<?php echo $e->Emp_id ?>"><?php echo $e->Emp_Nombre . " " . $e->Emp_Apellidos ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-1" for="agenda"><span>*</span>Agenda comite</label>
                                    <div class="col-md-3">
                                        <select name="agenda[]" id="agenda" class="form-control obligatorio" multiple>
                                            <?php foreach ($agenda as $a): ?>
                                                <option value="<?php echo $a->ageCom_id ?>"><?php echo $a->ageCom_agenda ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label class="col-md-1" for="estadoReunion"><span>*</span>Estado</label>
                                    <div class="col-md-3" id="selectResponsable">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4 fechaProxima">
                                    <div class="form-group">
                                        <label class="col-md-4" for="fechaProximaReunion"><span>*</span>Fecha proxima reunión</label>
                                        <div class="col-md-8">
                                            <input type="text" name="fechaProximaReunion" id="fechaProximaReunion"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 fechaProxima">
                                    <div class="form-group">
                                        <label class="col-md-4" for="horaInicialProximaReunion">Hora Inicial proxima reunión</label>
                                        <div class="col-md-8">
                                            <input type="text" name="horaInicialProximaReunion" id="horaInicialProximaReunion"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 fechaProxima">
                                    <div class="form-group">
                                        <label class="col-md-4" for="horaFinalProximaReunion">Hora Final proxima reunión</label>
                                        <div class="col-md-8">
                                            <input type="text" name="horaFinalProximaReunion" id="horaFinalProximaReunion"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4 reunionesAnteriores">
                                    <div class="form-group">
                                        <label class="col-md-4" for="reunionAnterior"><span>*</span>Reuniones anteriores</label>
                                        <div class="col-md-8">
                                            <select name="reunionAnterior" id="reunionAnterior" class="form-control">

                                            </select>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="agregar" class="btn btn-success"><i class="fa fa-user-plus"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <th style="width: 15%;text-align: center">¿Pertenece a la compañia?</th>
                                        <th style="width: 40%;text-align: center">Persona</th>
                                        <th style="width: 20%;text-align: center">Cédula</th>
                                        <th style="width: 20%;text-align: center">Correo</th>
                                        <th style="width: 5%;text-align: center">Eliminar</th>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('#guardar').click(function () {
        if (obligatorio('obligatorio')) {
            $.post(url + "index.php/administrativo/guardarReunionCopasst",
                    $('#frmReunion').serialize())
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta(msg.color, msg['message'])
                        else {

                        }
                    }).fail(function (msg) {

            });
        }
    });

    $('.fechaProxima').hide();
    $('.reunionesAnteriores').hide();
    var responsable = $('#selectResponsable').html();

    $('#agregar').click(function () {
        var table = "<tr>";
        table += "<td><select name='compania[]' class='form-control integrante'><option value=''>::Seleccionar::</option><option value='1'>Si</option><option value='2'>No</option></select></td>";
        table += "<td class='persona'></td>";
        table += "<td class='cedula'></td>";
        table += "<td class='correo'></td>";
        table += "<td class='eliminar' style='text-align:center;cursor:pointer'><button type='button' class='btn btn-danger'><i class='fa fa-remove fa-2x eliminar'></i></button></td>";
        table += "</tr>";
        $('#cuerpoTablaComite').append(table);
    })

    $('body').delegate('.eliminar', 'click', function () {
        $(this).parents("tr").remove();
    });

    $('body').delegate('.integrante', 'change', function () {
        $(this).parents('td').siblings('.persona').children("input,select").remove();
        $(this).parents('td').siblings('.correo').children("input,select").remove();
        $(this).parents('td').siblings('.cedula').children("input,select").remove();
        if ($(this).val() == 1) {
            $(this).parents('td').siblings('.persona').append(responsable);
            $(this).parents('td').siblings('.cedula').append('<input type="text" name="cedula[]" readonly="" class="form-control">');
            $(this).parents('td').siblings('.correo').append('<input type="text" name="correo[]"   class="form-control">');
        }
        if ($(this).val() == 2) {
            $(this).parents('td').siblings('.persona').append('<input type="text" name="participantes[]" class="form-control">');
            $(this).parents('td').siblings('.cedula').append('<input type="text" name="cedula[]"  class="form-control">');
            $(this).parents('td').siblings('.correo').append('<input type="text" name="correo[]"  class="form-control">');
        }
        $('#cuerpoTablaComite').find('input[name="responsable"],select[name="responsable"]').attr("name", 'participantes[]');
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
                    apuntador.parents('td').siblings('.cedula').children('input').val(msg.Json.Emp_Cedula)
                }
            })
                    .fail(function (msg) {
                        alerta("rojo", "Error intente mas tarde");
                    });
        }
    });

    $('#agenda').change(function () {

        var index = $(this).val();
        $('#reunionAnterior *').remove();


        if (index.indexOf("1") == 0) {
            $('.reunionesAnteriores').show('slow');
            $.post(
                    url + "index.php/administrativo/reunionesAnterioresCopasst"
                    ).done(function (msg) {
                if (!jQuery.isEmptyObject(msg.message))
                    alerta("amarillo", msg['message']);
                else {
                    var option = "<option value=''>::Seleccionar::</option>";

                    $.each(msg.Json, function (key, val) {
                        option += "<option value='" + val.copReu_id + "'>" + val.copReu_nombre + "</option>"
                    })

                    $('#reunionAnterior').append(option);
                }
            })
                    .fail(function (msg) {
                        alerta("rojo", "Error intente mas tarde");
                    });
        } else {
            $('.reunionesAnteriores').hide('slow');
        }

        if (index.indexOf("5") < 0) {
            $('#fechaProximaReunion').removeClass("obligatorio");
            $('.fechaProxima').hide('slow');
        } else {
            $('#fechaProximaReunion').addClass("obligatorio");
            $('.fechaProxima').show('slow');
        }
    });


</script>