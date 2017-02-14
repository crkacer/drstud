<?php
	include_once('/app/Config/database.php');

  	$sql = "select * from student_homeworks";
  	$student = 1;
  	$question = "R";
  	$location = ;
  	$subject = 6;
  	
  	$sql = "INSERT INTO student_homeworks (id ,student_id ,question_type ,record_location ,subject_id) VALUES (NULL ,  '$question',  '$location',  '$subject')";
  	return DATABASE_CONFIG::execQuery($sql);
?>