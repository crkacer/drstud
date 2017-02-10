<?php
class Forgot extends AppModel
{
  public $validationDomain = 'validation';
  public $useTable="users";
  public $validate =array('email' => array('email'=>array('rule'=>'email','message'=>'Enter a valid email')));
}
?>