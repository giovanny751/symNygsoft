<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">PRUEBA DE CONOCIMIENTO</span>
        </div>
    </div>
</div>
    <div class="cuerpoContenido">
        <table class="tablesst">
            <thead>
            <th></th>
            <th><b>Evaluación</b></th>
            </thead>
            <tbody>
                <?php 
                if(count($evaluacion)){
                foreach ($evaluacion as $value) { ?>
                    <tr>
                        <td><center><input type="radio" name="nan" value="<?php echo $value->eva_id ?>"></center></td>
                        <td><?php echo $value->eva_nombre ?></td>
                    </tr>
                <?php }}else{ ?>
                    <tr>
                        <td colspan="2">No tiene puebas pendientes</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<form action="<?php echo base_url('index.php/Evaluacion/prueba')?>" id="form1" method="post"><input type="hidden" id="eva_id" name="eva_id"></form>
<script>
    $('input[type="radio"]').click(function () {
        var r =confirm('En este momento va a dar incio a la prueba \n ¿desea continuar?');
        if(r==false)
            return false;
        $('#eva_id').val($(this).val());
        $('#form1').submit();
    })
</script>