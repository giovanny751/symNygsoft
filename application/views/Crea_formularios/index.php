<div class="alert alert-info"><center><b>CREACIÓN DE FORMULARIOS</b></center></div>
<form id="form1">
    <div class="row">
        <div class="col-md-3" id="datos">
            <label for="tabla">Tabla</label>
        </div> 
        <div class="col-md-3" id="datos">
            <select id="tabla" class="form-control" name="tabla">
                <option value="">::Seleccionar::</option>
                <?php foreach ($tablas as $key =>$value) { ?>
                    <option value="<?php echo $value->Tables_in_sst ?>">
                        <?php echo $value->Tables_in_sst ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3" id="datos">
            <label for="columnas">Número de columnas</label>
        </div> 
        <div class="col-md-3" id="datos">
            <select id="columnas" class="form-control" name="columnas">
                <?php for ($i = 1; $i <= 12; $i++) { ?>
                    <option value="'<?php echo $i; ?> '"><?php echo $i ?></option>;
                <?php } ?>
            </select>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-3" id="datos">
            <label for="titulo">Título</label>
        </div>
        <div class="col-md-3" id="datos">
            <input type="text" class="form-control" name="titulo" id="titulo">
        </div>
    </div>
    <div class="row">
        <table class="cree table table-bordered" width="100%">
            <thead>
            <th>Campo</th>
            <!--<th>Archivo</th>-->
            <th>Descripción</th>
            <th>Label</th>
            <th>Tipo</th>
            <th>Obligatorio</th>
            <th>Númerico</th>
            <th>Fecha</th>
            <th>Autocompletable</th>
            <th>Visible</th>
            <th>Orden</th>
            </thead>
            <tbody id="tbody_table">

            </tbody>
        </table>
    </div>
</form>

<center><button id="guardar" style="display: none" class="btn btn-dcs">Guardar</button></center>
<script>

    $('#guardar').click(function() {
        var url = "<?php echo base_url("index.php/Crea_formularios/new_file") ?>";
        $.post(url, $('#form1').serialize())
                .done(function(msg) {
                    alert('Se agregaron con exito');
                })
                .fail(function() {
                    alert('No se agregaron ');
                });
    });
    $('#tabla').change(function() {
        var url = "<?php echo base_url("index.php/Crea_formularios/info_table") ?>";
        var tabla = $("#tabla option:selected").text()
//        tabla=tabla.capitalize();
//        $('#titulo').val(tabla);
        $.post(url, {tabla: $('#tabla').val()})
                .done(function(msg) {
                    var table = "";
                    $.each(msg[0], function(key, val) {
                        table += "<tr>";
                        table += "<td><input type='hidden' name='nombre_campo[]' value='" + val.Field + "' class='form-control' />" + val.Field + "</td>";
                        table += "<td>" + val.Type + "</td>";
                        table += "<td><input type='text' name='nombre_label[]' value='" + val.Field + "' class='form-control' /></td>";
                        var dd = '"' + val.Field + '2"';
                        table += "<td><select name='tipo[]' class='form-control' onchange='auto2(this," + dd + ")'>";
                        $.each(msg[1], function(key2, val2) {
                            table += "<option value='" + val2.name + "'>" + val2.name + "</option>";
                        });
                        table += "</select><div class='" + val.Field + "2' style='display:none'>";
                        table += "<br>tablaa<input type='text' style='width: 80px' name='select1[]' >";
                        table += "<br>value<input type='text' style='width: 80px'name='select2[]' >";
                        table += "<br>text<input type='text' style='width: 80px' name='select3[]' >";
                        table += "</div></td>";
                        table += "<td><select name='obligatorio[]' class='form-control'>";
                        table += "<option value='obligatorio'>Si</option>";
                        table += "<option value=''>No</option>";
                        table += "</select></td>";
                        table += "<td><select name='numero[]' class='form-control'>";
                        table += "<option value=''>No</option>";
                        table += "<option value='number'>Si</option>";
                        table += "</select></td>";
                        table += "<td><select name='fecha[]' class='form-control'>";
                        table += "<option value=''>No</option>";
                        table += "<option value='fecha hasDatepicker'>Si</option>";
                        table += "</select></td>";
                        var dd = '"' + val.Field + '"';
                        table += "<td><select name='autocomplete[]' class='form-control' onchange='auto(this," + dd + ")'>";
                        table += "<option value=''>No</option>";
                        table += "<option value='1'>Si</option>";
                        table += "</select><div class='" + val.Field + "' style='display:none'>";
                        table += "<br>tabla<input type='text' style='width: 80px' name='autocomplete1[]' >";
                        table += "<br>value<input type='text' style='width: 80px'name='autocomplete2[]' >";
                        table += "<br>text<input type='text' style='width: 80px' name='autocomplete3[]' >";
                        table += "</div></td>";
                        table += "<td><select name='aparezca[]' class='form-control'>";
                        table += "<option value='1'>Si</option>";
                        table += "<option value=''>No</option>";
                        table += "</select></td>";
                        table += "<td><input type='text' name='orden' class='form-control' /></td>";
                        table += "</tr>";
                    });
                    $('#guardar').show();
                    $('#tbody_table').html(table)
                })
                .fail(function(msg) {

                });
    })
    function auto(num, campo) {
        if (num.value == 1) {
            $('.'+campo).show();
        } else {
            $('.'+campo).hide();
        }
    }
    function auto2(num, campo) {
        console.log(num);
        if (num.value == 'select') {
            $('.'+campo).show();
        } else {
            $('.'+campo).hide();
        }
    }
</script>
