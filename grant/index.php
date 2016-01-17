<?php 
	include('grafica.php');
        
        for($i=0;$i<count($_POST['diferencia']);$i++){
            if(empty($_POST['progreso'][$i]))
                $r=0;
            else
                $r=$_POST['progreso'][$i]/100;
            $datos[]=array($i,array($_POST['tar_nombre'][$i],$_POST['diferencia'][$i].' Días',$_POST['tar_fechaInicio'][$i],$_POST['tar_fechaFinalizacion'][$i],$_POST['progreso'][$i]." %")
              , $_POST['tar_fechaInicio'][$i],$_POST['tar_fechaFinalizacion'][$i],FF_ARIAL,FS_NORMAL,8, $r);
        }
//         array(0,array("Pre-study","17 days","1 Nov '2011","1 Mar '2012")
//              , "2011-11-01","2012-01-1",FF_ARIAL,FS_NORMAL,8, 0.5)
        
    grafica($_POST['fecha_maxima'],$_POST['fecha_minima'],$datos);
 ?>




