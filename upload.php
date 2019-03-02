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


$img = $_POST['src'];
$query = "SELECT * from users where id = $id";
		 $result = $conn->query($query);
		 $member = mysqli_fetch_assoc($result);
		 $n=$member['nop'];
		 $n++;
$query = "UPDATE users set nop =$n where id = $id";
		 $result = $conn->query($query);
		 $query = "UPDATE users set profile = '$img' where id = $id";
		 $result = $conn->query($query);
	$query = "INSERT into profileimg (id, name) values ($id,'$img')";
		 $result = $conn->query($query);	

?>
