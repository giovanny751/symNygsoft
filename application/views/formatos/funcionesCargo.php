<table style="width: 100%;border: 1px solid #CCC">
    <tr >
        <td style="width: 40%;border: 1px solid #CCC;"><br><b>NOMBRE DEL CARGO:</b><br></td>
        <td style="width: 60%;border: 1px solid #CCC"><br><?php echo $cargo[0]->car_nombre ?><br></td>
    </tr>
    <tr >
        <td style="border:1px solid #CCC"><br><b>CARGO DEL JEFE INMEDIATO </b><br></td>
        <td style="border:1px solid #CCC"><?php echo $cargo[0]->jefe ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;border:1px solid #CCC"><br><b>OBJETIVO PRINCIPAL</b><br></td>
    </tr>
    <tr>
        <td colspan="2" style="border:1px solid #CCC"><?php echo $cargo[0]->car_objetivoPrincipal ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center"><br><b>FUNCIONES ESENCIALES</b><br></td>
    </tr>
    <tr>
        <td>
            <ul>
                <?php foreach($funciones as $fe):?>
                <li><?php echo $fe->carFun_funcion ?></li>
                <?php endforeach; ?>
            </ul>
        </td>
    </tr>
</table>