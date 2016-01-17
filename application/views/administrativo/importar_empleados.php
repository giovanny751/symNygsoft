
<h1>Subir documento</h1>
<input type="file" id="documento3" name="files[]" required="required"   ><br>
<button class="btn btn-primary" id="procesar">Procesar</button> 

Descargar Guia : <a href="<?php echo base_url('uploads/empleados_a_plano/archivo_empleados.xlsx'); ?>" target="_black">Descargar</a><br>
<div id="resultados"></div>
<script>

    $('#procesar').click(function() {
        var file_data = $('#documento3').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

        var fullPath = document.getElementById('documento3').value;
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
        }
        $.ajax({
            url: "<?php echo base_url('index.php/Administrativo/subir_archivo'); ?>",
            dataType: 'text', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data) {
                $('#resultados').html(data)
            }
        });
    });



</script>
