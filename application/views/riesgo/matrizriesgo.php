<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">MATRIZ DE RIESGO</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
        <?php
        $tabla = "<table>";
        foreach ($matriz as $key => $value) {
            $tabla .= "<tr><td rowspan='".count($value)."'>".$key."</td>";
            for ($i = 0; $i < count($value); $i++) {
               $tabla .= "<tr>".$value[$i]."</tr>";
            }
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";
        echo $tabla;
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
