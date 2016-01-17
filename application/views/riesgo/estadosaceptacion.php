<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon estado" title="Guardar" ><i class="fa fa-floppy-o fa-3x"></i></div>
        <a href="<?php echo base_url()."/index.php/riesgo/nuevoriesgo" ?>"><div class="circuloIcon" title="Nuevo Riesgo" ><i class="fa fa-folder-open fa-3x"></i></div></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">ESTADOS DE ACEPTACIÓN</span> 
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <div class="row">
        <div class="form-inline">
            <div class="form-group">
                <label for="estadoaceptacion">Estado de aceptación</label>
                <input type="text" name="estadoaceptacion" id="estadoaceptacion" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <table class="tablesst" id="tablaPrincipal">
            <?php foreach ($estadoaceptacion as $id=>$es): ?>
                <?php foreach ($es as $descripcionEstado=>$col): ?>
                    <thead>
                        <tr>
                            <th><b><?php echo $descripcionEstado; ?></b></th>
                            <th><i class="fa fa-pencil-square-o fa-2x modificarEstado" title="Modificar Estado" estId="<?php echo $id ?>"></i></th>
                            <th><i class="fa fa-trash-o fa-2x eliminarEstado" title="Eliminar Estado" estId="<?php echo $id ?>" descripcion="<?php echo $descripcionEstado; ?>"></i></th>
                        </tr>
                    <?php if($col != null){ ?>
                            <tr>
                                <th width="80%"><b>Color</b></th>
                                <th width="10%"><b>Editar</b></th>
                                <th width="10%"><b>Eliminar</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($col as $colId=>$colColor): ?>
                                <tr>
                                    <td><b><?php echo $colColor; ?></b></td>
                                    <td class="transparent"><i class="fa fa-pencil-square-o fa-2x modificarColor" title="Modificar Color" colId="<?php echo $colId ?>"></i></td>
                                    <td class="transparent"><i class="fa fa-trash-o fa-2x eliminarColor" title="Eliminar Color" colId="<?php echo $colId ?>" estId="<?php echo $id ?>"></i></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php }else{ ?>
                        </thead>
                    <?php } ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="row">
        <button type="button" class="btn-sst" data-toggle="modal" data-target="#nuevoColor">Nuevo</button>
    </div>
    <!-- Modal Nuevo Color -->
    <div class="modal fade" id="nuevoColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><div class="circuloIcon" id="guardarmodificacion" ><i class="fa fa-floppy-o fa-3x"></i></div> NUEVO TIPO DE RIESGO</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="form-horizontal" method="post" id="frmestadocolor">
                            <div class="form-group">
                                <label for="estados" class="col-sm-offset-2 col-sm-2">Estados</label>
                                <div class="col-sm-6">
                                    <select name="estados" id="estados" class="form-control">
                                        <option value="">::Seleccionar::</option>
                                        <?php foreach ($estadoaceptacionxcolor as $ec): ?>
                                            <option value="<?php echo $ec->estAce_id ?>"><?php echo $ec->estAce_estado ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-offset-2 col-sm-2">Color</label>
                                <div class="col-sm-6">
                                    <select name="color" id="color" class="form-control">
                                        <option value="">::Seleccionar::</option>
                                        <?php foreach ($color as $co): ?>
                                            <option value="<?php echo $co->rieCol_id ?>"><?php echo $co->rieCol_color ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edtar Estado -->
    <div class="modal fade" id="editarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><div class="circuloIcon" id="guardarNuevoEstado" ><i class="fa fa-floppy-o fa-3x"></i></div> EDITAR ESTADO</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="form-horizontal" method="post" id="frmEditarNuevoEstado">
                            <div class="form-group">
                                <label for="editarNuevoEstado" class="col-sm-offset-2 col-sm-2">Estado</label>
                                <div class="col-sm-6">
                                    <input type="text" name="editarNuevoEstado" id="editarNuevoEstado" class="form-control">
                                </div>
                            </div>
                            <input type="hidden" id="EditarNuevoEstadoId" name="EditarNuevoEstadoId" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edtar Color -->
    <div class="modal fade" id="editarColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align: center"><div class="circuloIcon" id="guardarNuevoColor" ><i class="fa fa-floppy-o fa-3x"></i></div> EDITAR COLOR</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="form-horizontal" method="post" id="frmEditarNuevoColor">
                            <div class="form-group">
                                <label for="editarNuevoColor" class="col-sm-offset-2 col-sm-2">Color</label>
                                <div class="col-sm-6">
                                    <select name="editarNuevoColor" id="editarNuevoColor" class="form-control">
                                        <option value="">::Seleccionar::</option>
                                        <?php foreach ($color as $co): ?>
                                            <option value="<?php echo $co->rieCol_id ?>"><?php echo $co->rieCol_color ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" id="editarNuevoColorId" name="editarNuevoColorId" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#estadoaceptacion, #color").keypress(function(key){
        if(key.charCode == 34){
            return false;
        }
    });
    $('#guardarmodificacion').click(function(){
        var url = "<?php echo base_url("index.php/riesgo/guardarcolorxestado") ?>";
        $.post(url,$('#frmestadocolor').serialize())
                .done(function(msg){
                    if (msg != 1) {
                        actualizarTabla();
                        $("#nuevoColor").modal("hide");
                        alerta("verde", "Estado guardada con exito");
                    } else {
                        alerta("amarillo","El color ya existe en este estado")
                    }
                }).fail(function(msg){
                    alerta("rojo","error en el sistema por favor comunicarse con el administrador");
                });
    });
    //Guardar Estado
    $('.estado').click(function () {
        var url = "<?php echo base_url("index.php/riesgo/guardaestadoaceptacion") ?>";
        var estadoaceptacion = $('#estadoaceptacion').val();
        $.post(url,{estadoaceptacion: estadoaceptacion})
            .done(function (msg) {
                if (msg != 1) {
                    var select = "<option value=''>::Seleccionar::</option>";
                    $.each(msg,function(id,val){
                        select += "<option value='"+val.estAce_id+"'>" + val.estAce_estado + "</option>";
                    })
                    //Restauramos el select
                    $("#estados").html(select);
                    //Actualizamos tabla
                    actualizarTabla();
                    //Dejamos en blanco el campo
                    $('#estadoaceptacion').val(''); 
                    //Alerta
                    alerta("verde", "Estado guardado con exito")
                } else {
                    alerta("amarillo","Estado ya existe en el sistema")
                }
            })
            .fail(function (msg) {
                alerta("rojo", "Error por favor comunicarse con el administrador del sistema");
            });
    });
    //--------------------------------------------------------------------------
    //                                  ESTADO
    //--------------------------------------------------------------------------
    $("body").on("click",".eliminarEstado",function(){
        if(confirm("Deseas eliminar el estado?")){
            var idEstado = $(this).attr("estId");
            var descripcion = $(this).attr("descripcion");
            var url = "<?php echo base_url("index.php/riesgo/eliminaestadoaceptacion") ?>";
            $.post(url,{idEstado:idEstado,descripcion:descripcion})
                    .done(function(msg){
                        //Actualizamos tabla
                        actualizarTabla();
                        //alerta
                        alerta("verde","Eliminado");
                    })
                    .fail(function(){
                        alerta("rojo","Error eliminar")
                    });
        }
    });
    //Boton modificar Modal
    $("body").on("click",".modificarEstado",function(){
        var idEstado = $(this).attr("estId");
        var url = "<?php echo base_url("index.php/riesgo/consultaestadoaceptacion") ?>";
        $.post(url,{idEstado:idEstado})
                .done(function(msg){
                        $("#editarNuevoEstado").val(msg.estAce_estado);
                        $("#EditarNuevoEstadoId").val(idEstado);
                        $("#editarEstado").modal("toggle");
                })
                .fail(function(){
                    alerta("rojo","Error consultar estado");
                })
    });
    //Editar Estado
    $("body").on("click","#guardarNuevoEstado",function(){
        var url = "<?php echo base_url("index.php/riesgo/actualizarestadoaceptacion") ?>";
        var envio = $("#frmEditarNuevoEstado").serialize();
        $.post(url,envio)
                .done(function(msg){
                    if(msg != 1){
                        var select = "<option value=''>::Seleccionar::</option>";
                        $.each(msg,function(id,val){
                            select += "<option value='"+val.estAce_id+"'>" + val.estAce_estado + "</option>";
                        })
                        //Restauramos el select
                        $("#estados").html(select);
                        //Actualizamos tabla
                        actualizarTabla();
                        //Cerramos Modal
                        $("#editarNuevoEstado").val("");
                        $("#EditarNuevoEstadoId").val("");
                        $("#editarEstado").modal("toggle");
                    }else{
                        alerta("amarillo","Estado ya existe en el sistema");
                    }
                })
                .fail(function(){
                    alerta("rojo","Error editar estado");
                })
    });
    //--------------------------------------------------------------------------
    //                                  COLOR
    //--------------------------------------------------------------------------
    $("body").on("click",".eliminarColor",function(){
        if(confirm("Deseas eliminar este Color?")){
            var idColor = $(this).attr("colId");
            var idEstado = $(this).attr("estId");
            var url = "<?php echo base_url("index.php/riesgo/eliminacolor") ?>";
            $.post(url,{idColor:idColor,idEstado:idEstado})
                    .done(function(msg){
                        //Actualizamos tabla
                        actualizarTabla();
                        //alerta
                        alerta("verde","Color Eliminado");
                    })
                    .fail(function(){
                        alerta("rojo","Error eliminar color")
                    });
        }
    });
    //Boton modificar Modal
    $("body").on("click",".modificarColor",function(){
        var idColor = $(this).attr("colId");
        var url = "<?php echo base_url("index.php/riesgo/consultacolor") ?>";
        $.post(url,{idColor:idColor})
                .done(function(msg){
                        $("#editarNuevoColor").val(msg.rieCol_id);
                        $("#editarNuevoColorId").val(idColor);
                        $("#editarColor").modal("toggle");
                })
                .fail(function(){
                    alerta("rojo","Error consultar color");
                })
    });
    //Editar Color
    $("body").on("click","#guardarNuevoColor",function(){
        var url = "<?php echo base_url("index.php/riesgo/actualizarcolor") ?>";
        var envio = $("#frmEditarNuevoColor").serialize();
        $.post(url,envio)
                .done(function(msg){
                    if(msg != 1){
                        //Actualizamos tabla
                        actualizarTabla();
                        //Cerramos Modal
                        $("#editarNuevoColor").val("");
                        $("#editarNuevoColorId").val("");
                        $("#editarColor").modal("toggle");
                    }else{
                        alerta("amarillo","Color ya existe en el sistema");
                    }
                })
                .fail(function(){
                    alerta("rojo","Error editar color");
                })
    });
    //--------------------------------------------------------------------------
    //                                  TABLA
    //--------------------------------------------------------------------------
    function actualizarTabla(){
        var url = "<?php echo base_url("index.php/riesgo/tablaestadosaceptacion") ?>";
        $.post(url)
                .done(function(msg){
                    var table = "";
                    $.each(msg,function(id,es){
                        $.each(es,function(descripcionEstado,col){
                            table += "<thead>";
                            table += "<tr>";
                            table += "<th><b>" + descripcionEstado + "</b></th>";
                            table += "<th><i class='fa fa-pencil-square-o fa-2x modificarEstado' title='Modificar Estado' estId='" + id + "'></i></th>";
                            table += "<th><i class='fa fa-trash-o fa-2x eliminarEstado' title='Eliminar Estado' estId='" + id + "' descripcion='" + descripcionEstado +"'></i></th>";
                            table += "<tr>";
                            if(col != null){
                                table += "<tr>";
                                table += "<th width='80%'><b>Color</b></th>";
                                table += "<th width='10%'><b>Editar</b></th>";
                                table += "<th width='10%'><b>Eliminar</b></th>";
                                table += "</tr>";
                                table += "</thead>";
                                table += "<tbody>";
                                $.each(col,function(colId,colColor){
                                    table += "<tr>";
                                    table += "<td><b>" + colColor + "</b></td>";
                                    table += "<td class='transparent'><i class='fa fa-pencil-square-o fa-2x modificarColor' title='Modificar Color' colId='"+ colId +"'></i></td>";
                                    table += "<td class='transparent'><i class='fa fa-trash-o fa-2x eliminarColor' title='Eliminar Color' colId='"+colId+"' estId='" + id + "'></i></td>";
                                    table += "</tr>";
                                });
                                table += "</tbody>";
                            }else{
                                table += "</thead>";
                            }
                        });
                    });
                    $("#tablaPrincipal").html(table);
                })
                .fail(function(msg){
                    alerta("rojo","Error cargar tabla");
                })
    }
    
    
    
</script>    