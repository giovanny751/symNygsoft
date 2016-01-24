<form method="post" id="frmCapacitaciones">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-table"></i>Tabla
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="responsable" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    Responsable
                                </label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> 
                                    <?php
                                    $option = "";
                                    $optionSelect = "<select id='responsable' name='responsable' class='form-control obligatorio'>";
                                    $option .= "<option value=''>::Seleccionar::</option>";
                                    foreach ($empleados as $e):
                                        $option .= "<option value='" . $e->Emp_id . "'>" . $e->Emp_Nombre . " " . $e->Emp_Apellidos . '</option>';
                                    endforeach;
                                    $option .= '</select>';
                                    echo $optionSelect . $option;
                                    ?>
                                </div>
                                <label for="fechaCapacitacion" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    Fecha capacitación
                                </label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <input type="text" name="fechaCapacitacion" id="fechaCapacitacion" class="form-control fecha obligatorio">
                                </div>
                                <label for="fechaCapacitacion" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    Nombre capacitación
                                </label>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <input type="text" name="nombre" id="nombre" class="form-control obligatorio">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label name="Observacion" class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    Observación
                                </label> 
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                    <textarea name="observacion" id="observacion" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-9 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <button type="button" id="guardar" class="btn btn-block green">Guardar</button>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <button type="button" class="btn btn-info " id="agregar">Agregar Empleados</button>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <button type="button"></button>
                        <table class="tabla-sst" id="tablaCapacitacion">
                            <thead style="text-align: Center">
                            <th>EMPLEADO</th>
                            <th>ELIMINAR</th>
                            </thead>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $('#agregar').click(function () {

        var select = "<select id='empleado' name='empleado[]' class='form-control'>";
        var table = $('#tablaCapacitacion').DataTable();
        table.row.add([
            select + "<?php echo $option ?>",
            "<button type='button' class='btn btn-danger' title='Eliminar'>-</button>"
        ]).draw();
    });
    $('#guardar').click(function(){
        if(obligatorio('obligatorio') == true){
        $.post(
                url+"index.php/administrativo/guardarCapacitaciones",
                $("#frmCapacitaciones").serialize()
                ).done(function(msg){
                    
                }).fail(function(msg){
                    
                });
        }
    
    });
</script>    