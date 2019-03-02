<?php
session_start();

	require_once 'dbconnect.php';
	
	// it will never let you open index(login) page if session is set
	if ( !isset($_SESSION['user']) ) {
		header("Location: classNET.html");
		exit;
	}
	else{
		$id=$_SESSION['user'];
$fn=$_POST['opass'];
$query = "SELECT * users where id = $id and password = '$fn'";
$res=$conn->query($query);
$row_cnt = $res->num_rows;
            if($row_cnt != 0) {
            	echo "Not ok";
            }
 }
?>