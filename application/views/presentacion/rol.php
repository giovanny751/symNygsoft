<div class="row">
    <div class="col-md-12">
        <div class="tituloCuerpo">
            <span class="txtTitulo">ROLES</span>
        </div>
    </div>
</div>
<div class='cuerpoContenido'>
    <form method="post" id="f20">
    <table class="tablesst">
        <thead>
        <th>Rol</th><th>Seleccionar</th>
        </thead>
        <tbody>
            <?php foreach($roles as $r){?>
            <tr>
                <td><?php echo $r->rol_nombre ?></td>
                <td align="center"><input type="radio" name="rol" id="rol" value="<?php echo $r->rol_id ?>"></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>   
    <div class="row" style="text-align:center">
        <!--<button type="button" class="btn btn-success ingresar">Ingresar</button>-->
        <button type="button" class="btn-sst defecto">Rol por defecto</button>
    </div>
</div>
<script>
    
    
    $('.defecto').click(function(){
        $.post("<?php echo base_url("index.php/presentacion/guardarroldefecto") ?>"
        ,$('#f20').serialize()
                ).done(function(msg){
                    window.location.href = '<?php echo base_url("index.php") ?>';
                }).fail(function(msg){
                    
                })
        
    });
</script>    