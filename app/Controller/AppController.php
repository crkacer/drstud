<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    //public $components = array('Session','DebugKit.Toolbar','CustomFunction');
    public $components = array('Session','CustomFunction');
    public function authenticate()
    {
        // Check if the session variable User exists, redirect to loginform if not
        if( $this->action != 'login' )
        {
            if(!$this->Session->check('Student'))
            {
                $this->redirect(array('controller' => 'Users', 'action' => 'login'));
                exit();
            }
        }
    }
    public function beforeFilter()
    {
        $this->loadModel('Configuration');
        $this->loadModel('Currency');
        $sysSetting=$this->Configuration->find('first');
        $currencyArr=$this->Currency->findById($sysSetting['Configuration']['currency']);
        $this->configLanguage=$sysSetting['Configuration']['language'];
        $this->siteTimezone=$sysSetting['Configuration']['timezone'];
        Configure::write('Config.language', $this->configLanguage);
        Configure::write('Config.timezone', $this->siteTimezone);
        date_default_timezone_set($this->siteTimezone);
        $this->set('siteTitle',$sysSetting['Configuration']['meta_title']);
        $this->set('siteDescription',$sysSetting['Configuration']['meta_desc']);
        $this->set('siteName',$sysSetting['Configuration']['name']);
        $this->set('siteOrganization',$sysSetting['Configuration']['organization_name']);
        $this->set('siteAuthorName',$sysSetting['Configuration']['author']);
        $this->set('siteYear',$sysSetting['Configuration']['created']);
        $this->set('frontRegistration',$sysSetting['Configuration']['front_end']);
        $this->set('frontSlides',$sysSetting['Configuration']['slides']);
        $this->set('frontLogo',$sysSetting['Configuration']['photo']);
        $this->set('translate',$sysSetting['Configuration']['translate']);
        $this->set('frontPaidExam',$sysSetting['Configuration']['paid_exam']);
        $this->set('siteTimezone',$sysSetting['Configuration']['timezone']);
        $this->set('frontLeaderBoard',$sysSetting['Configuration']['leader_board']);
        $this->set('contact',explode("~",$sysSetting['Configuration']['contact']));
        $this->siteName=$sysSetting['Configuration']['name'];
        $this->siteDomain=$sysSetting['Configuration']['domain_name'];
        $this->siteEmail=$sysSetting['Configuration']['email'];
        $this->frontRegistration=$sysSetting['Configuration']['front_end'];
        $this->frontSlides=$sysSetting['Configuration']['slides'];
        $this->frontExamPaid=$sysSetting['Configuration']['paid_exam'];
        $this->frontLeaderBoard=$sysSetting['Configuration']['leader_board'];
        $currency='<img src="'.$this->webroot.'img/currencies/'.$currencyArr['Currency']['photo'].'"> ';
        $this->currency=$currency;
        $this->currencyType=$currencyArr['Currency']['short'];
        $this->set('currency',$currency);
        $this->set('currencyType',$this->currencyType);
        $this->emailNotification=$sysSetting['Configuration']['email_notification'];
        $this->smsNotification=$sysSetting['Configuration']['sms_notification'];
        $this->siteEmailContact=$sysSetting['Configuration']['email_contact'];
        $this->mathEditor=$sysSetting['Configuration']['math_editor'];
        $this->siteSignature=$sysSetting['Configuration']['signature'];
        $this->siteCertificate=$sysSetting['Configuration']['certificate'];
        $this->examExpiry=$sysSetting['Configuration']['exam_expiry'];
        $this->examFeedback=$sysSetting['Configuration']['exam_feedback'];
        $this->tolranceCount=$sysSetting['Configuration']['tolrance_count'];
        $this->set('emailNotification',$this->emailNotification);
        $this->set('smsNotification',$this->smsNotification);
        $this->set('siteEmailContact',$this->siteEmailContact);
        $this->set('mathEditor',$this->mathEditor);
        $this->set('frontExamPaid',$this->frontExamPaid);
        $this->set('siteSignature',$this->siteSignature);
        $this->set('siteCertificate',$this->siteCertificate);
        $this->set('siteTestimonial',$sysSetting['Configuration']['testimonial']);
        $this->set('siteAds',$sysSetting['Configuration']['ads']);
        $this->set('examExpiry',$this->examExpiry);
        $this->set('examFeedback',$this->examFeedback);
        $this->set('tolranceCount',$this->tolranceCount);
        $this->set('sitePanel1',$sysSetting['Configuration']['panel1']);
        $this->set('sitePanel2',$sysSetting['Configuration']['panel2']);
        $this->set('sitePanel3',$sysSetting['Configuration']['panel3']);        
        $sysDateArr=explode(",",$sysSetting['Configuration']['date_format']);
        $this->sysDay=$sysDateArr[0];$this->sysMonth=$sysDateArr[1];$this->sysYear=$sysDateArr[2];
        $this->sysHour=$sysDateArr[3];$this->sysMin=$sysDateArr[4];$this->sysSec=$sysDateArr[5];$this->sysMer=$sysDateArr[6];
        $this->set('sysDay',$this->sysDay);$this->set('sysMonth',$this->sysMonth);$this->set('sysYear',$this->sysYear);
        $this->set('sysHour',$this->sysHour);$this->set('sysMin',$this->sysMin);$this->set('sysSec',$this->sysSec);$this->set('sysMer',$this->sysMer);
        $this->dateSep=$sysDateArr[7];$this->timeSep=$sysDateArr[8];$this->dateGap=" ";
        $this->set('dateSep',$this->dateSep);$this->set('timeSep',$this->timeSep);$this->set('dateGap',$this->dateGap);
        $dpDay=null;$dpMonth=null;$dpYear=null;$this->dtFormat=null;
        if(strtolower($this->sysDay)==strtolower("Y"))
        $dpDay=4;
        elseif(strtolower($this->sysDay)==strtolower("m"))
        $dpDay=2;
        elseif(strtolower($this->sysDay)==strtolower("d"))
        $dpDay=2;
        if(strtolower($this->sysMonth)==strtolower("Y"))
        $dpMonth=4;
        elseif(strtolower($this->sysMonth)==strtolower("m"))
        $dpMonth=2;
        elseif(strtolower($this->sysMonth)==strtolower("d"))
        $dpMonth=2;
        if(strtolower($this->sysYear)==strtolower("Y"))
        $dpYear=4;
        elseif(strtolower($this->sysYear)==strtolower("m"))
        $dpYear=2;
        elseif(strtolower($this->sysYear)==strtolower("d"))
        $dpYear=2;
        if($dpDay==null || $dpMonth==null || $dpYear==null)
        {
            $this->dpFormat="YYYY-MM-DD";
            $this->dtFormat="Y-m-d";
        }
        else
        {
            $this->dpFormat=strtoupper(str_repeat($this->sysDay,$dpDay).$this->dateSep.str_repeat($this->sysMonth,$dpMonth).$this->dateSep.str_repeat($this->sysYear,$dpYear));
            $this->dtFormat=$this->sysDay.$this->dateSep.$this->sysMonth.$this->dateSep.$this->sysYear;
        }
        $this->set('dpFormat', $this->dpFormat);
        $this->set('dtFormat', $this->dtFormat);
        $this->currentDate=CakeTime::format('Y-m-d',time());
        $this->currentDateTime=CakeTime::format('Y-m-d H:i:s',time());
        $this->set('currentDate',$this->currentDate);
        $this->set('currentDateTime',$this->currentDateTime);
        $this->userValue=$this->Session->read('Student');
        $this->adminValue=$this->Session->read('User');
        if($sysSetting['Configuration']['min_limit'])
        $minLimit=$sysSetting['Configuration']['min_limit'];
        else
        $minLimit=20;
        if($sysSetting['Configuration']['max_limit'])
        $maxLimit=$sysSetting['Configuration']['max_limit'];
        else
        $maxLimit=500;
        $this->pageLimit=$minLimit;
        $this->maxLimit=$maxLimit;
        if($sysSetting['Configuration']['captcha_type']==1)
        $this->captchaType="image";
        else
        $this->captchaType="math";
        if($sysSetting['Configuration']['dir_type']==1)
        $this->dirType="ltr";
        else
        $this->dirType="rtl";
        $this->set('dirType',$this->dirType);
        $this->set('captchaType',$this->captchaType);
        $this->set('configLanguage',$this->configLanguage);
        $this->set('userValue',$this->userValue);
        $this->set('adminValue',$this->adminValue);
        $this->loadModel('Slide');
        $this->loadModel('News');
        $this->loadModel('Content');
        $news=array();$slides=array();$contents=array();$menuArr=array();
        $slides=$this->Slide->find('all',array('conditions'=>array('status'=>'Active'),'order'=>array('ordering'=>'asc')));
        $news=$this->News->find('all',array('conditions'=>array('status'=>'Active'),
                                            'order'=>'id desc'));
        $contents=$this->Content->find('all',array('fileds'=>array('link_name,is_url,url,page_url'),'conditions'=>array('published'=>'Published'),
                                            'order'=>'ordering asc'));
        $this->set('slides',$slides);
        $this->set('news',$news);
        $this->set('contents',$contents);
        $walletBalance="0.00";
        if($sysSetting['Configuration']['paid_exam']>0)
        $walletBalance=$this->CustomFunction->WalletBalance($this->userValue['Student']['id']);
        $this->set('walletBalance',$walletBalance);
        $menuArr=array(__("Dashboard")=>array("controller"=>"Dashboards","action"=>"","icon"=>"fa fa-home"),
                       __("Leader2Board")=>array("controller"=>"Leaderboards","action"=>"index","icon"=>"fa fa-dashboard"),
					   __("Progression")=>array("controller"=>"Progressions","action"=>"index","icon"=>"fa fa-dashboard"),
                       __("Vocabulary")=>array("controller"=>"Vocabulary","action"=>"index","icon"=>"fa fa-shopping-cart"),
                       __("My Groups")=>array("controller"=>"Mygroups","action"=>"index","icon"=>"fa fa-list-alt"),
                       __("My Result")=>array("controller"=>"Results","action"=>"index","icon"=>"fa fa-trophy"),
                       __("Group Performance")=>array("controller"=>"Groupperformances","action"=>"index","icon"=>"fa fa-cog"),
                       __("Payment")=>array("controller"=>"Payments","action"=>"index","icon"=>"fa fa-money"),
                       __("Payments Details")=>array("controller"=>"Orderhistories","action"=>"index","icon"=>"fa fa-briefcase"),
                       __("Mailbox")=>array("controller"=>"Mails","action"=>"index","icon"=>"fa fa-envelope"),
                       __("Help")=>array("controller"=>"Helps","action"=>"index","icon"=>"fa fa-support"));
        $frontmenuArr=array(__("Home")=>array("controller"=>"","action"=>"index","icon"=>"fa fa-home"),
                       __("Register")=>array("controller"=>"Registers","action"=>"index","icon"=>"fa fa-user"),
                       __("Buy")=>array("controller"=>"Packages","action"=>"index","icon"=>"fa fa-shopping-cart"),
                       __("Log In")=>array("controller"=>"Users","action"=>"index","icon"=>"fa fa-lock"));
        $this->loadModel('Mail');
        if($this->userValue)
        $emailCondition=$this->userValue['Student']['email'];
        else
        $emailCondition='Administrator';
        $this->set('totalInbox',$this->Mail->find('count',array('conditions'=>array('email'=>$emailCondition,'status <>'=>'Trash','type'=>'Unread','mail_type'=>'To'))));
        $this->set('mailArr',$this->Mail->find('all',array('conditions'=>array('email'=>$emailCondition,'mail_type'=>'To','status <>'=>'Trash'),'order'=>array('Mail.id'=>'desc'),'limit'=>5)));
        $this->set('menuArr',$menuArr);
        $this->set('frontmenuArr',$frontmenuArr);
        $this->set('contentId','');
        $this->set('emailCondition',$emailCondition);
        $this->emailSettings();
        $this->smsSettings();
        $this->loadModel('Cart');
        $this->set('count',$this->Cart->getCount());
    }
    /* Email Setting */
    public function emailSettings()
    {
        if($this->emailNotification)
        {
            $this->loadModel('Emailsetting');
            $emailSettingArr=$this->Emailsetting->findById(1);
            $this->emailSettype=$emailSettingArr['Emailsetting']['type'];
            if($this->emailSettype=="Smtp")
            {
                $this->emailHost=$emailSettingArr['Emailsetting']['host'];
                $this->emailPort=$emailSettingArr['Emailsetting']['port'];
                $this->emailUsername=$emailSettingArr['Emailsetting']['username'];
                $this->emailPassword=$emailSettingArr['Emailsetting']['password'];
            }
        }
    }
    /* End Email Settings */
    /* Email Setting */
    public function smsSettings()
    {
        if($this->smsNotification)
        {
            $this->loadModel('Smssetting');
            $smsSettingArr=$this->Smssetting->findById(1);
            $this->smsSettingArr=$smsSettingArr;
        }
    }
    /* End Email Settings */
}
?>