<?php 
$clase=ucfirst($post['tabla']);
$model=ucfirst($post['tabla'])."__model";
?>
<=?php 
class <?php echo $model ?> extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function save_<?php echo $post['tabla']?>($post){
        if(isset($post['campo'])){ 
        $this->db->where($post["campo"],$post[$post["campo"]]);
        $id=$post[$post["campo"]];
            unset($post['campo']);
            $this->db->update('<?php echo $post['tabla']?>',$post);
        }else{
            $this->db->insert('<?php echo $post['tabla']?>',$post);
            $id=$this->db->insert_id();
        }
        return $id;
        
    }
    function delete_<?php echo $post['tabla']?>($post){
        $this->db->set('ACTIVO','N');
        $this->db->where($post["campo"],$post[$post["campo"]]);
        $this->db->update('<?php echo $post['tabla']?>');
    }
    function edit_<?php echo $post['tabla']?>($post){
        $this->db->where($post["campo"],$post[$post["campo"]]);
        $datos=$this->db->get('<?php echo $post['tabla']?>',$post);
        return $datos=$datos->result();
    }
    function consult_<?php echo $post['tabla']?>($post){
    <?php foreach ($post['nombre_campo'] as $key => $value) { ?>
        if(isset($post['<?php echo $value ?>']))
        if($post['<?php echo $value ?>']!="")
        $this->db->like('<?php echo $value ?>',$post['<?php echo $value ?>']);
            <?php }?>
        <?php 
            for ($i = 0; $i < count($post['nombre_label']); $i++) {
            if ($post['aparezca'][$i] == 1) { ?>
                $this->db->select('<?php echo $post['nombre_campo'][$i] ?>');
                <?php }
            }
        ?>
        $this->db->where('ACTIVO','S');
        $datos=$this->db->get('<?php echo $post['tabla']?>');
        $datos=$datos->result();
        return $datos;
    }
}
?=>