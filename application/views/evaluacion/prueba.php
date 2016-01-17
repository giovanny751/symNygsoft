<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo"><?php echo $nombre_evaluacion[0]->eva_nombre ?></span>
        </div>
    </div>
</div>
<div class="cuerpoContenido">
    <form action="<?php echo base_url('index.php/Evaluacion/calificar') ?>" method="post" id="" onsubmit="return enviar();">
        <!--<div class="container">-->
        <table width="100%">
            <?php
            $area = '';
            $tema = '';
            $tipo = '';
            $i = 1;
            foreach ($preguntas_evaluacion as $key => $value) {
                echo '<tr><td><span><b>Pregunta # ' . $i . '</b></span><span style="float:right">Tipo pregunta: ' . $value->tipPre_nombre . '</span></td></tr><tr><td>';
                $i++;
//                if ($value->are_nombre != $area) {
//                    echo '<b>Area: ' . $value->are_nombre . '</b><p>';
//                    $area = $value->are_nombre;
//                }
//                if ($value->tem_nombre != $tema) {
//                    echo '<b>Tema: ' . $value->tem_nombre . '</b><p>';
//                    $tema = $value->tem_nombre;
//                }
                if (!empty($value->pre_contexto))
                    echo '<b>Contexto:</b> <br>' . utf8_encode($value->pre_contexto) . '<p>';
                echo '<b>Pregunta:</b> <br>' . utf8_encode($value->pre_nombre) . '<p>';
                $pregu[] = $value->pre_id;
                @$datos = Evaluacion::obtener_respuestas($value->pre_id);
                foreach ($datos as $value2) {
                    ?>
                    <div class="col-md-12">
                        <div class="col-md-1">
                            <input type="radio" name="<?php echo $value2->pre_id ?>" class="obligado" value="<?php echo $value2->res_id ?>" >
                        </div>
                        <div class="col-md-10">
                            <?php echo $value2->res_nombre ?>
                        </div>
                    </div>
                    <?php
                }
                echo "</td></tr>";
            }
            ?>
        </table>
        <center>
            <button class="btn btn-sst">Enviar</button>
        </center>
        <!--</div>-->
    </form>
</div>

<script>
    function enviar() {
<?php for ($i = 0; $i < count($pregu); $i++) { ?>
            var dato = $('input:radio[name=<?php echo $pregu[$i]; ?>]:checked').val();
            if (dato == '' || dato == undefined) {
                alerta('rojo', 'pregunta # <?php echo $i + 1; ?>');
                return false;
            }
<?php } ?>

        var r = confirm('Desea enviar el formulario');
        if (r == false)
            return false
        return true
    }
</script>
<style>
    table tr{

        border-bottom: 3px solid #fff;
    }
</style>