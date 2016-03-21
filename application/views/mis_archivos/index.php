<br>
<div class="row">
    <div class="col-md-6">
        <div class="circuloIcon guardar" title="Guardar dimension" metodo="guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="glyphicon glyphicon-ok"></i> Mis archivos
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-info" title="Subir Documento"><i class="fa fa-arrow-up"></i></button>
                            <button class="btn btn-info" title="Nueva Carpeta"  id="crearCarpeta"><i class="fa fa-folder-open-o"></i></button>
                        </div>
                        <div class="col-md-4"></div>
                        <div style="display: " class="col-md-4">
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="fa fa-search"></i>
                                    <input type="text" name="id_carpeta" id="id_carpeta" class="form-control placeholder-no-fix" value="<?php echo $carpeta[0]->carDoc_id_padre ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row genera_carpeta">
                        <div class="form-horizontal">
                            <div class="col-md-12">
                                <?php
                                $i = 0;
                                $d = 1;
                                foreach ($carpeta as $value) :
                                    if ($d == 1):
                                        ?>
                                        <div class="form-group">
                                        <?php
                                        endif;
                                        if (!empty($value->carDoc_id_padre) && $i == 0) :
                                            $i++;
                                            ?>
                                            <div class="col-md-1 carpeta_atras">  
                                                <i class="fa fa-folder-o fa-4x"></i>
                                            </div>
    <?php endif; ?>
                                        <div class="col-md-1 carpeta_seccion" toma="<?php echo $value->carDoc_id; ?>">  
                                            <br>
                                            <i class="fa fa-folder-o fa-4x"></i>
                                            <span class="nombreDocumento"><?php echo $value->carDoc_nombre ?></span>
                                        </div>
                                        <?php
                                        $d++;
                                        if ($d == 13):
                                            ?>
                                        </div>
                                        <?php
                                        $d = 1;
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nueva Carpeta</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3" for="nueva_carpeta">Nombre Carpeta</label>
                            <div class="col-md-9"><input type="text" class="form-control" id="nueva_carpeta"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success guardar_carpeta" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div id="myMenu1" class="contextMenu" style="display: none">

    <ul>

        <li id="open"><img src="folder.png" /> Open</li>

        <li id="email"><img src="email.png" /> Email</li>

        <li id="save"><img src="disk.png" /> Save</li>

        <li id="close"><img src="cross.png" /> Close</li>

    </ul>

</div>
<style>
    .carpeta_seccion{
        cursor: pointer;
    }
    .carpeta_seccion:hover{
        border-style: dotted;
        border-width: 1px;
        background-color: #EFF4FA;
    }
    body{
        font: normal 13px Tahoma, Verdana, Arial, sans-serif;
        padding: 0;
        margin: 0;
    }

    h1{
        text-align: center;
        padding: 20px 0;
    }
    p{
        text-align: justify;
        padding: 5px;
    }

    #divContenedor{
        position: absolute;
        width: 700px;
        left: 50%;
        margin-left: -350px;
        top: 40px;
        z-index: 1;
        background: #fff;
    }
    #divCoordenadas{
        border: solid 1px #ccc;
        padding: 10px;
        width: 200px;
        text-align: center;
        border-radius: 5px;
        box-shadow: 1px 1px 10px #c0c0c0;
        float: left;
    }
    #divScroll{
        border: solid 1px #ccc;
        border-radius: 5px;
        height: 400px;
        padding: 10px;
        overflow-y: scroll;
        margin: 20px 0;
        box-shadow: 1px 1px 10px #c0c0c0;
    }
    #divEstado{
        width: 200px;
        padding: 10px;
        border: solid 1px #ccc;
        border-radius: 5px;
        box-shadow: 1px 1px 10px #c0c0c0;
        float: right;
        text-align: center;
    }

    #divMenu{
        position: absolute;
        width: 200px;
        border: solid 1px #ccc;
        border-radius: 5px;
        box-shadow: 1px 1px 10px #c0c0c0;
        display: none;
        padding: 10px;
        background: #fff;
        z-index: 100;
    }
    #divMenu ul{
        padding: 0;
        margin: 0;
        list-style-type: none;
    }
    #divMenu ul li{
        padding: 7px;
        cursor: pointer;
    }
    #divMenu ul li:hover{
        background: #ccc;
        border-radius: 3px;
    }
    .clsSalto{
        clear: both;
    }
</style>
<div id="divMenu">
            <ul>
                <li>Hola mundo</li>
                <li>Hola mundo</li>
                <li>Hola mundo</li>
                <li>Hola mundo</li>
                <li>Hola mundo</li>
            </ul>
        </div>
