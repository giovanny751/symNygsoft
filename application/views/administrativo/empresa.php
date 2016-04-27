<link rel="stylesheet" href="<?php echo base_url('dist/css/font-awesome.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('dist/js/summernote.js?v=' . date("d-h")); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('dist/js/script_summernote.js?v=' . date("d-h")); ?>"></script>
<link href="<?php echo base_url('dist/css/summernote.css?v=' . date("d-h")); ?>" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i><?= $title ?>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="tabbable tabbable-tabdrop">
                    <ul class="nav nav-tabs">
                        <li class='active'>
                            <a data-toggle="tab" href="#tab1">Empresa</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab2">Politica General</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">
                            <form method="post" id="f5" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url("index.php/administrativo/guardarempresa") ?>">
                                <div class="form-body">
                                    <?php if (!empty($mensaje)) { ?>
                                        <p class="alert alert-info"  style='margin-top:10px;font-weight: bold;text-align: center;'><?php echo $mensaje ?></p>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php
                                                if (isset($informacion[0]->emp_logo))
                                                    if (!empty($informacion[0]->emp_logo)) {
                                                        ?>
                                                        <center><img  style="width: 350;height: 155px;border-radius: 15px" src="<?php echo base_url('uploads') . '/empresa/' . $informacion[0]->emp_id . "/" . $informacion[0]->emp_logo; ?>"></center>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nit" class="control-label col-md-3">* Nit</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="nit" name="nit"  class="form-control obligatorio" value="<?php echo $informacion[0]->emp_nit ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="razonsocial" class="control-label col-md-3">* Razón social</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="razonsocial" name="razonsocial" class="form-control obligatorio" value="<?php echo $informacion[0]->emp_razonSocial ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="direccion" class="control-label col-md-3">Dirección</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $informacion[0]->emp_direccion ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ciudad" class="control-label col-md-3">Ciudad</label>
                                                <div class="col-md-9">
                                                    <select id="ciudad" name="ciudad" class="form-control" >
                                                        <option value=""></option>
                                                        <?php foreach ($ciudad as $c) { ?>
                                                            <option <?php echo ($c->ciu_id == $informacion[0]->ciu_id) ? "selected" : ""; ?> value="<?php echo $c->ciu_id ?>"><?php echo $c->ciu_nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tamano" class="control-label col-md-3">* Tamaño</label>
                                                <div class="col-md-9">
                                                    <select id="tamano" name="tamano" class="form-control obligatorio" >
                                                        <option value=""></option>
                                                        <?php foreach ($tamano as $t) { ?>
                                                            <option <?php echo ($t->TamEmp_tamano == $informacion[0]->tam_id ) ? "selected" : ""; ?>  value="<?php echo $t->TamEmp_tamano ?>"><?php echo $t->TamEmp_descripcion ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="arl" class="control-label col-md-3">ARL</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="arl" name="arl" class="form-control"  value="<?php echo $informacion[0]->emp_arl ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sector" class="control-label col-md-3">Sector económico</label>
                                                <div class="col-md-9">
                                                    <select id="sector" name="sector" class="form-control" >
                                                        <option value=""></option>
                                                        <?php
                                                        foreach ($sector as $s):
                                                            $selected = ($informacion[0]->secEco_id == $s->secEco_id) ? "selected" : "";
                                                            ?>
                                                            <option  value="<?php echo $s->secEco_id ?>" <?php echo $selected ?>><?php echo $s->secEco_tipo ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="empleados" class="control-label col-md-3">Número de empleados</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="empleados" name="empleados" class="form-control"  value="<?php echo $informacion[0]->numEmpleados ?>" disabled="disabled" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="actividadeconomica" class="control-label col-md-3">* Actividad económica</label>
                                                <div class="col-md-9">
                                                    <select id="actividadeconomica" name="actividadeconomica" class="form-control obligatorio " >
                                                        <option value=""></option>
                                                        <?php
                                                        foreach ($actividadeconomica as $ae) {
                                                            $selected = ($informacion[0]->actEco_id == $ae->actEco_id) ? "selected" : "";
                                                            ?>
                                                            <option value="<?php echo $ae->actEco_id ?>" <?php echo $selected ?> ><?php echo $ae->actEco_Detalle ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="representante" class="control-label col-md-3">Representante</label>
                                                <div class="col-md-9">
                                                    <input type="text" checked="" id="representante" name="representante" class="form-control"  value="<?php echo $informacion[0]->emp_representante ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dimension1" class="control-label col-md-3">Dimensión 1</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="dimension1" name="dimension1" class="form-control" value="<?php echo $informacion[0]->Dim_id ?>" /> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dimension2" class="control-label col-md-3">Dimensión 2</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="dimension2" name="dimension2" class="form-control" value="<?php echo $informacion[0]->Dimdos_id ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userfile" class="control-label col-md-3">Logo</label>
                                                <div class="col-md-9">
                                                    <input type="file" id="userfile" name="userfile"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-md-2">
                                                    <div class="btn-group dropup" >
                                                        <button class="btn blue btn-block" type="button" data-toggle="dropdown" aria-expanded="false">
                                                            Empresa <i class="fa fa-angle-up"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li>
                                                                <a href="<?php echo base_url("index.php/administrativo/cargos") ?>">
                                                                    Ver Cargos 
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url("index.php/administrativo/organigrama") ?>">
                                                                    Ver Organigrama 
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="btn-group dropup">
                                                        <button class="btn blue btn-block" type="button" data-toggle="dropdown" aria-expanded="false">
                                                            Empleados <i class="fa fa-angle-up"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li>
                                                                <a href="<?php echo base_url("index.php/administrativo/listadoempleados") ?>">
                                                                    Ver Empleados 
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url("index.php/administrativo/importar_empleados") ?>">
                                                                    Importar Empleados 
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="<?php echo base_url("index.php/Tipo_contrato/index") ?>" class="btn blue btn-block" >Tipos de Contrato</a> 
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="<?php echo base_url("index.php/administrativo/dimension") ?>" class="btn blue btn-block">Dimensión 1</a>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="<?php echo base_url("index.php/administrativo/dimension2") ?>" class="btn blue btn-block">Dimensión 2</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-offset-4 col-md-4">
                                                    <input type="button" class="btn btn-block green" id="guardar" value="GUARDAR" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="tab2" class="tab-pane">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success" id="guardarPolitica">Guardar</button>
                            </div>
                            <div class="col-md-12">
                                <textarea class="textareasumer" name="politica" id="politica"><?php echo (!empty($politicaGeneral[0]->ini_politicaEmpresarial))?$politicaGeneral[0]->ini_politicaEmpresarial:""; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="portlet box green">
        <div class="portlet-tittle">

        </div>
    </div>

    <script>
        
        $('#guardarPolitica').click(function(){
            
            politica = $('#politica').code();
            $.post("<?php echo base_url("index.php/administrativo/guardarPoliticaEmpresarial") ?>", {politica: politica})
                .done(function (msg) {
                    if (!jQuery.isEmptyObject(msg.message))
                        alerta(msg.color, msg['message'])
                    else {
                        alerta('verde', 'la politica fue guardada con Exito');
                    }
                }).fail(function (msg) {
            alerta('rojo', 'Error al Guardar');
        })
        });

        $('.dirigir').click(function () {

            if ($('#direccionar').val() == 1)
                window.location.href = url + "index.php/administrativo/cargos";
            if ($('#direccionar').val() == 2)
                window.location.href = url + "index.php/administrativo/organigrama";
            if ($('#direccionar').val() == 3)
                window.location.href = '';

        });

        $('#guardar').click(function () {
            if ($('#dimension1').val() == '')
                $('#dimension1').val('TRANSVERSAL');
            if ($('#dimension2').val() == '')
                $('#dimension2').val('TRANSVERSAL');



            if (obligatorio('obligatorio') == true) {
                $("#f5").submit();
            }
        });

    </script>