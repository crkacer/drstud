<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add Questions');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    
<div class="panel">
    <div class="panel-heading">
<?php echo $this->Form->create(array('name'=>'searchfrm','action' => "index/$exam_id"));?>
		<div class="row mrg">
		    <div  class="col-md-3">
			<?php
			echo $this->Form->input('subject_id',array('options'=>array($subjectId),'empty'=>__('Subject'),'class'=>'form-control','id'=>'subjectId','div'=>false,'label'=>false));?>
		    </div>
		    <div  class="col-md-3">
			<?php echo $this->Form->input('qtype_id',array('options'=>array($qtypeId),'empty'=>__('Question Type'),'class'=>'form-control','div'=>false,'label'=>false));?>
		    </div>
		    <div  class="col-md-3">
			<?php echo $this->Form->input('diff_id',array('options'=>array($diffId),'empty'=>__('Difficulty Level'),'class'=>'form-control','div'=>false,'label'=>false));?>
		    </div>
		    <div  class="col-md-3">
			<button type="submit" class="btn btn-success"><span class="fa fa-search"></span>&nbsp;<?php echo __('Search');?></button>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('controller'=>'Addquestions','action'=>'index',$exam_id),array('class'=>'btn btn-warning','escape'=>false));?>
		    </div>
		</div>
		<?php echo$this->Form->end();?>
		
        <div class="btn-group">
            <?php if($userPermissionArr['save_right']){ echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add To Exam'),'#',array('name'=>'add','id'=>'add','onclick'=>"all_question('add');",'escape'=>false,'class'=>'btn btn-success'));}?>
            <?php if($userPermissionArr['delete_right']){ echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete To Exam'),'#',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>"all_question('delete');",'escape'=>false,'class'=>'btn btn-danger'));}?>
            <?php echo $this->Html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back To Exam'),array('controller' => 'Exams','action'=>'index'),array('escape' => false,'class'=>'btn btn-info'));?>
        </div>
    </div>
        <?php echo $this->element('pagination',array('IsSearch'=>'No'));
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','controller'=>'Addquestion','action'=>'adddelete'));?>
    <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
                            <th><?php echo $this->Paginator->sort('Subject.subject_name', __('Subject'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('Qtype.question_type', __('Type'), array('direction' => 'asc'));?></th>
                            <th ><?php echo $this->Paginator->sort('question', __('Body of Question'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('Diff.diff_level', __('Level'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('marks', __('Marks'), array('direction' => 'asc'));?></th>
                            <?php if($userPermissionArr['delete_right'] || $userPermissionArr['save_right']){?><th><?php echo __('Action');?></th><?php }?>
                        </tr>
                        <?php foreach ($Addquestion as $post):
                        $id=$post['Addquestion']['id'];?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Addquestion']['id'],'name'=>'data[Addquestion][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
                            <td><?php echo h($post['Subject']['subject_name']); ?></td>
                            <td><?php echo h($post['Qtype']['question_type']); ?></td>
                            <td ><?php echo str_replace("<script","",($post['Addquestion']['question'])); ?></td>
                            <td><?php echo h($post['Diff']['diff_level']); ?></td>
                            <td><?php echo h($post['Addquestion']['marks']); ?></td>
                            <?php if($userPermissionArr['delete_right'] || $userPermissionArr['save_right']){?><td>
                            <?php $is_question=false;                            
                            foreach($ExamQuestion as $eq):
                            if($eq['ExamQuestion']['question_id']==$id){
                            $is_question=true;break;}
                            $is_question=false;
                            endforeach;
                             if($userPermissionArr['delete_right']){if($is_question==true)                            
                            echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete To Exam'),'#',array('onclick'=>"single_question('delete','$id');",'class'=>'btn btn-danger','escape'=>false));}
                            if($userPermissionArr['save_right']){if($is_question==false)
                            echo $this->Html->link('<span class="fa fa-plus"></span>&nbsp;'.__('Add To Exam'),'#',array('onclick'=>"single_question('add','$id');",'escape'=>false,'class'=>'btn btn-success'));}                         
                            unset($eq);?>
                            </td><?php }?>
                        </tr>
                        <?php endforeach;?>
                        <?php unset($post);?>
                        </table>
                </div>        
<?php echo $this->Form->input('action',array('name'=>'action','type'=>'hidden','value'=>''));
echo $this->Form->input('exam_id',array('type'=>'hidden','value'=>$exam_id));
echo $this->Form->input('limit',array('type'=>'hidden','value'=>$limit));
echo $this->Form->input('page',array('type'=>'hidden','value'=>$page));
echo $this->Form->input('keyword',array('type'=>'hidden','value'=>$this->params['keyword']));
echo $this->Form->input('subject_id',array('type'=>'hidden','value'=>$this->params['subject_id']));
echo $this->Form->input('qtype_id',array('type'=>'hidden','value'=>$this->params['qtype_id']));
echo $this->Form->input('diff_id',array('type'=>'hidden','value'=>$this->params['diff_id']));
echo $this->Form->end();?>
<?php echo $this->element('pagination',array('IsSearch'=>'No'));?>
</div>
    </div>

</div>