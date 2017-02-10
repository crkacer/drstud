<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div class="" id="dashBoard">

	<div  id="upperDashBoard">                   
		<div class="dashBoardTitle">
			Dashboard
		</div>
		<div class="dashBoardUrl">
			<a href="<?php $url=$this->Html->url();?>">Home</a> / <a href="<?php $url=$this->Html->url();?>">Videos</a>
            
		</div>


		<div class="phonics_section">
        <h2>Videos</h2>
			 
		<?php foreach($Subject as $post) {
			$id=$post['Subject']['id'];?>
			<tr>
			<td><?php echo$serial_no++;?></td>
			<td><?php echo h($post['Subject']['subject_name']);?></td>
			<td><?php echo $this->Html->link('<span class="fa fa-list"></span>&nbsp;'.__('Lesson'),'javascript:void(0);',array('onclick'=>"show_modal('$url/lesson/$id');",'escape'=>false,'class'=>'btn btn-warning'));?>			      
			</tr>		       
		<?php }
			unset($post);?>
			 <div class="content mCustomScrollbar">
				<?php 
				 foreach ($Lessons as $value) {
				 	?>
					<div class = "video_row">
						<div class="video_text"><h2><?php echo $value["Name"]; ?></h2></div> 
						<?php echo $value["Desc"]; ?>
					</div>
				 <?php }
				 
				 
				 ?>
				 <!-- <div class="video_row">
					  <div class="video_box"><img src="images/basicGrammarVideo.png" /></div>
					  <div class="video_text">
						   <div class="video_text_inner">
						   <h4>Basic Grammar   <span class="date"> September 01, 2016</span></h4>
						   <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here,</p>
						   <button class="watchBtn">Watch Video</button>
						   </div>
					  </div>
				 </div> -->

			 </div> <!-- class="content mCustomScrollbar" -->
		</div><!--close phonics_section-->


	</div>                
</div>
