<div class="container">
<div class="row col-p30">
<?php if($sitePanel1){?>
<div class="col-sm-4 xs-box2">
<div class="box-services-c">
<i class="fa fa-user fa-5x"></i>
<h3 class="title-small br-bottom-center"><?php echo __('No of Visitors');?></h3>
<p class="mb0"><h3 class="text-danger"><?php echo$visitors;?></h3></strong></p>
</div>
</div>
<?php }?>
<?php if($sitePanel2){?>
<div class="col-sm-4 xs-box2">
<div class="box-services-c">
<i class="fa fa-graduation-cap fa-5x"></i>
<h3 class="title-small br-bottom-center"><?php echo __('No of Students');?></h3>
<p class="mb0"><h3 class="text-danger"><?php echo$students;?></h3></p>
</div>
</div>
<?php }?>
<?php if($sitePanel3){?>
<div class="col-sm-4">
<div class="box-services-c">
<i class="fa fa-book fa-5x"></i>
<h3 class="title-small br-bottom-center"><?php echo __('No of Quizzes');?></h3>
<p class="mb0"><h3 class="text-danger"><?php echo$exams;?></h3></p>
</div>
</div>
<?php }?>
</div>
</div>
</section>
<section class="section">
<div class="container">
<div class="row col-p30">
<div class="col-sm-12 col-md-6 sm-box2">
<div class="box-services-b">
<div class="box-left"><i class="fa fa-style1 fa fa-bullhorn"></i></div>
<div class="box-right">
  <h3 class="title-small "><?php echo __('Latest News & Events');?></h3>
				    <marquee align="top" direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="2" height="218">
				    <ul>				
					<?php foreach($news as $value):$id=$value['News']['id'];?>
					<li><?php echo$this->Html->link($value['News']['news_title'],array('controller'=>'News','action'=>'show',$id));?></li>
					<?php endforeach;unset($value);?>				  
				  </ul>
				  </marquee>
</div>
</div>
<div class="mb50"></div>
</div>
<?php if($frontLeaderBoard==1){?>
<div class="col-sm-12 col-md-6">
<h3 class="title-small "><?php echo __('Leader Board');?></h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
		    <th><?php echo __('Rank');?></th>
		    <th><?php echo __('Name');?></th>
		    <th><?php echo __('Average Percentage(%)');?></th>
		    <th><?php echo __('Quiz Given');?></th>
		  </tr>
		  <?php foreach($scoreboard as $k=>$post):$k++?>
		  <tr>
		      <td><?php echo$k;?></td>
		      <td><?php echo h($post['Selection']['name']);?></td>
		      <td><?php echo$post['Selection']['points'];?>%</td>
		      <td><?php echo$post['Selection']['exam_given'];?></td>
		  </tr>
                    <?php endforeach;unset($post);?>
                </table>
            </div>
</div>
	    <?php }?>
</div>
</div>
</section>
<section class="section p0 mb50 max_height xs_max_height">
<div class="row col-p0">
<div class="col-sm-4 col-sm-push-8 xs-box3">
<?php if($siteAds){?>
<h3 class="title-small"><?php echo __('Advertisements');?></h3>
<div class="box-services-d el_max_height xs-pt0">
<div class="owl-carousel owl-portfolio">
<?php foreach($advertisements as $value):$photoImg='advertisement_thumb/'.$value['Advertisement']['photo'];?>
<div class="owl-el">
<?php
$urlArr="#";
if(strlen($value['Advertisement']['url'])>0){
if($value['Advertisement']['url_type']=="External"){$urlArr=$value['Advertisement']['url'];}else{$urlArr=array('controller'=>$value['Advertisement']['url']);}}
echo $this->Html->link($this->Html->image($photoImg,array('alt'=>$value['Advertisement']['name'],'class'=>'img-responsive')),$urlArr,array('escape'=>false,'target'=>$value['Advertisement']['url_target']));?>
</div>
<?php endforeach;unset($value);?>
</div></div>
<?php }?>
</div>
<?php if($siteTestimonial){?>
<div class="col-sm-8 col-sm-pull-4 xs-box3">
<div class="section-testimonials mt70 el_max_height">
<h3 class="title-small mrg-left"><?php echo __('Testimonials');?></h3>
<div class="owl-carousel owl-portfolio">
<?php foreach($testimonials as $postTestimonial):?>
<div class="owl-el">
<blockquote>
<p><?php echo$postTestimonial['Testimonial']['description'];?></p>
<footer>
<h5><?php echo$postTestimonial['Testimonial']['name'];?></h5>
</footer>
</blockquote>
</div>
<?php endforeach;unset($postTestimonial);?>
</div>
</div>
</div>
</div>
<?php }?>
</section>