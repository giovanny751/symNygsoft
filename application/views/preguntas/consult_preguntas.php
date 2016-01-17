<div class="row">
    <div class="col-md-6">
        <a href="javascript:" id="nueva_pregunta"><div title="Nueva Pregunta" class="circuloIcon"><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="tituloCuerpo">
            <span class="txtTitulo">PREGUNTAS</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form action="<?php echo base_url('index.php/') . '/Preguntas/consult_preguntas'; ?>" method="post" >
        <div class="row">


            <div class="col-md-3">
                <label for="eva_id">
                    Evaluación                        </label>
            </div>
            <div class="col-md-3">
                <?php echo lista("eva_id", "eva_id", "form-control obligatorio", "evaluacion", "eva_id", "eva_nombre", (isset($post['eva_id']) ? $post['eva_id'] : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>
                <br>
            </div>

            <!--<div class="col-md-3">
                <label for="tem_id">
                    Tema                        </label>
            </div>
            <div class="col-md-3">

                <?php // echo lista("tem_id", "tem_id", "form-control obligatorio", "tema", "tem_id", "tem_nombre", (isset($post['tem_id']) ? $post['tem_id'] : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>
                <br>
            </div>

            <div class="col-md-3">
                <label for="are_id">
                    Area                        </label>
            </div>
            <div class="col-md-3">
                <?php //echo lista("are_id", "are_id", "form-control obligatorio", "area", "are_id", "are_nombre", (isset($post['are_id']) ? $post['are_id'] : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>
                <br>
            </div>
-->
            <div class="col-md-3">
                <label for="tipPre_id">
                    Tipo pregunta                        </label>
            </div>
            <div class="col-md-3">

                <input type="text" value="<?php echo (isset($post['tipPre_id']) ? $post['tipPre_id'] : '' ) ?>" class="form-control obligatorio  " id="tipPre_id" name="tipPre_id">
                <br>
            </div>

            <div class="col-md-3">
                <label for="pre_nombre">
                    pregunta                        </label>
            </div>
            <div class="col-md-3">

                <input type="text" value="<?php echo (isset($post['pre_nombre']) ? $post['pre_nombre'] : '' ) ?>" class="form-control obligatorio  " id="pre_nombre" name="pre_nombre">
                <br>
            </div>
        </div>
        <button class="btn btn-sst">Consultar</button>
    </form>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <th style='display:none'></th>
                <th>Evaluación</th>
<!--                <th>Tema</th>
                <th>Area</th>-->
                <th>Tipo pregunta</th>
                <th>pregunta</th>
                <th>Numero de respuestas</th>
                <th>Visible</th>
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
                                echo '<a href="javascript:" class="btn btn-dcs" ><i class="fa fa-check fa-2x modificar" modificar=' . $valor . ' estado=' . "'" . $value->$key2 . "'" . ' style="color:' . $d . '"></i></a>';
                                echo "</td>";
                            } else {
                                echo "<td>" . utf8_encode($value->$key2) . "</td>";
                            }
                            $i++;
                        }
                        echo "<td align='center'>"
                        . '<a href="javascript:" class="" onclick="editar(' . $valor . ')"><i class="fa fa-pencil fa-2x"></i></a>'
                        . '</td><td align="center"><a href="javascript:" class="" onclick="delete_(' . $valor . ')"><i class="fa fa-trash-o fa-2x"></i></a>'
                        . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
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

<script>
    $('#nueva_pregunta').click(function () {
        $('#editar').attr('action', '<?php echo base_url() . "/index.php/Preguntas/index" ?>');
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
        var url = '<?php echo base_url() . "/index.php/Preguntas/pre_visible" ?>';
        $.post(url, {pre_visible: pre_visible, pre_id: pre_id})
                .done(function (msg) {
                    if (pre_visible == 'S')
                        io.css('color', 'green')
                    else
                        io.css('color', '#CCC')
                    io.attr('estado',pre_visible);

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
    $('.fecha').datepicker({
        rtl: Metronic.isRTL(),
        autoclose: true
    });
</script>
