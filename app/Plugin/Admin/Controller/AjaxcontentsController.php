<?php
class AjaxcontentsController extends AdminAppController
{
    public $helpers = array('Html', 'Form');
    public function lesson()
    {
        $this->layout=null;
        $this->request->onlyAllow('ajax');
        $id = $this->request->query('id');
        $this->loadModel('Lesson');
        $lessonName=$this->Lesson->find('list',array('conditions'=>array('subject_id'=>$id,'Lesson.status'=>'Active'),'order'=>array('Lesson.name'=>'asc')));
        $this->set(compact('lessonName'));
    }
}
