<div class="widgetTitle" >
    <h5>
        <i class="glyphicon glyphicon-ok"></i> <?php echo $post['titulo']; ?>
    </h5>
</div>
<div class='well'>
<form action="<=?php echo base_url('index.php/').'<?php echo '/' . ucfirst($post['tabla']) . '/consult_' . $post['tabla'] ?>'; ?=>" method="post" >
    <div class="row">
    <?php
    $post['columnas']=  str_replace("'", "", $post['columnas']);
    $resul = 12 / $post['columnas'];
    for ($i = 0; $i < count($post['nombre_label']); $i++) {
        if ($post['aparezca'][$i] == 1) {
                ?>
                <div class="col-md-<?php echo $resul ?>">
                    <label for="<?php echo $post['nombre_campo'][$i]; ?>">
                    <?php echo $post['nombre_label'][$i]; ?>
                        </label>
                </div>
                <div class="col-md-<?php echo $resul ?>">
                    
                    <?php 
                    
                    if($post['autocomplete'][$i]==1){
                    ?>
                    <script>
                        $('document').ready(function() {
                            $('#<?php echo $post['nombre_campo'][$i];?>').autocomplete({
                                source: "<=?php echo base_url("index.php/<?php echo "/" . ucfirst($post['tabla']) . '/autocomplete_' . $post['nombre_campo'][$i] ?>") ?=>",
                                minLength: 3
                            });
                        });
                    </script>
                    <?php
                    }
                    
                    
                    if($post['tipo'][$i]=='select'){
                            ?><=?php echo lista("<?php echo $post['nombre_campo'][$i]; ?>", "<?php echo $post['nombre_campo'][$i]; ?>", "form-control <?php echo $post['obligatorio'][$i] ?>", "<?php echo $post['select1'][$i]; ?>", "<?php echo $post['select2'][$i]; ?>", "<?php echo $post['select3'][$i]; ?>", (isset($datos[0]-><?php echo $post['nombre_campo'][$i]; ?>)?$datos[0]-><?php echo $post['nombre_campo'][$i]; ?>:'' ), array("ACTIVO" => "S"), /* readOnly? */ false); ?=><?php
                        }else if($post['nombre_campo'][$i]=="estado" || $post['nombre_campo'][$i]=="Estado"){
                            ?>
                        <select  class="form-control <?php echo $post['obligatorio'][$i] ?> <?php echo $post['fecha'][$i] ?> <?php echo $post['numero'][$i] ?>" id="<?php echo $post['nombre_campo'][$i]; ?>" name="<?php echo $post['nombre_campo'][$i]; ?>">
                            <option value=""></option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                                <?php
                        }else{ ?>
                        <input type="<?php echo ($post['tipo'][$i]=='file'?'text':$post['tipo'][$i]); ?>" value="<=?php echo (isset($post['<?php echo $post['nombre_campo'][$i]; ?>'])?$post['<?php echo $post['nombre_campo'][$i]; ?>']:'' ) ?=>" class="form-control <?php echo $post['obligatorio'][$i] ?> <?php echo $post['fecha'][$i] ?> <?php echo $post['numero'][$i] ?>" id="<?php echo $post['nombre_campo'][$i]; ?>" name="<?php echo $post['nombre_campo'][$i]; ?>">
                        <?php }?>
                    <br>
                </div>

            <?php
            }
        }
        ?>
    </div>
    <button class="btn btn-dcs">Consultar</button>
</form>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <?php
                for ($i = 0; $i < count($post['nombre_label']); $i++) {
                    if ($post['aparezca'][$i] == 1) {
                        ?>
                    <th><?php echo $post['nombre_label'][$i] ?></th>
                <?php }
            }
            ?>
            <th>Acción</th>
            </thead>
            <tbody>
                <=?php
                foreach ($datos as $key => $value) {
                echo "<tr>";
                    $i=0;

                    foreach ($value as $key2 => $value2) {
                    echo "<td>".$value->$key2."</td>";
                    if($i==0){
                    $campo=$key2;
                    $valor="'".$value->$key2."'";
                    }
                    $i++;
                    }
                    echo "<td>"
                        . '<a href="javascript:" class="btn btn-dcs" onclick="editar('.$valor.')"><i class="fa fa-pencil"></i></a>'
                        . '<a href="javascript:" class="btn btn-danger" onclick="delete_('.$valor.')"><i class="fa fa-trash-o"></i></a>'
                        . "</td>";
                    echo "</tr>";
                }
                ?=>

            </tbody>
        </table>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-12" style="float:right">
        <a href="<=?php echo base_url()."/index.php/<?php echo ucfirst($post['tabla'])."/index" ?>" ?=>" class="btn btn-dcs" >Nuevo</a>
    </div>
</div>
<=?php  if(isset($campo)){ ?=>
<form action="<=?php echo base_url('index.php/')."<?php echo "/" . ucfirst($post['tabla']) . '/edit_' . $post['tabla'] ?>"; ?=>" method="post" id="editar">
    <input type="hidden" name="<=?php echo $campo ?=>" id="<=?php echo $campo ?=>2">
    <input type="hidden" name="campo" value="<=?php echo $campo ?=>">
</form>
<form action="<=?php echo base_url('index.php/')."<?php echo "/" . ucfirst($post['tabla']) . '/delete_' . $post['tabla'] ?>"; ?=>" method="post" id="delete">
    <input type="hidden" name="<=?php echo $campo ?=>" id="<=?php echo $campo ?=>3">
    <input type="hidden" name="campo" value="<=?php echo $campo ?=>">
</form>
<=?php } ?=>
<script>
    function editar(num) {
        $('#<=?php echo $campo ?=>2').val(num);
        $('#editar').submit();
    }
    function delete_(num) {
        var r=confirm('Confirma que desea eliminar el registro');
        if(r==false){
            return false;
        }
        $('#<=?php echo $campo ?=>3').val(num);
        $('#delete').submit();
    }

    $('body').delegate('.number', 'keypress', function (tecla) {
        if (tecla.charCode > 0 && tecla.charCode < 48 || tecla.charCode > 57)
            return false;
    });
    $('.fecha').datepicker({
        rtl: Metronic.isRTL(),
        autoclose: true
    });
</script>