<div class="row">
    <div class="circuloIcon" id="guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">DATOS EMPRESA</span>
        </div>
    </div>
</div>
<div class="cuerpoContenido">
    <?php if (!empty($mensaje)) { ?>
        <p class="alert alert-info"  style='margin-top:10px;font-weight: bold;text-align: center;'><?php echo $mensaje ?></p>
    <?php } ?>
    <!--<div class="row">-->
    <form method="post" id="f5" enctype="multipart/form-data" action="<?php echo base_url("index.php/administrativo/guardarempresa") ?>" >
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="row">
                    <label for="nit" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <span class="campoobligatorio">*</span>Nit
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <input type="text" id="nit" name="nit"  class="form-control obligatorio" value="<?php echo $informacion[0]->emp_nit ?>"/>
                    </div>
                </div>
                <div class="row">
                    <label for="razonsocial" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <span class="campoobligatorio">*</span>Razón social
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <input type="text" id="razonsocial" name="razonsocial" class="form-control obligatorio" value="<?php echo $informacion[0]->emp_razonSocial ?>"/>
                    </div>
                </div>
                <div class="row">
                    <label for="direccion"  class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        Dirección
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $informacion[0]->emp_direccion ?>" />
                    </div>    
                </div> 
                <div class="row">
                    <label for="ciudad" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        Ciudad
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <select id="ciudad" name="ciudad" class="form-control" >
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($ciudad as $c) { ?>
                                <option <?php echo ($c->ciu_id == $informacion[0]->ciu_id) ? "selected" : ""; ?> value="<?php echo $c->ciu_id ?>"><?php echo $c->ciu_nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="tamano" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <span class="campoobligatorio">*</span>Tamaño
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <select id="tamano" name="tamano" class="form-control obligatorio" >
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($tamano as $t) { ?>
                                <option <?php echo ($t->TamEmp_tamano == $informacion[0]->tam_id ) ? "selected" : ""; ?>  value="<?php echo $t->TamEmp_tamano ?>"><?php echo $t->TamEmp_descripcion ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="arl" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        ARL
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <input type="text" id="arl" name="arl" class="form-control"  value="<?php echo $informacion[0]->emp_arl ?>" >
                    </div>
                </div>
                <div class="row">
                    <label for="sector" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        Sector economico
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <select name="sector" id="sector" class="form-control">
                            <option value="">::Seleccionar::</option>
                            <?php
                            foreach ($sector as $s):
                                $selected = ($informacion[0]->secEco_id == $s->secEco_id) ? "selected" : "";
                                ?>
                                <option  value="<?php echo $s->secEco_id ?>" <?php echo $selected ?>><?php echo $s->secEco_tipo ?></option>
<?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="empleados" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        Numero de empleados
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <input type="text" id="empleados" name="empleados" class="form-control"  value="<?php echo $informacion[0]->numEmpleados ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="row">
                    <label for="actividadeconomica" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <span class="campoobligatorio">*</span>Actividad Economica
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <select id="actividadeconomica" name="actividadeconomica" class="form-control obligatorio"  value="<?php echo $informacion[0]->actEco_id ?>">
                            <option value="">::Seleccionar::</option>
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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="row">
                    <?php
                    if (isset($informacion[0]->emp_logo))
                        if (!empty($informacion[0]->emp_logo)) {
                            ?>
                            <center><img  style="width: 350;height: 155px;border-radius: 15px" src="<?php echo base_url('uploads') . '/empresa/' . $informacion[0]->emp_id . "/" . $informacion[0]->emp_logo; ?>"></center>
    <?php } ?>
                </div> 
                <div class="row">
                    <label for="dimension1" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        Dimensión 1
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <input type="text" id="dimension1" name="dimension1" class="form-control" value="<?php echo $informacion[0]->Dim_id ?>" /> 
                    </div>
                </div>
                <div class="row">
                    <label for="dimension2" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        Dimensión 2
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">    
                        <input type="text" id="dimension2" name="dimension2" class="form-control" value="<?php echo $informacion[0]->Dimdos_id ?>" >
                    </div>
                </div>
                <div class="row">
                    <label for="representante" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        Representante
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <input type="text" checked="" id="representante" name="representante" class="form-control"  value="<?php echo $informacion[0]->emp_representante ?>"/>
                    </div>
                </div>
                <div class="row">
                    <label for="userfile" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        Logo
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">    
                        <input type="file" id="userfile" name="userfile"/>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row" style="text-align: center">
        <div class="btn-group dropup" >
            <button class="btn-sst dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
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
        <div class="btn-group dropup">
            <button class="btn-sst" type="button" data-toggle="dropdown" aria-expanded="false">
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
        <a href="<?php echo base_url("index.php/Tipo_contrato/index") ?>" class="btn-sst" >Tipos de Contrato</a> 
        <a href="<?php echo base_url("index.php/administrativo/dimension") ?>" class="btn-sst">Dimensión 1</a>
        <a href="<?php echo base_url("index.php/administrativo/dimension2") ?>" class="btn-sst">Dimensión 2</a>
    </div>
</div>
<script>

    $('.dirigir').click(function () {

        if ($('#direccionar').val() == 1)
            window.location.href = '<?php echo base_url("index.php/administrativo/cargos") ?>';
        if ($('#direccionar').val() == 2)
            window.location.href = '<?php echo base_url("index.php/administrativo/organigrama") ?>';
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