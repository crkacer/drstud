<?php
session_start();

$filename1 = $_SESSION['file'];

if(!is_dir("recordings")){
	$res = mkdir("recordings",0777); 
}

// pull the raw binary data from the POST array
$data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);
// decode it
$decodedData = base64_decode($data);
// print out the raw data, 
//echo ($decodedData);
$filename = 'audio_recording_' . date( 'Y-m-d-H-i-s' ) .'.mp3';
// $filename = $_COOKIE['file'];
echo $filename;
// write the data out to the file
$fp = fopen('recordings/'.$filename1, 'wb');
fwrite($fp, $decodedData);
fclose($fp);

?>
