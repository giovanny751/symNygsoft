<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon" title="Nuevo Registro" data-toggle="modal" data-target="#myModal2" ><i class="fa fa-folder-open fa-3x"></i></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">
                REGISTRO
            </span>
        </div>
    </div>
</div>
<div class="cuerpoContenido">
    <div class="row">
        <form method="post" id="frmregistro">
            <label for="plan" class="col-xs-1 col-sm-1 col-md-1 col-lg-1">Plan</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="plan" id="plan"/>
            </div>
            <!--            <label for="actividad" class="col-xs-1 col-sm-1 col-md-1 col-lg-1">Actividad</label>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">-->

            <input type="hidden" class="form-control" name="actividad" id="actividad"/>
            <!--</div>-->
            <label for="tarea" class="col-xs-1 col-sm-1 col-md-1 col-lg-1">Tarea</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="tarea" id="tarea"/>
            </div>
        </form>
    </div>    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: right">
            <button type="button" class="btn-sst limpiar">Limpiar</button>
            <button type="button" class="btn-sst" id="consultar">Consultar</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="tablesst" id="datatable_ajax">
                <thead>
                <th>Plan</th>
                <th>Nombre archivo</th>
                <th>Descripciòn</th>
                <th>Versiòn</th>
                <th>Categorìa</th>
                <th>Tarea</th>
                <th>Responsable</th>
                <th>Tamaño</th>
                <th>Fecha</th>
                <th>Ver Versiones</th>
                <th>Editar</th>
                <th>Eliminar</th>
                </thead>
                <tbody id="cuerpodatos">
                    <tr>
                        <td colspan="10"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">AGREGAR REGISTRO</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="formregistro" enctype="multipart/form-data" action="<?php echo base_url("index.php/tareas/guardarregistro") ?>" onsubmit="return validar();">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="planregistro">Plan:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <select id="planregistro" name="plan" class="form-control">
                                <option value=""></option>
                                <?php foreach ($plan as $pl): ?>
                                    <option value="<?php echo $pl->pla_id ?>"><?php echo $pl->pla_nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="tarearegistro">Tarea:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <select id="tarearegistro" name="tarea" class="form-control">
                                <option value="">::Seleccionar::</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="carpeta">Carpeta:</label>

                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <select id="carpeta" name="carpeta" class="form-control">
                                <option value="">::Seleccionar::</option>
                            </select>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="version">Versión:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <input type="text" id="version" name="version" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="descripcion">Descripción:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <textarea  id="descripcion" name="descripcion" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="archivocarpeta">Adjuntar archivo:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <input type="file" id="archivocarpeta" name="archivo" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarRegistro">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal15" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">NUEVO REGISTRO</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frmagregarregistro">
                    <input type="hidden" value="<?php echo (!empty($plan[0]->pla_id)) ? $plan[0]->pla_id : ""; ?>" name="pla_id" id="pla_id"/>
                    <input type="hidden" value="1" id="reg_id" name="reg_id">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="idactividad">Carpeta:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <select id="carpeta" name="carpeta" class="form-control carpeta">
                                <option value="">::Seleccionar::</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="version">Versión:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <input type="text" id="version" name="version" class="form-control ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="reg_descripcion">Descripción:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <textarea id="reg_descripcion" name="reg_descripcion" class="form-control "></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="archivo">Adjuntar archivo:</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <input type="file" id="archivo" name="archivo" class="form-control ">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnguardarregistro">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>

    $('body').delegate(".nuevoregistro,.modificarregistro", "click", function() {
        $('#carpeta').val("");
        $('#version').val("");
        $('#reg_descripcion').val("");
        $("#archivoadescargar").remove();
        $('#reg_id').val($(this).attr('reg_id'));
        $('#carpeta').val($(this).attr('car_id'));
    });

    $('body').delegate('.modificarregistro', 'click', function() {
        $.post(
                "<?php echo base_url("index.php/planes/modificarregistro") ?>",
                {registro: $(this).attr('reg_id')}
        ).done(function(msg) {
            $('#carpeta').val(msg.regCar_id);
            $('#version').val(msg.reg_version);
            $('#reg_descripcion').val(msg.reg_descripcion);
            var fila = "<div class='row' id='archivoadescargar' >\n\
                                    <label style='color:black' class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>\n\
                                        ARCHIVO\n\
                                    </label>\n\
                                    <div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>\n\
                                        <a target='_blank' href='" + "<?php echo base_url() ?>" + msg.reg_ruta + "'>" + msg.reg_archivo + "</a>\n\
                                    </div>\n\
                                </div>"
            $('#frmagregarregistro').append(fila);


//            alert(msg.tar_id);
            $.post(
                    "<?php echo base_url("index.php/tareas/busqueda_carpeta") ?>",
                    {tar_id: msg.tar_id}
            ).done(function(msg) {
                $('.carpeta *').remove();
                var option = "<option value=''>::Seleccionar::</option>";
                $.each(msg, function(key, val) {
                    option += "<option value='" + val.regCar_id + "'>" + val.regCar_nombre + "</option>";
                });
                $('.carpeta').append(option);
            }).fail(function(msg) {

            });


        }).fail(function(msg) {

        });
    });
    $('#btnguardarregistro').click(function() {
        var file_data = $('#archivo').prop('files')[0];
        var form_data = new FormData();
        form_data.append('archivo', file_data);
        form_data.append('pla_id', $('#pla_id').val());
        form_data.append('regCar_id', $('#carpeta').val());
        form_data.append('reg_id', $('#reg_id').val());
        form_data.append('reg_version', $('#version').val());
        form_data.append('reg_descripcion', $('#reg_descripcion').val());
        $.ajax({
            url: '<?php echo base_url("index.php/planes/guardarregistroempleado") ?>',
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                $('#consultar').trigger('click')
//                $('#datatable_ajax tbody').append(filas);
                $('#carpeta').val('');
                $('#version').val('');
                $('#reg_descripcion').val('');
                $('#archivo').val('');
                $("#myModal15").modal("hide");
                alerta('verde', 'Registro guardado con exito.');
            }
        });
    })
    $('#planregistro').change(function() {

        $.post(
                "<?php echo base_url("index.php/tareas/tareaxidplan") ?>",
                {pla_id: $(this).val()}
        ).done(function(msg) {
            $('#tarearegistro *').remove();
            var option = "<option value=''>::Seleccionar::</option>";
            $.each(msg, function(key, val) {
                option += "<option value='" + val.tar_id + "'>" + val.tar_nombre + "</option>";
            });
            $('#tarearegistro').append(option);
        }).fail(function(msg) {

        });

    });
    $('#tarearegistro').change(function() {

        $.post(
                "<?php echo base_url("index.php/tareas/busqueda_carpeta") ?>",
                {tar_id: $(this).val()}
        ).done(function(msg) {
            $('#carpeta *').remove();
            var option = "<option value=''>::Seleccionar::</option>";
            $.each(msg, function(key, val) {
                option += "<option value='" + val.regCar_id + "'>" + val.regCar_nombre + "</option>";
            });
            $('#carpeta').append(option);
        }).fail(function(msg) {

        });

    });

    $('#guardarRegistro').click(function() {
        $('#formregistro').submit();
    });

    $('#guardarcarpeta').click(function() {
        $.post(
                "<?php echo base_url("index.php/tareas/guardarcarpeta") ?>",
                $('#formcarpeta').serialize()
                )
                .done(function() {
                    $('#formcarpeta').find("input,textarea").val("");
                    alerta("verde", "Carpeta guardada con exito");
                })
                .fail(function() {
                    alerta("rojo", "Error por favor comunicarse con el administrador del sistema")
                });
    });
    $('#consultar').click(function() {
        $.post(
                "<?php echo base_url("index.php/tareas/consultaregistro") ?>",
                $('#frmregistro').serialize()
                )
                .done(function(msg) {
                    $('#cuerpodatos *').remove();
                    var body = ""
                    $.each(msg.Json, function(key, val) {
                        body += "<tr>";
                        body += "<td>" + (val.pla_nombre == null ? '' : val.pla_nombre) + "</td>";
                        body += "<td><a target='_black' href='<?php echo base_url('') ?>"+val.reg_ruta+'/'+val.reg_id+'/'+val.reg_archivo+"'>" + (val.reg_archivo == null ? '' : val.reg_archivo) + "</a></td>";
                        body += "<td>" + (val.reg_descripcion == null ? '' : val.reg_descripcion) + "</td>";
                        body += "<td>" + val.reg_version + "</td>";
                        body += "<td></td>";
                        body += "<td>" + (val.tar_nombre == null ? '' : val.tar_nombre) + "</td>";
                        body += "<td>" + (val.responsable == null ? '' : val.responsable) + "</td>";
                        body += "<td>" + val.reg_tamano + "</td>";
                        body += "<td>" + val.reg_fechaCreacion + "</td>";
                        body += "<td></td>";
                        body += "<td class='transparent'>\n\
                                    <i class='fa fa-pencil-square-o fa-2x modificarregistro' title='Modificar' reg_id='" + val.reg_id + "'  data-target='#myModal15' data-toggle='modal'></i>\n\
                                </td>";
                        body += "<td class='transparent'>\n\
                                    <i class='fa fa-trash-o fa-2x eliminarregistro' title='Eliminar' reg_id='" + val.reg_id + "'></i>\n\
                                </td>";
                        body += "</tr>";
                    })
                    $('#cuerpodatos').append(body);
                })
                .fail(function(msg) {
                    alerta("rojo", "Error por favor comunicarse con el administrador del sistema")
                });
    });

    $('body').delegate('.eliminarregistro', 'click', function() {
        var registro = $(this);
        if (confirm("esta seguro de eliminar el registro")) {
            $.post(
                    "<?php echo base_url("index.php/tareas/eliminarregistro") ?>",
                    {registro: registro.attr("reg_id")}
            ).done(function(msg) {
                registro.parents('tr').remove();
            }).fail(function(msg) {

            });
        }
    });

    $('#tarea').autocomplete({
        source: "<?php echo base_url("index.php/tareas/autocompletetareas") ?>",
        minLength: 3
    });
    $('#actividad').autocomplete({
        source: "<?php echo base_url("index.php/tareas/autocompleteactividadhijo") ?>",
        minLength: 3
    });
    $('#plan').autocomplete({
        source: "<?php echo base_url("index.php/tareas/autocompletar") ?>",
        minLength: 3
    });
    function validar() {
        if ($('#planregistro').val() == '') {
            alerta('rojo', 'Campo Plan Obligatorio')
            return false;
        }
        if ($('#tarearegistro').val() == '') {
            alerta('rojo', 'Campo Tarea Obligatorio')
            return false;
        }
        if ($('#carpeta').val() == '') {
            alerta('rojo', 'Campo Carpeta Obligatorio')
            return false;
        }
        if ($('#archivocarpeta').val() == '') {
            alerta('rojo', 'Campo Archivo Obligatorio')
            return false;
        }
        return true;
    }
</script>