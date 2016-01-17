<div>
    <h2 align="center">CREACION DE REPORTES</h2>
</div>
<div class="row">
    <button type="button" data-toggle="modal" data-target="#myModal2"  class="btn btn-info opciones">Nuevo Reporte</button>
</div>
<?php if (!empty($nombrepadre)) {
    ?> <div padre="<?= $hijo ?>"  class="row devolver" ><b><?= $nombrepadre ?></b></div>
<?php } else { ?>
    <div class="row devolver"><b>Principal</b></div>
<?php } ?>
<div class="row">
    <form method="post" id="formulario">
        <div class="table-responsive">
            <table class="table" align="center" border="1">
                <thead>
                <th align="center">Nombre</th>
                <th align="center">xml</th>
                <th align="center">Eliminar</th>
                <th align="center">Sub Reporte</th>
                </thead>
                <tbody id="cuerpomodulo">
                    <?php if (empty($menu)) { ?><tr><td colspan="3" align="center">No Existen Datos</td></tr><?php } ?>
                    <?php foreach ($menu as $modulo) { ?>
                        <tr id="<?= $modulo['rep_id'] ?>">
                            <td><?= $modulo['rep_nombrepadre'] ?></td>
                            <td align="center"><button type="button" data-toggle="modal" data-target="#myModal"  class="btn btn-info opciones"  idgeneral="<?= $modulo['rep_id'] ?>" nombre="<?= $modulo['rep_nombrepadre'] ?>" idpadre="<?= $modulo['rep_id'] ?>" >XML</button>
                            <td align="center"><button type="button" class="btn btn-danger eliminar"  idgeneral="<?= $modulo['rep_id'] ?>" nombre="<?= $modulo['rep_nombrepadre'] ?>" idpadre="<?= $modulo['rep_id'] ?>" >Eliminar</button></td>
                            <td align="center"><input type="radio" class="submodulo" idgeneral="<?= $modulo['rep_id'] ?>" idpadre="<?= $modulo['rep_idpadre'] ?>" nombrepadre="<?= $modulo['rep_nombrepadre'] ?>" name="submodulo" menu="<?= $modulo['rep_idhijo'] ?>"></td>
                        </tr>    
                    <?php } ?>
                </tbody>    
            </table>
        </div>
        <input type="hidden" id="menu" name="menu">
        <input type="hidden" id="nombrepadre" name="nombrepadre">
        <input type="hidden" id="idgeneral" name="idgeneral">
    </form> 
</div>    
<div id="desicion">
    <input type="hidden" id="papa">
</div>    
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">XML</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" marginV20">
                    <div class="widgetTitle">
                        <h5><i class="glyphicon glyphicon-pencil"></i> </h5>
                    </div>
                    <div class="well">
                        <div class="row">
                            <form method="post" id="formreport">
                                <input type="hidden" name="idreporte" id="idreporte">
                                <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">

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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>		
            <div class="modal-footer">
                <div class="row marginV10">
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" class="guardartotalreporte btn btn-success">Guardar</button>
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
                <h4 class="modal-title" id="myModalLabel">Creacion de Reporte</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" marginV20">
                    <div class="widgetTitle">
                        <h5><i class="glyphicon glyphicon-pencil"></i> Nuevo</h5>
                    </div>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                <label>Nombre Reporte</label><input type="text" placeholder="Modulo" id="modulo" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
            <div class="modal-footer">
                <div class="row marginV10">
                    <div class='col-md-12 col-lg-12 col-sm-12 col-sx-12 margenlogo' align='right' >
                        <button type="button" general="<?= $idgeneral ?>" padre="<?= $hijo ?>" class="btn btn-success" id="guardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
<form method="post" id="redireccion">
    <input type="hidden" name="idgeneral" id="idgeneral2">
    <input type="hidden" name="nombrepadre" id="nombrepadre2">
</form>    
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
                $('#myModal').modal('hide');
            });
        }
    });
    $('#desicion').hide();
    $('body').delegate(".opciones", "click", function () {                
        $('#idreporte').val($(this).attr('idgeneral'));
        $.post("<?php echo base_url('index.php/reportes/allreport') ?>", {id: $(this).attr('idgeneral')}, function (data) {
            $('#reporte').val(data.rep_nombrepadre);
            $('#query').val(data.rep_query);
            $('#host').val(data.rep_host);
            $('#user').val(data.rep_user);
            $('#password').val(data.rep_password);
        });
    });

    $('body').delegate('.eliminar', 'click', function () {
        if (confirm('Esta seguro que desea eliminar el Reporte') == true) {
            $.post("<?= base_url('index.php/reportes/eliminarmodulo') ?>", 
            {idgeneral: $(this).attr('generalid')}, 
            function (data) {
                $('#myModal').modal('hide');
            });
        }
    });
    $('a').click(function () {
        var papa = $(this).attr('padre');
        $('a').each(function (key, val) {
            if ($(this).attr('padre') > papa) {
                $(this).remove();
            }
        });
        $('#idgeneral2').val(papa);
        $('#nombrepadre2').val($('.devolver b').html());
        $('#redireccion').attr('href', "<?= base_url('index.php/reportes/menu') ?>");
        $('#redireccion').submit();
    });

    $('#guardar').click(function () {
        $.post("<?= base_url('index.php/reportes/guardarmodulo') ?>", 
        {
            modulo: $('#modulo').val(), 
            padre: $(this).attr('padre'), 
            general: $(this).attr('general')
        }, function (data) {
            $('#cuerpomodulo *').remove();
            var tabla = "";
            var eliminar ="";
            $.each(data, function (key, val) {
                eliminar = '<td align="center"><button type="button" class="btn btn-danger eliminar"  idgeneral="'+val.rep_id+'" nombre="'+val.rep_nombrepadre+'" idpadre="'+val.rep_id+'" >Eliminar</button></td>';
                tabla += "<tr><td>" + val.rep_nombrepadre + "</td><td align='center'><button class='btn btn-info opciones' data-target='#myModal' data-toggle='modal' idpadre='" + val.rep_idpadre + "' nombre='" + val.rep_nombrepadre + "' idgeneral='" + val.rep_id + "' type='button'>Opcion</button></td>"+eliminar+"<td align='center'><input menu='" + val.rep_idhijo + "' nombrepadre='" + val.rep_nombrepadre + "' idgeneral='" + val.rep_id + "' type='radio' name='submodulo' class='submodulo'></td></tr>";
            });
            $('#cuerpomodulo').append(tabla);
            $('#modulo').val('');
            $('#myModal2').modal('hide');
        });
    });

    $('body').delegate('.guardar', 'click', function () {

        $.post("<?= base_url('index.php/reportes/guardaratributosmenu') ?>", 
        {id: $(this).attr('generalid'), 
            nombre: $('#nombre').val(), 
            controlador: $('#controlador').val(), 
            accion: $('#accion').val(), 
            estado: $('#estado').val()
        }, function (data) {
            $('#myModal').modal('hide');
        });
    });

    $('body').delegate(".submodulo", "click", function () {
        $('#menu').val($(this).attr('menu'));
        $('#idgeneral').val($(this).attr('idgeneral'));
        $('#nombrepadre').val($('.devolver b').html() + "<i class='glyphicon glyphicon-chevron-right'></i><a padre='" + $(this).attr('menu') + "'>" + $(this).attr('nombrepadre') + "</a>");
        $('#formulario').attr('href', "<?= base_url('index.php/reportes/menu') ?>");
        $('#formulario').submit();
    });


</script>    