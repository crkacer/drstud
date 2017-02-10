<?php
class Group extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable','Upload.Upload' => array('photo' => array('pathMethod'=>'flat','thumbnailSizes' => array('' => '150x150',),'thumbnailMethod' => 'php','thumbnailPrefixStyle' => false,'thumbnailType'=>true),));   
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Group.group_name'));
  public $validate = array('group_name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed'),
                                                 'isUnique'=>array('rule' => 'isUnique','message' => 'Group  already exist')),
                            'description' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>true,'message'=>'Only Alphabets')),
                            'price' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty'=>false,'message' => 'Please fill any amount.')),
                            'day' => array('numeric' => array('rule' => 'numeric','required' => true,'allowEmpty'=>false,'message' => 'Please fill number of days to expire.')),
                            'photo' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png'),false),'allowEmpty'=>true,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>true,'message' => 'You must supply a JPG, GIF  or PNG File.')),
                            );
}
?>