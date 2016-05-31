<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>INFORME EXÁMENES MEDICOS
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <th>Tipo documento</th>
                                    <th>Documento</th>
                                    <th>Nombre(s)</th>
                                    <th>Apellido(s)</th>
                                    <th>Sexo</th>
                                    <th>Examen</th>
                                    <th>Valor examen</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total = "";
                                        foreach ($informeExamenesMedicos as $em): ?>
                                            <tr>
                                                <td rowspan="2"><?php echo $em->tipIde_tipo ?></td>
                                                <td rowspan="2"><?php echo $em->empPreExa_documento ?></td>
                                                <td rowspan="2"><?php echo $em->empPreExa_nombre ?></td>
                                                <td rowspan="2"><?php echo $em->empPreExa_apellido ?></td>
                                                <td rowspan="2"><?php echo $em->Sex_Sexo ?></td>
                                                <?php
                                                $ulExamen = "<ul style='list-style:none;'>";
                                                $info2 = explode(",", $em->preExa_examen);
                                                for ($i = 0; $i < count($info2); $i++):
                                                    $ulExamen .= "<li> ".($i+1)." - ". $info2[$i] . "</li>";
                                                endfor;
                                                $ulExamen .= "<ul>";
                                                ?>
                                                <td rowspan="2"><?php echo $ulExamen ?></td>
                                                <?php
                                                $ul = "<ul style='list-style:none;'>";
                                                $info = explode(",", $em->preExaVal_valor);
                                                $valor = '';
                                                for ($i = 0; $i < count($info); $i++):
                                                    $total += str_replace('.','',$info[$i]);
                                                    $valor += str_replace('.','',$info[$i]);
                                                    $ul .= "<li> ".($i+1)." - ". $info[$i] . "</li>";
                                                endfor;
                                                $ul .= "<ul>";
                                                ?>
                                                <td><?php echo $ul ?></td>
                                            </tr>
                                            <tr>
                                                <td style="background-color: #D8D8D8"><center><b>$ <?php echo $valor ?></b></center></td>
                                            </tr>
                                        <?php endforeach; ?>
                                            <tr>
                                                <td colspan="6" style="text-align: right"><b>TOTAL</b></td>
                                                <td style="text-align: center">$ <?php echo $total; ?></td>
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
</div>