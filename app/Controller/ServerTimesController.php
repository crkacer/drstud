<?php
App::uses('CakeTime', 'Utility');
class ServerTimesController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function index()
    {
        $this->layout=null;
        $currentDateTime=CakeTime::format('M j, Y H:i:s',time());
        $this->set('currentDateTime',$currentDateTime);
    }
}
