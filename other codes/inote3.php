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
		$tid=$_GET['tid'];
	}
  ?>
	   <?php
		 $query = "SELECT * FROM notes where tid = $tid";
		 $result = $conn->query($query);
	
		 $row = mysqli_fetch_assoc( $result);
		 	echo $row['ncontent'];
      ?>
