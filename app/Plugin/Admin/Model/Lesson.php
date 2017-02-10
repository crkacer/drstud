<?php
class Lesson extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Lesson.news_title'));
  public $validate =array('name' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Only alphabets')),
                          'description' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>true,'message'=>'Only alphabets')),
                          'subject_id' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Please select a subject first.')),
                          );
}
?>