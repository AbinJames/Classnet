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
?>
<!DOCTYPE html>
<html>
<body>
<?php
$fid=$_GET['id'];
$query = "SELECT * FROM notes where id = $fid";
			$result = $conn->query($query);
			$row = mysqli_fetch_assoc( $result);
echo '<object data="'.$row['ntitle'].'.txt" type="application/txt">
<p>'.$row['ncontent'].'
</object>';

 ?>
</body>
</html>