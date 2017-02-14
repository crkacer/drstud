<?php
class Homework extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $belongsTo=array('Subject','Qtype','Diff');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Question.question'),
                             'subject_ids' => array('field'=>'Question.subject_id'),
                             'qtype_ids' => array('field'=>'Question.qtype_id'));
  public $validate =array('subject_id' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Please select')),
    'marks' => array('Numeric'=>array('rule' =>'Numeric','required'=>true,'allowEmpty'=>false,'message'=>'Only numbers')),
    'negative_marks' => array('Numeric'=>array('rule' =>'Numeric','required'=>true,'allowEmpty'=>false,'message'=>'Only numbers')),
    
    
    );
  public function UserWiseGroup($userGroupWiseId)
  {
    $Homework=ClassRegistry::init('Homework');
    $Homework->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'question_groups',
                                                     'foreignKey' => 'question_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"QuestionGroup.group_id IN($userGroupWiseId)"))));
  }
}
?>