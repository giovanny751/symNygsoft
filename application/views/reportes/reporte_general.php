<input type="hidden" name="titulo" id="titulo"  value="<?php echo (isset($titulo_general) ? $titulo_general : 'Consultas y reportes') ?>">
<input type="hidden" name="titulo2" class="titulo3" value="<?php echo (isset($titulo_general) ? $titulo_general : 'Consultas y reportes') ?>">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>INFORME DOTACIÓN
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
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
                        </div>
                    </div>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tableNoMovilProveedores" class="table table-bordered table-hover " >
                                <thead>
                                    <?php
                                    $cantidad_titulo = count($titulo);
                                    for ($i = 0; $i < $cantidad_titulo; $i++) {
                                        if (strpos($titulo[$i], ' :: ') == false) {
                                            ?>
                                        <th style="text-align: center"><?php echo $titulo[$i]; ?></th>
                                        <?php
                                    } else {
                                        ?>
                                        <th style="display: none"><?php echo $titulo[$i]; ?></th>
                                        <?php
                                    }
                                }
                                ?>
                                </thead>
                                <tbody >
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
                                                        echo "<td>" . $value->$key2 . "&nbsp;</td>";
                                                    } else {
                                                        echo "<td>&nbsp;</td>";
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    //    $('#tableNoMovilProveedores').DataTable();

    $(document).ready(function () {
        // Setup - add a text input to each footer cell
//        $('#tableNoMovilProveedores thead th').each(function () {
//            var title = $('#tableNoMovilProveedores thead th').eq($(this).index()).text();
//            html = '<center><input type="text" placeholder=""   style="width:100%; color:#000;"/></center>'
//            $(this).html(html);
//        });
//        var table = $('#tableNoMovilProveedores').DataTable({
//        "paging":   false,
//            "ordering": false,
//            "info": false,
//            "dom": '<"top"i>rt<"bottom"flp><"clear">'

//        });

        // Apply the search
//        table.columns().every(function () {
//            var that = this;
//
//            $('input', this.header()).on('keyup change', function () {
//                that
//                        .search(this.value)
//                        .draw();
//            });
//        });
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