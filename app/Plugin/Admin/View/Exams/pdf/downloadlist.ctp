<table class="table table-bordered">
   <tr>
      <th><?php echo __('S.No.');?></th>
      <th><?php echo __('Student Name');?></th>
      <th><?php echo __('Email');?></th>
      <th><?php echo __('Enrolment');?></th>
      <th><?php echo __('Phone');?></th>
      <th><?php echo __('Percentage');?></th>
      <th><?php echo __('Result Status');?></th>
   </tr>
   <?php foreach($examResult as $rank=>$examValue):?>
   <tr>
      <td><?php echo++$rank;?></td>
      <td><?php echo h($examValue['Student']['name']);?></td>
      <td><?php echo$examValue['Student']['email'];?></td>      
      <td><?php echo$examValue['Student']['enroll'];?></td>
      <td><?php echo$examValue['Student']['phone'];?></td>
      <td><?php echo$examValue['ExamResult']['percent'].'%';?></td>
      <td><span class="label label-<?php if($examValue['ExamResult']['result']=="Pass")echo"success";else echo"danger";?>"><?php if($examValue['ExamResult']['result']=="Pass"){echo __('PASSED');}else{echo __('FAILED');}?></span></td>
   </tr>
   <?php endforeach;unset($examValue);?>
</table>