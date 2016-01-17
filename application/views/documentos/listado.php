<?php
include_once("configuracion.php");
$id_cliente; //variable configurada en "configuracion.php", por cada cliente
$directorio_cliente=$id_cliente;

$contenido_ejemplo= " 
       <li>Root node 1
        <ul>
          <li id='child_node_1'>Child node 1</li>
          <li>Child node 2</li>
        </ul>
      </li>
      <li>Root node 2</li>
      <li>Root node 3</li>";
	  

$contenido="";  
	  
foreach($documentos_padre as $key){	 
	$id_padre=$key->id;	
	$directorio=$key->nombre; //id='child_node_".$key->id."'
	$contenido.="<li>".$key->nombre;  
	$contenido.="<ul>";  
	$documentos_hijo=$this->Documentos__model->consultarDocumentosHijo($id_padre);
	$i=0;
	foreach($documentos_hijo as $key2){	  $i++; //id='child_node_1".$i."'
	  $id_hijo=$key2->id;  
	  //print "--".$key2->nombre;
	  $contenido.="<li><a href='../../uploads/documentos/".$directorio_cliente."/".$directorio."/".$key2->url."'>".$key2->nombre."</a></li>"; 
    }
	$contenido.="</ul></li>";	
}

//print $contenido_ejemplo;
//print"//////". $contenido;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>jsTree test</title>
  <link rel="stylesheet" href="../../js/jstree/dist/themes/default/style.min.css" /> 
  <script src="../../js/jquery-1.9.1.js"></script> 
  <script src="../../js/jstree/dist/jstree.min.js"></script>
</head>

<body>
<div class="row">
    <div class="col-md-12 page-404">    
        <div class="details">
            <h3>DOCUMENTOS...</h3>                     
        </div>
    </div>
</div>


  <!-- 3 setup a container element -->
  <div id="jstree">
    <!-- in this example the tree is populated from inline HTML -->	
    <ul>
      <?php 
	  //echo $contenido_ejemplo; 
	  echo $contenido; 	  
	  ?>
    </ul>
  </div>
  
  
  <!-- <button>demo button</button> -->


  
  
  <script>
  $(function () {
    // 6 create an instance when the DOM is ready
    $('#jstree').jstree();
    // 7 bind to events triggered on the tree
    $('#jstree').on("changed.jstree", function (e, data) {
      console.log(data.selected);
    });
    // 8 interact with the tree - either way is OK
    $('button').on('click', function () {
      $('#jstree').jstree(true).select_node('child_node_1');
      $('#jstree').jstree('select_node', 'child_node_1');
      $.jstree.reference('#jstree').select_node('child_node_1');
    });
  });
  
  $('#tree').jstree({
    'core' : {
        'data' : function (obj, cb) {
            cb.call(this,
              ['Root 1', 'Root 2']);
        }
    }});
  </script>
</body>
</html>



