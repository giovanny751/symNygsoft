<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <button class="btn btn-info" data-toggle="modal" data-target="#myModal2">Campos</button>
    </div>
</div>
<!--<div class="row">
    <div class="row">
        Totales
    </div>
    <?php foreach($totales as $nombre => $total){?>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        
    </div>
    <?php } ?>
</div>-->
<div class="row">
<div class="table-responsive ">
    <table class="table table-responsive table-striped table-bordered">
        <thead>    
            <?php
            foreach ($informacion[0] as $campo => $nombre) {
                echo "<th>" . $campo . "</th>";
            }
            ?>
        </thead>  
        <tbody>
            <?php
            foreach ($informacion as $campo => $info) {
                echo "<tr>";
                foreach ($info as $camos => $data) {
                    echo "<td>" . $data . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">CAMPOS A CONSULTAR</h4>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-sx-12">
                <div class=" marginV20">
                    <div class="widgetTitle">
                        <h5><i class="glyphicon glyphicon-pencil"></i> AGREGAR CAMPOS</h5>
                    </div>
                    <div class="well">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </div>		
            <div class="modal-footer">
                <div class="row marginV10">
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 col-md-offset-8 col-lg-offset-8 col-sm-offset-8 col-sx-offset-8 margenlogo' align='center' >
                        <button type="button" class="btn btn-primary guardarpermiso">Guardar</button>
                    </div>
                    <div class='col-md-2 col-lg-2 col-sm-2 col-sx-2 margenlogo' align='center' >
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".chosen-select").chosen({disable_search_threshold: 10});
</script>    