<script>
$(document).ready(function(){
    //evento que se produce al mover el raton sobre el documento
    $(document).on('mousemove',function(e){
        //obtener las coordenadas X e Y del raton
        var iX=e.pageX, iY=e.pageY;
        //imprimir en la capa las coordenadas
        $('#divCoordenadas').html('<strong>X: </strong>'+iX+', <strong>Y: </strong>'+iY);
    });
     
    //manejador de evento para el clic derecho (contextmenu)
    $(document).on('contextmenu',function(e){
        //evitamos que aparezca el menu predeterminado del navegador (si, asi se "bloquea")
        e.preventDefault();
         
        //volvemos a obtener las coordenadas del raton en el documento
        var iX=e.pageX, iY=e.pageY;
         
        //mostramos nuestro menu contextual en la ubicacion X e Y del puntero del raton
        $('#divMenu').css({
            display:    'block',
            left:       iX,
            top:        iY
        });
         
        //actualizamos el estado y decimos que "detectamos un clic"
        $('#divEstado').html('<strong>Clic derecho</strong> detectado');
    });
     
    //manejador del evento clic sobre el documento
    $(document).on('click',function(){
        //cuando se hace clic ocultamos el menu contextual
        $('#divMenu').css('display','none');
        //actualizamos el estado indicando que detectamos un clic
        $('#divEstado').html('<strong>Clic</strong> detectado');
    });
     
    //evento que se produce al hacer scroll sobre la capa divScroll
    $('#divScroll').on('scroll',function(){
        //actualizamos el estado para indicar que hemos detectado el scroll
        $('#divEstado').html('<strong>Scroll</strong> detectado');
         
        //este scroll se detecta tanto para la rueda del raton (mousewheel) como
        //para las teclas direccionales (arriba/abajo)
    });
     
    //evento cuando hacemos clic en un elemento (li) de la lista (ul)
    $('#divMenu ul li').on('click',function(){
        //mostramos una alerta
        alert('Se hizo clic sobre un elemento de la lista.')
    });
     
});
    

    $('#crearCarpeta').click(function () {
        $('#nueva_carpeta').val('');
        $('#myModal').modal('show');
    });
    $('body').delegate('.carpeta_seccion, .carpeta_atras', 'click', function () {
        $('.carpeta_seccion span').each(function () {
            $(this).css('background-color', '');
        })
        $('.carpeta_atras span').each(function () {
            $(this).css('background-color', '');
        })
        $(this).children('span').css('background-color', '#2d5f8b');
    })
    $('body').delegate('.carpeta_seccion', 'dblclick', function () {
        var url = "<?php echo base_url('index.php/Mis_archivos/traer_folder'); ?>"
        var toma = $(this).attr('toma');
        $.post(url, {id_carpeta: $(this).attr('toma')})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        llenar_carpetas(msg, toma);
                    }
                })
                .fail(function () {
                    alerta('Error al guardar');
                })
    });
    $('body').delegate('.carpeta_atras', 'dblclick', function () {
        var url = "<?php echo base_url('index.php/Mis_archivos/traer_atras'); ?>"
        var toma = $(this).attr('toma');
        $.post(url, {id_carpeta: $(this).attr('toma')})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        llenar_carpetas(msg, toma);
                    }
                })
                .fail(function () {
                    alerta('Error al guardar');
                })
    });
    $('.guardar_carpeta').click(function () {
        var url = "<?php echo base_url('index.php/Mis_archivos/new_folder'); ?>";
        var toma = $('#id_carpeta').val();
        $.post(url, {IdCarpetaPadre: $('#id_carpeta').val(), nueva_carpeta: $('#nueva_carpeta').val()})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta("rojo", msg['message'])
                    else {
                        llenar_carpetas(msg, toma)
                    }
                })
                .fail(function () {
                    alerta('Error al guardar');
                })
    })

    function llenar_carpetas(msg, toma) {
        var i = 0;
        var d = 1;
        html = "<div class='form-horizontal'>";
        html += "<div class='col-md-12'>";
        html += '<div class="col-md-1 carpeta_atras" toma=""><br><i class="fa fa-folder-o fa-4x"></i><br><span>...</span></div>';
        padre = null;
        $.each(msg.Json, function (key, val) {
            if (d == 1) {
                html += "<div class='form-group'>";
            }
            i++;
            padre = val.carDoc_id_padre;
            html += '<div class="col-md-1 carpeta_seccion" toma="' + val.carDoc_id + '">  ';
            html += '<br>';
            html += '<i class="fa fa-folder-o fa-4x"></i>';
            html += '<br><span>' + val.carDoc_nombre + '</span>';
            html += '</div>';
            d++;
            if (d == 13) {
                html += "</div>";
                d = 1;
            }
        });
        html += "</div>"
        html += "</div>"
        $('.genera_carpeta').html(html);
        if (padre == null && i == 0) {
            $('#id_carpeta').val(toma)
            $('.carpeta_atras').attr('toma', toma)
        } else if (padre == null) {
            $('.carpeta_atras').hide();
            $('#id_carpeta').val('')
        } else {
            $('.carpeta_atras').attr('toma', padre)
            $('#id_carpeta').val(padre)
        }

    }
</script>