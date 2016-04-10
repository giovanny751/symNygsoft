<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="glyphicon glyphicon-ok"></i> PQR
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form action="<?php echo base_url('index.php/') . '/Pqr/consult_pqr'; ?>" method="post" >
                        <div class="row">
                            <label for="tipSol_id" class="col-md-3">
                                Tipo De Solicitud:                        
                            </label>
                            <div class="col-md-3">
                                <?php echo lista("tipSol_id", "tipSol_id", "form-control obligatorio", "tipo_solicitud", "tipSol_id", "tipSol_nombre", (isset($post['tipSol_id']) ? $post['tipSol_id'] : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                    <br>
                            </div>
                            <label for="temSol_id" class="col-md-3">
                                Tema:                        
                            </label>
                            <div class="col-md-3">

                                <?php echo lista("temSol_id", "temSol_id", "form-control obligatorio", "temaSolicitud", "temSol_id", "temSol_nombre", (isset($post['temSol_id']) ? $post['temSol_id'] : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                    <br>
                            </div>
                            <label for="pqr_detalle" class="col-md-3">
                                Detalles:                        
                            </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($post['pqr_detalle']) ? $post['pqr_detalle'] : '' ) ?>" class="form-control obligatorio  " id="pqr_detalle" name="pqr_detalle">
                                <br>
                            </div>
                            <label for="sol_id" class="col-md-3">
                                Solicitante:                        
                            </label>
                            <div class="col-md-3">
                                <?php echo lista("sol_id", "sol_id", "form-control obligatorio", "solicitante", "sol_id", "sol_nombre", (isset($post['sol_id']) ? $post['sol_id'] : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                    <br>
                            </div>
                            <label for="pqr_nombre" class="col-md-3">
                                Nombre:                        
                            </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($post['pqr_nombre']) ? $post['pqr_nombre'] : '' ) ?>" class="form-control obligatorio  " id="pqr_nombre" name="pqr_nombre">
                                <br>
                            </div>
                            <label for="email" class="col-md-3">
                                E-mail:                        
                            </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($post['email']) ? $post['email'] : '' ) ?>" class="form-control obligatorio  " id="email" name="email">
                                <br>
                            </div>
                            <label for="telefono" class="col-md-3">
                                Teléfono:                        
                            </label>
                            <div class="col-md-3">
                                <input type="text" value="<?php echo (isset($post['telefono']) ? $post['telefono'] : '' ) ?>" class="form-control obligatorio  number" id="telefono" name="telefono">
                                <br>
                            </div>
                            <label for="dep_id" class="col-md-3">
                                Departamento:                        
                            </label>
                            <div class="col-md-3">
                                <?php echo lista("dep_id", "dep_id", "form-control obligatorio", "departamento", "dep_id", "dep_nombre", (isset($post['dep_id']) ? $post['dep_id'] : ''), array("ACTIVO" => "S"), /* readOnly? */ false); ?>                    <br>
                            </div>
                        </div>
                        <center><button class="btn btn-dcs">Consultar</button></center><p>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <th style='display:none'></th>
                                    <th>Tipo De Solicitud:</th>
                                    <th>Tema:</th>
                                    <th>Detalles:</th>
                                    <th>Solicitante:</th>
                                    <th>Nombre:</th>
                                    <th>E-mail:</th>
                                    <th>Teléfono:</th>
                                    <th>Departamento:</th>
                                    <th>Estado de Solicitud</th>
                                    <th>Acción</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($datos as $key => $value) {
                                            echo "<tr>";
                                            $i = 0;

                                            foreach ($value as $key2 => $value2) {
                                                if ($i == 0) {
                                                    echo "<td style='display:none'>" . $value->$key2 . "</td>";
                                                    $campo = $key2;
                                                    $valor = "'" . $value->$key2 . "'";
                                                } else {
                                                    echo "<td>" . $value->$key2 . "</td>";
                                                }
                                                $i++;
                                            }
                                            echo "<td>"
                                            . '<a href="javascript:" class="btn btn-dcs" onclick="editar(' . $valor . ')"><i class="fa fa-pencil"></i></a>'
                                            . '<a href="javascript:" class="btn btn-danger" onclick="delete_(' . $valor . ')"><i class="fa fa-trash-o"></i></a>'
                                            . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="float:right">
                        <a href="<?php echo base_url() . "/index.php/Pqr/index" ?>" class="btn btn-info" >Nuevo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($campo)) { ?>
    <form action="<?php echo base_url('index.php/') . "/Pqr/edit_pqr"; ?>" method="post" id="editar">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>2">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
    <form action="<?php echo base_url('index.php/') . "/Pqr/delete_pqr"; ?>" method="post" id="delete">
        <input type="hidden" name="<?php echo $campo ?>" id="<?php echo $campo ?>3">
        <input type="hidden" name="campo" value="<?php echo $campo ?>">
    </form>
<?php } ?>
<script>
    function editar(num) {
        $('#<?php echo $campo ?>2').val(num);
        $('#editar').submit();
    }
    function delete_(num) {
        var r = confirm('Confirma que desea eliminar el registro');
        if (r == false) {
            return false;
        }
        $('#<?php echo $campo ?>3').val(num);
        $('#delete').submit();
    }
</script>
