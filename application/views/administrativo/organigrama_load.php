   

<link rel="stylesheet" href="<?php echo base_url("css/organigrama/jquery.jOrgChart.css") ?>"/>
    <link rel="stylesheet" href="<?php echo base_url("css/organigrama/custom.css") ?>"/>
    <link href="<?php echo base_url("css/organigrama/prettify.css") ?>" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url("js/organigrama/prettify.js") ?>"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script src="<?php echo base_url("js/organigrama/jquery.jOrgChart.js") ?>"></script>
    <style>
        .well{
            background-image: url('<?php echo base_url("images/bkgd.png")?>') !important;
        }
        .jOrgChart .node{
            background-color: #CAFFEF !important;
            width: 129px !important;
            color: black !important;
             border: 1px solid black !important;
        }
    </style>
    <script>
    jQuery(document).ready(function() {
        $("#org").jOrgChart({
            chartElement : '#chart',
            dragAndDrop  : true
        });
    });
    </script>
<!--<div class='well'>-->
    <?php echo $organigrama ?>
    <div id="chart" class="orgChart"></div>
    <!--</div>-->
    <script>
        jQuery(document).ready(function() {
            $("#show-list").click(function(e){
                e.preventDefault();
                $('#list-html').toggle('fast', function(){
                    if($(this).is(':visible')){
                        $('#show-list').text('Hide underlying list.');
                        $(".topbar").fadeTo('fast',0.9);
                    }else{
                        $('#show-list').text('Show underlying list.');
                        $(".topbar").fadeTo('fast',1);                  
                    }
                });
            });
            
            $('#list-html').text($('#org').html());
            $("#org").bind("DOMSubtreeModified", function() {
                $('#list-html').text('');
                $('#list-html').text($('#org').html());
                prettyPrint();                
            });
        });
    </script>
   