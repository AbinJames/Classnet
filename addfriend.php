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
	}
if(isset($_POST['add']))
{
	$fid=$_POST['add'];
	$sql="INSERT into friendlinks (uid,fid) values ($id,$fid)";
	$result=$conn->query($sql);
	echo $sql;
}
?>