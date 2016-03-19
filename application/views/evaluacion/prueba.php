<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cog"></i> <?php echo $nombre_evaluacion[0]->eva_nombre ?>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="<?php echo base_url('index.php/Evaluacion/calificar') ?>" method="post" id="form_evaluacion" onsubmit="return enviar();">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12 " >
                                <?php if (!empty($nombre_evaluacion[0]->eva_tiempo)) { ?>
                                    <div class="tiempo_div">
                                        <div class="tiempo_div2">
                                            <?php 
                                            $segundos=strtotime($tiempo_incio) - strtotime(date("Y-m-d H:i:s"));
                                            ?>
                                            Tiempo de la prueba: <span class="tiempo"><?php $time=(($nombre_evaluacion[0]->eva_tiempo * 60)+$segundos); echo ($time>0)?$time:0; ?>  </span> Segundos
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-12">
                                <table width="100%">
                                    <?php
                                    $area = '';
                                    $tema = '';
                                    $tipo = '';
                                    $i = 1;
                                    foreach ($preguntas_evaluacion as $key => $value) {
                                        echo '<tr><td colspan=""><hr></td></tr><tr><td><span><b>Pregunta # ' . $i . '</b></span><span style="float:right">Tipo pregunta: ' . $value->tipPre_nombre . '</span></td></tr><tr><td>';
                                        $i++;
                                        if (!empty($value->pre_contexto))
                                            echo '<b>Contexto:</b> <br>' . utf8_encode($value->pre_contexto) . '<p>';
                                        echo '<b>Pregunta:</b> <br>' . utf8_encode($value->pre_nombre) . '<p>';

                                        @$datos = Evaluacion::obtener_respuestas($value->pre_id);
                                        if (count($datos)) {
                                            $pregu[] = $value->pre_id;
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
                                        } else {
                                            if ($value->tipPre_id == 3) {
                                                ?>
                                                <textarea name="<?php echo $value->pre_id; ?>" class="obligatorio form-control"></textarea>
                                                <?php
                                            }
                                        }
                                        echo "</td></tr>";
                                    }
                                    ?>
                                </table>
                                <center>
                                    <button class="btn btn-sst">Enviar</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
<?php if (!empty($nombre_evaluacion[0]->eva_tiempo)) { ?>
        fin_tiempo = 0;
        mi_tiempo = 0;
        //    setTimeout(time, 1000);
        setInterval(time, 1000);
        function time() {
            var time = $('.tiempo').html();
            time = time - 1;

            if (time < 1) {
                if (fin_tiempo == 0) {
                    $('#form_evaluacion').submit();
                    fin_tiempo++;
                }
            } else {
                mi_tiempo = time;
                $('.tiempo').html(time);
            }
            //        time();
        }
<?php } ?>

    function enviar() {
        if (mi_tiempo > 1) {
<?php for ($i = 0; $i < count($pregu); $i++) { ?>
                var dato = $('input:radio[name=<?php echo $pregu[$i]; ?>]:checked').val();
                if (dato == '' || dato == undefined) {
                    alerta('rojo', 'pregunta # <?php echo $i + 1; ?>');
                    return false;
                }
<?php } ?>
            var r = obligatorio('obligatorio');
            if (r == false) {

                return false;
            }

            var r = confirm('Desea enviar el formulario');
            if (r == false)
                return false
        }
        return true
    }
</script>
<style>
    table tr{

        border-bottom: 3px solid #fff;
    }
    .tiempo_div{
        /*position: fixed;*/
        float: right;
        width: 20%
    }
    .tiempo_div2{
        background:#26a69a;
        border:1px solid #ccc;
        color:#fff;
        margin-top:-50px;
        padding:10px;
        position: fixed;
        z-index:50;
    }
</style>