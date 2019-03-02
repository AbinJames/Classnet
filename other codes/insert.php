<?php
  ob_start();
	session_start();
	require_once 'dbconnect.php';
	

	
		$id=$_SESSION['user'];
    
// clean user inputs to prevent sql injections
$name = $_POST['subject'];
$d = $_POST['eventdate'];
$m = $_POST['message'];
// Create database
$sql = "INSERT INTO event (eventname,eventdate,message,userid) VALUES ('$name','$d','$m',$id)";
$res=$conn->query($sql);
header("Location:events.php");
?>