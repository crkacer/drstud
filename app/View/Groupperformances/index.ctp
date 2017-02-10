<?php echo $this->Session->flash();?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
	<div class="page-title"><?php echo __('Your performance compared to your group');?></div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
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