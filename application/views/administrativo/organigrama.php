<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">
                <a href="<?php echo base_url("index.php/presentacion/principal") ?>">HOME</a>/
                <a href="<?php echo base_url("index.php/administrativo/empresa") ?>">EMPRESA</a>/
                ORGANIGRAMA
            </span>
        </div>
    </div>
</div>
<div class="cuerpoContenido">
<iframe src="<?php echo base_url("index.php/administrativo/loadorganigrama") ?>" frameborder="0" style="width: 100%;height: 700px;"></iframe>
</div>