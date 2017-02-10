<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//App::uses('File', 'Utility');
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    public function studentAverageResult($examId)
    {
        $ExamResult=ClassRegistry::init('ExamResult');
        $totalAttempt=$ExamResult->find('count',array('conditions'=>array('exam_id'=>$examId)));
        $ExamResult->virtualFields= array('total'=>'SUM(ExamResult.percent)');
        $studentPercent=$ExamResult->find('first',array('conditions'=>array('exam_id'=>$examId)));
        $totalPercent=$studentPercent['ExamResult']['total'];
        if($totalAttempt>0)
        $averagePercent=CakeNumber::precision($totalPercent/$totalAttempt,2);
        else
        $averagePercent=0;
        return$averagePercent;
        
    }
    public function examTotalAbsent($examId,$findMethod='count')
    {
        $Exam=ClassRegistry::init('Exam');
        $ExamResult=$Exam->find($findMethod,array(
                              'fields'=>array('Student.name','Student.email','Student.enroll','Student.phone'),
                              'joins'=>array(array('table'=>'exam_groups','alias'=>'ExamGroup','type'=>'Inner','conditions'=>array('Exam.id=ExamGroup.exam_id')),
                                             array('table'=>'student_groups','alias'=>'StudentGroup','type'=>'Inner','conditions'=>array('StudentGroup.group_id=ExamGroup.group_id')),
                                             array('table'=>'students','alias'=>'Student','type'=>'INNER','conditions'=>array('Student.id=StudentGroup.student_id')),
                                             array('table'=>'exam_results','alias'=>'ExamResult','type'=>'LEFT','conditions'=>array('ExamResult.student_id=Student.id','ExamResult.exam_id=Exam.id'))),
                              'conditions'=>array('Exam.status'=>'Closed','Exam.id'=>$examId,'ExamResult.id'=>NULL,'Exam.finalized_time>Student.created'),                              
                              'group'=>array('Student.id')));
        return$ExamResult;
    }
    public function studentStat($examId,$type,$findMethod='count')
    {
        $ExamResult=ClassRegistry::init('ExamResult');
        return$ExamResult->find($findMethod,array('fields'=>array('Student.name','Student.email','Student.enroll','Student.phone','ExamResult.percent','ExamResult.result'),
                                                  'joins'=>array(array('table'=>'students','alias'=>'Student','type'=>'INNER','conditions'=>array('Student.id=ExamResult.student_id'))),
                                                  'conditions'=>array('exam_id'=>$examId,'result'=>$type)));
    }
    function unbindValidation($type, $fields, $require=false) 
    { 
        if ($type === 'remove') 
        { 
            $this->validate = array_diff_key($this->validate, array_flip($fields)); 
        } 
        else 
        if ($type === 'keep') 
        { 
            $this->validate = array_intersect_key($this->validate, array_flip($fields)); 
        } 
         
        if ($require === true) 
        { 
            foreach ($this->validate as $field=>$rules) 
            { 
                if (is_array($rules)) 
                { 
                    $rule = key($rules); 
                     
                    $this->validate[$field][$rule]['required'] = true; 
                } 
                else 
                { 
                    $ruleName = (ctype_alpha($rules)) ? $rules : 'required'; 
                     
                    $this->validate[$field] = array($ruleName=>array('rule'=>$rules,'required'=>true)); 
                } 
            } 
        } 
    }
    public function alphaNumericCustom($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];
        //return preg_match('/^[a-z0-9 \/ \s\\\\,-.:;"~!@#$&%&*{}\\[\\]()_=+|?]*$/i', $value);
        return true;
    }
    public function passwordHasher($plainPassword)
    {
        $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
        $password = $passwordHasher->hash($plainPassword);
        return $password;
    }
    public function dateFormatBeforeSave($dateString)
    {
      return date('Y-m-d', strtotime($dateString));
    }
    public function dateTimeFormatBeforeSave($dateString)
    {
      return date('Y-m-d H:i:s', strtotime($dateString));
    }
}
