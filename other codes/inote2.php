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
		$tid=$_POST['str'];
		 $query = "SELECT * from notes where id=$id and tid=$tid";
      		$result = $conn->query($query);
      		 $row = mysqli_fetch_assoc( $result);
      		 $st=$row['ncontent'];
      		echo stripslashes(str_replace('\n',PHP_EOL,$st));
	}
?>