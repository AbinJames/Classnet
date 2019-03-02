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
$nid=$_GET['id'];
?>

<!DOCTYPE html>
<html>
<body>

	<style>
		img {
			max-width:100px;
			max-height:100px;
			width:auto;
			height:auto;
			margin:auto;
			border-radius: 50%;
		}
		.red, .outer {
			-moz-box-sizing:    border-box;
			-webkit-box-sizing: border-box;
			box-sizing:        border-box;
		}

		.red {
			width:100%;
			overflow: hidden;
			padding: 1% 0 0 1%;
		}

		.outer
		{
			width: 100px;
			vertical-align:middle;
			display: table;
			float: left;
		}

		.inner
		{
			width: 100%;

			display: table-row;
			text-align: center;
			
		}
	</style>
	<div class="red">
		<form  align = "left" action="" method="post">
			<h2>Your Buddies</h2>
			<?php
			$query = "SELECT * FROM friendlinks where uid=$id";
			$result = $conn->query($query);
			$n=0;
			while( $r = mysqli_fetch_assoc( $result) )
			{			
				$fid=$r['fid'];
				if($n%3==0)
					echo "</div>";
				$q = "SELECT * FROM users where id=$fid";
				$res = $conn->query($q);
				$row = mysqli_fetch_assoc( $res);
				echo "<div class=\"outer\"><div class=\"inner\"><img src=\""; 
				echo $row['profile'];
				echo "\" ></div><div class=\"inner\"><p><h3>";
				echo $row['firstname'];
				echo " ";
				echo $row['lastname'];
				echo "</h3></p></div><div class=\"inner\"><button type=\"submit\" name = \"share\" value = \"";echo $fid;echo "\">Share</button></div></div>";


				$n++;
			}
			$query = "SELECT * FROM friendlinks where fid=$id";
			$result = $conn->query($query);
			while( $r = mysqli_fetch_assoc( $result) )
			{			
				$fid=$r['uid'];
				if($n%3==0)
					echo "</div>";
				$q = "SELECT * FROM users where id=$fid";
				$res = $conn->query($q);
				$row = mysqli_fetch_assoc( $res);
				echo "<div class=\"outer\"><div class=\"inner\"><img src=\""; 
				echo $row['profile'];
				echo "\" ></div><div class=\"inner\"><p><h3>";
				echo $row['firstname'];
				echo " ";
				echo $row['lastname'];
				echo "</h3></p></div><div class=\"inner\"><button type=\"submit\" name = \"share\" value = \"";echo $fid;echo "\">Share</button></div></div>";


				$n++;
			}
			?>
		</form>
		</div>

</body>
</html>
<?php
if(isset($_POST['share']))
{
	$query2 = "SELECT * FROM notes where tid=$nid";
			$result2 = $conn->query($query2);
			$row2 = mysqli_fetch_assoc( $result2);
	$fid=$_POST['share'];
	$today = date('y/m/d h:m:s',time());
	$t=$row2['ntitle'];
	$st=$row2['ncontent'];
	$st=mysqli_real_escape_string($conn,$st);
	$query = "SELECT * FROM users where id=$fid";
			$result = $conn->query($query);
		$r = mysqli_fetch_assoc( $result);
		$fname= $r['firstname']." ".$r['lastname'];
	$query3 = "INSERT into notes (id,ntitle,ncontent,created,updated,shared) VALUES ($fid,'$t','$st','$today','$today','$fname');";
		 $result3 = $conn->query($query3);

} 
?>