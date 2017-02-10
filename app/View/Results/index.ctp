<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<?php echo $this->Session->flash();?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('My Results');?></div>
    </div>
</div>
<div class="panel">
    	<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));
		$page_params = $this->Paginator->params();
		$limit = $page_params['limit'];
		$page = $page_params['page'];
		$serial_no = 1*$limit*($page-1)+1;?>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped">
			<tr>
				<th><?php echo __('S.No.');?></th>
				<th><?php echo __('Exam Name');?></th>
				<th><?php echo __('Attempt Date');?></th>
				<th><?php echo __('Marks Scored');?>/<br><?php echo __('Max.Marks');?></th>
				<th><?php echo __('Percentage');?></th>
				<th><?php echo __('Result');?></th>
				<th><?php echo __('Action');?></th>
			</tr>
			<?php foreach($Result as $post):?>
			<tr>
				<td><?php echo$serial_no++;?></td>
				<td><?php echo h($post['Exam']['name']);?></td>
				<td><?php echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$timeSep.$sysSec.$dateGap.$sysMer,$post['Result']['start_time']);?></td>
				<td><?php echo CakeNumber::precision($post['Result']['obtained_marks'],2);?>/<?php echo CakeNumber::precision($post['Result']['total_marks'],2);?></td>
				<td><?php echo$this->Number->toPercentage($post['Result']['percent']);?></td>
				<td><span class="label label-<?php if($post['Result']['result']=="Pass")echo"success";else echo"danger";?>"><?php if($post['Result']['result']=="Pass"){echo __('PASSED');}else{echo __('FAILED');}?></span></td>
				<td><?php echo$this->Html->link('<span class="glyphicon glyphicon-fullscreen"></span>&nbsp;',array('action'=>'view',$post['Result']['id']),array('class'=>'btn btn-default','escape'=>false,'data-toggle'=>'tooltip','title'=>__('View Details')));?>
				<?php if($post['Exam']['declare_result']=='Yes'){ echo$this->Html->link('<span class="glyphicon glyphicon-print"></span>&nbsp;',array('action'=>'printresult',$post['Result']['id']),array('class'=>'btn btn-default','escape'=>false,'data-toggle'=>'tooltip','title'=>__('Print'),'target'=>'_blank'));}?>
				<?php if($siteCertificate==1 && $post['Result']['result']=="Pass") echo$this->Html->link('<span class="fa fa-certificate"></span>&nbsp;',array('action'=>'certificate',$post['Result']['id'],'ext'=>'pdf'),array('data-toggle'=>'tooltip','title'=>__('Certificate'),'class'=>'btn btn-info','escape'=>false));?></td>
			</tr>
			<?php endforeach;unset($post);?>
			</table>
		</div>
		<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));?>
	</div>
</div>
</div>