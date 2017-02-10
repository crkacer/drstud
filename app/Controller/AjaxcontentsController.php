<?php
App::uses('CakeTime', 'Utility');
class AjaxcontentsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->authenticate();
    }
    public function examwarning($id)
    {
        $this->layout=null;
        $this->loadModel('ExamWarn');
        $navigateCount=$this->ExamWarn->find('count',array('conditions'=>array('exam_result_id'=>$id)));
        $navigateCount++;
        if($navigateCount>$this->tolranceCount)
        {
            print "Yes";
            exit(0);
        }
        else
        {
            $recordArr=array('ExamWarn'=>array('exam_result_id'=>$id));
            $this->ExamWarn->create();
            $this->ExamWarn->save($recordArr);
        }
    }
    public function examclose($id)
    {
        $this->layout='exam';
        $this->loadModel('Exam');
        $examArr=$this->Exam->find('first',array('joins'=>array(array('table'=>'exam_results','alias'=>'ExamResult','type'=>'Left','conditions'=>array('Exam.id=ExamResult.exam_id'))),
                                                 'conditions'=>array('ExamResult.id'=>$id)));
        $this->set('UserArr',$this->userValue);
        $this->set('id',$id);
        if($examArr['Exam']['finish_result'])
        {
            $this->Session->setFlash(__('You can find your result here.'),'flash',array('alert'=>'success'));
            $controller='Results';
            $action='view';
        }
        else
        {
            $this->Session->setFlash(__('Thanks for given the exam.'),'flash',array('alert'=>'success'));
            $controller='Exams';
            $action='index';
        }
        $this->set('controller',$controller);
        $this->set('action',$action);
    }
}
