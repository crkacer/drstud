<?php
class Payment extends AppModel
{
    public $validationDomain = 'validation';
    public $name = 'Payment';
    public $useTable = 'paypal_configs';
    public $primaryKey = 'id';
    public $validate = array('username' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Invalid Username')),
                           'password' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Invalid Password')),
                           'signature' => array('alphaNumeric' => array('rule' => 'alphaNumericCustom','required' => true,'allowEmpty'=>false,'message' => 'Invalid Signature')),
                           );
}
?>