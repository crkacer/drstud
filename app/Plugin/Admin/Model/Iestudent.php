<?php
class Iestudent extends AppModel
{
  public $validationDomain = 'validation';
  public $name = 'Iestudent';
  public $useTable = 'students';
  public $primaryKey = 'id';  
  public $actsAs=array('Utils.CsvImport');
  public $validate =array('file' => array('isValidExtension' => array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png', 'gif'),false),'allowEmpty'=>false,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'message' => 'You must supply a JPG, GIF  or PNG File.'))
                          );
  
  public function UserWiseGroup($userGroupWiseId)
  {
    $Iestudent=ClassRegistry::init('Iestudent');
    $Iestudent->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'student_groups',
                                                     'foreignKey' => 'student_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"StudentGroup.group_id IN($userGroupWiseId)"))));
  }
}
?>