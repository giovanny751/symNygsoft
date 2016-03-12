<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>NOTIFICACIONES
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <th>Notificación</th>
                        <th>Permiso</th>
                        </thead>
                        <tbody>
                            <?php foreach ($notificacion as $not): ?>
                                <tr>
                                    <td><?php echo $not->not_notificacion ?></td>
                                    <td style="text-align:center">
                                        <button type="button" class="btn btn-success cargos" not="<?php echo $not->not_id ?>">Permiso</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cargos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">CARGOS</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-offset-2 col-sx-offset-2 col-md-8 col-sx-8">
                        <form method="post" id="frmCargosNotificaciones">
                            <input type='hidden' name="notificacion" id="notificacion">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th colspan="2">Cargo</th>
                            </thead>
                            <tbody id="cargosAsociados">

                            </tbody>
                        </table>
                        </form>    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary guardarCargos">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('body').delegate('.guardarCargos','click',function(){
        $.post(url + "index.php/Notificacion/notificacionesCargo",
        $('#frmCargosNotificaciones').serialize()
        ).done(function (msg) {
            
        }).fail(function(msg){
            
        })
    });
    $('body').delegate(".cargos", "click", function () {
        $("#cargosAsociados *").remove();
        $('#notificacion').val($(this).attr('not'));
        $.post(url + "index.php/Notificacion/cargosAsociadosNotificacion",
                {notificacion: $(this).attr('not')}
        ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message'])
            else {
                var tabla = ""
                $.each(msg.Json,function(key,val){
                    existencia = (val.not_id)?"checked":"";
                    tabla += "<tr>"
                    tabla += "<td>"+val.car_nombre+"</td>"
                    tabla += "<td><input type='checkbox' name='cargos[]' "+existencia+" value='"+val.car_id+"' ></td>"
                    tabla += "</tr>"
                });
                $('#cargosAsociados').append(tabla);
                $('#cargos').modal('show');
            }
        }).fail(function (msg) {
            alerta("rojo", "Error comunicarse con el administrador");
        });
    });
</script>   