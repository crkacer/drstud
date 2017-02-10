<?php
class Student extends AppModel
{
   public $validationDomain = 'validation';
   public $actsAs = array('search-master.Searchable','Upload.Upload' => array(
            'photo' => array(
                'pathMethod'=>'flat',
                'thumbnailSizes' => array(
                    '' => '150x150',
                ),                            
                'thumbnailMethod' => 'php',
                'thumbnailPrefixStyle' => false,
                'thumbnailType'=>true
            ),
        )
    );   
 public $validate = array('email' => array('email'=>array('rule'=>'email','message'=>'Enter a valid email'),
                                           'isUnique'=>array('rule' => 'isUnique','message' => 'This Email has already been exist! try new one'),),
                          'name' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Only Alphabets')),
                          'password' => array('alphaNumeric'=>array('rule'=>'alphaNumeric','required' => true,'message'=>'Password required'),
                                              'between'=>array('rule'=>array('minLength','4'),'message'=>'Password minimum 4 character long')),
                          'address' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Only Alphabets')),
                          'phone' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),                         
                          'expiry_days' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),
                          'status' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message' => 'Please select')),
                          'photo' => array('isValidExtension' =>array('rule' => array('isValidExtension', array('jpg', 'jpeg', 'png'),false),'allowEmpty'=>true,'message' => 'File does not have a valid extension'),
                                           'isValidMimeType' => array('rule' => array('isValidMimeType', array('image/jpeg','image/png','image/bmp','image/gif'),false),'allowEmpty'=>true,'message' => 'You must supply a JPG, GIF  or PNG File.')),
                          'amount' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed')),
                          'action' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message' => 'Please select')),
                          'remarks' => array('alphaNumeric'=>array('rule' =>'alphaNumeric','required'=>true,'allowEmpty'=>false,'message'=>'Only Alphabets')),                          
                          );
  public $filterArgs = array('keyword' => array('type' => 'like','field'=>'Student.email'));
  public function UserWiseGroup($userGroupWiseId)
  {
    $Student=ClassRegistry::init('Student');
    $Student->bindModel(array('hasAndBelongsToMany'=>array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'student_groups',
                                                     'foreignKey' => 'student_id',
                                                     'associationForeignKey' => 'group_id',
                                                     'conditions'=>"StudentGroup.group_id IN($userGroupWiseId)"))));
  }
  public function beforeSave($options = array())
  {
      if (!empty($this->data['Student']['password'])) {
      $this->data['Student']['password'] = $this->passwordHasher($this->data['Student']['password']);
      }
      if (!empty($this->data['Student']['renewal_date'])) {
      $this->data['Student']['renewal_date'] = $this->dateTimeFormatBeforeSave($this->data['Student']['renewal_date']);
      }
      return true;
  }  
}
?>