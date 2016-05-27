<table style="width: 100%;border: 1px solid #CCC">
    <tr>
        <td colspan="2" style="text-align: center;border:1px solid #CCC"><h4>MANUAL ESPECÍFICO DE FUNCIONES Y COMPETENCIAS LABORALES</h4></td>
    </tr>
    <tr >
        <td style="width: 40%;border: 1px solid #CCC;"><h4>NOMBRE DEL CARGO:</h4></td>
        <td style="width: 60%;border: 1px solid #CCC"><br><?php echo $cargo[0]->car_nombre ?><br></td>
    </tr>
    <tr >
        <td style="border:1px solid #CCC"><h4>CARGO DEL JEFE INMEDIATO </h4></td>
        <td style="border:1px solid #CCC"><?php echo $cargo[0]->jefe ?></td>
    </tr>
    <tr >
        <td style="border:1px solid #CCC"><h4>PERFIL DEL CARGO </h4></td>
        <td style="border:1px solid #CCC"><?php echo $cargo[0]->car_perfilCargo ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;border:1px solid #CCC"><h4>OBJETIVO PRINCIPAL</h4></td>
    </tr>
    <tr>
        <td colspan="2" style="border:1px solid #CCC"><?php echo $cargo[0]->car_objetivoPrincipal ?></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;border:1px solid #CCC"><h4>FUNCIONES ESENCIALES</h4></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: justify">
            <ul>
                <?php foreach ($funciones as $fe): ?>
                    <li><?php echo $fe->carFun_funcion ?></li>
                <?php endforeach; ?>
            </ul>
        </td>
    </tr>
</table>