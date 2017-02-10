<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');
App::uses('CakeTime', 'Utility');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class FunctionHelper extends Helper
{
    var $helpers = array('Html');
    public function secondsToWords($seconds,$msg="Unlimited")
    {
        $ret = "";
        if($seconds>0)
        {
            /*** get the hours ***/
            $hours = intval(intval($seconds) / 3600);
            if($hours > 0)
            {
                $ret .= $hours.' '.__('Hours').' ';
            }
            /*** get the minutes ***/
            $minutes = bcmod((intval($seconds) / 60),60);
            if($minutes > 0)
            {
                $ret .= $minutes.' '.__('Mins').' ';
            }
            $tarMinutes = bcmod((intval($seconds)),60);
            if(strlen($ret)==0 || $tarMinutes>0)
            {
                if($tarMinutes>0)
                $ret .= $tarMinutes.' '.__('Sec');
                else
                $ret .= $seconds.' '.__('Sec');
            }
        }
        else
        {
            $ret=$msg;
        }
        return $ret;
    }
    public function showGroupName($gropArr,$string=" | ")
    {
        $groupNameArr=array();
        foreach($gropArr as $groupName)
        {
            $groupNameArr[]=$groupName['group_name'];
        }
        unset($groupName);
        $showGroup= implode($string,$groupNameArr);
        unset($groupNameArr);
        return h($showGroup);
    }
    public function showExamType($post)
    {
        if($post['type']=="Exam")
        {
            $showExam="<strong>".$post['total_marks']."</strong> ".__('Marks');
        }
        else
        {
            $showExam="<strong>".$post['total_question']."</strong> ".__('Questions');
        }
        return$showExam;
    }
   public function showExamList($showType,$exam,$currency,$dateFormat,$frontExamPaid,$examExpiry)
    {
        $examList="";$attempt="";$serialNo=0;$ppendingAttempt="";$amountHeading=null;$amount=null;$expireHeading=null;$expireValue=null;$dateHeading=null;
        if($showType=='today' || $showType=='purchased'){$ppendingAttempt="<th>".__('Attempts')."<br>".__('Remaining')."</th>";}
        if($frontExamPaid==true)$amountHeading="<th>".__('Amount')."</th>";
        if($showType=='today' || $showType=='purchased')$dateHeading.="<th>".__('End Date')."</th>";
        if($showType=='purchased')$dateHeading.="<th>".__('Expiry Date')."</th>";
        if($showType=='upcoming')$dateHeading.="<th>".__('Start Date')."</th>";
        if($showType=='expired')$dateHeading.="<th>".__('Expired Date')."</th>";
        if(($showType=='today'|| $showType=='upcoming') && $examExpiry)$expireHeading="<th>".__('Expiry')."</th>";
        $examList="<tr>
        <th>".__('#')."</th>
        <th>".__('Name')."</th>
        <th>".__('Type')."</th>
        $dateHeading
        $expireHeading
        $ppendingAttempt
        $amountHeading
        <th>".__('Action')."</th>
        </tr>";
        foreach($exam as $post)
        {
            $dateValue=null;
            $serialNo++;
            $id=$post['Exam']['id'];
            $viewUrl=$this->Html->url(array('controller'=>'Exams','action'=>"view/$id"));
            $instructionUrl=$this->Html->url(array('controller'=>'Exams','action'=>"instruction/$id"));
            if($frontExamPaid==true){if($post['Exam']['paid_exam']=="1"){$amount="<td>$currency". $post['Exam']['amount']."</td>";}else{$amount="<td>".__('Free')."</td>";}}
            if($post['Exam']['attempt_count']==0){$pendingAttempt=__('Unlimited');}else{ if($post['Exam']['paid_exam']==1 && !$post['ExamOrder']['expiry_date']){$pendingAttempt=__('Not Purchased');}else{if($post['Exam']['paid_exam']==1)$pendingAttempt=($post['Exam']['attempt_order']*$post['Exam']['attempt_count']-$post['Exam']['attempt']);else$pendingAttempt=($post['Exam']['attempt_count']-$post['Exam']['attempt']);}}
            if($showType=='today' || $showType=='purchased'){$attempt=$this->Html->link('<span class="fa fa-sign-in"></span>',array('controller'=>'Exams','action'=>'guidelines',$id),array('data-toggle'=>'tooltip','title'=>__('Attempt Now'),'escape'=>false,'target'=>'_blank','class'=>'btn btn-success'));
            $ppendingAttempt="<td>". $pendingAttempt."</td>";}
            if($showType=='today' || $showType=='purchased')$dateValue.=CakeTime::format($dateFormat,$post['Exam']['end_date']);
            if($showType=='purchased'){if($post['Exam']['expiry']==0)$dateValue="Unlimited";else$dateValue=CakeTime::format($dateFormat,$post['Exam']['fexpiry_date']);}
            if($showType=='upcoming')$dateValue=CakeTime::format($dateFormat,$post['Exam']['start_date']);
            if($showType=='expired')$dateValue=CakeTime::format($dateFormat,$post['Exam']['fexpiry_date']);
            if($showType!='expired' && $showType!='purchased' && $examExpiry){if($post['Exam']['expiry']==0)$expireValue='<td>'.__('Unlimited').'</td>';else$expireValue='<td>'.$post['Exam']['expiry'].__('Days').'</td>';}
            if($showType=='purchased' && $examExpiry){if($post['Exam']['expiry']==0)$expireValue='<td>'.__('Unlimited').'</td>';else$expireValue='<td>'.CakeTime::format($dateFormat,$post['Exam']['fexpiry_date']).'</td>';}
            $examList.="
                        <td>". $serialNo."</td>
                        <td>". h($post['Exam']['name'])."</td>
                        <td>". __($post['Exam']['type'])."</td>
                        <td>".$dateValue."</td>".
                        $expireValue.
                        $ppendingAttempt.
                        $amount."
                        <td>". $this->Html->link('<span class="fa fa-arrows-alt"></span>','javascript:void(0);',array('data-toggle'=>'tooltip','title'=>__('View Details'),'onclick'=>"show_modal('$viewUrl/$showType');",'escape'=>false,'class'=>'btn btn-info')).' '.
                        $attempt."
                    </tr>";
        }
        unset($post);unset($id);
        return$examList;
    }    
}
