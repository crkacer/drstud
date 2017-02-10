<?php
class Menuname extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable='pages';
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Menuname.page_name'));
  public $validate = array('page_name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed'),
                                                 'isUnique'=>array('rule' => 'isUnique','message' => 'Name already exist')),
                           'model_name' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Only letters and numbers allowed')),
                            );
}
?>