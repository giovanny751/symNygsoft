<table class="table table-striped table-bordered table-hover tabla-sst">
    <thead>
        <tr>
            <th rowspan="2">Cedula</th>
            <th rowspan="2">Nombre Empleado</th>
            <th rowspan="2">Cargo</th>
            <th rowspan="2">Salario</th>
            <th rowspan="2">Dias Trabajados</th>
            <th colspan="5" style="text-align: center">Devengado</th>
            <th colspan="5" style="text-align: center">Deducciones</th>
            <th rowspan="2">Neto pagado</th>
        </tr>
        <tr>
            <th>Basico</th>
            <th>Auxilio Transporte</th>
            <th>Bonificaciones</th>
            <th>Vacaciones</th>
            <th>Total Devengado</th>
            <th>Aportes salud</th>
            <th>Aportes Pension</th>
            <th>Prestamos</th>
            <th>Sanciones</th>
            <th>Total deducido</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($empleados as $e): ?>
            <tr>
                <td><?php echo $e->Emp_Cedula ?></td>
                <td><?php echo $e->Emp_Nombre . " " . $e->Emp_Apellidos ?></td>
                <td><?php echo $e->car_nombre ?></td>
                <td><?php echo $e->emp_salario ?></td>
                <td>dias trabajados</td>
                <td><?php echo $auxilioTransporte->parNom_salarioMinimo ?></td>
                <td><?php echo $auxilioTransporte->parNom_auxilioTransporte ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo $auxilioTransporte->parNom_aporteSalud ?></td>
                <td><?php echo $auxilioTransporte->parNom_aportePension ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>