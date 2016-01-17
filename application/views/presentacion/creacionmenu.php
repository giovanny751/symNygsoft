<style type="text/css">
    .item:hover{
        cursor: pointer;
        background-color: #f5f5f5 !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">ADMINISTRACIÓN DE MODULOS</span>
        </div>
    </div>
</div>
<div class="cuerpoContenido">
    <div class="page-bar" style="background-color: transparent !important;">
        <ul class="page-breadcrumb">
            <?php if (!empty($nombrepadre)) { ?>
                <?php echo $nombrepadre ?>
            <?php } else { ?>
                <li class="devolver">
                    <i class="fa fa-home"></i>
                    <a href="<?= base_url("index.php/presentacion/creacionmenu") ?>">Principal</a>
                    <i class="fa fa-angle-right"></i>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="row">
        <button type="button" data-toggle="modal" data-target="#myModal2"  class="btn btn-info opciones">Nuevo Modulo</button>
    </div>
    <div class="row">
        <form method="post" id="formulario">
            <table class="tablesst" >
                <thead>
                <th>Nombre</th>
                <th>Opción</th>
                <th>Seguridad</th>
                <th>Sub Modulo</th>
                <th>Eliminar</th>
                </thead>
                <tbody id="cuerpomodulo">
                    <?php if (empty($menu)) { ?>
                        <tr>
                            <td colspan="3" align="center">No Existen Datos</td>
                        </tr>
                        <?php
                    }
                    foreach ($menu as $modulo) {
                        ?>
                        <tr id="<?= $modulo['menu_id'] ?>">
                            <td><?= $modulo['menu_nombrepadre'] ?></td>
                            <td align="center"><button type="button" data-toggle="modal" data-target="#myModal"  class="btn btn-info opciones"  idgeneral="<?= $modulo['menu_id'] ?>" nombre="<?= $modulo['menu_nombrepadre'] ?>" idpadre="<?= $modulo['menu_id'] ?>" >Opción</button>
                            </td>
                            <td style="text-align: center"><button type="button"  class="btn btn-success metodos" idgeneral="<?php echo $modulo['menu_id'] ?>" idpadre="<?php echo $modulo['menu_idpadre'] ?>" menu="<?php echo $modulo['menu_idhijo'] ?>">Metodos</button></td>
                            <td align="center"><input type="radio" class="submodulo" idgeneral="<?= $modulo['menu_id'] ?>" idpadre="<?php echo $modulo['menu_idpadre'] ?>" nombrepadre="<?php echo $modulo['menu_nombrepadre'] ?>" name="submodulo" menu="<?php echo $modulo['menu_idhijo'] ?>"></td>
                            <td style="text-align:center"><button type="button" class="btn btn-danger eliminarSubModulo" generalid='<?php echo $modulo['menu_id'] ?>'>Eliminar</button></td>
                        </tr>    
                    <?php } ?>
                </tbody>    
            </table>
            <input type="hidden" id="menu" name="menu">
            <input type="hidden" id="nombrepadre" name="nombrepadre">
            <input type="hidden" id="idgeneral" name="idgeneral">
        </form> 
    </div>    
    <div id="desicion">
        <input type="hidden" id="papa">
    </div>    
</div>    
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Modificacion</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" marginV20">
                    <div class="widgetTitle">
                        <h5><i class="glyphicon glyphicon-pencil"></i> Editar</h5>
                    </div>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                <label>Nombre</label><input type="text" id="nombre" class="form-control">
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                <label>Controlador</label><input type="text" name="controlador" id="controlador"  class="form-control">
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                <label>Accion</label><input type="text" name="accion" id="accion"  class="form-control">
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                <label>Estado</label>
                                <select id="estado"  class="form-control">
                                    <option value="">-Seleccionar-</option>
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
                        <button type="button" class="btn btn-success guardar">Guardar</button>
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
                <h4 class="modal-title" id="myModalLabel">Creacion de Menu</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" marginV20">
                    <div class="widgetTitle">
                        <h5><i class="glyphicon glyphicon-pencil"></i> Nuevo</h5>
                    </div>
                    <div class="well">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                                <label>Nombre Menu</label><input type="text" placeholder="Modulo" id="modulo" class="form-control">
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
<!-- Modal -->
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Creacion de Menu</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <form method="post" id="FrmMetodos">
                    <input type="hidden" name="modulo" id="Hdnmodulo" >
                    <div id="modalHtml"></div>
                </form>
            </div>		
            <div class="modal-footer">
                <div class="row marginV10">
                    <div class='col-md-12 col-lg-12 col-sm-12 col-sx-12 margenlogo' align='right' >
                        <button type="button" class="btn btn-success" id="guardarmetodos">Guardar</button>
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

    $('body').delegate("#guardarmetodos", "click", function () {
        $.post("<?php echo base_url("index.php/presentacion/guardarMetodos") ?>", $('#FrmMetodos').serialize())
                .done(function (msg) {
                    $('#myModal5').modal("hide");
                    alerta("verde", "Guardado");
                })
                .fail(function (msg) {
                    alerta("rojo", "Error");
                });
    });
    
    function htmlModal(datos){
        var clases = ["TxtClaseEliminar[]","TxtClaseActualizar[]","TxtClaseConsultar[]","TxtClaseInsertar[]"];
        var metodos = ["TxtMetodoEliminar[]","TxtMetodoActualizar[]","TxtMetodoConsultar[]","TxtMetodoInsertar[]"];
        var idEtiqueta = ["filaEliminar","filaActualizar","filaConsultar","filaInsertar"];
        var titulo = ["Eliminar","Actualizar","Consultar","Insertar"];
        var html = "";
        for(var i=0 ; i<4; i++){
            var fila = false;
            html += "<div class=\"marginV20\">";
            html += "<div class=\"widgetTitle\">";
            html += "<h5><i class=\"glyphicon glyphicon-pencil\"></i> "+titulo[i]+"</h5>";
            html += "</div>";
            html += "<div class=\"well\" id=\""+idEtiqueta[i]+"\">";
            html += "<div class=\"row\">";
            html += "<div class=\"col-md-12 col-lg-12 col-sm-12 col-sx-12\">";
            html += "<button type=\"button\" class=\"agregarmetodo btn btn-success\" tipo=\""+parseInt(i+1)+"\">+</button>";
            html += "</div>";
            html += "</div>";
            $.each(datos,function(metodo,cantidad){
                if(metodo == (i+1)){
                    $.each(cantidad,function(index,valor){
                        html += "<div class=\"row\">";
                        html += "<div class=\"col-md-5 col-lg-5 col-sm-5 col-sx-5\">";
                        html += "<label>Clase</label>";
                        html += "<input type=\"text\" placeholder=\"Modulo\" name=\"" + clases[i] + "\" value=\""+valor[0]+"\" id=\"modulo\" class=\"form-control\" >";
                        html += "</div>";
                        html += "<div class=\"col-md-5 col-lg-5 col-sm-5 col-sx-5\">";
                        html += "<label>Metodo</label>";
                        html += "<input type=\"text\" placeholder=\"Modulo\" name=\"" + metodos[i] + "\" value=\""+valor[1]+"\" id=\"modulo\" class=\"form-control\" >";
                        html += "</div>";
                        html += "<div class=\"col-md-2 col-lg-2 col-sm-2 col-sx-2\">";
                        html += "<button type=\"button\" class=\"eliminarmetodo btn btn-danger\">-</button>";
                        html += "</div>";
                        html += "</div>";
                    });
                    fila = true
                    return false;
                }
            });
            
            if(fila == false){
                html += "<div class=\"row\">";
                html += "<div class=\"col-md-5 col-lg-5 col-sm-5 col-sx-5\">";
                html += "<label>Clase</label>";
                html += "<input type=\"text\" placeholder=\"Modulo\" name=\"" + clases[i] + "\" id=\"modulo\" class=\"form-control\" >";
                html += "</div>";
                html += "<div class=\"col-md-5 col-lg-5 col-sm-5 col-sx-5\">";
                html += "<label>Metodo</label>";
                html += "<input type=\"text\" placeholder=\"Modulo\" name=\"" + metodos[i] + "\" id=\"modulo\" class=\"form-control\" >";
                html += "</div>";
                html += "<div class=\"col-md-2 col-lg-2 col-sm-2 col-sx-2\">";
                html += "<button type=\"button\" class=\"eliminarmetodo btn btn-danger\">-</button>";
                html += "</div>";
                html += "</div>";
            }
            
            html += "</div>";
        }
        $("#modalHtml").html(html);
    }

    
    $('body').delegate(".metodos", "click", function () {
        var modulo = $(this).attr('idgeneral');
        var url = "<?php echo base_url("index.php/presentacion/cargarMetodos") ?>";
        var datos = {modulo: modulo};
        $('#Hdnmodulo').val(modulo);
        $.post(url, datos)
                .done(function (msg) {
                    htmlModal(msg);
                    $('#myModal5').modal("show");
                })
                .fail(function (msg) {
                    alerta("rojo", "Error Modal");
                })

    });

    function filas(tipo) {
        switch (tipo) {
            case "1":
                var clase = "TxtClaseEliminar[]";
                var metodo = "TxtMetodoEliminar[]";
                var agregar = "filaEliminar";
                break;
            case "2":
                var clase = "TxtMetodoActualizar[]";
                var metodo = "TxtClaseActualizar[]";
                var agregar = "filaActualizar";
                break;
            case "3":
                var clase = "TxtClaseConsultar[]";
                var metodo = "TxtMetodoConsultar[]";
                var agregar = "filaConsultar";
                break;
            case "4":
                var clase = "TxtClaseInsertar[]";
                var metodo = "TxtMetodoInsertar[]";
                var agregar = "filaInsertar";
                break;
            default:
                alerta("naranja", "Error Tipo Filas");
        }
        var html = "";
        html += "<div class=\"row\">";
        html += "<div class=\"col-md-5 col-lg-5 col-sm-5 col-sx-5\">";
        html += "<label>Clase</label>";
        html += "<input type=\"text\" placeholder=\"Modulo\" name=\"" + clase + "\" id=\"modulo\" class=\"form-control\" >";
        html += "</div>";
        html += "<div class=\"col-md-5 col-lg-5 col-sm-5 col-sx-5\">";
        html += "<label>Metodo</label>";
        html += "<input type=\"text\" placeholder=\"Modulo\" name=\"" + metodo + "\" id=\"modulo\" class=\"form-control\" >";
        html += "</div>";
        html += "<div class=\"col-md-2 col-lg-2 col-sm-2 col-sx-2\">";
        html += "<button type=\"button\" class=\"eliminarmetodo btn btn-danger\">-</button>";
        html += "</div>";
        html += "</div>";

        $("#" + agregar).append(html);
    }
    $('body').delegate(".eliminarmetodo", "click", function () {
        $(this).parent().parent().remove();
    });

    $('body').delegate(".agregarmetodo", "click", function () {
        var tipo = $(this).attr('tipo');
        filas(tipo);
    });

    $('#desicion').hide();
    $('body').delegate(".opciones", "click", function () {
        var idgeneral = $(this).attr('idgeneral');
        $('.guardar').attr('generalid', idgeneral);
        $.post("<?php echo base_url('index.php/presentacion/consultadatosmenu') ?>",
                {idgeneral: idgeneral}, function (data) {
//            $('.modal-backdrop').css('z-index', '-1');
            $('#nombre').val(data['menu_nombrepadre']);
            $('#papa').val(data['menu_idpadre']);
            $('#controlador').val(data['menu_controlador']);
            $('#accion').val(data['menu_accion']);
            $('#estado').val(data['menu_estado']);
        });
    });

    $('body').delegate('.eliminarSubModulo', 'click', function () {
        var apuntador = $(this);
        if (confirm("Esta seguro de eliminar el modulo") == true) {
            $.post("<?php echo base_url('index.php/presentacion/eliminarmodulo') ?>",
                    {idgeneral: $(this).attr('generalid')})
                    .done(function (msg) {
                        if (!jQuery.isEmptyObject(msg.message))
                            alerta("rojo", msg['message'])
                        else {
                            apuntador.parent('td').parent('tr').remove();
                            alerta("verde", "Eliminado correctamente")
                        }
                    }).fail(function (msg) {
                alerta("Error, por favor comunicarse con el administrador");
            });
        }
    });
    $('.page-breadcrumb a').click(function () {
        var papa = $(this).attr('padre');
        $('a').each(function (key, val) {
            if ($(this).attr('padre') > papa) $(this).remove();
        });
        $('#idgeneral2').val(papa);
        $('#nombrepadre2').val($('.page-breadcrumb').html());
        $('#redireccion').attr('href', "<?= base_url('index.php/presentacion/menu') ?>");
        $('#redireccion').submit();
    });
    $('#guardar').click(function () {
        $.post("<?php echo base_url('index.php/presentacion/guardarmodulo') ?>", {modulo: $('#modulo').val(), padre: $(this).attr('padre'), general: $(this).attr('general')}, function (data) {
            $('#cuerpomodulo *').remove();
            var tabla = "";
            $.each(data.Json, function (key, val) {
                tabla += "<tr>\n\
                        <td>" + val.menu_nombrepadre + "</td>\n\
                        <td align='center'>\n\
                        <button class='btn btn-info opciones' data-target='#myModal' data-toggle='modal' idpadre='" + val.menu_idpadre + "' nombre='" + val.menu_nombrepadre + "' idgeneral='" + val.menu_id + "' type='button'>Opcion</button>\n\
                        <td></td>\n\
                        <td align='center'><input menu='" + val.menu_idhijo + "' nombrepadre='" + val.menu_nombrepadre + "' idgeneral='" + val.menu_id + "' type='radio' name='submodulo' class='submodulo'></td>\n\
                        <td style='text-align:center'><button type='button' generalid='' class='btn btn-danger eliminarSubModulo'>Eliminar</button></td>    \n\
                        </tr>";
            });
            $('#cuerpomodulo').append(tabla);
            $('#modulo').val('');
            $('#myModal2').modal('hide');
            $.notific8('Los Datos en Formacion Fueron Guardados.', {
                horizontalEdge: 'bottom',
                life: 5000,
                theme: 'amethyst',
                heading: 'EXITO'
            });
        });
    });
    $('body').delegate('.guardar', 'click', function () {

        $.post("<?php echo base_url('index.php/presentacion/guardaratributosmenu') ?>"
                , {id: $(this).attr('generalid')
                    , nombre: $('#nombre').val()
                    , controlador: $('#controlador').val()
                    , accion: $('#accion').val()
                    , estado: $('#estado').val()
                }, function (data) {
            $('#myModal').modal('hide');
        });
    });
    $('body').delegate(".submodulo", "click", function () {
        $('#menu').val($(this).attr('menu'));
        $('#idgeneral').val($(this).attr('idgeneral'));
        $("#nombrepadre").val($(".page-breadcrumb").html() + "<li><a padre='" + $(this).attr('menu') + "'>" + $(this).attr('nombrepadre') + "</a><i class='fa fa-angle-right'></i></li>")
        $('#formulario').attr('href', "<?php echo base_url('index.php/presentacion/menu') ?>");
        $('#formulario').submit();
    });
    /*---------------- ICONOS ---------------*/
    var botonIcono;
    $("body").on("click", ".iconos", function () {
        botonIcono = $(this);
    });

</script>    