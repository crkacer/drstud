    <div class="container signin">
        <div id="win" class="signin">
            <div id="winLogo" class="signin"></div>
            
                
            <?php echo $this->Session->flash();?>
                                	
               
                <?php echo $this->Form->create('User', array('name'=>'post_req','id'=>'post_req','class'=>'signin','role'=>'form'));?>
                    <table class="table signin">
                        <tr class="signin"><td id="idCol" class="signin"><?php echo $this->Form->input('email',array('required'=>true,'type'=>'email','label' => false,'class'=>'signin','placeholder'=>__('Email'),'div'=>false));?></td></tr>
                       <tr class="signin"><td id="passwordCol" class="signin"><?php echo $this->Form->input('password',array('required'=>true,'label' => false,'class'=>'signin','placeholder'=>__('Password'),'value'=>'','type'=>'password','div'=>false));?></td></tr>
                    </table>
                    
				<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-log-in"></span> <?php echo __('Sign In');?></button>
                <?php echo$this->Form->end();?>	
            
           

            
        </div>
        
    </div>