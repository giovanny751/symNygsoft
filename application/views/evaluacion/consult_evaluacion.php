<div class="row">
    <div class="col-md-6">
        <a href="<?php echo base_url() . "/index.php/Evaluacion/index" ?>"><div title="Nueva Evaluación" class="circuloIcon"><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">EVALUACIÓN</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form action="<?php echo base_url('index.php/') . '/Evaluacion/consult_evaluacion'; ?>" method="post" >
        <div class="row">
            <div class="col-md-3">
                <label for="eva_nombre">
                    Nombre                        </label>
            </div>
            <div class="col-md-3">
                <input type="text" value="<?php echo (isset($post['eva_nombre']) ? $post['eva_nombre'] : '' ) ?>" class="form-control obligatorio  " id="eva_nombre" name="eva_nombre">
                <br>
            </div>

        </div>
        <button class="btn btn-sst" >Consultar</button>
    </form>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                <th style="display: none"></th>
                <th>eva_nombre</th>
                <th>Acción</th>
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
                            }else{
                                echo "<td>" . $value->$key2 . "</td>";
                            }
                            $i++;
                        }
                        echo "<td>"
                        . '<a href="javascript:" class="" onclick="preguntas(' . $valor . ')" title="Preguntas"><i class="fa fa-book fa-2x"></i></a>'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:" class="" onclick="editar(' . $valor . ')" title="Modificar"><i class="fa fa-pencil fa-2x"></i></a>'
                        . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:" class="" onclick="delete_(' . $valor . ')" title="Eliminar"><i class="fa fa-trash-o fa-2x"></i></a>'
                        . "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (isset($campo)) { ?>
    <form action="<?php echo base_url('index.php/') . "/Evaluacion/edit_evaluacion"; ?>" method="post" id="editar">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>2">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
    <form action="<?php echo base_url('index.php/') . "/Evaluacion/delete_evaluacion"; ?>" method="post" id="delete">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>3">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
<?php } ?>
<script>
    function editar(num) {
        $('#<?php echo $campo ?>2').val(num);
        $('#editar').submit();
    }
    function preguntas(num) {
        $('#editar').attr('action','<?php echo base_url('index.php/') . "/Preguntas/consult_preguntas"; ?>');
        $('#<?php echo $campo ?>2').val(num);
        $('#editar').submit();
    }
    function delete_(num) {
        var r = confirm('Confirma que desea eliminar el registro');
        if (r == false) {
            return false;
        }
        $('#<?php echo $campo ?>3').val(num);
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
