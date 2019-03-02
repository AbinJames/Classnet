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
$query = "SELECT * FROM files where id = $fid";
			$result = $conn->query($query);
			$row = mysqli_fetch_assoc( $result);
$url = $row['uname'];
echo $url;
$width = '100%';
$height = '600px';
echo '<iframe src="http://docs.google.com/viewer?url='.$url.'&embedded=true" style="width:600px; height:500px;" frameborder="0"></iframe>';
 ?>
</body>
</html>
<?php
?>