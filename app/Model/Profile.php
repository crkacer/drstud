<?php
class Profile extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="students";
  public $actsAs = array('Upload.Upload' => array(
            'photo' => array(
                'pathMethod'=>'flat',
                'thumbnailSizes' => array(
                    '' => '150x150',
                ),
                'path' => '{ROOT}webroot{DS}img{DS}student{DS}',
                'thumbnailPath' => '{ROOT}webroot{DS}img{DS}student_thumb{DS}',
                'thumbnailMethod' => 'php',
                'thumbnailPrefixStyle' => false,
                'thumbnailType'=>true,
                'deleteOnUpdate' => true,
            ),
        )
    );
  public $validate = array('photo' => array('allowEmpty' => true,
                                           'rule' => array('isValidExtension', array('jpg', 'jpeg', 'png'),false),
                                           'message' => 'File does not have a valid extension',
                                           'rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),
                                           'message' => 'You must supply a JPG, GIF  or PNG File.'),
                          );
}
?>