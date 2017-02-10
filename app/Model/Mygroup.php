<?php
class Mygroup extends AppModel
{
  public $useTable="groups";  
  public $belongsTo=array('StudentGroup'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('StudentGroup.group_id=Mygroup.id')),);
}
?>