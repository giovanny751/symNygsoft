<?php

include('jpgraph.php');
include('jpgraph_gantt.php');
//ponemos todo en una función para poder ocuparlo en otros archivo sin amontonar código
function grafica($fecha_max,$fecha_min,$datos){
    $graph = new GanttGraph();
    $graph->title->Set("");

    // Rango de fechas a presentar 
    $graph->SetDateRange($fecha_min,$fecha_max);


    // linea de espaciado vertical entre los elementos
    $graph->SetVMarginFactor(2);

    // configuracion de colores 
    $graph->SetMarginColor('lightgreen@0.8');			//  color del fondo
    $graph->SetBox(true,'yellow:0.6',2);				//  contorno del marco interior
    $graph->SetFrame(true,'darkgreen',4);				// contorno  del marco exterior
    $graph->scale->divider->SetColor('yellow:0.6');    // linea divisora de datos y grafico
    $graph->scale->dividerh->SetColor('red:0.6');   //liena que divide el tiempo con las barras de la grafica

    // Ponemos la medida de tiempo que queremos usar, por ejemplo años, meses, dias, hors o minutos
    //por ejemplo, si queremos solamente la division por meses y semanas en lugar de tener 
    //GANTT_HWEEK | GANTT_HMONTH | GANTT_HYEAR | GANTT_HDAY
    //dejamos 
    //GANTT_HWEEK | GANTT_HMONTH
    // para mas opciones de division de tiempo ver comentarios abajo
    $graph->ShowHeaders(GANTT_HWEEK | GANTT_HMONTH | GANTT_HYEAR | GANTT_HDAY); 
    $graph->scale->month->grid->SetColor('gray');   //lineas verticales que dividen los meses
    $graph->scale->month->grid->Show(true);
    $graph->scale->year->grid->SetColor('gray');	// linea verticales que dividen los años
    $graph->scale->year->grid->Show(true);

    
    $graph->scale->actinfo->SetColTitles(
        //el segundo array array(30,100) , es el espacio de cada titulo, 30 para ovservacion, 100 para accion, etc
        array('Acción','Duracion','Inicio','Final','Porcentaje'),array(30,100)); 
    $graph->scale->actinfo->SetBackgroundColor('blue:0.5@0.5'); //color de fondo de los titulos de la tabla
    $graph->scale->actinfo->SetFont(FF_ARIAL,FS_NORMAL,12); //tipografia
    // division vertical de los datos a la izquierda, posibles valores 'solid', 'dotted', 'dashed'
    $graph->scale->actinfo->vgrid->SetStyle('solid'); 
    $graph->scale->actinfo->vgrid->SetColor('red'); // color de las divisiones puestas en el renglon anterior

    // Configuración de los iconos que queremos usar
    //para poner algun icono no definido podemos usarlo de la siguiente manera
    //$icon = new IconImage("imagen.png",0.7); 
    //en el ejemplo estoy usando una omagen desde blogspot
    //el numero que es el segundo parametro de IconImage es el porcentaje de la imagen, en este caso esta al 20%
    $erricon = new IconImage("logo-copia.png",0.2);
    $startconicon = new IconImage(GICON_FOLDEROPEN,0.6);
    $endconicon = new IconImage(GICON_TEXTIMPORTANT,0.5);

    //ahora ponemos los datos de la tabla e iniciamos los datos de las barras
    
//    $data = array(
//        //valores del arreglo:
//        //indice del arreglo, arreglo de datos para la informacion a la izquierda, fecha de inicio de la barra, fecha final de la barra, tipografia, estilo,tamaño tipografia,% de progreso en la barra 
//        array(0,array("Pre-study","17 days","1 Nov '2011","1 Mar '2012")
//              , "2011-11-01","2012-01-1",FF_ARIAL,FS_NORMAL,8, 0.5),//el 0.5 indica el 50%, que ocuparemos en la linea 74, dando su posicion en el arreglo
//        array(1,array("Prototype","10 days","26 Oct '2011","16 Nov '2011"),
//              "2011-10-26","2011-11-01",FF_ARIAL,FS_NORMAL,8, 0.12),
//        array(2,array("Report","12 days","1 Mar '2012","13 Mar '2012"),
//              "2012-03-01","2012-03-13",FF_ARIAL,FS_NORMAL,8, 1)
//    );
    $data = $datos;    
    // Crea las barras y las añade a la grafica gantt
    for($i=0; $i<count($data); ++$i) {
        $bar = new GanttBar($data[$i][0],$data[$i][1],$data[$i][2],$data[$i][3],'',10);
        if( count($data[$i])>4 )
            $bar->title->SetFont($data[$i][4],$data[$i][5],$data[$i][6]);
        $bar->SetPattern(BAND_RDIAG,"yellow");
        $bar->SetFillColor("gray");
        $bar->progress->Set($data[$i][7]);// ocupamos el % de adelanto en la actividad
        $bar->progress->SetPattern(GANTT_SOLID,"darkgreen");
        //$bar->title->SetCSIMTarget(array('#1'.$i,'#2'.$i,'#3'.$i,'#4'.$i,'#5'.$i),array('11'.$i,'22'.$i,'33'.$i));
        $graph->Add($bar);
        //echo "<br>--> ".$data[$i][7];
    }

    // Creamos la imagen y le damos nombre, la imagen se guarda donde estan estos archivos
    $graph->Stroke('imagenprueba.jpg');
    

}


?>





















































<?php





/********************************************************

// Creating an icon from an image file and scaling it to 70% 
// of original size 
$icon = new IconImage("smiley.png",0.7); 

// Using on of the bultin icons 
$icon = new IconImage(GICON_TEXT,0.8); 
 
//////////////////////////////

$icon = new IconImage("../smiley.png",0.7); 
$icon->SetAlign('center','center'); 

*/




/*

Para divisiones bajo las fechas, puede ser por año, mes, semana, día, hora o minutos
el uso es el siguiente 

$graph->ShowHeaders(GANTT_HWEEK | GANTT_HMONTH | GANTT_HYEAR);

GANTT_HYEAR
GANTT_HMONTH
GANTT_HWEEK
GANTT_HDAY
GANTT_HHOUR
GANTT_HMIN


*/
?>