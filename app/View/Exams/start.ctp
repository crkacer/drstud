<?php
$origQuesNo=$userExamQuestion['ExamStat']['ques_no'];
$examDuration=$post['Exam']['duration'];
$viewUrl=$this->Html->url(array('controller'=>'Exams','action'=>'submit',$examId,$examResultId,$origQuesNo));
$targetUrl=$this->Html->url(array('controller'=>'Ajaxcontents','action'=>'examwarning',$examResultId));
$finishUrl=$this->Html->url(array('controller'=>'Exams','action'=>'finish',$examId,'warn',$origQuesNo));
$examUrl=$this->Html->url(array('controller'=>'Exams','action'=>'start',$examId));
?>
<div class="col-sm-offset-3 col-md-6" id="exam-loading" style="display: none;"><?php echo$this->Html->image('loading-lg.gif',array('class'=>'img-responsive'));?></div>
<div class="col-md-12 col-sm-12 col-xs-12"><div class="col-md-3 col-sm-4 col-xs-12 main-top-timer"><div id="timer"><div id="maincount"></div></div></div></div>
<div id="printajax">
<div class="col-md-12">
<?php echo $this->Form->create('Exam', array('controller'=>'Exams','action' =>"save/$examId/$oquesNo/$origQuesNo",'name'=>'post_req','id'=>'post_req'));?>
	<div class="col-md-9">
		<div class="panel">
			<div class="panel-body"><?php echo $this->Session->flash();?>
				<div class="exam-heading"><?php echo h($post['Exam']['name']);?></div>
					<div class="panel panel-default">
						<div class="table-responsive exam-panel">
							<table class="table">
								<thead>
								<tr>
									<td><h4><div class="pull-left mrg-left"><strong><?php echo __('Question');?> <?php echo$userExamQuestion['ExamStat']['ques_no'];?></strong></div> <div class="pull-right mrg-left mrg-right"><strong><?php echo __('Correct Marks');?>: <span class="text-success"><?php echo$userExamQuestion['ExamStat']['marks'];?></span> , <?php echo __('Negative Marks');?>: <span class="text-danger"><?php echo$userExamQuestion['Question']['negative_marks'];?></span></strong></div></h4></td>
								</tr>
								<tr>
									<td><div class="mrg-left"><strong><?php echo str_replace("<script","",$userExamQuestion['Question']['question']);?></strong></div></td>
								</tr>
								</thead>
								<?php if(strlen($userExamQuestion['Question']['hint'])>0){?>
								<tr>
									<td><div class="mrg-left"><strong><?php echo __('Hint');?> : </strong><?php echo str_replace("<script","",$userExamQuestion['Question']['hint']);?></div></td>
								</tr>
								<?php }?>
								<?php if($userExamQuestion['Qtype']['type']=="M")
								{
									$options=array();
									$optColor1_1='<span>';$optColor1_2='<span>';$optColor1_3='<span>';
									$optColor1_4='<span>';$optColor1_5='<span>';$optColor1_6='<span>';$optColor2='</span>';
									if($post['Exam']['instant_result']==1 && $userExamQuestion['ExamStat']['answered']==1)
									{
										if(strlen($userExamQuestion['Question']['answer'])>1)
										{
											$selDanger='<span class="text-danger"><b>';
											$selSuccess='<span class="text-success"><b>';
											foreach(explode(",",$userExamQuestion['ExamStat']['option_selected']) as $value)
											{
												$opt=$value;
												$varName1='optColor1'.'_'.$opt;
												$$varName1=$selDanger;
											}
											unset($value);
											foreach(explode(",",$userExamQuestion['ExamStat']['correct_answer']) as $value)
											{
												$opt=$value;
												$varName1='optColor1'.'_'.$opt;
												$$varName1=$selSuccess;												
											}
											unset($value);
										}
										else
										{
											$selDanger='<span class="text-danger"><b>';
											$selSuccess='<span class="text-success"><b>';
											$opt=$userExamQuestion['ExamStat']['option_selected'];
											$varName1='optColor1'.'_'.$opt;
											$$varName1=$selDanger;
											$opt=$userExamQuestion['ExamStat']['correct_answer'];
											$varName1='optColor1'.'_'.$opt;
											$$varName1=$selSuccess;	
										}																		
									}
									$optionKeyArr=explode(",",$userExamQuestion['ExamStat']['options']);
									foreach($optionKeyArr as $value)
									{
										$optKey="option".$value;
										$doptCol='optColor1'.'_'.$value;
										if(strlen($userExamQuestion['Question'][$optKey])>0)
										$options[$value]=$$doptCol.str_replace("<script","",$userExamQuestion['Question'][$optKey]).$optColor2;
									}
									unset($value);
									?>
								<tr>
									<td>								
										<?php if(strlen($userExamQuestion['Question']['answer'])>1)
										{
											?><div class="checkbox"><?php
											$optionSelected=array();
											$optionSelected=explode(",",$userExamQuestion['ExamStat']['option_selected']);
											echo$this->Form->input('option_selected',
																	 array('type'=>'select','multiple' => 'checkbox','label'=>false,
																		   'options'=>$options,
																		   'value'=>$optionSelected,
																		   'escape'=>false));
											?></div><?php
										}
										else
										{
											$optionSelected=$userExamQuestion['ExamStat']['option_selected'];
											echo$this->Form->input('option_selected',
																	 array('type'=>'radio','label'=>false,'legend'=>false,'div'=>false,
																		   'options'=>$options,
																		   'value'=>$optionSelected,
																		   'before' => '<div class="radio"><label>','separator' => '</label></div><div class="radio"><label>',
																		   'escape'=>false));
										}
										?>
									</td>
								</tr>				
								<?php }?>
								<?php if($userExamQuestion['Qtype']['type']=="T")
								{?>
								<tr>
									<td>
										<?php echo$this->Form->radio('true_false',array('True'=>__('True'),'False'=>__('False')),array('value'=>$userExamQuestion['ExamStat']['true_false'],'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">','legend'=>false,'label'=>array('class'=>'radio-inline')));?>
									</td>
								</tr>
								<?php }?>
								<?php if($userExamQuestion['Qtype']['type']=="F")
								{?>
								<tr>
									<td>
										<?php echo$this->Form->input('fill_blank',array('value'=>$userExamQuestion['ExamStat']['fill_blank'],'label'=>false,'autocomplete'=>'off'));?>
									</td>
								</tr>
								<?php }?>
								<?php if($userExamQuestion['Qtype']['type']=="S")
								{?>
								<tr>
									<td>
										<?php echo$this->Form->input('answer',array('type'=>'textarea','value'=>$userExamQuestion['ExamStat']['answer'],'label'=>false,'class'=>'form-control','rows'=>'7'));?>
									</td>
								</tr>
								<?php }?>
							</table>
						</div>
						<div class="panel-body">
							<div class="row">
							<?php $navigationUrl=$this->Html->url(array('controller'=>'Exams','action'=>'ajaxcontentview'));$reviewUrl='';$unreviewUrl='';$saveUrl='';$resetUrl='';$savenextUrl='';?>
								<div class="col-sm-2">
								<?php $prevUrl=$this->Html->url(array('controller'=>'Exams','action'=>'ajaxcontentview'));
								echo$this->Form->button('&larr;'.__('Prev'),array('type'=>'button','rel'=>$navigationUrl,'onclick'=>"navigation($examId,$pquesNo,$origQuesNo)",'class'=>'btn btn-default btn-sm btn-block navigation','escape'=>false));?>
								</div>
								<div class="col-sm-2">
								<?php $saveUrl=$this->Html->url(array('controller'=>'Exams','action'=>'save',$examId,$oquesNo,$origQuesNo)); echo$this->Form->button('<span class="glyphicon glyphicon-check"></span>&nbsp;'.__('Save'),array('type'=>'button','id'=>'save','class'=>'btn btn-success btn-sm btn-block','escape'=>false));?>
								</div>
								<?php if($totalQuestion!=$oquesNo){?>
								<div class="col-sm-2">
								<?php $savenextUrl=$this->Html->url(array('controller'=>'Exams','action'=>'save',$examId,$oquesNo,$origQuesNo)); echo$this->Form->button('<span class="glyphicon glyphicon-log-out"></span>&nbsp;'.__('Save & Next'),array('type'=>'button','id'=>'savenext','class'=>'btn btn-success btn-sm btn-block','escape'=>false));?>
								</div>
								<?php }?>
								<?php if($userExamQuestion['ExamStat']['review']==1){?>
								<div class="col-sm-2">
								<?php $reviewUrl=$this->Html->url(array('controller'=>'Exams','action'=>'unreviewAnswer',$examId,$oquesNo,$origQuesNo));echo$this->Form->button('<span class="fa fa-dot-circle-o"></span>&nbsp;'.__('Unreview'),array('type'=>'button','id'=>'unreview','class'=>'btn btn-primary btn-sm btn-block','escape'=>false));?>
								</div><?php }else{?>
								<div class="col-sm-2">
								<?php $reviewUrl=$this->Html->url(array('controller'=>'Exams','action'=>'reviewAnswer',$examId,$oquesNo,$origQuesNo)); echo$this->Form->button('<span class="fa fa-dot-circle-o"></span>&nbsp;'.__('Review'),array('type'=>'button','id'=>'review','class'=>'btn btn-primary btn-sm btn-block','escape'=>false));?>
								</div><?php }?>
								<div class="col-sm-2">
								<?php $resetUrl=$this->Html->url(array('controller'=>'Exams','action'=>'resetAnswer',$examId,$oquesNo,$origQuesNo));echo$this->Form->button('<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;'.__('Reset Answer'),array('type'=>'button','id'=>'reset','class'=>'btn btn-danger btn-sm btn-block','escape'=>false));?>
								</div>
								<?php if($totalQuestion==$oquesNo){?>
								<div class="col-sm-2">
								<?php echo$this->Form->button(__('Finish').'&rarr;',array('type'=>'button','onclick'=>"show_modal('$viewUrl')",'class'=>'btn btn-default btn-sm btn-block','escape'=>false));?>
								</div><?php }else{?>
								<div class="col-sm-2">
								<?php echo$this->Form->button(__('Next').'&rarr;',array('type'=>'button','rel'=>$navigationUrl,'onclick'=>"navigation($examId,$nquesNo,$origQuesNo)",'class'=>'btn btn-default btn-sm btn-block navigation','escape'=>false));?>
								</div><?php }?>							
							</div>
						</div>
					</div>
			</div>
		</div>
		<?php echo$this->Form->input('save',array('type'=>'hidden','name'=>'saveNext','value'=>''));?>		
	</div>
	<?php echo$this->Form->end();?>
	<div class="col-md-3">	
		<div id="timer"><div id="maincount"></div></div>
		<div class="panel-group" id="accordion">
			<?php foreach($userSectionQuestion as $subjectName=>$quesArr):
			$subjectNameId=str_replace(" ","",h($subjectName));
			?>			
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#<?php echo$subjectNameId;?>"><?php echo h($subjectName);?></a></h4>
				</div>
				<div id="<?php echo$subjectNameId;?>" class="panel-collapse collapse <?php echo(h($currSubjectName)==h($subjectName)) ? "in" : "";?>">
					<div class="panel-body">
						<div class="row">
							<?php foreach($quesArr as $value):
							if($oquesNo==$value['ExamStat']['ques_no'])
							$btn_type="info";
							elseif($value['ExamStat']['review']==1)
							$btn_type="primary";
							elseif($value['ExamStat']['answered']==1)
							$btn_type="success";
							elseif($value['ExamStat']['opened']==1)
							$btn_type="warning";							
							else
							$btn_type="default";?>
							<div class="col-md-2 col-xs-2 col-sm-2 mrg-1"><?php $quesNo=$value['ExamStat']['ques_no'];echo$this->Form->button($quesNo,array('type'=>'button','rel'=>$navigationUrl,'onclick'=>"navigation($examId,$quesNo,$origQuesNo)",'class'=>"btn btn-$btn_type btn-circle btn-sm navigation"));?></div>
							<?php endforeach;unset($quesArr);?>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach;unset($i);unset($value);?>
			<?php echo $this->Form->button('<span class="glyphicon glyphicon-lock"></span>&nbsp;'.__('Finish').'&nbsp;'.$post['Exam']['type'],array('type'=>'button','onclick'=>"show_modal('$viewUrl')",'class'=>'btn btn-danger btn-sm btn-block','escape'=>false));?>
			<div class="mrg-1">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h4 class="panel-title"><?php echo __('Legend');?></h4>
					</div>
					<div class="panel-body">
						<div class="mrg-1"><div class="btn btn-circle btn-info btn-xs">&nbsp;&nbsp;&nbsp;</div>&nbsp;<strong><?php echo __('Current Question');?></strong></div>
						<div class="mrg-1"><div class="btn btn-circle btn-default btn-xs">&nbsp;&nbsp;&nbsp;</div>&nbsp;<strong><?php echo __('Not Attempted');?></strong></div>			
						<div class="mrg-1"><div class="btn btn-circle btn-success btn-xs">&nbsp;&nbsp;&nbsp;</div>&nbsp;<strong><?php echo __('Answered');?>&nbsp;</strong></div>
						<div class="mrg-1"><div class="btn btn-circle btn-warning btn-xs">&nbsp;&nbsp;&nbsp;</div>&nbsp;<strong><?php echo __('Not Answered');?></strong></div>
						<div class="mrg-1"><div class="btn btn-circle btn-primary btn-xs">&nbsp;&nbsp;&nbsp;</div>&nbsp;<strong><?php echo __('Review');?></strong></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $endTime=$this->Time->format('M d, Y H:i:s',$this->Time->fromString($examResult['ExamResult']['start_time'])+($post['Exam']['duration']*60));
