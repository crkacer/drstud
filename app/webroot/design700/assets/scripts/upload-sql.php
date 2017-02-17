<?php
//App::uses('ConnectionManager', 'Model');
//==============SQL Insert into database======================

// $connection = ConnectionManager::getDataSource('default');
// write hard-coded connection parameters for the database
	define("SERVER", "localhost");
	define("DATABASE", "devdrstud");
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
$path = "/app/webroot/design700/assets/scripts/recordings/".$_POST['student'];
$subject = $_POST['subject'];
$query = "INSERT INTO student_homeworks (student_id, question_type, record_location, subject_id) VALUES (1, 'R'".",'$path',"."'$subject')";
// $data = $conn->execute($query);
$data = ConnectDB::execQuery($query);
echo $path;
echo $query;
echo "TRACE OUT";
echo $data;
?>