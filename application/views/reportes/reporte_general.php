<input type="hidden" name="titulo" id="titulo"  value="<?php echo (isset($titulo_general) ? $titulo_general : 'Consultas y reportes') ?>">
<input type="hidden" name="titulo2" class="titulo3" value="<?php echo (isset($titulo_general) ? $titulo_general : 'Consultas y reportes') ?>">

<span id="impresiones">
    <button class="btn btn-success excel" type="button">
        <li class="fa fa-file-excel-o"></li>
        Excel
    </button>
    <button class="btn btn-success pdf" type="button">
        <li class="fa fa-file-pdf-o"></li>
        PDF
    </button>
</span>
<div id="mi_table_expor" class="table-responsive formulario_consul">
    <p></p>
    <table id="tableNoMovilProveedores" class="table table-striped cree" style="min-width:900px ">
        <thead>
            <tr>
                <?php
                $cantidad_titulo = count($titulo);
                for ($i = 0; $i < $cantidad_titulo; $i++) {
                    if (strpos($titulo[$i], ' :: ') == false) {
                        ?>
                        <td><?php echo $titulo[$i]; ?></td>
                        <?php
                    } else {
                        ?>
                        <td style="display: none"><?php echo $titulo[$i]; ?></td>
                        <?php
                    }
                }
                ?>
            </tr>
            <tr>
                <?php for ($i = 0; $i < count($titulo); $i++) {
                    ?>
                    <th eeo=""><?php echo $titulo[$i]; ?></th><?php }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            //            print_r($consulta);
            if ($consulta != false) {

                foreach ($consulta as $key => $value) {
                    ?>
                    <tr>
                        <?php
                        $t = 0;
                        foreach ($value as $key2 => $value2) {

                            if (!empty($value->$key2)) {
                                echo "<td style='border:1px solid #000'>" . $value->$key2 . "&nbsp;</td>";
                            } else {
                                echo "<td style='border:1px solid #000'>&nbsp;</td>";
                            }
                            $t++;
                        }
                        ?>
                        <?php
                        if (count($consulta) != count($titulo)) {
                            $cantidad_td = $cantidad_titulo - $t;
                            for ($rr = 0; $rr < $cantidad_td; $rr++) {
                                echo "<td>&nbsp</td>";
                            }
                        }
                        ?>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>

    //    $('#tableNoMovilProveedores').DataTable();

    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#tableNoMovilProveedores thead th').each(function () {
            var title = $('#tableNoMovilProveedores thead th').eq($(this).index()).text();
            html = '<center><input type="text" placeholder=""   style="width:100%; color:#000;"/></center>'
            $(this).html(html);
        });
        var table = $('#tableNoMovilProveedores').DataTable({
//        "paging":   false,
//            "ordering": false,
//            "info": false,
            "dom": '<"top"i>rt<"bottom"flp><"clear">'

        });

        // Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.header()).on('keyup change', function () {
                that
                        .search(this.value)
                        .draw();
            });
        });
    });


    impri = 0;
    $('.pdf').click(function () {
        if (impri == 0)
            $('select[name=tableNoMovilProveedores_length]').append('<option value="-1">TODOS</option>')
        $('select[name=tableNoMovilProveedores_length]').val(-1).trigger('change');
//        $('option[value="4"]').attr('selected', 'selected').parent().focus();
        var my_tatle = $('#mi_table_expor').html()
        $('.input').val(my_tatle)
        $('.action').val(2)
        $('.form1').submit();
        $('select[name=tableNoMovilProveedores_length]').val(10).trigger('change');
        impri++;
    })
    $('.excel').click(function () {
        if (impri == 0)
            $('select[name=tableNoMovilProveedores_length]').append('<option value="-1">TODOS</option>')
        $('select[name=tableNoMovilProveedores_length]').val(-1).trigger('change');

        var my_tatle = $('#mi_table_expor').html()
        $('.input').val(my_tatle)
        $('.action').val(1)
        $('.form1').submit();
        $('select[name=tableNoMovilProveedores_length]').val(10).trigger('change');
        impri++;
    })



    $('#excelCompleto').click(function () {


        var proveedores = "";
        $('#proveedor_servicio :selected').each(function () {
            proveedores += $(this).val() + ",";
        });

        $('#proveedores2').val(proveedores);
        $('#componente22').val($('#componente').val())
        $('#tipo_alarma2').val($('#tipo_alarma').val())
        $('#mes12').val($('#mes1').val())
        $('#anio12').val($('#anio1').val())
        $('#mes22').val($('#mes2').val())
        $('#anio22').val($('#anio2').val())
        $('#reporte2').val($('#reporte').val())
        $('#formulario_excel_x').submit();

    });


</script>
<form class="form1" target="_black" action="<?php echo base_url('PlanesMejoraController/imprimir_doc') ?>"
      method="post">
    <input type="hidden" class="action" name="action">
    <input type="hidden" class="columas" name="columas" value="7">
    <input type="hidden" class="input" name="documento">
    <input type="hidden" class="titulo2" name="titulo2">
</form>