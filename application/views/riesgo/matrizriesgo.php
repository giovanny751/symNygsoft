<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">MATRIZ DE RIESGO</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <table class="table table-bordered table-hover">
        <?php
        foreach ($matriz as $plan => $cantidad):
            echo "<tr>";
            echo "<td rowspan='".count($cantidad,COUNT_RECURSIVE)."'>" . $plan . "</td>";
            for($i = 0; $i < count($cantidad);$i++){
                if($i == 0):
                    echo "<td>".$cantidad[$i]."</td>";
                    echo "<tr>";
                else:
                    echo "<tr>";
                    echo "<td>".$cantidad[$i]."</td>";
                    echo "<tr>";
                endif;
            }
        endforeach;
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
