
<html>
<body>
<table>
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
$query = "SELECT * FROM users where id = $id";
		 $result = $conn->query($query);
	
		 $row = mysqli_fetch_assoc( $result);$link = $row['profile'];
		 echo "<td><img src = \"";echo $link; echo"\" height=\"240\" width=\"240\"></td>";
		 echo "<td><h2>Welcome ";echo $row['firstname'];echo " ";
		 	echo $row['lastname'];
		 	 echo "</td>";

?>
</table>
</body>
</html>
