<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">MATRIZ DE RIESGO</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <!--<table class="table table-bordered table-hover">-->
    <table border="1" >
        <thead>
            <tr>
                <th rowspan="2" style="text-align: center">PLAN</th>
                <th rowspan="2" style="text-align: center">ACTIVIDAD</th>
                <th rowspan="2" style="text-align: center">TAREA</th>
                <th rowspan="2" style="text-align: center">RUTINARIA</th>
                <th colspan="3" style="text-align: center">RIESGO</th>
            </tr>
            <tr>
                <th style="text-align: center">RIESGO</th>
                <th style="text-align: center">CLASIFICACIÓN</th>
                <th style="text-align: center">TIPO</th>
            </tr>
        </thead>
        <tbody>
            <?php

            function capturaColumnas($array) {
                $i = 0;
                if (is_array($array)) {
                    foreach ($array as $key => $val) {
                        if (is_array($val)) {
                            return capturaColumnas($val);
                        } else {
                            return $val;
                        }
                    }
                } else {
                    return $array;
                }
            }

//            print_y($matriz);
            foreach ($matriz as $plan => $act_hijos):
                echo "<tr>";
                echo "<td rowspan='" . (count($act_hijos, COUNT_RECURSIVE) + 1) . "'>" . $plan . "</td>";
                echo "</tr>";
                foreach ($act_hijos as $act_hijo => $tareas):
                    echo "<tr>";
                    echo "<td rowspan='" . (count($tareas, COUNT_RECURSIVE) + 1) . "'>" . $act_hijo . "</td>";
                    echo "</tr>";
                    foreach ($tareas as $tarea => $rutinario):

                        echo "<tr>";
                        echo "<td rowspan='" . (count($rutinario, COUNT_RECURSIVE) + 1) . "'   >" . $tarea . "</td>";

//                        var_dump($categorias);die;


                        if (empty($resultado = capturaColumnas($rutinario))) {
//                            echo "<td colspan='4'>&nbsp;</td>";
                        }
                        echo "</tr>";
                        foreach ($rutinario as $rutina => $riesgosCreados):
                            echo "<tr>";
                            echo "<td rowspan='" . ((count($riesgosCreados, COUNT_RECURSIVE) + 1) + 1 ) . "' style='text-align:center'>" . $rutina . "</td>";
                            if (empty($resultado = capturaColumnas($riesgosCreados))) {
                                echo "<td colspan='3'>&nbsp;</td>";
                            }
                            echo "</tr>";
                            foreach ($riesgosCreados as $tipo => $rieDescripciones):
                                echo "<tr>";
                                echo "<td rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "'>" . $tipo . "</td>";
                                if (empty($resultado = capturaColumnas($rieDescripciones))) {
                                    echo "<td colspan='2'>&nbsp;</td>";
                                }
                                echo "</tr>";
                                foreach ($rieDescripciones as $rieDescripcion => $indices):
                                    echo "<tr>";
                                    echo "<td rowspan='" . (count($indices, COUNT_RECURSIVE) + 1) . "'>" . $rieDescripcion . "</td>";
                                    if (empty($resultado = capturaColumnas($indices))) {
                                        echo "<td colspan='1'>&nbsp;</td>";
                                    }
                                    echo "</tr>";
                                    foreach ($indices as $indice => $val):
                                        echo "<tr>";
                                        echo "<td>" . $val . "</td>";
                                        echo "</tr>";
                                    endforeach;
                                endforeach;
                            endforeach;
                        endforeach;
                    endforeach;
                endforeach;
            endforeach;

//                foreach ($tareas as $tarea => $id):
//
//                endforeach;
//            endforeach;
            ?>
            <?php
//        foreach ($matriz as $plan => $cantidad):
//            echo "<tr>";
//            echo "<td rowspan='".count($cantidad,COUNT_RECURSIVE)."'>" . $plan . "</td>";
//            for($i = 0; $i < count($cantidad);$i++){
//                if($i == 0):
//                    echo "<td>".$cantidad[$i]."</td>";
//                    echo "<tr>";
//                else:
//                    echo "<tr>";
//                    echo "<td>".$cantidad[$i]."</td>";
//                    echo "<tr>";
//                endif;
//            }
//        endforeach;
            ?>
        </tbody>
    </table>

</div>
<style>
    /*    tr td{
            border-bottom:1px solid #FFF;
        }*/
    .t1{
        width: 200px;
        border:1px solid red;
    }
    .t2{
        width: 200px;
        border:1px solid red;
    }
    .t3{
        width: 200px;
        border:1px solid red;
    }
    .t4{
        width: 200px;
        border:1px solid red;
    }
    .t5{
        width: 200px;
        border:1px solid red;
    }
</style>
