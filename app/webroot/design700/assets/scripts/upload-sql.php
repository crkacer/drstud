<?php
//App::uses('ConnectionManager', 'Model');
//==============SQL Insert into database======================

// $connection = ConnectionManager::getDataSource('default');
// write hard-coded connection parameters for the database
session_start();

	define("SERVER", "localhost");
	define("DATABASE", "db1");
	define("USERNAME", "root");
	define("PASSWORD", "");

	class ConnectDB
	{
		public static function execQuery($sql)
		{
			$conn = mysqli_connect(SERVER, USERNAME, PASSWORD, DATABASE);
			if (!$conn) {
    			echo "Error: Unable to connect to MySQL." . PHP_EOL;
    			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  			  exit;
  			}
			$result = mysqli_query($conn, $sql);
			// if (!$result) {
      //       die("Query failed: " . mysql_error());
      //   }
      		mysqli_close($conn);
			return $result;
		}
	};
$question = intval($_POST['question']);
$filename = 'audio_recording_' . date( 'Y-m-d-H-i-s' ) .'.mp3';

$_SESSION['file'] = $filename;
// $play = "<p>1<iframe title="" src="http://www.youtube.com/embed/hfTjXYUXd2c?wmode=opaque&amp;theme=dark" width="640" height="385" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>";
$path = "/Applications/XAMPP/xamppfiles/htdocs/stud-6Feb/app/webroot/design700/assets/scripts/recordings/".$_POST['student']."/".$filename;
$play = '<p>1<iframe title="" src='."$path".' width="640" height="385" frameborder="0" allowfullscreen="allowfullscreen"'.'></iframe></p>';
$subject = $_POST['subject'];
$name = $_POST['stuname'];
$id = intval($_POST['student']);

// $preQuery = "SELECT 1 FROM homework_phonics WHERE student_id = "."$id"." AND question = "."$question";
// $d = ConnectDB::execQuery($preQuery);
// echo $d;
// if (ConnectDB::execQuery($preQuery)) {
// 	// check if exist 
// 	$query = "UPDATE homework_phonics SET record_location = "."'$path'"." WHERE student_id = "."$id"." AND question = "."$question";
// 	$data = ConnectDB::execQuery($query);
// 	echo "0";
// } else {
// 	$query = "INSERT INTO homework_phonics (student_id, student_name, question_type, record_location, subject_id, question) VALUES ("."$id".",'$name',"."'R'".",'$path',"."'$subject'".",'$question')";
// 	$data = ConnectDB::execQuery($query);
// 	echo "1";
// };

$query = "INSERT INTO homework_phonics (student_id, student_name, question_type, record_location, subject_id, question) VALUES ("."$id".",'$name',"."'R'".",'$path',"."'$subject'".",'$question')";
$data = ConnectDB::execQuery($query);


?>