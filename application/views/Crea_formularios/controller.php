<?php 
$clase=ucfirst($post['tabla']);
$model=ucfirst($post['tabla'])."__model";
?>
<=?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class <?php echo $clase ?> extends My_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('<?php echo $model; ?>');
        $this->load->helper('security');
        $this->load->helper('miscellaneous');
        $this->load->library('tcpdf/tcpdf.php');
        validate_login($this->session->userdata('usu_id'));
    }
    function index(){
        $this->data['post']=$this->input->post();
        $this->layout->view('<?php echo $post['tabla']?>/index', $this->data);
    }
    function consult_<?php echo $post['tabla']?>(){
        $post=$this->input->post();
        $this->data['post']=$this->input->post();
        $this->data['datos']=$this-><?php echo $model; ?>->consult_<?php echo $post['tabla']?>($post);
        $this->layout->view('<?php echo $post['tabla']?>/consult_<?php echo $post['tabla']?>', $this->data);
    }
    function save_<?php echo $post['tabla']?>(){
        $post=$this->input->post();
        <?php for ($i = 0; $i < count($post['nombre_label']); $i++) {
            if($post['tipo'][$i]=='file'){
                ?>
                    $post['<?php echo $post['nombre_campo'][$i];?>']=basename($_FILES['<?php echo $post['nombre_campo'][$i];?>']['name']);
                <?php
            }
        }
        ?>
        $id=$this-><?php echo $model; ?>->save_<?php echo $post['tabla']?>($post);
        
        <?php for ($i = 0; $i < count($post['nombre_label']); $i++) {
            if($post['tipo'][$i]=='file'){
                ?>
                $targetPath = "./uploads/<?php echo $post['tabla']?>";
                if (!file_exists($targetPath)) {
                    mkdir($targetPath, 0777, true);
                }
                $targetPath = "./uploads/<?php echo $post['tabla']?>/".$id;
                if (!file_exists($targetPath)) {
                    mkdir($targetPath, 0777, true);
                }
                $target_path = $targetPath.'/'. basename($_FILES['<?php echo $post['nombre_campo'][$i];?>']['name']);
                if (move_uploaded_file($_FILES['<?php echo $post['nombre_campo'][$i];?>']['tmp_name'], $target_path)) {

                }    
                <?php
            }
        }?>
                
        redirect('index.php/<?php echo ucfirst($post['tabla'])?>/consult_<?php echo $post['tabla']?>', 'location');
    }
    function delete_<?php echo $post['tabla']?>(){
        $post=$this->input->post();
        $this-><?php echo $model;?>->delete_<?php echo $post['tabla']?>($post);
        redirect('index.php/<?php echo ucfirst($post['tabla'])?>/consult_<?php echo $post['tabla']?>', 'location');
    }
    function edit_<?php echo $post['tabla']?>(){
        $this->data['post']=$this->input->post();
        if(!isset($this->data['post']['campo']))
        redirect('index.php/<?php echo ucfirst($post['tabla'])?>/consult_<?php echo $post['tabla']?>', 'location');
        $this->data['datos']=$this-><?php echo $model;?>->edit_<?php echo $post['tabla']?>($this->data['post']);
        $this->layout->view('<?php echo $post['tabla']?>/index', $this->data);
    }
    <?php 
    for ($i = 0; $i < count($post['nombre_label']); $i++) {
        if($post['autocomplete'][$i]==1){
            ?>
                function <?php echo 'autocomplete_' . $post['nombre_campo'][$i];?>(){
                  $info = auto("<?php echo $post['autocomplete1'][$i]; ?>","<?php echo $post['autocomplete2'][$i]; ?>","<?php echo $post['autocomplete3'][$i]; ?>",$this->input->get('term'));
                  $this->output->set_content_type('application/json')->set_output(json_encode($info));
                }
            <?php
        }
    }
    ?>
}
?=>