$startTime=$this->Time->format('M d, Y H:i:s',$this->Time->fromString($examResult['ExamResult']['start_time']));
$expiryUrl=$this->Html->url(array('controller'=>'Exams','action'=>'finish',$examId,'null',$origQuesNo));
$serverTimeUrl=$this->Html->url(array('controller'=>'ServerTimes','action'=>'index'));
?>
<script type="text/javascript">
<?php if($examDuration>0){if($ajaxView==false){ ?>
$(document).ready(function(){
liftoffTime=new Date("<?php echo$endTime;?>");
$("#maincount").countdown({until: liftoffTime, format: 'HMS',serverSync: serverTime,alwaysExpire: true,expiryUrl:"<?php echo$expiryUrl;?>"});
  function serverTime() {
    var time = null; 
    $.ajax({url: "<?php echo$serverTimeUrl;?>", 
        async: false, dataType: 'text', 
        success: function(text) {            
            time = new Date(text);
        }, error: function(http, message, exc) { 
            time = new Date();
    }}); 
    return time; 
}
});
<?php }} else{ ?>
$(document).ready(function(){
startTime=new Date("<?php echo$startTime;?>");
	$('#maincount').countdown({since: startTime,format: 'HMS',serverSync: serverTime});
	function serverTime() {
    var time = null; 
    $.ajax({url: "<?php echo$serverTimeUrl;?>", 
        async: false, dataType: 'text', 
        success: function(text) {            
            time = new Date(text);
        }, error: function(http, message, exc) { 
            time = new Date();
    }}); 
    return time; 
}
});
<?php }?>
function callUserAnswerSaveNext()
{
	document.post_req.saveNext.value="Yes";
	document.post_req.submit();
}
function callUserAnswerSave()
{
	document.post_req.submit();
}
<?php if($post['Exam']['browser_tolrance']==1 && $ajaxView==false){?>
$(window).on("blur", function(e) {
  $.ajax({
      method: "GET",
      cache: false ,
      url: '<?php echo$targetUrl;?>'})
      .done(function(response) {
      if(response=="Yes")
      {
	   window.location='<?php echo$finishUrl;?>';
      }
      else
      {
	   $('#myModal').modal({
		   backdrop: 'static',
		   keyboard: false
	       })
      }
      });
});
<?php }?>
$(document).ready(function(){
$('#reset').click(function (){$.ajax({method: "GET",url: '<?php echo$resetUrl;?>',beforeSend: function(){$('#exam-loading').show();}}).done(function(data) {$('#exam-loading').hide();$('#printajax').html(data);}).error(function(xhr, textStatus, errorThrown ){retryAjax();});});
$('#review').click(function (){$.ajax({method: "GET",url: '<?php echo$reviewUrl;?>',beforeSend: function(){$('#exam-loading').show();}}).done(function(data) {$('#exam-loading').hide();$('#printajax').html(data);}).error(function(xhr, textStatus, errorThrown ){retryAjax();});});
$('#unreview').click(function (){$.ajax({method: "GET",url: '<?php echo$reviewUrl;?>',beforeSend: function(){$('#exam-loading').show();}}).done(function(data) {$('#exam-loading').hide();$('#printajax').html(data);}).error(function(xhr, textStatus, errorThrown ){retryAjax();});});
$('#save').click(function (){$.ajax({method: "POST",data:$('#post_req').serialize(),url: '<?php echo$saveUrl;?>',beforeSend: function(){$('#exam-loading').show();}}).done(function(data) {$('#exam-loading').hide();$('#printajax').html(data);}).error(function(xhr, textStatus, errorThrown ){retryAjax();});});
$('#savenext').click(function (){$.ajax({method: "POST",data:$('#post_req').serialize()+ '&saveNext=Yes',url: '<?php echo$savenextUrl;?>',beforeSend: function(){$('#exam-loading').show();}}).done(function(data) {$('#exam-loading').hide();$('#printajax').html(data);}).error(function(xhr, textStatus, errorThrown ){retryAjax();});});
});
function navigation(examId,quesNo,currQuesNo){targetUrl=$('.navigation').attr('rel')+'/'+examId+'/'+quesNo+'/'+currQuesNo;$.ajax({method: "GET",url: targetUrl,beforeSend: function(){$('#exam-loading').show();}}).done(function(data) {$('#exam-loading').hide();$('#printajax').html(data);}).error(function(xhr, textStatus, errorThrown ){retryAjax(xhr, textStatus, errorThrown);});}
function retryAjax(xhr, textStatus, errorThrown ){tryCount=0;retryLimit=3;if (textStatus == 'timeout') {tryCount++;if (tryCount <= retryLimit) {$.ajax(this);return;}return;}if (xhr.status == 500) {window.location='<?php echo$examUrl;?>';} else {window.location='<?php echo$examUrl;?>';}}
</script>
<style type="text/css">
.modal-backdrop {background-color:#ff0000;}
.modal-backdrop.in{opacity: .8;}
</style>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo __('Navigated Away');?></h4>
      </div>
      <div class="modal-body">
        <p><blockquote><?php echo$userValue['Student']['name'];?>, <?php echo __('you had navigated away from the test window. This will be reported to Moderator');?></blockquote></p>
	<p><blockquote><span class="text-danger"><?php echo __('Do not repeat this behaviour');?></span> <?php echo __('Otherwise you may get disqualified');?></blockquote></p>
	<div class="text-center"><button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Continue');?></button></div>
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
