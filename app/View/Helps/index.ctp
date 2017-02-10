<?php echo $this->Session->flash();?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Help');?></div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
                <div class="panel-group" id="accordion">
                    <?php foreach($helpPost as $k=>$post):$id=$post['Help']['id'];?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-toggle="collapse" href="#collapse<?php echo$id;?>"><strong><?php echo h($post['Help']['link_title']);?></strong></a></h4>                        
                    </div>
                        <div id="collapse<?php echo$id;?>" class="collapse<?php echo($k==0)?"in":"";?>">
                            <div class="panel-body">
                                <?php echo str_replace("<script","",$post['Help']['link_desc']);?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;unset($post);?>                
                </div>
		</div>
</div>