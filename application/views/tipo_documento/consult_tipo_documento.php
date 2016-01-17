<div class="row">
    <a href="<?php echo base_url() . "index.php/Tipo_documento/index" ?>"><div class="circuloIcon" title="Nuevo Tipo Documento" ><i class="fa fa-folder-open fa-3x"></i></div></a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">TIPOS DE DOCUMENTO</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form action="<?php echo base_url('index.php/') . '/Tipo_documento/consult_tipo_documento'; ?>" method="post" >
        <div class="row">
            <div class="col-md-12">
                <label for="tipDoc_Descripcion">
                    Tipo de documento                        </label>
            </div>
            <div class="col-md-12">

                <script>
                    $('document').ready(function () {
                        $('#tipDoc_Descripcion').autocomplete({
                            source: "<?php echo base_url("index.php//Tipo_documento/autocomplete_tipDoc_Descripcion") ?>",
                            minLength: 3
                        });
                    });
                </script>
                <input type="text" value="<?php echo (isset($post['tipDoc_Descripcion']) ? $post['tipDoc_Descripcion'] : '' ) ?>" class="form-control obligatorio  " id="tipDoc_Descripcion" name="tipDoc_Descripcion">
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
                <th>Tipo de documento</th>
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
                        echo '<td class="transparent"><a href="javascript:" onclick="editar(' . $valor . ')"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>';
                        echo '<td class="transparent"><a href="javascript:" onclick="delete_(' . $valor . ')"><i class="fa fa-trash-o fa-2x"></i></a></td>';
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="float:right">
        <a href="<?php echo base_url() . "/index.php/Tipo_documento/index" ?>" class="btn-sst" >Nuevo</a>
    </div>
</div>
<?php if (isset($campo)) { ?>
    <form action="<?php echo base_url('index.php/') . "/Tipo_documento/edit_tipo_documento"; ?>" method="post" id="editar">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>2">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
    <form action="<?php echo base_url('index.php/') . "/Tipo_documento/delete_tipo_documento"; ?>" method="post" id="delete">
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
