<?php
$url=$this->Html->url(array('controller'=>'Mails','action'=>'View'));
$urlCompose=$this->Html->url(array('controller'=>'Mails','action'=>'compose'));
$urlAction=$this->params['action'];
if($urlAction=="trash")
$deleteAction="deleteall";
else
$deleteAction="trashall";
?>
<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"><div class="title-env"> <h1 class="title"><?php echo __('Mailbox');?></h1></div></div>
<?php echo $this->Session->flash();?>
                        <section class="mailbox-env"> <div class="row">
	<?php if($userPermissionArr['search_right'])echo $this->element('pagination');
	else echo $this->element('pagination',array('IsSearch'=>'No'));
$page_params = $this->Paginator->params();
$limit = $page_params['limit'];
$page = $page_params['page'];
$serial_no = 1*$limit*($page-1)+1;?>
<div class="mrg-mail"></div>
                                <div class="col-sm-3 mailbox-left">
                                    <div class="mailbox-sidebar">
				    <?php echo$this->Html->link('<i class="fa fa-envelope"></i><span>&nbsp;'.__('Compose').'</span>',array('controller'=>'Mails','action'=>'compose'),array('class'=>'btn btn-block btn-danger btn-icon btn-icon-standalone btn-icon-standalone-right','escape'=>false));?>
                                        <div class="sidebar-row">
                                            <ul class="list-unstyled mailbox-list">
                                                <li <?php if($urlAction=="index"){echo "class=\"active\"";}?>><?php echo$this->Html->link(__('Inbox')."<span class=\"badge badge-success pull-right\">$totalInbox</span>&nbsp;",array('controller'=>'Mails','action'=>'index'),array('escape'=>false));?></li>
						<li <?php if($urlAction=="sent"){echo "class=\"active\"";}?>><?php echo$this->Html->link(__('Sent Mail'),array('controller'=>'Mails','action'=>'sent'),array('class'=>'btn-group dropup btn-block'));?></li>
						<li <?php if($urlAction=="trash"){echo "class=\"active\"";}?>><?php echo$this->Html->link(__('Trash'),array('controller'=>'Mails','action'=>'trash'),array('class'=>'btn-group dropup btn-block'));?></li>
                                            </ul> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 mailbox-right">
                                    <div>
                                       <div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul class="list-group mail-action list-unstyled list-inline">
                                                        <li><a class="btn btn-default"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></a></li>
                                                        <?php if($userPermissionArr['delete_right']){ if($urlAction=="trash"){?>
							<li><?php echo $this->Html->link('<i class="fa fa-trash"></i>','javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrmi','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-default','data-hover'=>'tooltip','data-original-title'=>'Delete Forever'));?></li>
							<?php }else{?>
							<li><?php echo $this->Html->link('<i class="fa fa-trash"></i>','javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_trash();','escape'=>false,'class'=>'btn btn-default','data-hover'=>'tooltip','data-original-title'=>'Move to Trash'));?></li>
							<?php }}?>
							<?php if($userPermissionArr['update_right']){ if($urlAction!="sent"){?>
							<li class="dropdown"><a href="#" data-toggle="dropdown"
                                                                                class="btn btn-default dropdown-toggle"><i
                                                                class="fa fa-folder"></i>&nbsp; <?php echo __('More');?> &nbsp;<span
                                                                class="caret"></span></a>
                                                            <ul role="menu" class="dropdown-menu">
								<?php if($urlAction=="index"){?>
                                                                <li><?php echo $this->Html->link(__('Mark as Read'),'javascript:void(0);',array('onclick'=>'check_perform_more("read");'));?></li>
                                                                <li><?php echo $this->Html->link(__('Mark as Unread'),'javascript:void(0);',array('onclick'=>'check_perform_more("unread");'));?></li><?php }?>
                                                                <?php if($urlAction=="trash"){?><li><?php echo $this->Html->link(__('Move to Inbox'),'javascript:void(0);',array('onclick'=>'check_perform_more("inbox");'));?></li><?php }?>
                                                            </ul>
                                                        </li><?php }}?>                                                      
                                                    </ul>
						    <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => $deleteAction));?> 
                                                    <div class="list-group mail-box">
						    <?php foreach ($Mail as $post):
						    $id=$post['Mail']['id'];?>
						    <a href="#" class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-5 col-lg-4"><?php echo $this->Form->checkbox(false,array('value' => $post['Mail']['id'],'name'=>'data[Mail][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?>
							    <?php echo($post['Mail']['type']=="Unread") ? "<strong onclick=show_modal('$url/$id'); class=\"mail-from\">" : "<span onclick=show_modal('$url/$id'); class=\"mail-from\">";?><?php if($post['Mail']['to_email']==$mailType){echo h($post['Mail']['from_email']);}else{echo h($post['Mail']['to_email']);}?><?php echo ($post['Mail']['type']=="Unread") ? "</strong>" : "</span>"?></div>
                                                            <div class="col-md-7 col-lg-8" onclick=show_modal('<?php echo$url;?>/<?php echo$id;?>');><?php echo($post['Mail']['type']=="Unread") ? "<strong class=\"mail-title\">" : "<span class=\"mail-title\">";?><i><?php echo h($post['Mail']['subject']);?></i><?php echo ($post['Mail']['type']=="Unread") ? "</strong>" : "</span>"?>
							    <span class="pull-right"><?php echo $this->Time->Format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$timeSep.$sysSec.$dateGap.$sysMer,$post['Mail']['date']);?></span>
                                                            </div>
                                                        </div>
                                                    </a>
						    <?php endforeach;?>
						    <?php unset($post);?>
						   </div>
						   <?php echo$this->Form->input('type',array('type'=>'hidden','name'=>'type'));?>
						   <?php echo $this->Form->end();?>
                                                </div>
                                            </div>
                                        </div>
				    </div>
				</div>
			    </div>
			</section>
                
<script type="text/javascript">
function check_perform_trash()
{
    document.deleteallfrm.submit();
}
function check_perform_more(type)
{
    document.deleteallfrm.type.value=type;
    document.deleteallfrm.submit();
}
</script>
</div>