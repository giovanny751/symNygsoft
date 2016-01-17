<div style='border: 1px solid blue;width:50%;padding: 40px;'>
    <div style='text-align: center'>
        <img src='<?php echo base_url("uploads/empresa/2/") ."/". $empresa[0]->emp_logo; ?>' style="width: 350;height: 155px;border-radius: 15px">
    </div>
        <br>
    <p>Señor(@): <?php echo ucwords(strtolower($nombre)) ?></p>

    <p>Le damos la Bienvenida al software del Sistema de gesti&oacute;n de Seguridad y Salud en el Trabajo (SG-SST)</p>

    <p>Estamos enviando la informaci&oacute;n relacionada con su cuenta y clave de acceso al sistema</p>
    <table>
        <tr>
            <th style='text-align: left;'><b>Usuario:</b></th>
            <td style='text-transform: capitalize'><?php echo $usuario; ?></td>
        </tr>
        <tr>
            <th style='text-align: left;'><b>Clave: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></th>
            <td style='text-transform: capitalize'><?php echo $contrasena; ?></td>
        </tr>
    </table>    
    <br>
    <p>Consideraciones de Seguridad: El usuario es personal e intransferible, no permita que terceros usen esta informaci&oacute;n.</p>
    <p>Advertencia. Debe cambiar la clave enviada luego de su
        primera interacci&oacute;n con el sistema, a trav&eacute;s de la opci&oacute;n Cambiar Clave, 
        de no hacerlo la responsabilidad de este hecho recae totalmente sobre Usted</p>
    <p>NOTA: Por favor no responder este correo, cualquier duda o inquietud comunicarse con el administrador del sistema.</p>
</div>