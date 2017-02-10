<style type="text/css">
    .cname{position: absolute;top: 215px;font-size: 30px;font-family:serif;color: #29007d;text-align: center;left: 170px;}
    .cemail{position: absolute;top: 200px;font-size: 24px;font-family:serif;color: #29007d;text-align: center;left: 170px;}
    .cexam{position: absolute;top: 330px;font-size: 24px;font-family:serif;color: #29007d;text-align: center;left: 110px;}
    .cdate0{position: absolute;top: 502px;font-size: 26px;font-weight: bold;left: 150px;font-family:serif;color: #29007d;}
    .cdate{position: absolute;top: 502px;font-size: 26px;left: 222px;font-family:serif;color: #29007d;}
    .csign0{position: absolute;top: 460px;font-size: 28px;font-weight: bold;color: #29007d;left: 610px;}
    .csign{position: absolute;top: 500px;font-size: 26px;left: 590px;}
    .cphoto{position: absolute;top: 200px;font-size: 26px;left: 750px;}
    .ctopheading{position: absolute;top: 120px;font-family:Tahoma, Geneva, sans-serif;left: 140px;font-size: 60px;font-weight: bold;color: #29007d;}
</style>
<img src="<?php echo APP.'webroot'.DS.'img'.DS.'certificate.jpg';?>">
<div class="ctopheading"><?php echo __('Certification of Completion');?></div>
<div class="cname"><?php echo __('This is to certify that');?> <strong><?php echo$userValue['Student']['name'];?></strong><br><?php echo __('Email');?>: <strong><?php echo$userValue['Student']['email'];?><strong></div>
<div class="cexam"> <?php echo __('has succesfully completed the');?> <br/><strong><?php echo$post['Exam']['name'];?></strong> <?php echo ('with');?><br/><strong><?php echo CakeNumber::precision($post['Result']['obtained_marks'],2);?>/<?php echo CakeNumber::precision($post['Result']['total_marks'],2);?> (<?php echo$post['Result']['percent'];?>%)</strong>
 <br/><?php echo __('in course program offered by');?> <strong><?php echo$siteOrganization;?></strong></div>
 <div class="cdate0"><?php echo __('Date');?></div><div class="cdate"><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$post['Result']['start_time']);?></div>
 <div class="csign0"><?php echo __('Signature');?></div><div class="csign"><img src="<?php echo APP.'webroot'.DS.'img'.DS.$siteSignature;?>"></div>
 <?php
 if(strlen($userValue['Student']['photo'])==0)$userValue['Student']['photo']="blank.jpg";
 if(file_exists(APP.'webroot'.DS.'img'.DS.'student_thumb'.DS.$userValue['Student']['photo'])){?><div class="cphoto"><img src="<?php echo APP.'webroot'.DS.'img'.DS.'student_thumb'.DS.$userValue['Student']['photo'];?>"></div><?php }?>
