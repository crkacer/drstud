<?php
class Iequestion extends AppModel
{
  public $validationDomain = 'validation';
  public $name = 'Iequestion';
  public $useTable = 'questions';
  public $primaryKey = 'id';
  public $belongsTo=array('Subject','Qtype','Diff');
  public $actsAs=array('Utils.CsvImport');
  public $validate =array('subject_id' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Please select')),
                          'file' => array('isValidExtension' => array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png', 'gif'),false),'allowEmpty'=>false,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'message' => 'You must supply a JPG, GIF  or PNG File.'))
                          );
  public function UserWiseGroup($userGroupWiseId)
  {
    $Iequestion=ClassRegistry::init('Iequestion');
    $Iequestion->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'question_groups',
                                                     'foreignKey' => 'question_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"QuestionGroup.group_id IN($userGroupWiseId)"))));
  }
}
?>