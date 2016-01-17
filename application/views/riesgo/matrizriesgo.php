<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">MATRIZ DE RIESGO</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <table border="0">
        <?php
        echo "<tr><td><table border='0' >";
        foreach ($matriz as $key => $value) {
            echo '<tr>';
            if (!empty($key))
                echo "<td class='t1' >" . $key . "</td>";
            echo '<td><table>';
            foreach ($value as $key2 => $value2) {
                echo '<tr>';
                if (!empty($key2))
                    echo "<td class='t1' >" . $key2 . "</td>";
                echo '<td><table>';
                foreach ($value2 as $key3 => $value3) {
                    echo '<tr>';
                    if (!empty($key3))
                        echo "<td class='t1' >" . $key3 . "</td>";
                    echo '<td><table>';
                    foreach ($value3 as $key4 => $value4) {
                        echo '<tr>';
                        if (!empty($key4))
                            echo "<td class='t1' >" . $key4 . "</td>";
                        echo '<td><table>';
                        foreach ($value4 as $key5 => $value5) {
                            if (!empty($key5))
                                echo "<tr><td class='t5'>" . $key5 . "</td></tr>";
                        }
                        echo "</table></td>";
                    }
                    echo "</table></td>";
                }
                echo "</table></td>";
            }
            echo "</table></td>";
        }
        echo "</table></td></tr>";
        ?>
    </table>              
    <?php // print_y($matriz); ?>
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
