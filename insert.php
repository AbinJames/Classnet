<?php
  ob_start();
	session_start();
	require_once 'dbconnect.php';
	

	
		$id=$_SESSION['user'];
    
// clean user inputs to prevent sql injections
$name = $_POST['subject'];
$d = $_POST['eventdate'];
$today=date('Y-m-d',time());
$m = $_POST['message'];
// Create database
if($d<$today)
{
	echo '<script type="text/javascript">'; 
  echo 'alert("Select date after current date");'; 
  echo 'window.location.href = "events.php";';
  echo '</script>';
}
else
{
$sql = "INSERT INTO event (eventname,eventdate,message,userid) VALUES ('$name','$d','$m',$id)";
$res=$conn->query($sql);
header("Location:events.php");
}
?>