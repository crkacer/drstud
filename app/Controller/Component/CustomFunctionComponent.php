<?php
App::uses('Component','Controller');
class CustomfunctionComponent extends Component
{
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
    public function generate_rand($digit=6)
    {
      $no=substr(strtoupper(md5(uniqid(rand()))),0,$digit);
      return $no;
    }
    public function WalletInsert($student_id,$amount,$amount_type,$date,$type,$remarks,$user_id=null)
    {
        $Wallet=ClassRegistry::init('Wallet');
        $in_amount=null;
        $out_amount=null;
        if($amount_type=="Added")
        $in_amount=$amount;
        else
        $out_amount=$amount;
        if($in_amount==null && $out_amount==null)
        {
            return false;
        }
        elseif($amount<=0)
        {
            return false;
        }
        else
        {
            $Wallet->virtualFields= array('in_amount'=>'SUM(in_amount)','out_amount'=>'SUM(out_amount)');
            $AmountArr=$Wallet->find('first',array('fields'=>array('in_amount','out_amount'),'conditions'=>array('student_id'=>$student_id)));
            $total_in_amount=$AmountArr['Wallet']['in_amount'];
            $total_out_amount=$AmountArr['Wallet']['out_amount'];
            if($total_in_amount=="")
            $total_in_amount=0;
            if($total_out_amount=="")
            $total_out_amount=0;
            $balance=$total_in_amount-$total_out_amount+$in_amount-$out_amount;
            $record_arr=array('student_id'=>$student_id,'in_amount'=>$in_amount,'out_amount'=>$out_amount,'balance'=>$balance,'date'=>$date,'type'=>$type,
                              'remarks'=>$remarks,'user_id'=>$user_id);
            $Wallet->create();
            if($Wallet->save($record_arr))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    public function WalletBalance($student_id)
    {
        $Wallet=ClassRegistry::init('Wallet');
        $balanceWallet=$Wallet->find('first',array('conditions'=>array('student_id'=>$student_id),
                                                   'fields'=>array('balance'),
                                                   'order'=>array('id DESC'),
                                                   'limit'=>1));
        $balance="0.00";
        if(count($balanceWallet)>0)
        {
            $balance=$balanceWallet['Wallet']['balance'];
        }
        return $balance;
    }
    public function secondsToHourMinute($seconds)
    {
        $ret = "";
        if($seconds>0)
        {
            /*** get the hours ***/
            $hours = intval(intval($seconds) / 3600);
            if($hours > 0)
            {
                $ret .= "$hours.";
            }
            /*** get the minutes ***/
            $minutes = bcmod((intval($seconds) / 60),60);
            if($hours > 0 || $minutes > 0)
            {
                $ret .= "$minutes";
            }
        }
        else
        {
            $ret="";
        }
        return (float) $ret;
    }
    function showStudentData($post)
    {
        $showData=array();
        foreach($post as $rank=>$value)
        {
            $showData[]=array('Group'=>array('groups'=>$this->showGroupName($value['Group'])),
                          'Iestudent'=>array('name'=>$value['Iestudent']['name'],'email'=>$value['Iestudent']['email'],'phone'=>$value['Iestudent']['phone'],
                                             'enroll'=>$value['Iestudent']['enroll'],'guardian_phone'=>$value['Iestudent']['guardian_phone'],'address'=>$value['Iestudent']['address']));
        }
        return$showData;
    }
    function showQuestionData($post)
    {
        $showData=array();
        foreach($post as $rank=>$value)
        {
            $showData[]=array('Group'=>array('groups'=>$this->showGroupName($value['Group'])),
                          'Subject'=>array('subject'=>$value['Subject']['subject_name']),
                          'Diff'=>array('diff_id'=>$value['Diff']['type']),
                          'Qtype'=>array('qtype_id'=>$value['Qtype']['type']),                          
                          'Iequestion'=>array('question'=>$value['Iequestion']['question'],'option1'=>$value['Iequestion']['option1'],'option2'=>$value['Iequestion']['option2'],'option3'=>$value['Iequestion']['option3'],
                                             'option4'=>$value['Iequestion']['option4'],'option5'=>$value['Iequestion']['option5'],'option6'=>$value['Iequestion']['option6'],
                                             'marks'=>$value['Iequestion']['marks'],'negative_marks'=>$value['Iequestion']['negative_marks'],'hint'=>$value['Iequestion']['hint'],
                                             'explanation'=>$value['Iequestion']['explanation'],'answer'=>$value['Iequestion']['answer'],'true_false'=>$value['Iequestion']['true_false'],
                                             'fill_blank'=>$value['Iequestion']['fill_blank']));
        }
        return$showData;
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
    public function sendSms($mobileNo,$message,$smsArr=array())
    {
        $url=$smsArr['Smssetting']['api'];
        $postData=array($smsArr['Smssetting']['husername']=>$smsArr['Smssetting']['username'],$smsArr['Smssetting']['hpassword']=>$smsArr['Smssetting']['password'],$smsArr['Smssetting']['hsenderid']=>$smsArr['Smssetting']['senderid'],$smsArr['Smssetting']['hmobile']=>$mobileNo,$smsArr['Smssetting']['hmessage']=>$message);
        
        //$file = new File(TMP.'sms.txt',true,0777);
        //$file->write($url.'\n'.$mobileNo.'\n'.$message.'\n','a',true);
        //$file->close();
        
        $ch = curl_init();
        curl_setopt_array($ch, array(CURLOPT_URL => $url,CURLOPT_RETURNTRANSFER => true,CURLOPT_POST => true,CURLOPT_POSTFIELDS => $postData));
        $output = curl_exec($ch);
        curl_close($ch);
    }
}