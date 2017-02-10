
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add News');?></h1></div></div>
<div class="panel">
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('News', array( 'controller' => 'News','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('News Title');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('news_title',array('label' => false,'class'=>'form-control','placeholder'=>__('News Title'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('News Description');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Tinymce->input('news_desc', array('class'=>'form-control','placeholder'=>__('News Description'),'label' => false),array('language'=>$configLanguage,'directionality'=>$dirType),'full');?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
			    <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
			 </div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>