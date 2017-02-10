<script type="text/javascript">
    $(document).ready(function(){
$('#selectAllar').click(function() {
$('.chkselectar').prop('checked', this.checked);});
});
</script>
<?php 
$url=$this->Html->url(array('controller'=>'Users'));?>
<div class="container">
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Assign Form Rights');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('User', array('controller' => 'PageRight','action'=>"assignrightsedit/$id",'name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAllar','hiddenField'=>false));?></th>
                                <th><?php echo __('#');?></th>
                                <th><?php echo __('Module Name');?></th>
                                <th><?php echo __('Page Name');?></th>
                                <th>Action</th>
                            </tr>
                            <?php $checkMultiple=null; foreach ($PageRight as $k=>$post): $prId=$post['Page']['id'];$pageId=$post['PageRight']['page_id'];$ugroupId=$post['PageRight']['ugroup_id'];
                            if($prId==$pageId && $id==$ugroupId)
                            $checked="checked";
                            else
                            $checked="";
                            if($post['PageRight']['update_right']==1)
                            $updateChecked="checked";
                            else
                            $updateChecked="";
                            if($post['PageRight']['save_right']==1)
                            $saveChecked="checked";
                            else
                            $saveChecked="";
                            if($post['PageRight']['delete_right']==1)
                            $deleteChecked="checked";
                            else
                            $deleteChecked="";
                            if($post['PageRight']['search_right']==1)
                            $searchChecked="checked";
                            else
                            $searchChecked="";
                            if($post['PageRight']['view_right']==1)
                            $viewChecked="checked";
                            else
                            $viewChecked="";
                            $serialNo=$k;?>
                            <tr>
                                <td><?php echo $this->Form->checkbox("$k.User.id",array('value' =>$prId/*,'name'=>'data[PageRight][id][]'*/,'id'=>"DeleteCheckbox$prId",'class'=>'chkselectar','checked'=>$checked,'hiddenField'=>false));?></td>
                                <td><?php echo ++$serialNo; ?></td>
                                <td><?php echo $post['Page']['model_name']; ?></td>
                                <td><?php echo $post['Page']['page_name']; ?></td>
                                <td>
                                Update
                                <?php echo $this->Form->checkbox("$k.User.update_right",array('value'=>1,'class'=>"chk$k",'checked'=>$updateChecked,'label'=>false));?>
                                Save
                                <?php echo $this->Form->checkbox("$k.User.save_right",array('value'=>1,'class'=>"chk$k",'checked'=>$saveChecked,'label'=>false));?>
                                Delete
                                <?php echo $this->Form->checkbox("$k.User.delete_right",array('value'=>1,'class'=>"chk$k",'checked'=>$deleteChecked,'label'=>false));?>
                                Search
                                <?php echo $this->Form->checkbox("$k.User.search_right",array('value'=>1,'class'=>"chk$k",'checked'=>$searchChecked,'label'=>false));?>
                                View
                                <?php echo $this->Form->checkbox("$k.User.view_right",array('value'=>1,'class'=>"chk$k",'checked'=>$viewChecked,'label'=>false));?>                                
                                </td>
                            </tr>
                            <?php $checkMultiple.="$('.chk$k').prop('checked', this.checked);";?>
                            <script type="text/javascript">
                            $(document).ready(function(){
                            $("#DeleteCheckbox<?php echo$prId;?>").click(function() {
                            $(".chk<?php echo$k;?>").prop('checked', this.checked);});
                            });
                            </script>                            
                            <?php endforeach; ?>
                            <?php unset($post); ?>
                            <tr>
                                <td colspan="4"><?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?></td>
                            </tr>
                            </table>
                    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('#selectAllar').click(function() {
$('.chkselectar').prop('checked', this.checked);
<?php echo$checkMultiple;?>
});
});
</script>