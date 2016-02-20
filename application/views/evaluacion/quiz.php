<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i>Prueba de Conocimiento
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('message')) { ?>
                                <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div>            
                            <?php } ?>
                            <table class="table table-striped table-bordered table-hover tabla-sst">
                                <thead>
                                <th></th>
                                <th><b>Evaluación</b></th>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($evaluacion)) {
                                        foreach ($evaluacion as $value) {
                                            ?>
                                            <tr>
                                                <td><center><input type="radio" name="nan" value="<?php echo $value->eva_id ?>"></center></td>
                                        <td><?php echo $value->eva_nombre ?></td>
                                        </tr>
                                    <?php }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="<?php echo base_url('index.php/Evaluacion/prueba') ?>" id="form1" method="post"><input type="hidden" id="eva_id" name="eva_id"></form>
<script>
    $('input[type="radio"]').click(function () {
        var r = confirm('En este momento va a dar incio a la prueba \n ¿desea continuar?');
        if (r == false)
            return false;
        $('#eva_id').val($(this).val());
        $('#form1').submit();
    })
</script>