<head>
    <title>Administrador Usuarios</title>
<link rel="stylesheet" href="<?php echo  base_url('css/jquery-ui.css') ?>">
<script src="<?php echo  base_url('js/jquery.js') ?>"></script>
<script src="<?php echo  base_url('js/jquery-1.9.1.js') ?>"></script>
<script src="<?php echo  base_url('js/jquery-ui.js') ?>"></script>

</head>
<h3 align="center">ADMINISTRACION USUARIOS</h3>
<br>
    <div class="table-responsive ">
        <table class="table table-responsive table-striped table-bordered">
    <thead>
    <th style="width: 500px">Nombre Usuario</th>
        <th>Opciones</th>
        <th>Permisos</th>
    </thead>
    <tbody>
        <?php foreach($usuarios as $todosusuarios){?>
        <tr>
            <td><?php echo  $todosusuarios['usu_nombres_apellido'] ?></td>
            <td align="center"><button type="button" class="btn btn-success" id="opciones">Opción</button></td>
            <td align="center"><button type="button" class="btn btn-info permisos" usuario="<?php echo  $todosusuarios['usu_id'] ?>">Permisos</button></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<div id="modulos">
</div>

<script>
    
    $('#modulos').hide();
//    $('#modulos').draggable({ scrollSpeed: 20 });
    
    $('.permisos').click(function(){
        $('#modulos *').remove();
        var usuario = 1;
        var idpadre= $(this).attr('idpadre');
        
        var url = "<?php echo  base_url('index.php/presentacion/retornamenutotal') ?>";
        $.post(url,{usuario : usuario,idpadre : idpadre},function(data){
            
            var formulario = "<form id='permisos' method='post'>"+data+"\
                <input type='hidden' value='"+usuario+"' name='usuario' id='usuario'></form>";
            
            $('#modulos').append(formulario);

            $('#modulos').dialog({
                title : 'PERMISOS',
                autoOpen : true,
                modal : true,
                width : 700,
                buttons : [{
                        id : 'guardar',
                        text : 'Guardar',
                        click : function(){
                            var url2 = "<?php echo  base_url('index.php/presentacion/savepermissionsuser') ?>";
                            $.post(url2,$('form').serialize(),function(data){
                                $('#modulos').dialog('close');
                            });
                        }
                }]
            });
        });
    });
    
    
    
</script>    