<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="glyphicon glyphicon-ok"></i>EXAMENES REALIZADOS
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <form method="post" id="frmConsultaExamenes" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="form-group" id="desicionCompania">
                                            <label class="col-md-2">
                                                <span>* </span>Pertenece a la compañia
                                            </label>
                                            <div class="col-md-2">
                                                <select name="pertenece" id="pertenece" class="form-control obligatorio">
                                                    <option value="">::Seleccionar::</option>
                                                    <option value="1">SI</option>
                                                    <option value="0">NO</option>
                                                </select>
                                            </div>
                                            <label class="col-md-2"><span>* </span>N° documento</label>
                                            <div class="col-md-2">
                                                <input type="text" name="noDocumento" id="noDocumento" class="form-control obligatorio" >
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Nombre(s)</label>
                                            <div class="col-md-2">
                                                <input type="text" name="nombre" id="nombre" class="form-control inactivar">
                                            </div>
                                            <label class="col-md-2">Apellido(s)</label>
                                            <div class="col-md-2">
                                                <input type="text" name="apellidos" id="apellidos" class="form-control inactivar">
                                            </div>
                                            <label class="col-md-2">Sexo</label>
                                            <div class="col-md-2">
                                                <select name="sexo" id="sexo" class="form-control inactivar">
                                                    <option value="">::Seleccionar::</option>
                                                    <?php foreach ($sexo as $s): ?>
                                                        <option value="<?php echo $s->Sex_id ?>"><?php echo $s->Sex_Sexo ?></option> 
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2">Tipos de examenes</label>
                                            <div class="col-md-2">
                                                <select name="tipoExamen" id="tipoExamen" class="form-control " multiple>
                                                    <?php foreach ($examenes as $e): ?>
                                                        <option value="<?php echo $e->preExaVal_id ?>"><?php echo $e->preExa_examen ?></option> 
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <label class="col-md-2">Proveedor</label>
                                            <div class="col-md-2">
                                                <select name="proveedor" id="proveedor" class="form-control">
                                                    <option value="">::Seleccionar::</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4" style="text-align: center">
                                                <button type="button" id="consultar" class="btn btn-success">Consultar</button>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <table  id="tablesst" class="table table-striped table-bordered table-hover tabla-sst">
                                <thead>
                                <th>Pertenece a la compañia</th>
                                <th>Examen</th>
                                <th>Tipo de documento</th>
                                <th>No Documento</th>
                                <th>Nombre</th>
                                <th>correo</th>
                                <th>Sexo</th>
                                <th>Tipo examen</th>
                                <th>Proveedor</th>
                                <th>Formato asignación medico</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="manual_form" target="_black" action="<?php echo base_url('index.php/Presupuesto/examenMedico')?>" method="post">
    <input type="hidden" id="examenId" name="examenId">
</form>
<style>
    i{
        cursor:pointer;
    }
</style>
<script>
    $('body').delegate(".manual", "click", function () {
        $('#examenId').val($(this).attr('empPreExa_id'));
        $('#manual_form').submit();
    })
    
    $('#consultar').click(function () {
        $.post(
                url + "index.php/Presupuesto/consultarExamenesMedicos",
                $('#frmConsultaExamenes').serialize()
                ).done(function (msg) {
            if (!jQuery.isEmptyObject(msg.message))
                alerta("rojo", msg['message']);
            else {

                var table = $('#tablesst').DataTable();
                table.clear().draw();
                $.each(msg['Json'], function (key, val) {
                    
                    examenesMedicos = val.preExa_examen;
                    
                    examenes = examenesMedicos.split(",");
                    examen = "<ul style='list-style:none;'>"
                    for(var i = 0; i<examenes.length;i++){
                        examen += "<li>"+parseInt(i+1)+"-"+examenes[i]+"</li>"
                    }
                    examen += "</ul>"
                    
                    table.row.add([
                        "<center>"+val.empPreExa_pertenece+"</center>",
                        val.tipExa_tipo,
                        val.tipIde_tipo,
                        val.empPreExa_documento,
                        val.empPreExa_nombre+" "+val.empPreExa_apellido,
                        val.empPreExa_correo,
                        val.Sex_Sexo,
                        examen,
                        "",
                        '<center><i class="fa fa-file-pdf-o  fa-2x " ></i></center>',
                        '<center><i class="fa fa-pencil-square-o fa-2x  modificar" aria-hidden="true" title="Modificar"  empPreExa_id="' + val.empPreExa_id + '"  data-toggle="modal" data-target="#myModal"></i></center>',
                        '<center><i class="fa fa-trash-o fa-2x   eliminar" aria-hidden="true" title="Eliminar" empPreExa_id="' + val.empPreExa_id + '"  ></i></center>'
                    ]).draw();
                });
            }
        }).fail(function () {

        });
    });
</script>