<?php
class User extends AppModel {
    public $validationDomain = 'validation';
    public $actsAs = array('search-master.Searchable');
    public $filterArgs = array('keyword' => array('type' => 'like','field'=>'User.name'));
    public $belongsTo=array('Ugroup');
    public $hasAndBelongsToMany = array('Group'=>array('className'=>'Group',
                                                     'joinTable' => 'user_groups',
                                                     'foreignKey' => 'user_id',
                                                     'associationForeignKey' => 'group_id'));
    
    public $validate =array('username' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Only Alphabets')),
                            'password' => array('alphaNumeric'=>array('rule'=>'alphaNumeric','required' => true,'message'=>'Password required'),
                                                'between'=>array('rule'=>array('minLength','4'),'message'=>'Password minimum 4 character long')),
                            'name' => array('alphaNumeric'=>array('rule' =>'alphaNumericCustom','required'=>true,'allowEmpty'=>false,'message'=>'Only Alphabets')),
                            'email' => array('email'=>array('rule'=>'email','message'=>'Enter a valid email'),
                                             'isUnique'=>array('rule' => 'isUnique','message' => 'This Email has already been exist! try new one'),),
                            'mobile' => array('numeric' => array('rule' => 'numeric','required' => true,'message' => 'Only numbers allowed'))
                            );
  
    public function assingPages($id)
    {
        $Page=ClassRegistry::init('Page');
        return$Page->find('all',array('joins'=>array(array('table'=>'page_rights','alias'=>'PageRight','type'=>'Left',
                                                        'conditions'=>array('Page.id=PageRight.page_id',"PageRight.ugroup_id=$id"))),
                                      'fields'=>array('Page.*,PageRight.*'),                                      
                                   'order'=>'Page.model_name,Page.ordering asc'));
    }
    public function beforeSave($options = array())
  {
      if (!empty($this->data['User']['password'])) {
      $this->data['User']['password'] = $this->passwordHasher($this->data['User']['password']);
      }
      else
      {
        unset($this->data['User']['password']);  
      }
      return true;
  }
}
?>