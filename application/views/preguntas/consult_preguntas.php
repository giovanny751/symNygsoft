<br><div class="row">
    <div class="col-md-6">
        <a href="javascript:" id="nueva_pregunta"><div title="Nueva Pregunta" class="circuloIcon"><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> Preguntas
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?php echo base_url('index.php/') . '/Preguntas/consult_preguntas'; ?>" method="post" >
                    <div class="form-body">
                        <div class="row">
                            <label for="eva_id" class="col-md-3">
                                Evaluación                        
                            </label>
                            <div class="col-md-3">
                                <?php echo lista("eva_id", "eva_id", "form-control obligatorio", "evaluacion", "eva_id", "eva_nombre", (isset($post['eva_id']) ? $post['eva_id'] : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>
                                <br>
                            </div>
                            <label for="tipPre_id" class="col-md-3">
                                Tipo pregunta                        
                            </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($post['tipPre_id']) ? $post['tipPre_id'] : '' ) ?>" class="form-control obligatorio  " id="tipPre_id" name="tipPre_id">
                                <br>
                            </div>
                            <label for="pre_nombre" class="col-md-3">
                                pregunta                        
                            </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($post['pre_nombre']) ? $post['pre_nombre'] : '' ) ?>" class="form-control obligatorio  " id="pre_nombre" name="pre_nombre">
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-3">
                                <button class="btn btn-block" >Consultar</button>
                                <br>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover tabla-sst" >
                            <thead>
                            <th style='display:none'></th>
                            <th>Evaluación</th>
                            <th>Tipo pregunta</th>
                            <th>pregunta</th>
                            <th>Numero de respuestas</th>
                            <th>Visible</th>
                            <th>Vista previa</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($datos as $key => $value) {
                                    echo "<tr>";
                                    $i = 0;
                                    foreach ($value as $key2 => $value2) {
                                        if ($i == 0) {
                                            $campo = $key2;
                                            $valor = "'" . $value->$key2 . "'";
                                            echo "<td style='display:none'>" . $value->$key2 . "</td>";
                                        } else if ($key2 == 'pre_visible') {
                                            echo "<td align='center'>";
                                            if ($value->$key2 == 'S') {
                                                $d = 'green';
                                            } else {
                                                $d = '#CCC';
                                            }
                                            echo '<a href="javascript:" class="btn btn-dcs" ><i class="modificar fa fa-check fa-2x " modificar=' . $valor . ' estado=' . "'" . $value->$key2 . "'" . ' style="color:' . $d . '"></i></a>';
                                            echo "</td>";
                                        } else {
                                            echo "<td>" . ($value->$key2) . "</td>";
                                        }
                                        $i++;
                                    }
                                    echo "<td  align='center'>" . '<a href="javascript:" class="modal_eva" data-toggle="modal" data-target="#myModal" id=' . $valor . '><i class="fa fa-eye fa-2x"></i></a></td>'
                                    . "<td align='center'>"
                                    . '<a href="javascript:" class="" onclick="editar(' . $valor . ')"><i class="fa fa-pencil fa-2x"></i></a></td>'
                                    . '<td align="center"><a href="javascript:" class="" onclick="delete_(' . $valor . ')"><i class="fa fa-trash-o fa-2x"></i></a></td>';
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="<?php echo base_url('index.php/') . "/Preguntas/edit_preguntas"; ?>" method="post" id="editar">
    <input type="hidden" name="<?php echo (isset($campo) ? $campo : '') ?>" id="<?php echo (isset($campo) ? $campo : '') ?>2">
    <input type="hidden" name="eva_id" id="eva_id2">
    <input type="hidden" name="campo" value="<?php echo (isset($campo) ? $campo : '') ?>">
</form>

<form action="<?php echo base_url('index.php/') . "/Preguntas/delete_preguntas"; ?>" method="post" id="delete">
    <input type="hidden" name="<?php echo (isset($campo) ? $campo : '') ?>" id="<?php echo (isset($campo) ? $campo : '') ?>3">
    <input type="hidden" name="campo" value="<?php echo (isset($campo) ? $campo : '') ?>">
</form>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="nomb_pre"></span></h4>
            </div>
            <div class="modal-body">
                <span id="tipo_pre"></span><p>
                    <span id="contex_pre"></span><p>
                    <span id="nombre_pre"></span><p>
                    <span id="body_pre"></span><p>
                    <span id="respuesta_pre"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

<script>

    $('.modal_eva').click(function () {
        $('#nomb_pre').html('');
        $('#tipo_pre').html('');
        $('#contex_pre').html('');
        $('#nombre_pre').html('');
        $('#body_pre').html('')
        $('#respuesta_pre').html('');
        var id = $(this).attr('id');
        $.post(
                url + "index.php/Preguntas/buscar_pregunta", {id: id})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message']);
                    else {
                        var body = ""
                        var i = 1;
                        $.each(msg.Json, function (key, val) {
                            $('#nomb_pre').html("<b>Nombre Pregunta: </b>" + val.pre_nombre_busqueda);
                            $('#tipo_pre').html('<b>Tipo pregunta: </b>' + val.tipPre_nombre);
                            if (val.pre_contexto != '<p></p>' && val.pre_contexto != '' && val.pre_contexto != null)
                                $('#contex_pre').html("<b>Contexto: </b><br>" + val.pre_contexto);
                            $('#nombre_pre').html('<b>Pregunta: </b><br>' + val.pre_nombre);
                            if (val.res_nombre != '<p></p>' && val.res_nombre != '' && val.res_nombre != null)
                                $('#body_pre').append(i + ") " + val.res_nombre + '<br>')
                                if(val.id_respuesta==val.res_id){
                                    $('#respuesta_pre').html("<b>Respuesta: </b>" + (i));
                                }
                            i++;
                        });
                    }
                })
                .fail(function () {

                })
    })
    $('#nueva_pregunta').click(function () {
        $('#editar').attr('action', url + "index.php/Preguntas/index");
        $('#eva_id2').val($('#eva_id').val())
        $('#editar').submit();
    })
    function editar(num) {
        $('#<?php echo (isset($campo) ? $campo : '') ?>2').val(num);
        $('#editar').submit();
    }
    $('.modificar').click(function () {
        var pre_visible = $(this).attr('estado');
        var pre_id = $(this).attr('modificar');
        if (pre_visible == 'S')
            pre_visible = 'N'
        else
            pre_visible = 'S'
        var io = $(this);
        $.post(url + "index.php/Preguntas/pre_visible", {pre_visible: pre_visible, pre_id: pre_id})
                .done(function (msg) {
                    if (pre_visible == 'S')
                        io.css('color', 'green')
                    else
                        io.css('color', '#CCC')
                    io.attr('estado', pre_visible);

                })
                .fail(function (msg) {

                })
    });
    function delete_(num) {
        var r = confirm('Confirma que desea eliminar el registro');
        if (r == false) {
            return false;
        }
        $('#<?php echo (isset($campo) ? $campo : '') ?>3').val(num);
        $('#delete').submit();
    }

    $('body').delegate('.number', 'keypress', function (tecla) {
        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
            return false;
    });
</script>
