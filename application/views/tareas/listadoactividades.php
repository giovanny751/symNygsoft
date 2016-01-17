<!-- Colorear Menu -->
<script type="text/javascript">
        $(".menPLAN_DE_TRABAJO").addClass("active open");
        $(".subMenACTIVIDADES").addClass("active");
</script>
<div class="page-bar" style="background-color: transparent !important;">
    <ul class="page-breadcrumb">
        <li class="devolver">
            <i class="fa fa-home"></i>
            <a href="<?php echo base_url("index.php/presentacion/principal") ?>">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li class="devolver">
            <a href="#">Plan De Trabajo</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li class="devolver">
            <a href="#">Listado Actividades</a>
        </li>
    </ul>
</div>
<div class="widgetTitle" >
    <h5>
        <i class="glyphicon glyphicon-ok"></i>ACTIVIDADES
    </h5>
</div>
<div class='well'>
    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
            <th>Fecha inicio</th>
            <th>Fecha Fin</th>
            <th>Presupuesto</th>
            <th>Descripción</th>
            <th>Opciones</th>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <i class="fa fa-times fa-2x eliminar btn btn-danger" title="Eliminar" emp_id="'+val.emp_id+'"></i>
                        <i class="fa fa-pencil-square-o fa-2x modificar btn btn-info" title="Modificar"  emp_id="'+val.emp_id+'"  data-toggle="modal" data-target="#myModal">
                        </i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row" style="text-align: center">
        <a href="<?php echo base_url("index.php/tareas/actividadhijo") ?>"><button type="button" class="btn btn-info">Crear actividad padre</button></a>
        <a href="<?php echo base_url("index.php/tareas/actividadhijo") ?>"><button type="button" class="btn btn-info">Crear actividad hijo</button></a>
    </div>
</div>