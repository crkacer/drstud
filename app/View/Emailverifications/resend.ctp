<div class="col-md-9">
    <div class="page-heading">
        <div class="widget">
            <h2 class="widget-title"><?php echo __('Re-Send Email Verification');?></h2>
        </div>
    </div>
    <?php echo $this->Session->flash();?>
    <?php echo $this->Form->create('Emailverification', array( 'controller' => 'Emailverifications', 'action' => 'resendsub','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','role'=>'form'));?>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label"><small><?php echo __('Email');?></small></label>
        <div class="col-sm-9">
        <?php echo $this->Form->input('email',array('type'=>'email','required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Please Enter Email Id in the Text Box which you enter at the time of registration'),'div'=>false));?>
        </div>
    </div>            
    <div class="form-group text-center">
        <div class="col-sm-offset-3 col-sm-2">
        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-log-in"></span><?php echo __('Submit');?></button>
        </div>
    </div>
    <?php echo$this->Form->end();?>
</div>