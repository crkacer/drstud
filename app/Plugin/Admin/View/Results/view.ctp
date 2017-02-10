<div class="container">
<?php echo $this->Session->flash();?>
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Exam Details');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
	    <div class="panel-body">
                    <div class="table-responsive"> 
			<table class="table">
			    <tr>
				<td>
				    <div class="chart">
				    <div id="piewrapperqc"></div>
				    <?php echo $this->HighCharts->render("Pie Chartqc");?>
				    </div>
				</td>
			    </tr>
			</table>
		    </div>
		    <div class="table-responsive"> 
			<table class="table">			
			    <tr>
				<td>
				    <div class="chart">
				    <div id="mywrapperdl"></div>
				    <?php echo $this->HighCharts->render("My Chartdl");?>
				    </div>
				</td>
			    </tr>
			</table>
		    </div>
                </div>
            </div>
        </div>