<table style="width: 100">
    <tr>
        <td style="width: 40%">NOMBRE DEL CARGO:</td>
        <td style="width: 60%"><?php echo $cargo[0]->car_nombre ?></td>
    </tr>
    <tr>
        <td style="width: 40%">CARGO DEL JEFE INMEDIATO </td>
        <td style="width: 60%"><?php echo $cargo[0]->jefe ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center">OBJETIVO PRINCIPAL</td>
    </tr>
    <tr>
        <td colspan="2"><?php echo $cargo[0]->car_objetivoPrincipal ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center">FUNCIONES ESENCIALES</td>
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