<?php
class Addquestion extends AppModel
{
  public $validationDomain = 'validation';
  public $name = 'AddQuestion';
  public $useTable = 'questions';
  public $primaryKey = 'id';
  public $belongsTo=array('Subject','Qtype','Diff');
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('subject_id' => array('field'=>'Addquestion.subject_id'),
                             'qtype_id' => array('field'=>'Addquestion.qtype_id'),
                             'diff_id' => array('field'=>'Addquestion.diff_id'));
  
  
}
?>