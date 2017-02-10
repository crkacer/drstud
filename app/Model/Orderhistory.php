<?php
class Orderhistory extends AppModel
{
  public $useTable="groups_payments";
  public $belongsTo=array('Payment'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Orderhistory.payment_id=Payment.id')),
                          'Group'=>array('foreignKey'=>false,'type'=>'LEFT','conditions'=> array('Orderhistory.group_id=Group.id')),
                          );
}
?>