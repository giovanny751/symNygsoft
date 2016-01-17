<div class="row">
    <a href="<?php echo base_url() . "index.php/Tipo_aseguradora/index" ?>"><div class="circuloIcon" title="Nuevo Tipo Contrato" ><i class="fa fa-folder-open fa-3x"></i></div></a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">CREAR TIPO DE ASEGURADORA</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form action="<?php echo base_url('index.php/') . '/Tipo_aseguradora/consult_tipo_aseguradora'; ?>" method="post" >
        <div class="row">
            <div class="col-md-6">
                <label for="TipAse_Nombre">
                    Tipo aseguradora                        </label>
            </div>
            <div class="col-md-6">
                <script>
                    $('document').ready(function () {
                        $('#TipAse_Nombre').autocomplete({
                            source: "<?php echo base_url("index.php//Tipo_aseguradora/autocomplete_TipAse_Nombre") ?>",
                            minLength: 3
                        });
                    });
                </script>
                <input type="text" value="<?php echo (isset($post['TipAse_Nombre']) ? $post['TipAse_Nombre'] : '' ) ?>" class="form-control obligatorio  " id="TipAse_Nombre" name="TipAse_Nombre">
                <br>
            </div>

        </div>
        <button class="btn-sst">Consultar</button>
    </form>

    <div class="row">
        <div class="col-md-12">
            <table class="tablesst">
                <thead>
                <th>N°</th>
                <th>Tipo aseguradora</th>
                <th>Editar</th>
                <th>Eliminar</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($datos as $key => $value) {
                        echo "<tr>";
                        $i = 0;
                        foreach ($value as $key2 => $value2) {
                            echo "<td>" . $value->$key2 . "</td>";
                            if ($i == 0) {
                                $campo = $key2;
                                $valor = "'" . $value->$key2 . "'";
                            }
                            $i++;
                            
                        }
                        echo "<td class='transparent'> <a href=\"javascript:\" onclick=\"editar(" . $valor . ")\"><i class='fa fa-pencil-square-o fa-2x'></i></a> </td>";
                        echo "<td class='transparent'> <a href=\"javascript:\" onclick=\"delete_(" . $valor . ")\"><i class='fa fa-trash-o fa-2x'></i></a> </td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php if (isset($campo)) { ?>
    <form action="<?php echo base_url('index.php/') . "/Tipo_aseguradora/edit_tipo_aseguradora"; ?>" method="post" id="editar">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>2">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
    <form action="<?php echo base_url('index.php/') . "/Tipo_aseguradora/delete_tipo_aseguradora"; ?>" method="post" id="delete">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>3">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
<?php } ?>
<script>
    function editar(num) {
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
