<?php if($userValue){?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title"><?php echo __('Buy Group');?></div>
    </div>
</div>
<?php }else{?>
<div class="page-heading">
        <div class="widget">
            <h2 class="widget-title"><?php echo __('Buy Group');?></h2>
        </div>
</div>
<?php }?>
<?php if($userValue){?>
    <div class="panel">
    <div class="panel-body"><?php }?>
        <?php echo $this->Session->flash();
        //$cartUrl = $this->Html->url(array('controller'=>'Carts','action' => 'viewajax'));
        $cartUrl = $this->Html->url(array('controller'=>'Checkouts','action' => 'index'));?>
        <?php foreach($package as $post):$id=$post['Package']['id'];
        if(strlen($post['Package']['photo'])>0){
            $photo="group_thumb/".$post['Package']['photo'];}else{
                $photo="nia.png";}$viewUrl=$this->Html->url(array('controller'=>'Packages','action'=>"view",$id));?>           
           <div class="<?php if($userValue){?>col-sm-4<?php }else{?>col-sm-3<?php }?> mrg">
            <div>
                <h5 class="text-info"><strong><?php echo h($post['Package']['group_name']);?></strong></h5>
            </div>
            <div>
                <?php echo$this->Html->image($photo,array('alt'=>h($post['Package']['group_name']),'class'=>'img-thumbnail'));?>
            </div>
            <div>
                <h5><span class="text-danger"><strong><?php echo$currency.$post['Package']['price'];?></strong></span></h5>
            </div>
             <div class="btn-group">
                <?php
                $url = $this->Html->url(array('controller'=>'Carts','action' => 'buy'));                
                echo $this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;'.__('Buy'),'javascript:void(0);',array('onclick'=>"shopcart('$id');",'rel'=>$url,'escape'=>false,'class'=>'btn btn-success shopcart'));?>
                <?php echo$this->Html->link('<span class="glyphicon glyphicon-fullscreen"></span>&nbsp;'.__('View Details'),'javascript:void(0);',array('onclick'=>"show_modal('$viewUrl');",'escape'=>false,'class'=>'btn btn-info'));?>
            </div>
    </div>
        <?php endforeach;unset($value);?>
    <?php if($userValue){?>    
    </div>
    </div><?php }?>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>
<script>
function shopcart(selectedValue){
    $(document).ready(function(){
            var targeturl = $('.shopcart').attr('rel') + '?prodId=' + selectedValue;
            $.ajax({
                    type: 'get',
                    url: targeturl,
                    beforeSend: function(xhr) {
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                            if (response) {
                                    $('#cart-counter').html(response);
                                    window.location='<?php echo$cartUrl;?>';
                            }
                    },
                    error: function(e) {
                            
                    }
            });
            });
}
</script>