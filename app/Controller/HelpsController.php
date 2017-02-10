<?php
class HelpsController extends AppController {
    public function index()
    {
        $helpPost=$this->Help->find('all',array('conditions'=>array('status'=>'Active'),
                                                'order'=>'id asc'));
        $this->set('helpPost',$helpPost);
    }    
}
