<div class="container">
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('View');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
    		<div class="panel-body">
		    <div class="table-responsive">
			<table class="table table-bordered">
			    <tr>
				<td><strong><small class="text-danger"><?php echo __('Name').':      ';?></small></strong><b><?php echo h($post['HomeworkPhonic']['student_name']);?></b></td>
			    </tr>
			    <tr>
			    <td><strong><small class="text-danger"><?php echo __('Question Type').':      ';?></small></strong><b><?php echo h($post['HomeworkPhonic']['question_type']);?></b></td>
			    </tr>
			    <tr>
			    <td><strong><small class="text-danger"><?php echo __('Question').':      ';?></small></strong><b><?php echo h($post['HomeworkPhonic']['question']);?></b></td>
			    </tr>		
			    <tr>
			    <td><strong><small class="text-danger"><?php echo __('Record').':      ';?></small></strong><b><?php echo $post['HomeworkPhonic']['record_location'];?></b></td>
			    </tr>
			    <tr>
			    <td><strong><small class="text-danger"><?php echo __('Mark').':      ';?></small></strong><b><?php echo $post['HomeworkPhonic']['mark'];?></b></td>
			    <audio controls>
  					<source src="<?php echo $post['HomeworkPhonic']['record_location'];?>" type="audio/ogg">
  				</audio>
			    </tr>		    
			</table>
		    </div>
		    <script>
				function getMark() {
					var m = document.getElementById("mark").value;
  					var q = document.getElementById("sid");
  					var qq = parseInt(q.textContent);
  					var i = String(qq);
    				$.ajax({
        				type: "POST",
        				url: "/../../app/webroot/design700/assets/scripts/mark.php",
        				data: { mark: m, id : i}
          			}).done(function(data) {
        			console.log(data);
      				});
				}
			</script>
		    <form>
  				Given Mark:<br>
  				<input id = "mark" type="text" name="mark" placeholder="Maximum: 10" >

  				<div id="sid" style="display: none;">
                	<?php $id = $post['HomeworkPhonic']['id'];
                  	echo htmlspecialchars($id);?> 
                </div>
  				<br><br>
  				<button onclick="getMark(this);">Submit</button>
			</form> 
			
		</div>
	    </div>
	</div>
    