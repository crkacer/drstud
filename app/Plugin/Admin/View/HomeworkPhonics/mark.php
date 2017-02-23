<?php 
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
$mark = intval($_POST['mark']);
$query = "UPDATE homework_phonics SET mark = ".$mark." WHERE id = ".$_POST['id'];
echo $query;
$data = ConnectDB::execQuery($query);
header("Location: /admin/HomeworkPhonics/");
?>