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
		$st=mysqli_real_escape_string($conn,$_POST['str']);
		
		$t=$_POST['title'];
		$check=$_POST['check'];
  		$today = date('y/m/d h:m:s',time());

		if($check==1)
		{
		 $query = "INSERT into notes (id,ntitle,ncontent,created,updated) VALUES ($id,'$t','$st','$today','$today');";
		}
		else{
			$query = "UPDATE notes set updated = '$today' where ntitle='$t'";
			$result = $conn->query($query);
			$query = "UPDATE notes set ncontent = '$st' where ntitle='$t'";
			
		}
      		$result = $conn->query($query);
      		echo stripslashes(str_replace('\n',PHP_EOL,$st));;
	}
?>