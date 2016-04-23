<br>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bars"></i>INSPECCIÓN DE ELEMENTOS
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form method="post" class="form-horizontal" id="inspecciones">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4">Inspección</label>
                                    <div class="col-md-8">
                                        <select id="tipoinspec" class="form-control" name="tipoinspec">
                                            <option value="">-Seleccionar-</option>
                                            <option value="1">Botiquin</option>
                                            <option value="2">Extintores</option>
                                            <option value="3">General</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4">Fecha Desde:</label> 
                                    <div class="col-md-8">
                                        <input type="text" class="form-control fecha" id="fechadesde" name="fechadesde">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4">Fecha Hasta:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control fecha" id="fechahasta" name="fechahasta">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-4">Responsable</label>
                                    <div class="col-md-8">
                                        <input type="text" name="responsable" id="responsable" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="col-md-12" align="right">
                                        <button class="btn btn-success" id="consultar">Consultar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tablesst" class="table table-striped table-bordered table-hover ">
                                <thead>
                                    <th>FECHA</th>
                                    <th>RESPONSABLE</th>
                                    <th>EDITAR</th>
                                    <th>ELIMINAR</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#consultar').click(function(){
        $.post(
                url+"index.php/documento/filtroInspeccion",
        $('#inspecciones').serialize()
                )
    });
</script>