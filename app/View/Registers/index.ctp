<div class="col-md-9">
    <div class="page-heading">
        <div class="widget">
            <h2 class="widget-title"><?php echo __('New  Student Register');?></h2>
        </div>
    </div><div class="panel-body">
        <?php echo $this->Session->flash();?>
            <?php echo $this->Form->create('Register', array( 'controller' => 'Register', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','role'=>'form','type' => 'file'));?>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"><small><?php echo __('Email');?> <span class="text-danger"> *</span></small></label>
                <div class="col-sm-4">
                <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-4">
                <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                </div>
            <!--<label for="group_name" class="col-sm-2 control-label"><small><?php //echo __('Group');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-4">
                <?php //echo $this->Form->select('StudentGroup.group_name',$group_id,array('multiple'=>true,'label' => false,'class'=>'form-control multiselectgrp','placeholder'=>__('Group'),'div'=>false));?>
                </div>-->
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Password');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-4">
                <?php echo $this->Form->input('password',array('label' => false,'class'=>'form-control','placeholder'=>__('Password'),'minlength'=>'4','maxlength'=>'15','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Address');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-4">
                <?php echo $this->Form->input('address',array('label' => false,'class'=>'form-control','placeholder'=>__('Address'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Phone');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-4">
                <?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Guardian Phone');?></small></label>
                <div class="col-sm-4">
                <?php echo $this->Form->input('guardian_phone',array('label' => false,'class'=>'form-control','placeholder'=>__('Guardian Phone'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">                
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Enrolment Number');?></small></label>
                <div class="col-sm-4">
                <?php echo $this->Form->input('enroll',array('label' => false,'class'=>'form-control','placeholder'=>__('Enrolment Number'),'div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Auto Renewal');?></small></label>
                <div class="col-sm-1">
                <?php echo $this->Form->input('auto_renewal',array('checked'=>true,'label' => false,'class'=>'form-control','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Upload Photo');?></small></label>
                <div class="col-sm-4">
                <?php echo $this->Form->input('photo',array('type' => 'file','label' => false,'class'=>'','div'=>false));?>
                </div>
                <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Security Code');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-4">
                <?php echo$this->Captcha->render($captchaSettings);?>
                </div>
            </div>
            <div class="form-group text-center">
                <div class="col-sm-offset-2 col-sm-2">
                <button type="submit" class="btn btn-success"><span class="fa fa-user"></span> <?php echo __('Submit');?></button>
                </div>
            </div>
            <?php echo$this->Form->end();?>
    </div>
</div>