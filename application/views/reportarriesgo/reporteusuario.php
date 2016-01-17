<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SG-SST</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>/css/jquery_ui_1.11.4.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/css/bootstrap_3.3.5.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/css/bootstrap_theme_3.3.5.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/global/css/components.css" />
    <link rel="stylesheet" href="<?= base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css') ?>" type="text/css"/> 
    <style type="text/css">
        
        @font-face {
            font-family: "open_sans_regular";
            src: url(<?php echo base_url("fonts/OpenSans-Regular.ttf") ?>) format("truetype");
        }
        @font-face {
            font-family: "anton";
            src: url(<?php echo base_url("fonts/Anton.ttf") ?>) format("truetype");
        }
        
        html, body{
            background-color: #eee;
            font-family: "open_sans_regular";
        }
        .portlet.box > .portlet-body {
            background-color: #ffffff;
            padding: 15px 30px;
        }
        .row{
            margin-top: 15px;
        }
        .logo{
            font-family: "anton";
            color: #0C7093;
            font-size: 120px;
            margin-left: 15px;
            padding:0px;
        }
        header{
            border-bottom: 1px solid white;
        }
        #nota{
            display:none;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">SST</div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Datos de solicitud de registro de peligro
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form method="post" id="solicitud">
                            <div class="row">
                                <div class="form-group">
                                    <label for="cedula" class="col-sm-2 control-label">Cédula del empleado:</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="cedula" id="cedula" class="form-control" />
                                    </div>
                                    <label for="sede" class="col-sm-2 control-label">Correo electrónico:</label>
                                    <div class="col-sm-4">
                                        <input type="text" name="correo" id="correo" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="dimension1" class="col-sm-2 control-label"><?php echo $empresa->Dim_id ?></label>
                                    <div class="col-sm-4">
                                        <select name="dimension1" id="dimension1" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach($dimension as $d1): ?>
                                                <option value="<?php echo $d1->dim_id ?>"><?php echo $d1->dim_descripcion ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label for="dimension2" class="col-sm-2 control-label"><?php echo $empresa->Dimdos_id ?></label>
                                    <div class="col-sm-4">
                                        <select name="dimension2" id="dimension2" class="form-control">
                                            <option value="">::Seleccionar::</option>
                                            <?php foreach($dimension2 as $d2): ?>
                                                <option value="<?php echo $d2->dim_id ?>"><?php echo $d2->dim_descripcion ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="descripcion" class="col-sm-2 control-label">Descripción del Peligro</label>
                                    <div class="col-sm-10">
                                        <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-offset-4 col-sm-4">
                                    <div class="form-group" align="center">
                                        <button type="button" class="btn blue btn-block" id="enviar">Enviar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="note" id="nota">
                                            <h4 class="block" id="tituloError"></h4>
                                            <p id="textoError"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url() ?>/js/jquery_1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/js/jquery_ui_1.11.4.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/js/bootstrap_3.3.5.min.js"></script>
    <script type="text/javascript">
        $("#enviar").click(function(){
            var url = "<?php echo base_url("index.php/reportarriesgo/guardaSolicitud"); ?>";
            var datos = $("#solicitud").serialize();
            $.post(url,datos)
                    .done(function(msg){
                        if (!jQuery.isEmptyObject(msg.message))
                            nota("Sistema",msg['message']);
                        else {
                            $("#nota").hide();
                            alert("Numero de Solicitud: "+ msg)
                            $(":input","#solicitud").not(":button, :submit, :reset, :hidden").val("").removeAttr("checked").removeAttr("selected")
                        }
                    })
                    .fail(function(){
                        nota("Error !","Por favor comunicarse con el administrador del sistema");
                    })
        });
        
        function nota(titulo,texto){
            var nota = $("#nota");
            nota.addClass("note-danger");
            nota.find("#tituloError").text(titulo)
            nota.find("#textoError").text(texto)
            nota.show();
            
        }
    </script>
</body>
</html>

