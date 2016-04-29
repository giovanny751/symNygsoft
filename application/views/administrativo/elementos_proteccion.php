<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>DOTACIÓN DE PROTECCIÓN PERSONAL
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" id="form_proteccion" class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Empleado:</label>
                            </div>
                            <div class="col-md-7">
                                <select  id="empleado" class="form-control">
                                    <?php foreach ($empleados as $e): ?>
                                        <option value="<?php echo $e->Emp_id ?>"><?php echo $e->Emp_Nombre . " " . $e->Emp_Apellidos ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button tipo="1" class="agregar_empleado btn btn-success" type="button">+</button><p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover ">
                                    <thead>
                                    <th>Empleado</th>
                                    <th>Acción</th>
                                    </thead>
                                    <tbody id="tabla_empleados"></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            &nbsp;&nbsp;&nbsp;&nbsp;<button tipo="1" class="agregar_formulario btn btn-success" type="button">+</button>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>ELEMENTO DE PROTECCIÓN</label>
                            </div>
                            <div class="col-md-3">
                                <?php echo lista("elementop[]", "elementop", "form-control obligatorio", "inventario", "inv_id", "inv_nombre", null, array("est_id" => "1"), /* readOnly? */ false); ?>
                                <!--<input type="text" class="form-control obligatorio" name="elementop[]" id="elementop">-->
                            </div>
                            <div class="col-md-3">
                                <label>UNDS</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control obligatorio number" name="unidades[]" id="unidades">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>TALLA</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="talla[]" id="talla">
                            </div>
                            <div class="col-md-3">
                                <label>FECHA DE ENTREGA</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control fecha obligatorio" name="fecha_entrega[]" id="fecha_entrega">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>INDICACIÓN DE USO</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="indicacion_uso[]" id="indicacion_uso">
                            </div>
                            <div class="col-md-3">
                                <label>INDICACIÓN DE ALMACENAMIENTO</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="indicacion_alm[]" id="indicacion_alm">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label>VIDA UTIL/FECHA CADUCIDAD</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control fecha" name="vida_util[]" id="vida_util"><p>
                            </div>
                        </div>
                        <div class="row"><br><hr><br></div>
                        <div id="resultado"></div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-8">
                                        <input type="button" value="Agregar" class="btn btn-block green guardar" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    


<script>
    $('.agregar_empleado').click(function () {
        var empleado = $('#empleado').val();
        var i = 0;
        $('.selec_emple').each(function () {
            if ($(this).val() == empleado) {
                alerta('rojo', 'El empleado ya se encuentra seleccionado');
                i++;
            }
        })

        if (i > 0) {
            return false;
        }


        $.post(url + 'index.php/Administrativo/consultar_empreado', {empleado: empleado})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {

                        $.each(msg['Json'], function (key, val) {
                            if (val.doc_fecha_entrega != null)
                                alerta('azul', 'Ultima fecha de entrega: ' + val.doc_fecha_entrega)
                        })

                        var empleado_text = $('#empleado option:selected').text();
                        var html = '<tr>';
                        html += '<td><input type="hidden" name="empleados[]" class="selec_emple" value="' + empleado + '">' + empleado_text + '</td>';
                        html += '<td><a class="btn btn-xs default eliminar" href="javascript:"><i title="Eliminar" class="fa fa-pencil-square-o"></i>Eliminar</a></td>';
                        html += '</tr>';
                        $('#tabla_empleados').append(html);
                        $('.dataTables_empty').parent().remove();
                    }
                })
                .fail(function () {

                })
    })
    $('body').delegate('.eliminar', 'click', function () {
        $(this).parent().parent().remove();
    });

    $('body').delegate('.agregar_formulario', 'click', function () {
        var html = '<div><div class=""><button class="agregar_formulario btn btn-success" type="button" tipo="1">+</button><button class="eliminar_formulario btn btn-danger" type="button" tipo="1">-</button></div><div class="row"><div class="col-md-3"><label>ELEMENTO DE PROTECCIÓN</label></div><div class="col-md-3">'+$('#elementop').parent().html()+'</div>'
                + '<div class="col-md-3"><label>UNDS</label></div><div class="col-md-3"><input type="text" class="form-control obligatorio number" name="unidades[]" id="unidades">'
                + '</div></div><div class="row"><div class="col-md-3"><label>TALLA</label></div><div class="col-md-3"><input type="text" class="form-control" name="talla[]" id="talla">'
                + '</div><div class="col-md-3"><label>FECHA DE ENTREGA</label></div><div class="col-md-3"><input type="text" class="form-control fecha obligatorio" name="fecha_entrega[]" id="fecha_entrega">'
                + '</div></div><div class="row"><div class="col-md-3"><label>INDICACIÓN DE USO</label></div><div class="col-md-3"><input type="text" class="form-control" name="indicacion_uso[]" id="indicacion_uso">'
                + '</div><div class="col-md-3"><label>INDICACIÓN DE ALMACENAMIENTO</label></div><div class="col-md-3"><input type="text" class="form-control" name="indicacion_alm[]" id="indicacion_alm">'
                + '</div></div><div class="row"><div class="col-md-3"><label>VIDA UTIL/FECHA CADUCIDAD</label></div><div class="col-md-3"><input type="text" class="form-control fecha" name="vida_util[]" id="vida_util"><p>'
                + '</div></div><div class="row"><br><hr><br></div></div>'
        $('#resultado').append(html);
    });
    $('body').delegate('.eliminar_formulario', 'click', function () {
        $(this).parent().parent().remove();
    })
    $('.guardar').click(function () {
        var i = 0;
        var empleado = $('#empleado').val();
        $('.selec_emple').each(function () {
            if ($(this).val() == empleado) {
                i++;
            }
        });
        if (i == 0) {
            alerta('rojo', 'Seleccione al menos un empleado');
            return false;
        }
        var obli = obligatorio('obligatorio');
        if (obli == false) {
            return false;
        }
        $.post(url + 'index.php/Administrativo/guardar_protexion', $('#form_proteccion').serialize())
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        $('.guardar').hide();
                        alerta('verde', 'Informacion guardada con exito')
                        location.reload();
                    }
                })
                .fail(function (msg) {

                })
    })

</script>