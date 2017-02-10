<div class="page-title"><div class="title-env"> <h1 class="title"><?php echo __('Confrigration Options');?></h1></div></div>
<div class="panel">    
    <div class="panel-body"><?php echo $this->Session->flash();?>
	<?php echo $this->Form->create('Configuration', array( 'controller' => 'Configurations', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
	    <div class="form-group">
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Site Name');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Site Name'),'div'=>false));?>
		</div>
		 <label for="site_name" class="col-sm-2 control-label"><?php echo __('Organization Name');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('organization_name',array('label' => false,'class'=>'form-control','placeholder'=>__('Organization Name'),'div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Domain Name');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('domain_name',array('label' => false,'class'=>'form-control','placeholder'=>__('Domain Name'),'div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Organization Email')?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>__('Organization Email'),'div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Meta Title');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('meta_title',array('label' => false,'class'=>'form-control','placeholder'=>__('Meta Title'),'div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Meta Description');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('meta_desc',array('label' => false,'class'=>'form-control','placeholder'=>__('Meta Description'),'div'=>false));?>
		</div>
	    </div>	    
	    <div class="form-group">
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Time Zone');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->select('timezone',$this->Time->listTimezones(),array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		 <label for="site_name" class="col-sm-2 control-label"><?php echo __('Currency');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->select('currency',$currency,array('empty'=>false,'label' => false,'class'=>'form-control','div'=>false,'escape'=>false));?>
		</div>                        
	    </div>
	    <div class="form-group">
	       <label for="site_name" class="col-sm-2 control-label"><?php echo __('Header Contact');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('contact',array('label' => false,'class'=>'form-control','placeholder'=>__('Header Contact'),'div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Email Contact');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('email_contact',array('label' => false,'class'=>'form-control','placeholder'=>__('Email Contact'),'div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Display records per page');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('min_limit',array('label' => false,'class'=>'form-control','placeholder'=>__('Display records per page'),'div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Max records per page');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('max_limit',array('label' => false,'class'=>'form-control','placeholder'=>__('Max records per page'),'div'=>false));?>
		</div>
	    </div>	    
	    <div class="form-group">
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Date Format');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('date_format',array('label' => false,'class'=>'form-control','placeholder'=>__('Date Format'),'div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-6 control-label"><?php echo __('Date, Month, Year, Hour, Min, Sec, Meridian, Date Seprator, Time Seprator');?></label>
	    </div>
	    <div class="form-group">
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Capthca');?></small></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->input('captcha_type',array('type'=>'radio','options'=>array("1"=>__('Image'),"0"=>__('Text')),'default'=>'1','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
		</div>
		<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Text Direction');?></small></label>
		<div class="col-sm-4">
		    <?php echo $this->Form->input('dir_type',array('type'=>'radio','options'=>array("1"=>__('Left-to-right (LTR)'),"0"=>__('Right-to-Left (RTL)')),'default'=>'1','legend'=>false,'before' => '<label class="radio-inline">','separator' => '</label><label class="radio-inline">','after'=>'</label>','label' => false,'div'=>false));?>
		</div>                                                                               
	    </div>
	    <div class="form-group">
		<label for="site_name" class="col-sm-2 control-label"><?php echo __('Language');?></label>
		<div class="col-sm-4">
		   <?php echo $this->Form->select('language',$language,array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
		</div>        
	    </div>
	    <div class="form-group">
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Enable SMS Notification');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('sms_notification',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		 <label for="site_name" class="col-sm-3 control-label"><?php echo __('Enable Email Notification');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('email_notification',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		 <label for="site_name" class="col-sm-3 control-label"><?php echo __('Manual Verification');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('guest_login',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
	    </div>                    
	    <div class="form-group">
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Front End Registration');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('front_end',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Front End Slides');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('slides',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Translation');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('translate',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Paid Exam');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('paid_exam',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Leader Board');?></label>
		<div class="col-sm-1">                            
		   <?php echo $this->Form->checkbox('leader_board',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Math Editor')?></label>
		<div class="col-sm-1">                            
		   <?php echo $this->Form->checkbox('math_editor',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Exam Expiry');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('exam_expiry',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Exam Feedback');?></label>
		<div class="col-sm-1">                            
		   <?php echo $this->Form->checkbox('exam_feedback',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Tolrance Count');?></label>
		<div class="col-sm-1">                            
		    <?php echo $this->Form->input('tolrance_count',array('label' => false,'class'=>'form-control','div'=>false));?>   
		</div>
	    </div>
	    <div class="form-group">
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Certificate');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('certificate',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Testimonial');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('testimonial',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('Advertisement');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('ads',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
	    </div>
	    <div class="form-group">
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('No. of Visitor');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('panel1',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('No. of Student');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('panel2',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
		<label for="site_name" class="col-sm-3 control-label"><?php echo __('No. of Exam');?></label>
		<div class="col-sm-1">
		   <?php echo $this->Form->checkbox('panel3',array('label' => false,'class'=>'form-control','div'=>false));?>
		</div>
	    </div>
	    <div class="form-group text-left">
		<div class="col-sm-offset-2 col-sm-7">
		<?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Save Settings'),array('class'=>'btn btn-success','escpae'=>false));?>
	    </div>
	    </div>
	<?php echo $this->Form->end();?>
    </div>
</div>