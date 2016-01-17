<div class="widgetTitle" >
    <h5>
        <i class="glyphicon glyphicon-ok"></i>REPORTES
    </h5>
</div>
<div class='well'>
    <form method="post" id="f12" action="<?php echo base_url('index.php/reportes/abrirxml') ?>"> 
        <div class="row">
            <?php
            echo $logicareportes;
            ?>
        </div>
    </form>
    <div class="row" align="center">
        <button type="button" class="btn btn-success reporte" >REPORTE</button>
    </div>
</div>
<script>
    $('.reporte').click(function(){
        var i = 0;
        $('.seleccion').each(function(key,val){
            if($(this).is(":checked") == true){
                i++;
            }
        });
        if(i > 0){
            $('#f12').submit();
        }
        else{
            alerta("rojo", "Por favor seleccionar reporte");
        }
    });
</script>    
