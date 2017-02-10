<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class UsersController extends AppController
{
    var $name = 'Users';
    var $helpers = array('Form');
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function login()
    {
        if (empty($this->data['User']['email']) == false)
        {
            $this->loadModel('Student');
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $password=$passwordHasher->hash($this->request->data['User']['password']);            
            $user = $this->Student->find('first', array('conditions' => array('Student.email' => $this->data['User']['email'], 'Student.password' =>$password)));            
            if($user != false)
            {
                if($user['Student']['status']=="Active")
                {
                    $expiryDays=$user['Student']['expiry_days'];
                    if($expiryDays>0)
                    {
                        $expiryDate=date('Y-m-d',strtotime($user['Student']['renewal_date']."+$expiryDays days"));
                        if($this->currentDate>$expiryDate)
                        {
                            $this->Session->setFlash(__('Your account has expired. Please contact administrator'),'flash', array('alert'=> 'danger'));
                            $this->Redirect(array('action' => 'login'));
                            exit(); 
                        }
                    }
                    $recordArr=array('Student'=>array('id'=>$user['Student']['id'],'last_login'=>$this->currentDateTime));
                    $this->Student->save($recordArr);
                    $this->Session->setFlash(__('You have been logged in successfully'),'flash', array('alert'=> 'success'));
                    $this->Session->write('Student', $user);
                    $carts = $this->Cart->readPackage();
                    if($carts)
                    $this->Redirect(array('controller' => 'Checkouts', 'action' => 'index'));
                    else
                    $this->Redirect(array('controller' => 'Dashboards', 'action' => 'index'));
                    exit();
                }
                elseif($user['Student']['status']=="Pending" && $user['Student']['reg_status']=="Live")
                {
                    $this->Session->setFlash(__('Your email not verified! Please click on link sent to your email inbox or spam'),'flash', array('alert'=> 'danger'));
                    $this->Redirect(array('action' => 'login'));
                    exit();
                }
                else
                {
                    $status=$user['Student']['status'];
                    $this->Session->setFlash(__d('default','You are %s Member! Please contact administrator',$status),'flash', array('alert'=> 'danger'));
                    $this->Redirect(array('action' => 'login'));
                    exit();
                }
            }
            else
            {
                $this->Session->setFlash(__('Incorrect username/password'),'flash', array('alert'=> 'danger'));
                $this->Redirect(array('action' => 'login'));
                exit();
            }
        } 
    }
    public function logout()
    {
        $this -> Session -> destroy();
        $this -> Session -> setFlash(__('You have been logged out successfully'),'flash', array('alert'=> 'success'));
        $this -> Redirect(array('action' => 'login'));
        exit();
    }    
}
