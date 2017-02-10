<?php echo $this->Session->flash();?>
<div class="" id="dashBoard">
               
	<div  id="upperDashBoard">                   
		<div class="dashBoardTitle">
			Dashboard
		</div>
		<div class="dashBoardUrl">
			Home / Profile
		</div>

		<form id="profileForm" class="form-horizontal">

			<div class="form-group">
				<label class="control-label col-sm-2" for="name">Name</label>
				<div class="col-sm-10">
					<input class="form-control" id="name" value="<?php echo h($post['Student']['name']);?>"/>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="dob">DOB</label>
				<div class="col-sm-10">
					<input class="form-control" id="dob" />
				</div>
			</div>
			<?php
			$groupVal = null;
			foreach($groupSelect as $groupValue) {
				$groupVal = $groupValue['Groups']['group_name'] ." ; ". $groupVal;
			}
			?>
			<div class="form-group">
				<label class="control-label col-sm-2" for="program">Program</label>
				<div class="col-sm-10">
					<input class="form-control" id="program" value="<?php echo $groupVal; ?>" />
				</div>
			</div>
			<? unset($groupVal); ?>
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Email</label>
				<div class="col-sm-10">
					<input class="form-control" id="email" value="<?php echo h($post['Student']['email']);?>"/>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="address">Address</label>
				<div class="col-sm-10">
					<input class="form-control" id="address" />
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="contact">Contact</label>
				<div class="col-sm-10">
					<input class="form-control" id="contact" value="<?php echo h($post['Student']['guardian_phone']);?>" />
				</div>
			</div>

			<div class="red">Expiration &nbsp;&nbsp;&nbsp; Sep/07/2016 ~ Oct/07/2016</div>
		</form>


	</div>                
</div>
      