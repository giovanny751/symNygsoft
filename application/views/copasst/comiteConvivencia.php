<div class="row">
    <div class="col-md-6">
        <br>
        <div class="circuloIcon" id="guardar" title="guardarComite">
            <i class="fa fa-floppy-o fa-3x"></i>
        </div>
        <a href="<?php echo base_url() . "index.php/administrativo/creacionempleados" ?>">
            <div class="circuloIcon" title="Nuevo Comite" ><i class="fa fa-folder-open fa-3x"></i></div>
        </a>
        <a href="<?php echo base_url("index.php/administrativo/listadoempleados"); ?>">
            <div class="circuloIcon" title="Comites creados"><i class="fa fa-sticky-note fa-2x"></i></div>
        </a>
        <br>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-table"></i>ACTA DE REUNIÓN DEL COMITÉ DE CONVIVENCIA LABORAL
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="Abrir/Cerrar"></a>
                    <a href="javascript:;" class="reload" data-original-title="Recargar"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <form class="form-horizontal">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-1">Tema</label>
                                    <div class="col-md-3">
                                        <input type="text" name="tema" id="tema" class="form-control">
                                    </div>
                                    <label class="col-md-1" for="dim1"><?php echo $empresa[0]->Dim_id ?></label>
                                    <div class="col-md-3">
                                        <select id="dimension1" name="dimension1" class="form-control dimencion_uno_se">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach ($dimension as $d) { ?>
                                                <option  <?php echo (!empty($empleado[0]->Dim_id) && $empleado[0]->Dim_id == $d->dim_id) ? "selected" : ""; ?> value="<?php echo $d->dim_id ?>"><?php echo $d->dim_descripcion ?></option>
                                            <?php } ?>
                                        </select>    
                                    </div>
                                    <label class="col-md-1" for="dim2"><?php echo $empresa[0]->Dimdos_id ?></label>
                                    <div class="col-md-3">
                                        <select id="dimension2" name="dimension2" class="form-control dimencion_dos_se">
                                            <option value="">::Seleccionar::</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1">Fecha</label>
                                    <div class="col-md-2">
                                        <input class="form-control fecha" type="text" name="fecha" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <fieldset>
                                    <legend>Asistentes</legend>
                                    <div clas="col-md-12">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="adicionarEmpleado" class="btn btn-info" ><i class="fa fa-plus"></i></button>
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <td style="text-align: center">Pertenece a la Compañia</td>
                                            <td style="text-align: center">Cedula</td>
                                            <td style="text-align: center">Nombre</td>
                                            <td style="text-align: center">Correo</td>
                                            <td style="text-align: center" >Opción</td>
                                            </thead>
                                            <tbody id="cuerpoAsistentes">
                                                <tr class="NoFilas">
                                                    <td>
                                                        <select class="form-control obligatorio pertenece" id="pertenece">
                                                            <option value="">::Seleccionar::</option>
                                                            <option value="1">Si</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </td>
                                                    <td class="cedula"></td>
                                                    <td class="nombre"></td>
                                                    <td class="correo"></td>
                                                    <td class="opcion"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </fieldset>
                                <fielset>
                                    <legend>
                                        Objetivo de la reunión
                                    </legend>
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="objetivoReunion"></textarea>
                                    </div>
                                </fielset>
                                <fielset>
                                    <legend>
                                        Temas tratados
                                    </legend>
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="objetivoReunion"></textarea>
                                    </div>
                                </fielset>
                                <fielset>
                                    <legend>
                                        Casos evaluados
                                    </legend>
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="objetivoReunion"></textarea>
                                    </div>
                                </fielset>
                                <fielset>
                                    <legend>
                                        Observaciones y/o sugerencias
                                    </legend>
                                    <div class="col-md-12">
                                        <textarea class="form-control" name="objetivoReunion"></textarea>
                                    </div>
                                </fielset>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('body').delegate(".pertenece", "change", function () {
        var puntero = $(this);
        $.post(
                "<?php echo base_url("index.php/copasst/empleadosActivos") ?>"
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("amarillo", msg['message']);
            else {
                puntero.parents('tr').find('.cedula *').remove();
                puntero.parents('tr').find('.correo *').remove();
                puntero.parents('tr').find('.opcion *').remove();
                puntero.parents('tr').find('.nombre *').remove();
                var option = "<button type='button' class='btn btn-danger eliminar'><i class='fa fa-remove'></i></button>";


                if (puntero.val() == 1) {
                    var disabled = "disabled='disabled'";
                    var optionSelect = "<select name='empleado' class='form-control datosEmpleado'><option value=''>::Seleccionar::</option>";
                    $.each(msg.Json, function (key, val) {
                        optionSelect += "<option value='" + val.Emp_id + "'>" + val.Emp_Nombre + "" + val.Emp_Apellidos + "</option>";
                    });
                    option += "</select>";
                    puntero.parents('td').siblings('.nombre').append(optionSelect);
                } else {
                    var disabled = "";
                    var nombre = "<input type='text' name='empleado' class='form-control' />";
                    puntero.parents('td').siblings('.nombre').append(nombre);
                }
                var cedula = "<input type='text' name='cedula' class='form-control' " + disabled + "/>";
                var correo = "<input type='text' name='correo' class='form-control' " + disabled + "/>";
                puntero.parents('tr').find('.cedula').append(cedula);
                puntero.parents('tr').find('.correo').append(correo);
                puntero.parents('tr').find('.opcion').append(option);
            }
        }).fail(function (msg) {

        });
    });

    $('body').delegate(".datosEmpleado", "change", function () {
        var puntero = $(this);
        $.post(
                "<?php echo base_url("index.php/Administrativo/consultaCorreo") ?>",
                {
                    empId: $(this).val()
                }
        ).done(function (msg) {
            puntero.parents('tr').find('.cedula').children('input').val(msg.Json.Emp_Cedula);
            puntero.parents('tr').find('.correo').children('input').val(msg.Json.Emp_Email);
        }).fail(function (msg) {
            alerta("rojo", "Error por favor comunicarse con el administrador");
        })
    });

    $('#adicionarEmpleado').click(function () {
        adicionarFila();
    });

    $('body').delegate(".eliminar", "click", function () {
        var filas = $('.NoFilas').length;
        console.log(filas);
        if (filas > 0) {
            $(this).parents("tr").remove();
            if (filas == 1) {
                adicionarFila();
            }
        } else {

        }
    });
    
    function adicionarFila(){
        var fila = "<tr class='NoFilas'>\n\
                        <td>\n\
                            <select class='form-control obligatorio pertenece' id='pertenece'>\n\
                                <option value=''>::Seleccionar::</option>\n\
                                <option value='1'>Si</option>\n\
                                <option value='0'>No</option>\n\
                            </select>\n\
                        </td>\n\
                        <td class='cedula'></td>\n\
                        <td class='nombre'></td>\n\
                        <td class='correo'></td>\n\
                        <td class='opcion'></td>\n\
                    </tr>"
                $('#cuerpoAsistentes').append(fila);
    }

    $('#guardar').click(function(){
        $.post(
                "<?php echo base_url("index.php/copasst/guardaComiteConvivencia") ?>",
                ).done(function(msg){
                    
                }).fail(function(msg){
                    
                });
    });
</script>