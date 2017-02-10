<?php
class News extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable');
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'News.news_title'));
  public $validate =array('news_title' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Only alphabets')),
                          );
}
?>