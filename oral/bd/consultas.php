<?php

include_once 'conexion.php';

$tipo = $_POST['tipo'];

switch ($tipo) {
    case 1:
        $query = "insert into contactenos (con_nombre,con_correo,con_telefono,con_mensaje)"
            . " values('".$_POST['nombre']."','".$_POST['correo']."','".$_POST['telefono']."','".$_POST['mensaje']."')";
        mysql_query($query);
        break;

    default:
        break;
}