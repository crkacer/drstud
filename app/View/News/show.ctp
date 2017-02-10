<div class="col-md-9">
    <div class="page-heading">
        <div class="widget">
            <h2 class="widget-title"><?php echo __('News Detail');?></h2>
        </div>
    </div>
        <?php echo $this->Session->flash();?>
            <div><strong><?php echo h($newsPost['News']['news_title']);?></strong></div><br/>
			<div><?php echo str_replace("<script","",($newsPost['News']['news_desc']));?></div>        
</div>