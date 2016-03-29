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
        <?php 
//            print_y($matriz);
            foreach ($matriz as $plan => $act_hijos):
                echo "<tr>";
                echo "<td rowspan='".(count($act_hijos, COUNT_RECURSIVE)+1)."'>".$plan."</td>";
                echo "</tr>";
                foreach ($act_hijos as $act_hijo => $tareas):
                    echo "<tr>";
                    echo "<td rowspan='".(count($tareas, COUNT_RECURSIVE)+1)."'>".$act_hijo."</td>";
                    echo "</tr>";
                    foreach ($tareas as $tarea => $categorias):
                        echo "<tr>";
                        echo "<td rowspan='".(count($categorias, COUNT_RECURSIVE)+1)."'>".$tarea."</td>";
                        echo "</tr>";
                        foreach ($categorias as $categoria => $tipos):
                            echo "<tr>";
                            echo "<td rowspan='".(count($tipos, COUNT_RECURSIVE)+1)."'>".$categoria."</td>";
                            echo "</tr>";
                            foreach ($tipos as $tipo => $rieDescripciones):
                                echo "<tr>";
                                echo "<td rowspan='".(count($rieDescripciones, COUNT_RECURSIVE)+1)."'>".$tipo."</td>";
                                echo "</tr>";
                                foreach ($rieDescripciones as $rieDescripcion => $indices):
                                    echo "<tr>";
                                    echo "<td rowspan='".(count($indices, COUNT_RECURSIVE)+1)."'>".$rieDescripcion."</td>";
                                    echo "</tr>";
                                    foreach ($indices as $indice => $val):
                                        echo "<tr>";
                                        echo "<td>".$val."</td>";
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
