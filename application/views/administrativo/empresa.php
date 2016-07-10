
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
                            <a data-toggle="tab" href="#tab2">Politicas / Copasst</a>
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nit" class="control-label col-md-2">* Nit</label>
                                                <div class="col-md-4">
                                                    <input type="text" id="nit" name="nit"  class="form-control obligatorio" value="<?php echo $informacion[0]->emp_nit ?>"/>
                                                </div>
                                                <label for="razonsocial" class="control-label col-md-2">* Razón social</label>
                                                <div class="col-md-4">
                                                    <input type="text" id="razonsocial" name="razonsocial" class="form-control obligatorio" value="<?php echo $informacion[0]->emp_razonSocial ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="telefono" class="control-label col-md-2">Teléfono</label>
                                                <div class="col-md-4">
                                                    <input type="text" id="telefono" name="telefono" class="form-control" value="" />
                                                </div>
                                                <label for="celular" class="control-label col-md-2">Celular</label>
                                                <div class="col-md-4">
                                                    <input type="text" id="celular" name="celular" class="form-control" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="direccion" class="control-label col-md-2">Dirección</label>
                                                <div class="col-md-4">
                                                    <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $informacion[0]->emp_direccion ?>" />
                                                </div>
                                                <label for="ciudad" class="control-label col-md-2">Ciudad</label>
                                                <div class="col-md-4">
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tamano" class="control-label col-md-2">* Tamaño</label>
                                                <div class="col-md-4">
                                                    <select id="tamano" name="tamano" class="form-control obligatorio" >
                                                        <option value=""></option>
                                                        <?php foreach ($tamano as $t) { ?>
                                                            <option <?php echo ($t->TamEmp_tamano == $informacion[0]->tam_id ) ? "selected" : ""; ?>  value="<?php echo $t->TamEmp_tamano ?>"><?php echo $t->TamEmp_descripcion ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <label for="arl" class="control-label col-md-2">ARL</label>
                                                <div class="col-md-4">
                                                    <input type="text" id="arl" name="arl" class="form-control"  value="<?php echo $informacion[0]->emp_arl ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sector" class="control-label col-md-2">Sector económico</label>
                                                <div class="col-md-4">
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
                                                <label for="empleados" class="control-label col-md-2">Número de empleados</label>
                                                <div class="col-md-4">
                                                    <input type="text" id="empleados" name="empleados" class="form-control"  value="<?php echo $informacion[0]->numEmpleados ?>" disabled="disabled" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="actividadeconomica" class="control-label col-md-2">* Actividad económica</label>
                                                <div class="col-md-4">
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
                                                <label for="representante" class="control-label col-md-2">Representante</label>
                                                <div class="col-md-4">
                                                    <input type="text" checked="" id="representante" name="representante" class="form-control"  value="<?php echo $informacion[0]->emp_representante ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="representante" class="control-label col-md-2">Número de vehiculos</label>
                                                <div class="col-md-4">
                                                    <input type="text" checked="" id="cantidadVehiculos" name="cantidadVehiculos" class="form-control"  value="" disabled="disabled"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="dimension1" class="control-label col-md-2">Dimensión 1</label>
                                                <div class="col-md-4">
                                                    <input type="text" id="dimension1" name="dimension1" class="form-control" value="<?php echo $informacion[0]->Dim_id ?>" /> 
                                                </div>
                                                <label for="dimension2" class="control-label col-md-2">Dimensión 2</label>
                                                <div class="col-md-4">
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
                            <form method="post" class="form-horizontal">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4"><a href="<?php echo base_url("uploads/sgsst/politicas/PolíticadeSeguridadySaludenelTrabajo.docx") ?>">Política de Seguridad y Salud en el Trabajo</a></label>
                                            <div class="col-md-4"><input type="file" class="form-control" name="" id=""></div>
                                            <label class="col-md-4"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4"><a href="<?php echo base_url("uploads/sgsst/politicas/PolíticadePreparaciónPrevenciónyRespuestaanteEmergencias.docx") ?>">Política de Preparación Prevención y Respuesta ante Emergencias</a></label>
                                            <div class="col-md-4"><input type="file" class="form-control" name="" id=""></div>
                                            <label class="col-md-4"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4"><a href="<?php echo base_url("uploads/sgsst/politicas/PolíticadeElementosyEquiposdeProteciónPersonal.docx") ?>">Política de Elementos y Equipos de Proteción Personal</a></label>
                                            <div class="col-md-4"><input type="file" class="form-control" name="" id=""></div>
                                            <label class="col-md-4"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4"><a href="<?php echo base_url("uploads/sgsst/politicas/PolíticadeControldeCigarrilloAlcoholyDrogas.docx") ?>">Política de Control de Cigarrillo Alcohol y Drogas</a></label>
                                            <div class="col-md-4"><input type="file" class="form-control" name="" id=""></div>
                                            <label class="col-md-4"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-4">
                                                <a href="<?php echo base_url("uploads/sgsst/copasst/FormatodeActadeConformacióndelCOPASST.docx") ?>">Formato de Acta de Conformación del COPASST</a></label>
                                            <div class="col-md-4"><input type="file" class="form-control" name="" id=""></div>
                                            <label class="col-md-4"></label>
                                        </div>
                                    </div>
                            </form>
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

        $('#guardarPolitica').click(function () {

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