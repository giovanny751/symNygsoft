<?php
include("config.inc.php");
?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.1.0/css/fixedColumns.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedcolumns/3.1.0/js/dataTables.fixedColumns.min.js"></script>


<style type="text/css">
    h4{background-color: #1e90ff;color: white;padding-bottom: 10px;padding-top: 10px;text-align: center;margin-bottom: 0;}
    thead{background-color:#788FBF;color: white}
</style>
<?php
$añoActual = date("Y");
$estado = array(14, 6);
$titulo = array('ENTREGADO AL CLIENTE (PF)', 'ENTREGADO AL CLIENTE');
$idTabla = array("entregadoClientePF","entregadoCliente")
?> 
<br />
<?php
for ($ii = 0; $ii < 2; $ii++) {
    $GET = SIMUtil::makeSafe($_GET);
//paginador todos los articulos
//    $sql = "SELECT Usuario.Nombre,p.Fecha,p.GranTotal
//    FROM Usuario 
//    join Pedido p on p.IDUsuario=Usuario.IDUsuario 
//    WHERE p.IDEstado=" . $estado[$ii] . " and Usuario.IDUsuario <> 1 AND p.Fecha LIKE '%" . $añoActual . "%'
//    GROUP BY Usuario.Nombre,p.Fecha
//    ORDER BY Usuario.Nombre,p.Fecha";

    $sql = "
        SELECT 
            Usuario.Nombre
            ,p.Fecha
            ,p.GranTotal
            ,p.IDEstado
        FROM 
            Usuario 
        JOIN 
            Pedido p on 
                p.IDUsuario=Usuario.IDUsuario 
        WHERE 
            1 = 1
            and (p.IDEstado= " . $estado[$ii] . " or p.IDEstado=11)
            and Usuario.IDUsuario <> 1 
            and p.Fecha LIKE '%" . $añoActual . "%'
        GROUP BY 
            Usuario.Nombre,p.Fecha
        ORDER BY 
            Usuario.Nombre,p.Fecha";

    $paging = new PHPPaging;
    $paging->agregarConsulta($sql);
    $paging->porPagina(10000);
    $paging->mostrarPrimera("<<");
    $paging->mostrarUltima(">>");
    $paging->linkSeparadorEspecial("|");
    $paging->ejecutar();
    ?>
    
            <h4><?php echo $titulo[$ii] ?></h4>
            <table id="<?php echo $idTabla[$ii] ?>" class="dataTable display cell-border"> 
                <thead>
                    <tr>
                        <th>Asesor/Periodo</th>
                        <?php
                        $mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                        for ($i = 0; $i < count($mes); $i++) {
                            ?>
                            <th>E</th>
                            <th>V</th>
                            <th>%</th>
                            <th><?php echo $mes[$i]; ?></th>
                            <?php
                        }
                        ?>
                        <th>Suma Total</th>
                    </tr>
                </thead>
                <!-- Filtros -->
                <tbody>
                <?php
                while ($datos = $paging->fetchResultado()) {
                    $fecha = $datos[Fecha];
                    //Separamos Fecha [0] = Y [1] = M [2] = D
                    $fecha = explode('-', $fecha);

                    if (isset($datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-" . $fecha[1]])) {
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-" . $fecha[1]] += 1;
                    } else {
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-01"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-02"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-03"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-04"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-05"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-06"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-07"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-08"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-09"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-10"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-11"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-12"] = 0;
                        $datos_generales[$datos[Nombre]]["total"][$fecha[0] . "-" . $fecha[1]] = 1;
                    }
                    if ($datos[IDEstado] == $estado[$ii]) {
                        if (isset($datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-" . $fecha[1]])) {
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-" . $fecha[1]] += 1;
                        } else {
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-01"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-02"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-03"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-04"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-05"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-06"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-07"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-08"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-09"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-10"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-11"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-12"] = 0;
                            $datos_generales[$datos[Nombre]]["exito"][$fecha[0] . "-" . $fecha[1]] = 1;
                        }
                        if (isset($datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-" . $fecha[1]])) {
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-" . $fecha[1]]+=$datos[GranTotal];
                        } else {
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-01"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-02"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-03"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-04"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-05"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-06"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-07"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-08"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-09"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-10"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-11"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-12"] = 0;
                            $datos_generales[$datos[Nombre]]["mes"][$fecha[0] . "-" . $fecha[1]] = $datos[GranTotal];
                        }
                    }
                }

                $sumaTotalMes = array();
                foreach ($datos_generales as $nombre => $datoColumna) {
                    if (isset($datoColumna["exito"]) && isset($datoColumna["total"]) && isset($datoColumna["mes"])) {
                        $sumaTotal = 0;
                        echo "<tr>";
                        echo "<td>" . $nombre . "</td>";
                        for ($i = 1; $i <= count($mes); $i++) {
                            $fechaMes = $añoActual . "-" . sprintf("%02d", $i);
                            $porcentaje = number_format(($datoColumna["exito"][$fechaMes] / $datoColumna["total"][$fechaMes]) * 100, 1);
                            echo "<td>" . $datoColumna["exito"][$fechaMes] . "</td>";
                            echo "<td>" . $datoColumna["total"][$fechaMes] . "</td>";
                            echo "<td>" . $porcentaje . "%</td>";
                            echo "<td>$" . number_format($datoColumna["mes"][$fechaMes], 0, ".", ".") . "</td>";
                            $sumaTotal += $datoColumna["mes"][$fechaMes];
                            $sumaTotalMes["exito"][$fechaMes] += $datoColumna["exito"][$fechaMes];
                            $sumaTotalMes["total"][$fechaMes] += $datoColumna["total"][$fechaMes];
                            $sumaTotalMes["mes"][$fechaMes] += $datoColumna["mes"][$fechaMes];
                        }
                        $sumaTotalMes["mesTotal"] += $sumaTotal;
                        echo "<td>$" . number_format($sumaTotal, 0, ".", ".") . "</td>";
                        echo "</tr>";
                    }
                }
                echo "<tr  style='background: #F0F8FF'>";
                echo "<td>Total</td>";
                for ($i = 1; $i <= count($mes); $i++) {
                    $fechaMes = $añoActual . "-" . sprintf("%02d", $i);
                    $porcentaje = number_format(($sumaTotalMes["exito"][$fechaMes] / $sumaTotalMes["total"][$fechaMes]) * 100, 1);
                    echo "<td>" . $sumaTotalMes["exito"][$fechaMes] . "</td>";
                    echo "<td>" . $sumaTotalMes["total"][$fechaMes] . "</td>";
                    echo "<td>" . $porcentaje . "%</td>";
                    echo "<td>$" . number_format($sumaTotalMes["mes"][$fechaMes], 0, ".", ".") . "</td>";
                }
                echo "<td>$" . number_format($sumaTotalMes["mesTotal"], 0, ".", ".") . "</td>";
                echo "</tr>";
                ?>
                </tbody>
            </table>
            <?php
//                        echo "<pre>";
//                        print_r($sumaTotalMes);
//                        echo "</pre>";
            unset($sumaTotalMes);
            unset($datos_generales);
            ?>

<?php } ?>
<script>
    $(document).ready(function() {
        $('#entregadoClientePF').DataTable({
        scrollX: true,
        fixedColumns: true
    });
        $('#entregadoCliente').DataTable({
        scrollX: true,
        fixedColumns: true
    });
        $('input').on( 'keyup click', function () {
            filterGlobal($(this).attr("aria-controls"),$(this));
        } );
        function filterGlobal(id,campo){
            $('#'+id).DataTable().search(campo.val(),true,false ).draw();
        }
    })
    
</script>

