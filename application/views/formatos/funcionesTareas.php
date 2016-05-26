
<table>
    <tr>
        <td>Nombre</td>
        <td><?php echo (!empty($tarea->tar_nombre)) ? $tarea->tar_nombre : ""; ?></td>
    </tr>
    <tr>
        <td>Plan</td>
        <td><?php echo (!empty($tarea->pla_id)) ? $tarea->pla_id : ""; ?></td>
    </tr>
    <tr>
        <td>Actividad padre</td>
        <td><?php echo (!empty($tarea->actPad_id)) ? $tarea->actPad_id : ""; ?></td>
    </tr>
    <tr>
        <td>Actividad</td>
        <td><?php echo (!empty($tarea->actHij_id)) ? $tarea->actHij_id : ""; ?></td>
    </tr>
    <tr>
        <td>Rutinario</td>
        <td><?php echo ((!empty($tarea->tar_rutinario)) && (1 == $tarea->tar_rutinario) ? "SI" : "NO") ?></td>
    </tr>
    <tr>
        <td><?php echo $empresa[0]->Dim_id ?></td>
        <td><?php echo (!empty($tarea->dim_id)) ? $tarea->dim_id : ""; ?></td>
    </tr>
    <tr>
        <td><?php echo $empresa[0]->Dimdos_id ?></td>
        <td><?php echo (!empty($tarea->dim2_id)) ? $tarea->dim2_id : ""; ?></td>
    </tr>
    <tr>
        <td>Tipo</td>
        <td><?php echo (!empty($tarea->tip_id)) ? $tarea->tip_id : ""; ?></td>
    </tr>
    <tr>
        <td>Norma</td>
        <td><?php echo (!empty($tarea->nor_id)) ? $tarea->nor_id : ""; ?></td>
    </tr>
    <tr>
        <td>Artículo</td>
    </tr>
    <tr>
        <td>Fecha Incio</td>
    </tr>
    <tr>
        <td>Fecha Finalización</td>
    </tr>
    <tr>
        <td>Peso</td>
    </tr>
    <tr>
        <td>Estado</td>
    </tr>
    <tr>
        <td>Descripción</td>
    </tr>
    <tr>
        <td>Fecha de creación</td>
    </tr>
    <tr>
        <td>Fecha de modificación</td>
    </tr>
    <tr>
        <td><br><b>Responsable</b><br></td>
    </tr>
    <tr>
        <td>Cargo</td>
    </tr>
    <tr>
        <td>Nombre</td>
    </tr>
    <tr>
        <td>Tarea Padre</td>
    </tr>
    <tr>
        <td><br><b>Riesgos</b><br></td>
    </tr>
    <tr>
        <td> Clasificación de riesgo</td>
    </tr>
    <tr>
        <td>Tipos de Riesgos</td>
    </tr>
    <tr>
        <td>Riesgos</td>
    </tr>
</table>

<p></p>

<table>
    <tr>
        <td><b>SEGUIMIENTO</b></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
</table>

<p></p>

<table>
    <tr>
        <td><b>REGISTROS</b></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
</table>