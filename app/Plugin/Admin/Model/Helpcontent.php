<?php
class Helpcontent extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'HelpContent.link_title'));
  public $validate = array('link_title' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed')));
}
?>