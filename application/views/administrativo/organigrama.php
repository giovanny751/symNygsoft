<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-sitemap"></i>ORGANIGRAMA
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?php echo base_url("index.php/Administrativo/cargos") ?>"><button type="button" class="btn btn-info" title="Nuevo cargo"><i class="fa fa-user-plus fa-4x"></i></button></a>
                            <a href="<?php echo base_url("index.php/Administrativo/empresa") ?>"><button type="button" class="btn btn-info" title="Organización"><i class="fa fa-building-o"></i></button></a>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <!--<div class="cuerpoContenido">-->
                                <iframe src="<?php echo base_url("index.php/administrativo/loadorganigrama") ?>" frameborder="0" style="width: 100%;height: 700px;"></iframe>
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

