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
				echo "</h3></p></div><div class=\"inner\"><button type=\"input\" name = \"remove\" value = \"";echo $fid;echo "\">Remove Member</button></div></div>";


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
				echo "</h3></p></div><div class=\"inner\"><button type=\"input\" name = \"remove\" value = \"";echo $fid;echo "\">Remove Member</button></div></div>";


				$n++;
			}
			?>
		</form>
		</div>
<div class="red">
		<form  align = "left" action="" method="post">
			
			<?php
			$query = "SELECT * FROM request where receiver=$id";
			$result = $conn->query($query);
			$cnt=$result->num_rows;
			echo '<h2>You have ';echo $cnt;echo ' friend requests</h2>';
			while( $r = mysqli_fetch_assoc( $result) )
			{			
				$fid=$r['sender'];
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
				echo "</h3></p></div><div class=\"inner\"><button type=\"input\" name = \"confirm\" value = \"";echo $fid;echo "\">Confirm Member</button></div></div>";


				$n++;
			}
			?>
		</form>
		</div>
		<div class="red">
			<form  align = "left" action="" method="post">
				<h2>Other Members</h2>
				<?php
				$query = "SELECT * FROM users";
				$result = $conn->query($query);
				$n=0;
				while( $row = mysqli_fetch_assoc( $result))
				{		
					if($row['id']!=$id)	
					{
						$fid=$row['id'];
						$q = "SELECT * FROM friendlinks where (uid=$id and fid=$fid) or (uid=$fid and fid=$id)";
						$r = $conn->query($q);
						if($r->num_rows==0)
						{
							$q2 = "SELECT * FROM request where (sender=$id and receiver=$fid) or (sender=$fid and receiver=$id)";
						$r2 = $conn->query($q2);
						if($r2->num_rows==0)
						{
							if($n%3==0)
								echo "<div>";


							echo "<div class=\"outer\"><div class=\"inner\"><img src=\""; 
							echo $row['profile'];
							echo "\" ></div><div class=\"inner\"><p><h3>";
							echo $row['firstname'];
							echo " ";
							echo $row['lastname'];
							echo "</h3></p></div><div class=\"inner\"><button type=\"input\" name = \"add\" value = \"";echo $fid;echo "\">Send Request</button></div></div>";


							$n++;
						}
					}
				}
				}
				?>
			</table>
		</form>
	</div>
</body>
</html>
<?php

if(isset($_POST['add']))
{
	$fid=$_POST['add'];
	$sql="INSERT into request (sender,receiver) values ($id,$fid)";
	$result=$conn->query($sql);
	unset($_POST['add']);
	echo '<script type="text/javascript">'; 
echo 'window.location.href = "profiles.php";';
echo '</script>';
}
else if(isset($_POST['remove']))
{
	$fid=$_POST['remove'];
	$sql="DELETE from friendlinks where (uid=$id and fid=$fid) or (uid=$fid and fid=$id)";
	$result=$conn->query($sql);
	unset($_POST['remove']);
	echo '<script type="text/javascript">'; 
echo 'window.location.href = "profiles.php";';
echo '</script>';
}
else if(isset($_POST['confirm']))
{
	$fid=$_POST['confirm'];
	$sql="INSERT into friendlinks (uid,fid) values ($id,$fid)";
	$result=$conn->query($sql);
	$sql="DELETE from request where receiver=$id and sender = $fid";
	$result=$conn->query($sql);
	unset($_POST['confirm']);
	echo '<script type="text/javascript">'; 
echo 'window.location.href = "profiles.php";';
echo '</script>';
}
else{
        //do nothing
    }
?>