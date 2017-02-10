<style type="text/css">
html,body        {height:100%;}
.wrapper         {width:98%;height:100%;margin:0 auto;background:#CCC}
.h_iframe        {position:relative;}
.h_iframe .ratio {display:block;width:100%;height:auto;}
.h_iframe iframe {position:absolute;top:0;left:0;width:100%; height:100%;}
</style>
<?php $url=$this->Html->url(array('controller'=>'Questions','action'=>'view',$id));?>
<div class="container">
    <div class="row">
        <?php echo $this->Session->flash();?>
        <div class="col-md-12">    
            <div class="panel panel-default mrg">
                <div class="panel-heading"><?php echo __('Question Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                <div class="panel-body">
                    <div class="wrapper">
                        <div class="h_iframe">
                            <!-- a transparent image is preferable -->
                            <?php echo$this->Html->image('blank.png',array('class'=>'ratio'));?>
                            <iframe width="1100" height="525" src="<?php echo$url;?>"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
