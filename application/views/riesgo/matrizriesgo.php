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
                                                foreach ($tareas as $tarea => $rutinario):
                                                    echo "<tr>";
                                                    echo "<td rowspan='" . (count($rutinario, COUNT_RECURSIVE) + 1) . "'   >" . $tarea . "</td>";
//                                                    if (empty($resultado = capturaColumnas($rutinario))) {
//                                                    }
                                                    echo "</tr>";
                                                    foreach ($rutinario as $rutina => $riesgosCreados):
                                                        echo "<tr>";
                                                        if ($rutina == 1) {
                                                            $rutina = "SI";
                                                        } elseif ($rutina == 2) {
                                                            $rutina = "NO";
                                                        }
                                                        echo "<td rowspan='" . ((count($riesgosCreados, COUNT_RECURSIVE) + 1) + 1 ) . "' style='text-align:center'>" . $rutina . "</td>";
                                                        if (empty($resultado = capturaColumnas($riesgosCreados))) {
                                                            echo "<td colspan='8'>&nbsp;</td>";
                                                        }
                                                        echo "</tr>";
                                                        foreach ($riesgosCreados as $riesgo => $nivelDeficiencia):
                                                            echo "<tr>";
                                                            echo "<td rowspan='" . (count($nivelDeficiencia, COUNT_RECURSIVE) + 1) . "'>" . $riesgo . "</td>";
                                                            if (empty($resultado = capturaColumnas($nivelDeficiencia))) {
                                                                echo "<td colspan='7'>&nbsp;</td>";
                                                            }
                                                            echo "</tr>";
                                                            foreach ($nivelDeficiencia as $deficiencia => $nivelProbabilidad):
                                                                echo "<tr>";
                                                                echo "<td rowspan='" . (count($nivelProbabilidad, COUNT_RECURSIVE) + 1) . "'>" . $deficiencia . "</td>";
                                                                if (empty($resultado = capturaColumnas($nivelProbabilidad))) {
                                                                    echo "<td colspan='6'>&nbsp;</td>";
                                                                }
                                                                echo "</tr>";
                                                                foreach ($nivelProbabilidad as $nivProbabilidad => $nivelExposicion):
                                                                    echo "<tr>";
                                                                    echo "<td rowspan='" . (count($nivelExposicion, COUNT_RECURSIVE) + 1) . "'>" . $nivProbabilidad . "</td>";
                                                                    if (empty($resultado = capturaColumnas($nivelExposicion))) {
                                                                        echo "<td colspan='5'>&nbsp;</td>";
                                                                    }
                                                                    echo "</tr>";
                                                                    foreach ($nivelExposicion as $exposicion => $nivelConsecuencia):
                                                                        echo "<tr>";
                                                                        echo "<td rowspan='" . (count($nivelConsecuencia, COUNT_RECURSIVE) + 1) . "'>" . $exposicion . "</td>";
                                                                        if (empty($resultado = capturaColumnas($nivelConsecuencia))) {
                                                                            echo "<td colspan='4'>&nbsp;</td>";
                                                                        }
                                                                        echo "</tr>";
                                                                        foreach ($nivelConsecuencia as $consecuencia => $nivRiesgoNivel):
                                                                            echo "<tr>";
                                                                            echo "<td rowspan='" . (count($nivRiesgoNivel, COUNT_RECURSIVE) + 1) . "'>" . $consecuencia . "</td>";
                                                                            if (empty($resultado = capturaColumnas($nivRiesgoNivel))) {
                                                                                echo "<td colspan='3'>&nbsp;</td>";
                                                                            }
                                                                            echo "</tr>";
                                                                            foreach ($nivRiesgoNivel as $nivel => $rieDescripciones):
                                                                                echo "<tr>";
                                                                                echo "<td rowspan='" . (count($rieDescripciones, COUNT_RECURSIVE) + 1) . "' style='text-align:center;background-color:" . explode("/", $nivel)[1] . "' >" . explode("/", $nivel)[0] . "</td>";
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
