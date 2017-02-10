<?php
class Advertisement extends AppModel
{
  public $validationDomain = 'validation';
  public $actsAs = array('search-master.Searchable','Upload.Upload' => array(
            'photo' => array(
                'pathMethod'=>'flat',
                'thumbnailSizes' => array(
                    '' => '350x260',
                ),
                'path' => '{ROOT}webroot{DS}img{DS}advertisement{DS}',
                'thumbnailPath' => '{ROOT}webroot{DS}img{DS}advertisement_thumb{DS}',
                'thumbnailMethod' => 'php',
                'thumbnailPrefixStyle' => false,
                'deleteOnUpdate' => true,
                'thumbnailType'=>true
            ),
        )
    );
 public $validate = array('name' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Only letters and numbers allowed')),
                          'ordering' => array('Numeric' => array('rule' => 'Numeric','required' => true,'allowEmpty'=>false)),
                          'url' => array('alphaNumeric'=>array('rule' =>'URL','allowEmpty'=>true,'message'=>'Only Url')),
                          'photo' => array('isValidExtension' => array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png', 'gif'),false),'allowEmpty'=>false,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'message' => 'You must supply a JPG, GIF  or PNG File.'))
                          );
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Advertisement.name'));
}
?>