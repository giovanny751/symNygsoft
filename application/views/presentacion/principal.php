<div class="col-md-12">
    <div class="portlet green-meadow box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cogs"></i>INICIO
            </div>
            <div class="tools">
<!--                <a href="javascript:;" class="collapse" data-original-title="" title="">
                </a>-->
<!--                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                </a>
                <a href="javascript:;" class="reload" data-original-title="" title="">
                </a>-->
<!--                <a href="javascript:;" class="remove" data-original-title="" title="">
                </a>-->
            </div>
        </div>
        <div class="portlet-body">
	
        </div>
    </div>
</div> 

<script type="text/javascript" src="../../js/fusionchart/fusioncharts.js"></script>
<script type="text/javascript" src="../../fusionchart/widgets.js"></script>
<script type="text/javascript" src="../../js/fusionchart/gantt.js"></script>
<script type="text/javascript" src="../../js/fusionchart/themes/fusioncharts.theme.fint.js"></script>

  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="plan"><span class="campoobligatorio">*</span>Plan</label>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <select name="plan" id="plan" class="form-control" >
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($planes as $p) { ?>
                                <option value="<?php echo $p->pla_id ?>"><?php echo $p->pla_nombre ?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
 <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="dimensionuno"><?php echo $empresa[0]->Dim_id?></label>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <select name="dimensionuno" id="dimensionuno" class="form-control" >
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($dimension as $d1) { ?>
                            <option   value="<?php echo $d1->dim_id ?>"><?php echo $d1->dim_descripcion ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                </div>
<div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <label for="dimensionuno"><?php echo $empresa[0]->Dimdos_id?></label>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <select name="dimensionuno" id="dimensionuno" class="form-control" >
                            <option value="">::Seleccionar::</option>
                            <?php foreach ($dimension2 as $d1) { ?>
                            <option   value="<?php echo $d1->dim_id ?>"><?php echo $d1->dim_descripcion ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                </div>


<div id="chart-container-budget">

</div>
<div id="chart-container-gantt"></div>
<div id="chart-container-radar"></div>
<script>
    
    FusionCharts.ready(function(){
      var revenueChart = new FusionCharts({
        "type": "column2d",
        "renderAt": "chart-container-budget",
        "width": "500",
        "height": "300",
        "dataFormat": "json",
        "dataSource": {
          "chart": {
              "caption": "Presupuesto por categoría de riesgo",
              "subCaption": "",
              "xAxisName": "Categoria",
              "yAxisName": "Presupuesto en pesos",
              "theme": "fint"
           },
          "data": [
           <?php foreach ($presupuesto as $key=>$value){
               echo'  {
                 "label": "'.$value->categoria.'",
                 "value": "'.str_replace(",", "",$value->costo ).'"
              },';
           }
?>   
           ]
        }
    });

    revenueChart.render();
})
    
    </script>
    
    <script>
    
    FusionCharts.ready(function () {
    var chart = new FusionCharts({
        type: 'gantt',
        renderAt: 'chart-container-gantt',
        width: '900',
        height: '500',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "Plan de trabajo",
                "subcaption": "",                
                "dateformat": "dd/mm/yyyy",
                "outputdateformat": "ddds mns yy",
                "ganttwidthpercent": "60",
                "ganttPaneDuration": "50",
                "ganttPaneDurationUnit": "d",
                "plottooltext": "$processName{br} $label fecha inicio $start{br}$label fecha fin $end",
                "theme": "fint"
            },
            "categories": [
                {
                    "bgcolor": "#33bdda",
                    "category": [
                        {
                            <?php foreach ($mesesplan as $key=>$value) {
                                echo '   " start": "'.$value->desde.'",
                                " end": "'.$value->hasta.'",
                                        ';
                            }
                                ?>
                            "label": "Meses",
                            "align": "middle",
                            "fontcolor": "#ffffff",
                            "fontsize": "16"
                        }
                    ]
                },
                {
                    "bgcolor": "#33bdda",
                    "align": "middle",                                                        
                    "fontcolor": "#ffffff",
                    "fontsize": "16",
                    "category": [
                  <?php foreach ($listameses as $key=>$value){
                            echo'  {
                              "start": "1/'.($key+1).'/2016",  
                              "end": "'.$value[1].'/'.($key+1).'/2016",
                              "label": "'.$value[0].'"
                           },';
                                          }?>
                    ]
                },
                {
                    "bgcolor": "#ffffff",
                    "fontcolor": "#1288dd",
                    "fontsize": "12",
                    "isbold": "1",
                    "align": "center",
                   
                }
            ],
            "processes": {
                "headertext": "Tareas",
                "fontcolor": "#000000",
                "fontsize": "11",
                "isanimated": "1",
                "bgcolor": "#6baa01",
                "headervalign": "bottom",
                "headeralign": "left",
                "headerbgcolor": "#6baa01",
                "headerfontcolor": "#ffffff",
                "headerfontsize": "16",
                "align": "left",
                "isbold": "1",
                "bgalpha": "25",
                "process": [
                  <?php foreach ($tareasplangrafica as $key=>$value){
                            echo'  {
                              "label": "'.$value->nombre.'",  
                              "id": "'.$value->id.'",  
                              "hoverBandColor": "#e44a00",
                              "hoverBandAlpha": "40"
                           },';
                                          }?>
                
                  
                ]
            },
            "datatable": {
                "showprocessname": "1",
                "namealign": "left",
                "fontcolor": "#000000",
                "fontsize": "10",
                "valign": "right",
                "align": "center",
                "headervalign": "bottom",
                "headeralign": "center",
                "headerbgcolor": "#008ee4",
                "headerfontcolor": "#ffffff",
                "headerfontsize": "14",                
                "datacolumn": [
                    {
                        "bgcolor": "#eeeeee",
                        "headertext": "Fecha{br}Inicio{br}",
                        "text": [
                              <?php foreach ($tareasplangrafica as $key=>$value){
                            echo'  {
                              "label": "'.$value->fechainicio.'",  
                           },';
                                          }?>
                            
                           
                        ]
                    },
                    {
                        "bgcolor": "#eeeeee",
                        "headertext": "Fecha{br}Fin{br}",
                        "text": [
                          <?php foreach ($tareasplangrafica as $key=>$value){
                            echo'  {
                              "label": "'.$value->fechafin.'",  
                           },';
                                          }?>
                         
                        ]
                    }                    
                ]
            },
            "tasks": {
                "task": [
                 <?php foreach ($tareasplangrafica as $key=>$value){
                            echo'  {
                              "label": "Planned", 
                              "processid": "'.$value->id.'",  
                              "start": "'.$value->fechainicio.'",
                              "end": "'.$value->fechafin.'",
                              "id": "'.$value->id.'-'.$value->id.'",
                              "color": "#008ee4",
                                "height": "32%",
                                "toppadding": "12%"
                           },';
                                          }?>
                ]
            },
            "legend": {
                "item": [
                    {
                        "label": "Planeado",
                        "color": "#008ee4"
                    },
                    {
                        "label": "Actual",
                        "color": "#6baa01"
                    },
                    {
                        "label": "Retrazado",
                        "color": "#e44a00"
                    }
                ]
            }
        }
    })
    .render();
});
    
    </script>
    
    <script>
    FusionCharts.ready(function () {
    var budgetChart = new FusionCharts({
        type: 'radar',
        renderAt: 'chart-container-radar',
        width: '500',
        height: '450',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "PHVA análisis",
                "subCaption": "",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "numberPrefix":"$",
                "baseFontColor" : "#333333",
                "baseFont" : "Helvetica Neue,Arial",                        
                "subcaptionFontBold": "0",
                "paletteColors": "#008ee4,#6baa01",
                "bgColor" : "#ffffff",
                "radarfillcolor": "#ffffff",
                "showBorder" : "0",
                "showShadow" : "0",
                "showCanvasBorder": "0",
                "legendBorderAlpha": "0",
                "legendShadow": "0",
                "divLineAlpha": "10",
                "usePlotGradientColor": "0",
                "numberPreffix": "",
                "legendBorderAlpha": "0",
                "legendShadow": "0"
            },
           "categories": [
                {
                    "category": [
                        { "label": "ACTUAR" },
                        { "label": "HACER" },
                        { "label": "PLANEAR" },
                        { "label": "VERIFICAR" },
                    ]
                }
            ],
            "dataset": [
                {
                    "seriesname": "Tareas programadas",
                    "data": [
                        { "value": "1" },
                        { "value": "12" },
                        { "value": "8" },
                        { "value": "2" },
   
                    ]
                },
                {
                    "seriesname": "Con Avance",
                    "data": [
                        { "value": "1" },
                        { "value": "1" },
                        { "value": "0" },
                        { "value": "2" },
 
                    ]
                }
            ]
        }
    }).render();
});
    </script>
