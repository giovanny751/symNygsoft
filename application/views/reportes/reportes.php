
<div class="row">
    <div class="col-md-5 col-lg-5 col-sm-5 col-sx-5">
        <div class="row" align="right">
            <button type="button" data-toggle="modal" data-target="#myModal"  class="btn btn-success opciones">Nuevo</button>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table" align="center" border="1">
                    <thead>
                    <th>Nombre</th>
                    <!--<th>Estado</th>-->
                    <th>Opciones</th>
                    <th>Reporte</th>
                    </thead>
                    <tbody id="totalreportes">
                        <?php
                        foreach ($reporte as $totalreportes) {
                            ?>
                            <tr>
                                <td><?php echo $totalreportes['rep_nombre']; ?></td>
                                <!--<td><?php echo $totalreportes['rep_estado']; ?></td>-->
                                <td align="center"><button  data-toggle="modal" data-target="#myModal2"  class="btn btn-info opciones" repid="<?php echo $totalreportes['rep_id']; ?>">Opciones</button></td>
                                <td align="center"><button    class="btn btn-success reporte" repid="<?php echo $totalreportes['rep_id']; ?>">Reporte</button></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-1 col-lg-1 col-sm-1 col-sx-1"></div>
    <form method="post" id="formreport">
        <input type="hidden" name="idreporte" id="idreporte">
        <div class="col-md-6 col-lg-6 col-sm-6 col-sx-6">

            <div class="row">
                <label>Reporte</label><input type="text" class="form-control obligado" id="reporte" name="reporte">
            </div>
            <div class="row"><label>Host</label><input type="text" class="form-control" name="host" id="host"></div>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6 col-sx-6">
                    <label>User</label><input type="text" class="form-control" name="user" id="user">
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-sx-6">
                    <label>Password</label><input type="text" class="form-control" name="password" id="password">
                </div>
            </div>
            <div class="row">
                <label>XML</label><textarea style="height: 365px;" class="form-control obligado" id="query" name="query"></textarea>
            </div>
            <div class="row">
                <label>Categoria</label>
                <select class="form-control" name="categoria" id="categoria">
                    <option>-Seleccionar-</option>
                </select>
            </div>
            <div class="row" align="right">
                <button type="button" class="guardarquery btn btn-success">Validar</button>
            </div>
            <div class="row" align="center">
                <button type="button" class="guardartotalreporte btn btn-success">Guardar</button>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Nuevo</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" marginV20">
                    <div class="widgetTitle">
                        <h5><i class="glyphicon glyphicon-pencil"></i>Nuevo</h5>
                    </div>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                <label>Nombre</label><input type="text" id="nombre" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
            <div class="modal-footer">
                <div class="row marginV10">
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" class="btn btn-primary guardar">Guardar</button>
                    </div>
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" marginV20">
                    <div class="widgetTitle">
                        <h5><i class="glyphicon glyphicon-pencil"></i>Editar</h5>
                    </div>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                <label>Nombre</label><input type="text" id="editnombre" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                <label>Estado</label>
                                <select id="estado" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
            <div class="modal-footer">
                <div class="row marginV10">
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" class="btn btn-primary guardareditado">Guardar</button>
                    </div>
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" class="btn btn-danger guardar">Eliminar</button>
                    </div>
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .color{
        color: blue;
    }
</style>
<script>
    
    $('.guardartotalreporte').click(function () {

        var url = "<?php echo base_url('index.php/reportes/guardartodoreporte') ?>";
        var i = 0;
        $('.obligatorio').each(function (indice, campo) {
            if ($(this).val() == "") {
                i++;
            }
        });
        if (i == 0) {
            $.post(url, $('#formreport').serialize(), function (data) {

            });
        }
    });

    $('body').delegate('.reporte', 'click', function () {

        var id = $(this).attr('repid');
        $('#idreporte').val(id);
        var url = "<?php echo base_url('index.php/reportes/allreport') ?>";

        $.post(url, {id: id}, function (data) {
//            console.log(data);
//            data.rep_id();
            $('#reporte').val(data.rep_nombre);
            $('#query').val(data.rep_query);
            $('#host').val(data.rep_host);
            $('#user').val(data.rep_user);
            $('#password').val(data.rep_password);

        });
    });

    $('body').delegate('.guardarquery', 'click', function () {
        var query = $('#query').val();
        var url = "<?php echo base_url('index.php/reportes/validarquery') ?>";
        $.post(url, {query: query}, function (data) {

        });
    });

    $('.guardar').click(function () {

        $('#totalreportes *').remove();

        var nuevoreporte = $('#nombre').val();
        var url = "<?php echo base_url('index.php/reportes/guardarreporte') ?>";
        $.post(url, {nuevoreporte: nuevoreporte}, function (data) {
            var bodytable = "";
            $.each(data, function (key, val) {
                bodytable += "<tr>";
                bodytable += "<td>" + val.rep_nombre + "</td>"
                bodytable += "<td>" + val.rep_estado + "</td>"
                bodytable += '<td><button class="btn btn-info opciones" repid="' + val.rep_id + '">Opciones</button></td>'
                bodytable += "</tr>";
            });

            $('#totalreportes').append(bodytable);

            $('#myModal').modal('hide');
        });
    });

    $('.guardareditado').click(function () {
        var id = $(this).attr('reportid');
        var nombre = $('#editnombre').val();
        var estado = $('#estado').val();
        var url = "<?php echo base_url('index.php/reportes/editreport'); ?>";
        $.post(url, {nombre: nombre, estado: estado, id: id}, function (data) {

        });
    });

    $('table').delegate('.opciones', 'click', function () {

        var id = $(this).attr('repid');
        var url = "<?php echo base_url('index.php/reportes/inforeport'); ?>";

        $.post(url, {id: id}, function (data) {
            $('.guardareditado').attr('reportid', data.rep_id);
            $('#editnombre').val(data.rep_nombre);
            $('#estado').val(data.rep_estado);
        });
    });


</script>

