<form method="post" id="frmCapacitaciones">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-american-sign-language-interpreting"></i>Agregar capacitaciones
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
                                <div class="circuloIcon" title="Guardar capacitación" id="guardar" metodo="guardar"><i class="fa fa-floppy-o fa-3x"></i></div>
                                <hr>
                            </div>
                        </div>
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
                                    <br>
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
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-info btn-block" id="agregar" >Agregar Empleados</button>
                        </div>
                        <table class="tabla-sst" id="tablaCapacitacion">
                            <thead style="text-align: Center">
                            <th style="width: 80%;text-align: center">EMPLEADO</th>
                            <th style="width: 20%;text-align: center">ELIMINAR</th>
                            </thead>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>

    $('body').delegate(".eliminar", "click", function () {
        var table = $('#tablaCapacitacion').DataTable();
        table
                .row($(this).parents('tr'))
                .remove()
                .draw();
    });

    $('#agregar').click(function () {
        var select = "<select id='empleado' name='empleado[]' class='form-control'>";
        var table = $('#tablaCapacitacion').DataTable();
        table.row.add([
            select + "<?php echo $option ?>",
            "<center><button type='button' class='btn btn-danger eliminar' title='Eliminar'><i class='fa fa-remove'></i></button></center>"
        ]).draw();
    });
    $('#guardar').click(function () {
        if (obligatorio('obligatorio') == true) {
            $.post(
                    url + "index.php/administrativo/guardarCapacitaciones",
                    $("#frmCapacitaciones").serialize()

                    ).done(function (msg) {
                $("input,select,textarea").val('');
                var table = $('#tablaCapacitacion').DataTable();
                table.clear().draw();
            }).fail(function (msg) {

            });
        }

    });
</script>    