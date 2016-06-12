<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>MATRIZ DE RIESGOS
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
    <!--<table class="table table-bordered table-hover">-->
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table border="1" >
                                    <thead style="background-color: #B8B8B8    ">
                                        <tr>
                                            <th colspan="4" style="text-align: center">PLANEACIÓN</th>
                                            <th colspan="8" style="text-align: center">RIESGO</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2" style="text-align: center">Plan</th>
                                            <th rowspan="2" style="text-align: center">Actividad</th>
                                            <th rowspan="2" style="text-align: center">Tarea</th>
                                            <th rowspan="2" style="text-align: center" class="ratacion">Rutinaria</th>
                                            <th style="text-align: center">Riesgo</th>
                                            <th style="text-align: center">Nivel de deficiencia</th>
                                            <th style="text-align: center">Nivel de exposición</th>
                                            <th style="text-align: center">Nivel de Probabilidad</th>
                                            <th style="text-align: center">Nivel de consecuencia</th>
                                            <th style="text-align: center">Nivel de riesgo</th>
                                            <th style="text-align: center">Clasificación</th>
                                            <th style="text-align: center">Tipo</th>
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

                                        foreach ($matriz as $plan => $act_hijos):
                                            echo "<tr>";
                                            echo "<td rowspan='" . (count($act_hijos, COUNT_RECURSIVE) + 1) . "'>" . $plan . "</td>";
                                            echo "</tr>";
                                            foreach ($act_hijos as $act_hijo => $tareas):
                                                echo "<tr>";
                                                echo "<td rowspan='" . (count($tareas, COUNT_RECURSIVE) + 1) . "'>" . $act_hijo . "</td>";
                                                echo "</tr>";
                                                foreach ($tareas as $tarea => $riesgosCreados):
                                                    $atributoTarea = explode("//", $tarea);
                                                    echo "<tr>";
                                                    echo "<td rowspan='" . (count($riesgosCreados, COUNT_RECURSIVE) + 1) . "'   >" . $atributoTarea[0] . "</td>";
                                                    if ($atributoTarea[1] == 1)
                                                        $desicion = "SI";
                                                    else
                                                        $desicion = "NO";
                                                    echo "<td rowspan='" . (count($riesgosCreados, COUNT_RECURSIVE) + 1) . "'   >" . $desicion . "</td>";
//                                                    if (empty($resultado = capturaColumnas($rutinario))) {
//                                                    }
                                                    echo "</tr>";
                                                    foreach ($riesgosCreados as $riesgo => $rieDescripciones):
                                                        echo "<tr>";
                                                        $riesgosAdicionales = explode("//", $riesgo);
                                                        echo "<td rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "'>" . $riesgosAdicionales[0] . "</td>";
                                                        echo "<td rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "'>" . $riesgosAdicionales[1] . "</td>";
                                                        echo "<td rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "'>" . $riesgosAdicionales[2] . "</td>";
                                                        echo "<td rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "'>" . $riesgosAdicionales[3] . "</td>";
                                                        echo "<td rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "'>" . $riesgosAdicionales[4] . "</td>";
                                                        echo "<td rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "'>" . $riesgosAdicionales[5] . "</td>";
//                                                        echo "<td rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "'>" . $riesgosAdicionales[6] . "</td>";
                                                        echo "<td style='background-color:".$riesgosAdicionales[6]."' rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "'>" . $riesgosAdicionales[7] . "</td>";
//                                                        if (empty($resultado = capturaColumnas($nivelDeficiencia))) {
//                                                            echo "<td colspan='7'>&nbsp;</td>";
//                                                        }
                                                        echo "</tr>";
                                                            foreach ($rieDescripciones as $indice => $val):
                                                                echo "<tr>";
                                                                echo "<td>" . $val . "</td>";
                                                                echo "</tr>";
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .ratacion{
        -webkit-transform: rotate(-90deg); 
        -moz-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
        height:87px;                
        width: 10px;
    }
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
