<?php
class PackagesController extends AppController
{   
    public function index()
    {
        $this->set('package',$this->Package->find('all',array('Package.name'=>'asc')));
    }
    public function view($id)
    {
        $this->layout = null;
        $this->set('post',$this->Package->findById($id));
    }
}